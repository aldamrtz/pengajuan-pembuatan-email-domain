<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DomainController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('DomainModel');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data['unit_kerja'] = $this->DomainModel->getUnitKerja();
        $this->load->view('pengajuan_domain', $data);
    }

    public function submit() {
        // Dapatkan input dari user
        $sub_domain_diajukan = $this->input->post('sub_domain');
        $unit_kerja = $this->input->post('unit_kerja');

        // Tambahkan domain berdasarkan unit kerja
        $domain = $this->getDomainByUnitKerja($unit_kerja);
        if (strpos($sub_domain_diajukan, $domain) === false) {
            $sub_domain_diajukan .= $domain;
        }
        
        // Set input domain yang sudah ditambahkan domain
        $_POST['sub_domain_diajukan'] = $sub_domain_diajukan;

        // Validasi form
        $this->form_validation->set_rules('penanggung_jawab', 'Penanggung Jawab', 'required');
        $this->form_validation->set_rules('email_penanggung_jawab', 'Email Penanggung Jawab', 'required|valid_email');
        $this->form_validation->set_rules('nomor_induk', 'Nomor Induk', 'required');
        $this->form_validation->set_rules('unit_kerja', 'Unit Kerja', 'required');
        $this->form_validation->set_rules('sub_domain_diajukan', 'Sub Domain yang Diajukan', 'required|callback_checkSubDomainExistence');
        $this->form_validation->set_rules('kontak_penanggung_jawab', 'Kontak Penanggung Jawab', 'required');

        // Validasi captcha
        $this->form_validation->set_rules('captcha', 'Captcha', 'required|callback_validateCaptcha');

        if ($this->form_validation->run() == FALSE) {
            $data['unit_kerja'] = $this->DomainModel->getUnitKerja();
            $data['form_data'] = $this->input->post();
            $this->load->view('pengajuan_domain', $data);
        } else {
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

            if ($this->DomainModel->insert($data)) {
                $this->session->set_flashdata('success', 'Pengajuan domain berhasil dikirim.');
            } else {
                $this->session->set_flashdata('error', 'Pengajuan gagal. Nomor Induk sudah terdaftar.');
            }

            $this->load->model('NotificationModel');
            $notification_data = [
                'user' => $this->input->post('sub_domain_diajukan'),
                'type' => 'domain',
            ];
            $this->NotificationModel->insertNotification($notification_data);

            redirect('DomainController');
        }
    }

    public function validateSubDomain($sub_domain) {
        $lengthPattern = '/^.{6,30}$/';
        $contentPattern = '/^[a-zA-Z0-9.]+$/';

        if (!preg_match($lengthPattern, $sub_domain)) {
            $this->form_validation->set_message('validateSubDomain', 'Sub domain yang diajukan harus terdiri dari 6-30 karakter.');
            return FALSE;
        }

        if (!preg_match($contentPattern, $sub_domain)) {
            $this->form_validation->set_message('validateSubDomain', 'Hanya berisi huruf, angka, atau titik yang diizinkan.');
            return FALSE;
        }

        return TRUE;
    }

    public function checkSubDomainExistence($sub_domain) {
        if ($this->DomainModel->isSubDomainExist($sub_domain)) {
            $this->form_validation->set_message('checkSubDomainExistence', 'Sub domain yang diajukan sudah ada, silakan coba sub domain lain.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function getDomainByUnitKerja($unit_kerja) {
        $domains = [
            'Informatika' => '@if.unjani.ac.id',
            'Sistem Informasi' => '@si.unjani.ac.id'
            // Tambahkan domain lain sesuai kebutuhan
        ];

        return isset($domains[$unit_kerja]) ? $domains[$unit_kerja] : '@if.unjani.ac.id'; // Default domain
    }

    public function check_domain_availability() {
        $sub_domain_prefix = $this->input->post('sub_domain_prefix');
        $unit_kerja = $this->input->post('unit_kerja');
        $domain = $this->getDomainByUnitKerja($unit_kerja);
        $sub_domain_full = $sub_domain_prefix . $domain;

        if ($this->DomainModel->isSubDomainExist($sub_domain_full)) {
            $suggestions = [];
            $penanggung_jawab = strtolower(str_replace(' ', '', $this->input->post('penanggung_jawab')));

            // Generate suggestions for the radio button (with domain)
            $suggestionsWithDomain = [
                $penanggung_jawab . $domain,
                substr($penanggung_jawab, 0, 1) . $domain
            ];

            $suggestionsWithDomain = array_filter($suggestionsWithDomain, function($suggestion) use ($domain) {
                return !$this->DomainModel->isSubDomainExist($suggestion);
            });

            // Generate suggestions for email feedback (without domain)
            $suggestionsWithoutDomain = [
                $penanggung_jawab,
                $penanggung_jawab . rand(100, 999)
            ];

            // Filter out suggestions that appear in radio buttons
            $suggestionsWithoutDomain = array_diff($suggestionsWithoutDomain, array_map(function($suggestion) use ($domain) {
                return str_replace($domain, '', $suggestion);
            }, $suggestionsWithDomain));

            $suggestionsWithoutDomain = array_filter($suggestionsWithoutDomain, function($suggestion) use ($domain) {
                return !$this->DomainModel->isSubDomainExist($suggestion . $domain);
            });

            echo json_encode([
                'status' => 'taken',
                'suggestions' => array_slice($suggestionsWithoutDomain, 0, 3),
                'radioSuggestions' => $suggestionsWithDomain
            ]);
        } else {
            echo json_encode(['status' => 'available']);
        }
    }

    public function generateSuggestions() {
        $penanggung_jawab = strtolower(str_replace(' ', '', $this->input->post('penanggung_jawab')));
        $unit_kerja = $this->input->post('unit_kerja');
        
        $domain = $this->getDomainByUnitKerja($unit_kerja);
        
        $suggestions = [
            $penanggung_jawab,
            $penanggung_jawab . rand(100, 999),
        ];
        
        $valid_suggestions = array();
        foreach ($suggestions as $suggestion) {
            $full_sub_domain = $suggestion . $domain;
            if (!$this->DomainModel->isSubDomainExist($full_sub_domain)) {
                $valid_suggestions[] = $full_sub_domain;
            }
        }

        // Pastikan valid_suggestions berbeda dari saran di radio buttons
        $valid_suggestions = array_slice(array_unique($valid_suggestions), 0, 2);
        
        echo json_encode([
            'status' => 'success',
            'suggestions' => $valid_suggestions
        ]);
    }

    public function validateCaptcha($input) {
        if ($input == $this->session->userdata('captcha')) {
            return TRUE;
        } else {
            $this->form_validation->set_message('validateCaptcha', 'Captcha tidak valid.');
            return FALSE;
        }
    }
}
?>
