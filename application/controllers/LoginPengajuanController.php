<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginPengajuanController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('LoginPengajuanModel');
    }

    public function index() {
        $this->load->view('login_pengajuan');
    }

    public function login() {
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $captcha = $this->input->post('captcha');
        $session_captcha = $this->session->userdata('captcha');

        if ($captcha !== $session_captcha) {
            $this->session->set_flashdata('error', 'Captcha tidak valid.');
            redirect('LoginPengajuanController');
        }

        $admin = $this->LoginPengajuanModel->getAdmin($email, $password);

        if ($admin) {
            $this->session->set_userdata('admin_logged_in', TRUE);
            $this->session->set_userdata('admin_name', $admin['nama']); // Simpan nama admin ke session
            $this->session->set_userdata('profile_image', $admin['profile_picture']);
            redirect('AdminPengajuanController');
        } else {
            $this->session->set_flashdata('error', 'Email atau password salah.');
            redirect('LoginPengajuanController');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('LoginPengajuanController');
    }
}
?>
