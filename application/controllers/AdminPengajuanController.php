<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminPengajuanController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('EmailModel');
        $this->load->model('SubDomainModel');
        $this->load->model('AdminPengajuanModel');
        $this->load->helper('url');
        $this->load->library('session');
        $this->checkLogin();
    }

    private function checkLogin()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('loginpengajuancontroller');
        }
    }

    public function index()
    {
        $data['admin_name'] = $this->session->userdata('admin_name');
        $data['profile_image'] = $this->session->userdata('profile_image');
        $data['pengajuan_email'] = $this->EmailModel->getAllPengajuan();
        $this->load->view('admin_pengajuan', $data);
    }

    public function data_pengajuan_email()
    {
        $all_pengajuan_email = $this->EmailModel->getAllPengajuan();
        $data['email_diajukan'] = array_filter($all_pengajuan_email, function ($item) {
            return $item['status_pengajuan'] == 'Diajukan';
        });
        $data['email_diproses'] = array_filter($all_pengajuan_email, function ($item) {
            return $item['status_pengajuan'] == 'Diproses';
        });
        $data['email_diverifikasi'] = array_filter($all_pengajuan_email, function ($item) {
            return $item['status_pengajuan'] == 'Diverifikasi';
        });
        $data['email_dikirim'] = array_filter($all_pengajuan_email, function ($item) {
            return $item['status_pengajuan'] == 'Selesai';
        });

        $this->load->view('data_pengajuan_email', $data);
    }

    public function data_pengajuan_subdomain()
    {
        $all_pengajuan_subdomain = $this->SubDomainModel->getAllPengajuan();
        $data['subdomain_diajukan'] = array_filter($all_pengajuan_subdomain, function ($item) {
            return $item['status_pengajuan'] == 'Diajukan';
        });
        $data['subdomain_diproses'] = array_filter($all_pengajuan_subdomain, function ($item) {
            return $item['status_pengajuan'] == 'Diproses';
        });
        $data['subdomain_diverifikasi'] = array_filter($all_pengajuan_subdomain, function ($item) {
            return $item['status_pengajuan'] == 'Diverifikasi';
        });
        $data['subdomain_dikirim'] = array_filter($all_pengajuan_subdomain, function ($item) {
            return $item['status_pengajuan'] == 'Selesai';
        });

        $this->load->view('data_pengajuan_subdomain', $data);
    }

    public function updateStatusEmail()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status_pengajuan');

        $this->EmailModel->updateStatus($id, $status);
        $pengajuan = $this->EmailModel->getPengajuanById($id);

        if ($status == 'Diproses') {
            $subject = 'Status Pengajuan Email: Sedang Diproses';
            $message = '<p>Halo,</p>';
            $message .= '<p>Pengajuan pembuatan akun email Anda saat ini sedang dalam proses. Kami sedang memeriksa dan memproses permintaan Anda.</p>';
            $message .= '<p>Harap tunggu notifikasi lebih lanjut mengenai status pengajuan Anda. Terima kasih.</p>';
            $message .= '<p>Salam hormat,</p>';
            $message .= '<p>Tim Admin</p>';
            $this->sendEmail($pengajuan->email_pengguna, $subject, $message);
        } elseif ($status == 'Diverifikasi') {
            $subject = 'Status Pengajuan Email: Diverifikasi';
            $message = '<p>Halo,</p>';
            $message .= '<p>Pengajuan pembuatan akun email Anda telah berhasil diverifikasi.</p>';
            $message .= '<p>Kami akan segera memproses langkah berikutnya dan memberi tahu Anda jika ada pembaruan lebih lanjut.</p>';
            $message .= '<p>Terima kasih atas kerjasama Anda.</p>';
            $message .= '<p>Salam hormat,</p>';
            $message .= '<p>Tim Admin</p>';
            $this->sendEmail($pengajuan->email_pengguna, $subject, $message);
        }
        redirect('AdminPengajuanController/data_pengajuan_email');
    }

    public function sendEmailWithPassword()
    {
        $id = $this->input->post('id');
        $password = $this->input->post('password');
        $this->EmailModel->updateStatus($id, 'Selesai');
        $pengajuan = $this->EmailModel->getPengajuanById($id);
        $to = $pengajuan->email_pengguna;
        $subject = 'Akun Email Anda Telah Dibuat';
        $message = '<p>Halo,</p>';
        $message .= '<p>Kami menginformasikan bahwa akun email Anda telah berhasil dibuat.</p>';
        $message .= '<p><strong>Detail Akun:</strong></p>';
        $message .= '<p>Email: <strong>' . $pengajuan->email_diajukan . '</strong></p>';
        $message .= '<p>Password: <strong>' . $password . '</strong></p>';
        $message .= '<p>Silakan gunakan informasi ini untuk mengakses akun email Anda.</p>';
        $message .= '<p>Jika Anda memiliki pertanyaan lebih lanjut atau memerlukan bantuan, jangan ragu untuk menghubungi kami.</p>';
        $message .= '<p>Salam hormat,</p>';
        $message .= '<p>Tim Admin</p>';
        $this->sendEmail($to, $subject, $message);

        $registered_email_data = [
            'nim' => $pengajuan->nim,
            'prodi' => $pengajuan->prodi,
            'nama_depan' => $pengajuan->nama_depan,
            'nama_belakang' => $pengajuan->nama_belakang,
            'email' => $pengajuan->email_diajukan,
        ];

        // Insert data ke tabel email_terdaftar
        $this->EmailModel->insertToRegistered($registered_email_data);

        redirect('AdminPengajuanController/data_pengajuan_email');
    }

    public function updateStatusSubDomain()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status_pengajuan');

        $this->SubDomainModel->updateStatus($id, $status);
        $pengajuan = $this->SubDomainModel->getPengajuanById($id);

        if ($status == 'Diproses') {
            $subject = 'Status Pengajuan Sub Domain: Sedang Diproses';
            $message = '<p>Halo,</p>';
            $message .= '<p>Pengajuan pembuatan sub domain Anda saat ini sedang dalam proses. Kami sedang memeriksa dan memproses permintaan Anda.</p>';
            $message .= '<p>Harap tunggu notifikasi lebih lanjut mengenai status pengajuan Anda. Terima kasih.</p>';
            $message .= '<p>Salam hormat,</p>';
            $message .= '<p>Tim Admin</p>';
            $this->sendEmail($pengajuan->email_penanggung_jawab, $subject, $message);
        } elseif ($status == 'Diverifikasi') {
            $subject = 'Status Pengajuan Sub Domain: Diverifikasi';
            $message = '<p>Halo,</p>';
            $message .= '<p>Pengajuan pembuatan sub domain Anda telah berhasil diverifikasi.</p>';
            $message .= '<p>Kami akan segera memproses langkah berikutnya dan memberi tahu Anda jika ada pembaruan lebih lanjut.</p>';
            $message .= '<p>Terima kasih atas kerjasama Anda.</p>';
            $message .= '<p>Salam hormat,</p>';
            $message .= '<p>Tim Admin</p>';
            $this->sendEmail($pengajuan->email_penanggung_jawab, $subject, $message);
        } elseif ($status == 'Selesai') {
            $subject = 'Sub Domain Anda Telah Dibuat';
            $message = '<p>Halo,</p>';
            $message .= '<p>Kami menginformasikan bahwa sub domain Anda telah berhasil dibuat.</p>';
            $message .= '<p><strong>Detail:</strong></p>';
            $message .= '<p>Sub Domain: <strong>' . $pengajuan->sub_domain . '</strong></p>';
            $message .= '<p>Silakan gunakan informasi ini untuk mengakses akun email Anda.</p>';
            $message .= '<p>Jika Anda memiliki pertanyaan lebih lanjut atau memerlukan bantuan, jangan ragu untuk menghubungi kami.</p>';
            $message .= '<p>Salam hormat,</p>';
            $message .= '<p>Tim Admin</p>';
            $this->sendEmail($pengajuan->email_penanggung_jawab, $subject, $message);

            $registered_subdomain_data = [
                'nomor_induk' => $pengajuan->nomor_induk,
                'unit_kerja' => $pengajuan->unit_kerja,
                'penanggung_jawab' => $pengajuan->penanggung_jawab,
                'sub_domain' => $pengajuan->sub_domain,
            ];
            $this->SubDomainModel->insertToRegistered($registered_subdomain_data);
        }

        redirect('AdminPengajuanController/data_pengajuan_subdomain');
    }

    public function sendEmail($to, $subject, $message)
    {
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

    public function getNotifications()
    {
        $this->load->model('NotificationModel');
        $notifications = $this->NotificationModel->getAllNotifications();
        echo json_encode($notifications);
    }

    public function clearAllNotifications()
    {
        $this->load->model('NotificationModel');
        $this->NotificationModel->clearAllNotifications();
        echo json_encode(['status' => 'success']);
    }
}
