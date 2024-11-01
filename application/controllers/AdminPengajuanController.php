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
            redirect('LoginPengajuanController');
        }
    }

    public function index()
    {
        $data['program_studi'] = $this->EmailModel->getProgramStudi();
        $data['admin_name'] = $this->session->userdata('admin_name');
        $data['profile_image'] = $this->session->userdata('profile_image');
        $all_pengajuan_email = $this->EmailModel->getAllPengajuan();

        // Filter data berdasarkan status
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

    public function data_pengajuan_email()
    {
        $data['program_studi'] = $this->EmailModel->getProgramStudi();
        if (empty($data['email_diajukan'])) {
            $data['email_diajukan'] = [];
        }
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

    public function updateStatusEmail()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status_pengajuan');

        $this->EmailModel->updateStatus($id, $status);
        $pengajuan = $this->EmailModel->getPengajuanById($id);
        $nama_lengkap = $pengajuan->nama_lengkap;

        if ($status == 'Diproses') {
            $subject = 'Pembaruan Status Pengajuan Email';
            $message = '<p>Halo, ' . $nama_lengkap . ',</p>';
            $message .= '<p>Ada pembaruan terbaru terkait pengajuan pembuatan akun email Anda.</p>';
            $message .= '<p>Silakan cek halaman berikut untuk mengetahui status terbaru: <a href="' . base_url('EmailController/status_pengajuan_email') . '">cek status pengajuan</a>.</p>';
            $message .= '<p>Salam hormat,</p>';
            $message .= '<p>Tim Admin</p>';
            $this->sendEmail($pengajuan->email_pengguna, $subject, $message);
        } elseif ($status == 'Diverifikasi') {
            $subject = 'Pembaruan Status Pengajuan Email';
            $message = '<p>Halo, ' . $nama_lengkap . ',</p>';
            $message .= '<p>Ada pembaruan terbaru terkait pengajuan pembuatan akun email Anda.</p>';
            $message .= '<p>Silakan cek halaman berikut untuk mengetahui status terbaru: <a href="' . base_url('EmailController/status_pengajuan_email') . '">cek status pengajuan</a>.</p>';
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
        $nama_lengkap = $pengajuan->nama_lengkap;

        $to = $pengajuan->email_pengguna;
        $subject = 'Akun Email Anda Telah Dibuat';
        $message = '<p>Halo, ' . $nama_lengkap . ',</p>';
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
            'nama_lengkap' => $pengajuan->nama_lengkap,
            'email' => $pengajuan->email_diajukan,
        ];

        $this->EmailModel->insertToRegistered($registered_email_data);

        redirect('AdminPengajuanController/data_pengajuan_email');
    }

    public function deletePengajuanEmail()
    {
        $id = $this->input->post('id');
        $this->EmailModel->deletePengajuan($id);
        redirect('AdminPengajuanController/data_pengajuan_email');
    }

    public function editPengajuanEmail()
    {
        // Ambil data program studi dari model
        $data['program_studi'] = $this->EmailModel->getProgramStudi();

        $nim = $this->input->post('nim');
        $prodi = $this->input->post('prodi');
        $nama_lengkap = $this->input->post('nama_lengkap');
        $email_diajukan = $this->input->post('email_diajukan');
        $email_pengguna = $this->input->post('email_pengguna');

        // Update data di database
        $this->EmailModel->updatePengajuan($nim, $prodi, $nama_lengkap, $email_diajukan, $email_pengguna);
        $this->load->view('data_pengajuan_email', $data);
        redirect('AdminPengajuanController/data_pengajuan_email');
    }


    public function data_pengajuan_subdomain()
    {
        if (empty($data['subdomain_diajukan'])) {
            $data['subdomain_diajukan'] = [];
        }
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

    public function updateStatusSubDomain()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status_pengajuan');

        $this->SubDomainModel->updateStatus($id, $status);
        $pengajuan = $this->SubDomainModel->getPengajuanById($id);
        $penanggung_jawab = $pengajuan->penanggung_jawab;

        if ($status == 'Diproses') {
            $subject = 'Pembaruan Status Pengajuan Subdomain';
            $message = '<p>Halo, ' . $penanggung_jawab . ',</p>';
            $message .= '<p>Ada pembaruan terbaru terkait pengajuan pembuatan subdomain Anda.</p>';
            $message .= '<p>Silakan cek halaman berikut untuk mengetahui status terbaru: <a href="' . base_url('SubdomainController/status_pengajuan_subdomain') . '">cek status pengajuan</a>.</p>';
            $message .= '<p>Salam hormat,</p>';
            $message .= '<p>Tim Admin</p>';
            $this->sendEmail($pengajuan->email_penanggung_jawab, $subject, $message);
        } elseif ($status == 'Diverifikasi') {
            $subject = 'Pembaruan Status Pengajuan Subdomain';
            $message = '<p>Halo, ' . $penanggung_jawab . ',</p>';
            $message .= '<p>Ada pembaruan terbaru terkait pengajuan pembuatan subdomain Anda.</p>';
            $message .= '<p>Silakan cek halaman berikut untuk mengetahui status terbaru: <a href="' . base_url('SubdomainController/status_pengajuan_subdomain') . '">cek status pengajuan</a>.</p>';
            $message .= '<p>Salam hormat,</p>';
            $message .= '<p>Tim Admin</p>';
            $this->sendEmail($pengajuan->email_penanggung_jawab, $subject, $message);
        } elseif ($status == 'Selesai') {
            $subject = 'Sub Domain Anda Telah Dibuat';
            $message = '<p>Halo, ' . $penanggung_jawab . ',</p>';
            $message .= '<p>Kami menginformasikan bahwa sub domain Anda telah berhasil dibuat.</p>';
            $message .= '<p><strong>Detail:</strong></p>';
            $message .= '<p>Sub Domain: <strong>' . $pengajuan->sub_domain . '</strong></p>';
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

    public function deletePengajuanSubdomain()
    {
        $id = $this->input->post('id');
        $this->SubDomainModel->deletePengajuan($id);
        redirect('AdminPengajuanController/data_pengajuan_subdomain');
    }

    public function editPengajuanSubdomain()
    {
        $id_pengajuan_subdomain = $this->input->post('id_pengajuan_subdomain');
        $nomor_induk = $this->input->post('nomor_induk');
        $unit_kerja = $this->input->post('unit_kerja');
        $penanggung_jawab = $this->input->post('penanggung_jawab');
        $email_penanggung_jawab = $this->input->post('email_penanggung_jawab');
        $kontak_penanggung_jawab = $this->input->post('kontak_penanggung_jawab');
        $sub_domain = $this->input->post('sub_domain');
        $ip_pointing = $this->input->post('ip_pointing');
        $keterangan = $this->input->post('keterangan');

        // Update data di database
        $this->subDomainModel->updatePengajuan($id_pengajuan_subdomain, $nomor_induk, $unit_kerja, $penanggung_jawab, $email_penanggung_jawab, $kontak_penanggung_jawab, $sub_domain, $ip_pointing, $keterangan);

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
}
