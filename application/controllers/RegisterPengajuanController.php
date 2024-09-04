<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterPengajuanController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('RegisterPengajuanModel');
    }

    public function index() {
        $this->load->view('register_pengajuan');
    }

    public function prosesDaftar() {
        // Set validation rules
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[login_pengajuan.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('url', 'Profil Picture', 'callback_file_check');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, reload the form
            $this->load->view('register_pengajuan');
        } else {
            // Get the form data
            $email = $this->input->post('email');
            $password = md5($this->input->post('password')); // Encrypt the password
            $nama = $this->input->post('nama');
            
            // Handle file upload
            $config['upload_path'] = './uploads/profile/'; // Updated path
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // 2MB
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('url')) {
                // Get upload data
                $uploadData = $this->upload->data();

                // Rename the file based on the user's name
                $file_extension = $uploadData['file_ext'];
                $new_file_name = $nama . $file_extension;
                $new_file_path = $config['upload_path'] . $new_file_name;

                // Rename the uploaded file
                rename($uploadData['full_path'], $new_file_path);

                // Prepare data to save
                $data = array(
                    'email' => $email,
                    'password' => $password,
                    'nama' => $nama,
                    'profile_picture' => $new_file_name
                );

                // Insert data into database
                $insert = $this->RegisterPengajuanModel->insertUser($data);

                if ($insert) {
                    $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
                    redirect('LoginPengajuanController');
                } else {
                    $this->session->set_flashdata('error', 'Terjadi kesalahan. Silakan coba lagi.');
                    $this->load->view('register_pengajuan');
                }
            } else {
                // File upload failed
                $this->session->set_flashdata('error', $this->upload->display_errors());
                $this->load->view('register_pengajuan');
            }
        }
    }

    public function file_check($str){
        $allowed_mime_type_arr = array('image/jpeg','image/jpg','image/png');
        $mime = get_mime_by_extension($_FILES['url']['name']);
        if(isset($_FILES['url']['name']) && $_FILES['url']['name'] != ""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only jpg/jpeg/png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }
}
