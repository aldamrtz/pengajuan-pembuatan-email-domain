<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginPengajuanController extends CI_Controller
{

    private $recaptcha_secret;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('LoginPengajuanModel');

        $this->recaptcha_secret = '6Lf0PEQqAAAAACRlO3K96wdEZqJlS8qSfeD3IPCq';
    }

    public function index()
    {
        $this->load->view('login_pengajuan');
    }

    public function login()
    {
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $recaptcha_token = $this->input->post('recaptcha-token');

        if (empty($recaptcha_token)) {
            echo json_encode(['success' => false, 'error' => ['general' => 'Token reCAPTCHA tidak ditemukan.']]);
            return;
        }

        $response = $this->verifyRecaptcha($recaptcha_token);

        if (!$response['success'] || $response['score'] < 0.5) {
            echo json_encode(['success' => false, 'error' => ['general' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.']]);
            return;
        }

        $admin = $this->LoginPengajuanModel->getAdmin($email, $password);

        if ($admin) {
            $this->session->set_userdata('admin_logged_in', TRUE);
            $this->session->set_userdata('admin_name', $admin['nama']);
            echo json_encode(['success' => true]);
        } else {
            $emailExists = $this->LoginPengajuanModel->checkEmailExists($email);
            if (!$emailExists) {
                echo json_encode(['success' => false, 'error' => ['email' => 'Email tidak ditemukan']]);
            } else {
                echo json_encode(['success' => false, 'error' => ['password' => 'Password salah']]);
            }
        }
    }


    private function verifyRecaptcha($recaptcha_token)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => $this->recaptcha_secret,
            'response' => $recaptcha_token
        );

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ),
        );

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            return ['success' => false];
        }

        return json_decode($result, true);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('LoginPengajuanController');
    }
}
