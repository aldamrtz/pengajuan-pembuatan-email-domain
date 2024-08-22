<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('EmailModel');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index() {
        $data['captcha'] = $this->generateCaptcha();
        $this->load->view('pengajuan_email', $data);
    }

    public function submit() {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nim', 'Nomor Induk Mahasiswa', 'required');
        $this->form_validation->set_rules('prodi', 'Program Studi', 'required');
        $this->form_validation->set_rules('email_diajukan', 'Email yang Diajukan', 'required|valid_email|callback_checkEmailExistence');
        $this->form_validation->set_rules('email_pengguna', 'Email Pengguna', 'required|valid_email');

        // Cek apakah file KTM diupload
        if (empty($_FILES['ktm']['name'])) {
            $this->form_validation->set_rules('ktm', 'Kartu Tanda Mahasiswa', 'required');
        }

        $this->form_validation->set_rules('captcha', 'Captcha', 'required|callback_validateCaptcha');

        if ($this->form_validation->run() == FALSE) {
            $data['captcha'] = $this->generateCaptcha();
            $this->load->view('pengajuan_email', $data);
        } else {
            // Upload KTM
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
                    // Jika gagal mengupload, tambahkan pesan error
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('EmailController');
                }
            }

            // Menyimpan data ke database
            $data = array(
                'nama' => $this->input->post('nama'),
                'nim' => $this->input->post('nim'),
                'prodi' => $this->input->post('prodi'),
                'email_diajukan' => $this->generateEmail($this->input->post('email_diajukan')),
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

    public function generateCaptcha() {
        $captchaStr = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
        $this->session->set_userdata('captcha', $captchaStr);
        return $captchaStr;
    }

    public function validateCaptcha($input) {
        if ($input == $this->session->userdata('captcha')) {
            return TRUE;
        } else {
            $this->form_validation->set_message('validateCaptcha', 'Captcha yang dimasukkan salah.');
            return FALSE;
        }
    }

    public function generateEmail($emailPrefix) {
        $emailDomain = '@if.unjani.ac.id';
        $fullEmail = $emailPrefix . $emailDomain;

        // Check if the email already exists and append number if necessary
        $counter = 1;
        while ($this->EmailModel->isEmailExist($fullEmail)) {
            $fullEmail = $emailPrefix . $counter . $emailDomain;
            $counter++;
        }

        return $fullEmail;
    }
}
?>
