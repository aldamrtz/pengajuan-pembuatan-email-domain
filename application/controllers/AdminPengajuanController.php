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
        // Ambil data dari session
        $data['admin_name'] = $this->session->userdata('admin_name');
        $data['profile_image'] = $this->session->userdata('profile_image');
        // Ambil data dari model jika perlu
        $data['pengajuan_email'] = $this->EmailModel->getAllPengajuan();

        // Muat tampilan dengan data
        $this->load->view('admin_pengajuan', $data);
    }

    public function data_pengajuan_email() {
        // Ambil semua data dari tabel pengajuan_email
        $all_pengajuan_email = $this->EmailModel->getAllPengajuan();

        // Kelompokkan data berdasarkan status
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
        // Ambil semua data dari tabel pengajuan_domain
        $all_pengajuan_domain = $this->DomainModel->getAllPengajuan();

        // Kelompokkan data berdasarkan status
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

        // Update status di database
        $this->EmailModel->updateStatus($id, $status);

        // Redirect kembali ke halaman utama
        redirect('AdminPengajuanController/data_pengajuan_email');
    }

    public function updateStatusDomain() {
        $id = $this->input->post('id');
        $status = $this->input->post('status_pengajuan');

        // Update status di database
        $this->DomainModel->updateStatus($id, $status);

        // Redirect kembali ke halaman utama
        redirect('AdminPengajuanController/data_pengajuan_domain');
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