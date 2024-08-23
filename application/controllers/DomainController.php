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
        $data['units'] = $this->DomainModel->getUnits();
        $this->load->view('pengajuan_domain', $data);
    }

    public function submit() {
        // Dapatkan input dari user
        $sub_domain = $this->input->post('sub_domain');
        
        // Tambahkan domain @if.unjani.ac.id jika belum ada
        if (strpos($sub_domain, '@if.unjani.ac.id') === false) {
            $sub_domain .= '@if.unjani.ac.id';
        }
        
        // Set input sub_domain yang sudah ditambahkan domain
        $_POST['sub_domain'] = $sub_domain;

        // Validasi form
        $this->form_validation->set_rules('penanggung_jawab', 'Penanggung Jawab Domain', 'required');
        $this->form_validation->set_rules('unit_kerja', 'Unit Kerja', 'required');
        $this->form_validation->set_rules('email_penanggung_jawab', 'Email Penanggung Jawab', 'required|valid_email');
        $this->form_validation->set_rules('kontak_penanggung_jawab', 'Kontak Penanggung Jawab', 'required');
        $this->form_validation->set_rules('sub_domain', 'Sub Domain', 'required|callback_checkDomainExistence');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('ip_pointing', 'IP Pointing', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['units'] = $this->DomainModel->getUnits();
            $this->load->view('pengajuan_domain', $data);
        } else {
            $data = array(
                'penanggung_jawab' => $this->input->post('penanggung_jawab'),
                'unit_kerja' => $this->input->post('unit_kerja'),
                'email_penanggung_jawab' => $this->input->post('email_penanggung_jawab'),
                'kontak_penanggung_jawab' => $this->input->post('kontak_penanggung_jawab'),
                'sub_domain' => $sub_domain,
                'keterangan' => $this->input->post('keterangan'),
                'ip_pointing' => $this->input->post('ip_pointing')
            );

            if ($this->DomainModel->insert($data)) {
                $this->session->set_flashdata('success', 'Pengajuan domain berhasil dikirim.');
            } else {
                $this->session->set_flashdata('error', 'Pengajuan gagal. Sub domain sudah terdaftar.');
            }

            redirect('DomainController');
        }
    }

    public function checkDomainExistence($domain) {
        if ($this->DomainModel->isDomainExist($domain)) {
            $this->form_validation->set_message('checkDomainExistence', 'Sub domain yang diajukan sudah ada, silakan coba sub domain lain.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
?>
