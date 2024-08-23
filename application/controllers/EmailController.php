<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('EmailModel');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $this->load->view('pengajuan_email');
    }

    public function submit() {
        // Dapatkan input dari user
        $email_diajukan = $this->input->post('email_diajukan');
        
        // Tambahkan domain @if.unjani.ac.id jika belum ada
        if (strpos($email_diajukan, '@if.unjani.ac.id') === false) {
            $email_diajukan .= '@if.unjani.ac.id';
        }
        
        // Set input email yang sudah ditambahkan domain
        $_POST['email_diajukan'] = $email_diajukan;

        // Validasi form
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nim', 'Nomor Induk Mahasiswa', 'required');
        $this->form_validation->set_rules('prodi', 'Program Studi', 'required');
        $this->form_validation->set_rules('email_diajukan', 'Email yang Diajukan', 'required|valid_email|callback_checkEmailExistence');
        $this->form_validation->set_rules('email_pengguna', 'Email Pengguna', 'required|valid_email');

        // Validasi file KTM
        if (empty($_FILES['ktm']['name'])) {
            $this->form_validation->set_rules('ktm', 'Kartu Tanda Mahasiswa', 'required');
        }

        $this->form_validation->set_rules('captcha', 'Captcha', 'required|callback_validateCaptcha');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pengajuan_email');
        } else {
            $ktm = '';
            if (!empty($_FILES['ktm']['name'])) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                $config['file_name'] = $this->input->post('nim').'_ktm';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('ktm')) {
                    $uploadData = $this->upload->data();
                    $ktm = $uploadData['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('EmailController');
                }
            }

            $data = array(
                'nama' => $this->input->post('nama'),
                'nim' => $this->input->post('nim'),
                'prodi' => $this->input->post('prodi'),
                'email_diajukan' => $email_diajukan,
                'email_pengguna' => $this->input->post('email_pengguna'),
                'ktm' => $ktm
            );

            if ($this->EmailModel->insert($data)) {
                $this->session->set_flashdata('success', 'Pengajuan email berhasil dikirim.');
            } else {
                $this->session->set_flashdata('error', 'Pengajuan gagal. NIM sudah terdaftar.');
            }

            redirect('EmailController');
        }
    }
    
    public function checkEmailExistence($email) {
        if ($this->EmailModel->isEmailExist($email)) {
            $this->form_validation->set_message('checkEmailExistence', 'Email yang diajukan sudah ada, silakan coba email lain.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function generateEmail($emailPrefix) {
        $emailDomain = '@if.unjani.ac.id';
        $fullEmail = $emailPrefix . $emailDomain;

        $counter = 1;
        while ($this->EmailModel->isEmailExist($fullEmail)) {
            $fullEmail = $emailPrefix . $counter . $emailDomain;
            $counter++;
        }

        return $fullEmail;
    }

    public function check_email_availability() {
        $email_prefix = $this->input->post('email_diajukan');
        $email_full = $email_prefix . '@if.unjani.ac.id';

        if ($this->EmailModel->isEmailExist($email_full)) {
            // Generate alternative usernames
            $suggestions = [];
            $counter = 1;
            while(count($suggestions) < 3) {
                $new_username = $email_prefix . $counter;
                $new_email = $new_username . '@if.unjani.ac.id';
                if (!$this->EmailModel->isEmailExist($new_email)) {
                    $suggestions[] = $new_username;
                }
                $counter++;
            }

            echo json_encode([
                'status' => 'taken',
                'suggestions' => $suggestions
            ]);
        } else {
            echo json_encode(['status' => 'available']);
        }
    }

    public function validateCaptcha($input) {
        if ($input == $this->session->userdata('captcha')) {
            return TRUE;
        } else {
            $this->form_validation->set_message('validateCaptcha', 'Captcha yang dimasukkan salah.');
            return FALSE;
        }
    }
}
?>