<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminPengajuanController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('EmailModel');
        $this->load->model('DomainModel');
        $this->load->model('AdminPengajuanModel');
        $this->load->helper('url');
        $this->load->library('session');
        $this->checkLogin();
    }

    private function checkLogin() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('loginpengajuancontroller');
        }
    }

    public function index() {
        $data['admin_name'] = $this->session->userdata('admin_name');
        $data['profile_image'] = $this->session->userdata('profile_image');
        $data['pengajuan_email'] = $this->EmailModel->getAllPengajuan();
        $this->load->view('admin_pengajuan', $data);
    }

    public function data_pengajuan_email() {
        $all_pengajuan_email = $this->EmailModel->getAllPengajuan();
        $data['email_diajukan'] = array_filter($all_pengajuan_email, function($item) {
            return $item['status_pengajuan'] == 'Email Diajukan';
        });
        $data['email_diproses'] = array_filter($all_pengajuan_email, function($item) {
            return $item['status_pengajuan'] == 'Email Diproses';
        });
        $data['email_diverifikasi'] = array_filter($all_pengajuan_email, function($item) {
            return $item['status_pengajuan'] == 'Email Diverifikasi';
        });
        $data['email_dikirim'] = array_filter($all_pengajuan_email, function($item) {
            return $item['status_pengajuan'] == 'Email Dikirim';
        });

        $this->load->view('data_pengajuan_email', $data);
    }

    public function data_pengajuan_domain() {
        $all_pengajuan_domain = $this->DomainModel->getAllPengajuan();
        $data['domain_diajukan'] = array_filter($all_pengajuan_domain, function($item) {
            return $item['status_pengajuan'] == 'Domain Diajukan';
        });
        $data['domain_diproses'] = array_filter($all_pengajuan_domain, function($item) {
            return $item['status_pengajuan'] == 'Domain Diproses';
        });
        $data['domain_diverifikasi'] = array_filter($all_pengajuan_domain, function($item) {
            return $item['status_pengajuan'] == 'Domain Diverifikasi';
        });
        $data['domain_dikirim'] = array_filter($all_pengajuan_domain, function($item) {
            return $item['status_pengajuan'] == 'Domain Dikirim';
        });

        $this->load->view('data_pengajuan_domain', $data);
    }

    public function updateStatusEmail() {
        $id = $this->input->post('id');
        $status = $this->input->post('status_pengajuan');

        $this->EmailModel->updateStatus($id, $status);
        $pengajuan = $this->EmailModel->getPengajuanById($id);
        $to = $pengajuan->email_pengguna;
        
        if ($status == 'Email Diproses') {
            $subject = 'Status Pengajuan Email: Sedang Diproses';
            $message = 'Pengajuan email Anda sedang diproses. Harap tunggu notifikasi lebih lanjut.';
            $this->sendEmail($to, $subject, $message);
        } elseif ($status == 'Email Diverifikasi') {
            $subject = 'Status Pengajuan Email: Diverifikasi';
            $message = 'Pengajuan email Anda telah diverifikasi.';
            $this->sendEmail($to, $subject, $message);
        } elseif ($status == 'Email Dikirim') {
            $subject = 'Akun Email Anda Telah Dibuat';
            $message = 'Email: ' . $pengajuan->email_diajukan . '<br>Password: ' . $pengajuan->password;
            $this->sendEmail($to, $subject, $message);
        }
        
        redirect('AdminPengajuanController/data_pengajuan_email');
    }

    public function updateStatusDomain() {
        $id = $this->input->post('id');
        $status = $this->input->post('status_pengajuan');

        $this->DomainModel->updateStatus($id, $status);

        $pengajuan = $this->DomainModel->getPengajuanById($id);
        $to = $pengajuan->email_penanggung_jawab;
        
        if ($status == 'Domain Diproses') {
            $subject = 'Status Pengajuan Domain: Sedang Diproses';
            $message = 'Pengajuan domain Anda sedang diproses. Harap tunggu notifikasi lebih lanjut.';
            $this->sendEmail($to, $subject, $message);
        } elseif ($status == 'Domain Diverifikasi') {
            $subject = 'Status Pengajuan Domain: Diverifikasi';
            $message = 'Pengajuan domain Anda telah diverifikasi.';
            $this->sendEmail($to, $subject, $message);
        } elseif ($status == 'Domain Dikirim') {
            $subject = 'Domain Telah Dikirim';
            $message = 'Sub Domain: ' . $pengajuan->sub_domain . '<br>IP Pointing: ' . $pengajuan->ip_pointing;
            $this->sendEmail($to, $subject, $message);
        }

        redirect('AdminPengajuanController/data_pengajuan_domain');
    }

    public function sendEmail($to, $subject, $message) {
        $this->load->library('email');
        
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'aldaamorita@gmail.com', // Ganti dengan email kamu
            'smtp_pass' => 'iftxvtcfydxwalsy',        // Ganti dengan password email kamu
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'wordwrap'  => TRUE
        );
        
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        
        $this->email->from('aldaamorita@gmail.com', 'Admin Unjani');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function getNotifications() {
        $this->load->model('NotificationModel');
        $notifications = $this->NotificationModel->getAllNotifications();
        echo json_encode($notifications);
    }

    public function deleteNotification($id) {
        $this->load->model('NotificationModel');
        $this->NotificationModel->deleteNotification($id);
        echo json_encode(['status' => 'success']);
    }

    public function clearAllNotifications() {
        $this->load->model('NotificationModel');
        $this->NotificationModel->clearAllNotifications();
        echo json_encode(['status' => 'success']);
    }
}
?>
