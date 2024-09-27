<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SubDomainController extends CI_Controller
{

    private $recaptcha_secret;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SubDomainModel');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');

        $this->recaptcha_secret = '6Lf0PEQqAAAAACRlO3K96wdEZqJlS8qSfeD3IPCq';
    }

    public function index()
    {
        $data['unit_kerja'] = $this->SubDomainModel->getUnitKerja();
        $this->load->view('pengajuan_subdomain', $data);
    }

    public function submit()
    {
        $recaptcha_token = $this->input->post('recaptcha-token');

        if (empty($recaptcha_token)) {
            $this->session->set_flashdata('error', 'Token reCAPTCHA tidak ditemukan.');
            redirect('SubDomainController');
        }

        $response = $this->verifyRecaptcha($recaptcha_token);

        if (!$response['success'] || $response['score'] < 0.5) {
            $this->session->set_flashdata('error', 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.');
            redirect('SubDomainController');
        }

        $sub_domain_diajukan = $this->input->post('sub_domain');

        $sub_domain_diajukan = 'https://' . $sub_domain_diajukan . '.unjani.ac.id';
        $unit_kerja = $this->input->post('unit_kerja');

        $_POST['sub_domain'] = $sub_domain_diajukan;
        $this->form_validation->set_rules('penanggung_jawab', 'Penanggung Jawab', 'required');
        $this->form_validation->set_rules('email_penanggung_jawab', 'Email Penanggung Jawab', 'required|valid_email');
        $this->form_validation->set_rules('nomor_induk', 'Nomor Induk', 'required');
        $this->form_validation->set_rules('unit_kerja', 'Unit Kerja', 'required');
        $this->form_validation->set_rules('sub_domain', 'Sub Domain yang Diajukan', 'required|callback_checkSubDomainExistence');
        $this->form_validation->set_rules('kontak_penanggung_jawab', 'Kontak Penanggung Jawab', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['unit_kerja'] = $this->SubDomainModel->getUnitKerja();
            $data['form_data'] = $this->input->post();
            $this->load->view('pengajuan_subdomain', $data);
        } else {
            $unit_kerja = $this->input->post('unit_kerja');

            $data = array(
                'penanggung_jawab' => $this->input->post('penanggung_jawab'),
                'email_penanggung_jawab' => $this->input->post('email_penanggung_jawab'),
                'nomor_induk' => $this->input->post('nomor_induk'),
                'unit_kerja' => $this->input->post('unit_kerja'),
                'sub_domain' => $sub_domain_diajukan,
                'kontak_penanggung_jawab' => $this->input->post('kontak_penanggung_jawab'),
                'keterangan' => $this->input->post('keterangan'),
                'ip_pointing' => $this->input->post('ip_pointing'),
                'tgl_pengajuan' => date('Y-m-d')
            );

            if ($this->SubDomainModel->insert($data)) {
                $this->session->set_flashdata('success', 'Pengajuan sub domain berhasil dikirim.');
                $this->sendNotificationEmail($data['email_penanggung_jawab'], $data);
            } else {
                $this->session->set_flashdata('error', 'Pengajuan gagal. Nomor Induk sudah terdaftar.');
            }

            $this->load->model('NotificationModel');
            $notification_data = [
                'user' => $this->input->post('email_penanggung_jawab'),
                'type' => 'subdomain',
            ];
            $this->NotificationModel->insertNotification($notification_data);

            redirect('SubDomainController');
        }
    }

    public function sendNotificationEmail($email_penanggung_jawab, $data)
    {
        $this->load->library('email');

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'aldaamorita@gmail.com', // Ganti dengan email kamu
            'smtp_pass' => 'iftxvtcfydxwalsy', // Ganti dengan password email kamu
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'wordwrap'  => TRUE
        );

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from($email_penanggung_jawab, 'Pengajuan Sub Domain');
        $this->email->to('aldaamorita@gmail.com'); // Ganti dengan email admin
        $this->email->subject('Pengajuan Pembuatan Sub Domain Baru');

        // Message with more details and a "View Details" button
        $message = '<p>Halo Admin,</p>';
        $message .= '<p style="font-size: 14px; color: #333;">Terdapat pengajuan baru untuk pembuatan sub domain dengan rincian sebagai berikut:</p>';

        // Create table to align the colons
        $message .= '<table style="font-size: 14px; color: #333;">';
        $message .= '<tr><td style="padding-right: 20px;"><strong>Nama Penanggung Jawab</strong></td><td>:</td><td>' . $data['penanggung_jawab'] . '</td></tr>';
        $message .= '<tr><td style="padding-right: 20px;"><strong>Nomor Induk</strong></td><td>:</td><td>' . $data['nomor_induk'] . '</td></tr>';
        $message .= '<tr><td style="padding-right: 20px;"><strong>Unit Kerja</strong></td><td>:</td><td>' . $data['unit_kerja'] . '</td></tr>';
        $message .= '</table>';

        // View Details button linking to the admin dashboard
        $message .= '<p>Untuk meninjau lebih lanjut, silakan klik tombol di bawah ini:</p>';
        $message .= '<p><a href="' . base_url('AdminPengajuanController/data_pengajuan_subdomain') . '" style="display: inline-block; padding: 10px 20px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px;">Lihat Selengkapnya</a></p>';

        // Footer
        $message .= '<p>Terima kasih atas perhatian Anda.</p>';
        $message .= '<p style="font-size: 12px; color: #888;">Email ini dikirim secara otomatis. Mohon untuk tidak membalas email ini.</p>';

        $this->email->message($message);

        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function validateSubDomain($sub_domain)
    {
        // Pola validasi yang baru
        $lengthPattern = '/^.{6,63}$/'; // Panjang antara 6-63 karakter
        $contentPattern = '/^[a-z0-9\-\.]+$/'; // Memungkinkan huruf kecil, angka, tanda hubung (-), dan titik (.)
        $consecutiveHyphenPattern = '/--/'; // Dua tanda hubung berturut-turut
        $consecutiveDotPattern = '/\.\./'; // Dua titik berturut-turut
        $startEndHyphenPattern = '/^-|-$/'; // Tanda hubung tidak boleh di awal atau akhir
        $startEndDotPattern = '/^\.|.$/'; // Titik tidak boleh di awal atau akhir
        $hyphenDotFollowingPattern = '/[-]\./'; // Tanda hubung tidak boleh diikuti oleh titik
        $dotHyphenFollowingPattern = '/\.[-]/'; // Titik tidak boleh diikuti oleh tanda hubung

        // Validasi panjang
        if (!preg_match($lengthPattern, $sub_domain)) {
            $this->form_validation->set_message('validateSubDomain', 'Sub domain yang diajukan harus terdiri dari 6-63 karakter.');
            return FALSE;
        }

        // Validasi karakter
        if (!preg_match($contentPattern, $sub_domain)) {
            $this->form_validation->set_message('validateSubDomain', 'Hanya huruf kecil (a-z), angka (0-9), tanda hubung (-), dan titik (.) yang diizinkan.');
            return FALSE;
        }

        // Validasi dua tanda hubung berturut-turut
        if (preg_match($consecutiveHyphenPattern, $sub_domain)) {
            $this->form_validation->set_message('validateSubDomain', 'Sub domain tidak boleh mengandung dua tanda hubung berturut-turut.');
            return FALSE;
        }

        // Validasi dua titik berturut-turut
        if (preg_match($consecutiveDotPattern, $sub_domain)) {
            $this->form_validation->set_message('validateSubDomain', 'Sub domain tidak boleh mengandung dua titik berturut-turut.');
            return FALSE;
        }

        // Validasi tanda hubung di awal dan akhir
        if (preg_match($startEndHyphenPattern, $sub_domain)) {
            $this->form_validation->set_message('validateSubDomain', 'Sub domain tidak boleh dimulai atau diakhiri dengan tanda hubung (-).');
            return FALSE;
        }

        // Validasi titik di awal dan akhir
        if (preg_match($startEndDotPattern, $sub_domain)) {
            $this->form_validation->set_message('validateSubDomain', 'Titik (.) tidak boleh di awal atau akhir sub domain.');
            return FALSE;
        }

        // Validasi tanda hubung tidak diikuti oleh titik
        if (preg_match($hyphenDotFollowingPattern, $sub_domain)) {
            $this->form_validation->set_message('validateSubDomain', 'Tanda hubung (-) tidak boleh diikuti oleh titik (.).');
            return FALSE;
        }

        // Validasi titik tidak diikuti oleh tanda hubung
        if (preg_match($dotHyphenFollowingPattern, $sub_domain)) {
            $this->form_validation->set_message('validateSubDomain', 'Titik (.) tidak boleh diikuti oleh tanda hubung (-).');
            return FALSE;
        }

        return TRUE; // Validasi berhasil
    }

    public function checkSubDomainExistence($sub_domain)
    {
        // Cek di tabel pengajuan_subdomain
        if ($this->SubDomainModel->isSubDomainExist($sub_domain)) {
            $this->form_validation->set_message('checkSubDomainExistence', 'Sub Domain sudah terdaftar');
            return FALSE;
        }

        // Cek di tabel subdomain_terdaftar
        if ($this->SubDomainModel->isSubDomainExistInRegistered($sub_domain)) {
            $this->form_validation->set_message('checkSubDomainExistence', 'Sub domain sudah terdaftar');
            return FALSE;
        }

        return TRUE;
    }

    public function check_subdomain_availability()
    {
        $sub_domain_prefix = $this->input->post('sub_domain_prefix');

        // Remove the protocol and domain part for the check
        $sub_domain_prefix = str_replace(['https://', 'http://', '.unjani.ac.id'], '', $sub_domain_prefix);

        $exists = $this->SubDomainModel->checkSubDomainExists($sub_domain_prefix);

        if ($exists) {
            // Subdomain is taken
            echo json_encode(['status' => 'taken']);
        } else {
            echo json_encode(['status' => 'available']);
        }
    }

    private function verifyRecaptcha($recaptcha_token)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => $this->recaptcha_secret,
            'response' => $recaptcha_token
        );

        // Kirim permintaan POST ke server Google reCAPTCHA
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
            // Jika gagal menghubungi API reCAPTCHA
            return ['success' => false];
        }

        return json_decode($result, true);
    }
}
