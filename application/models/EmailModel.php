<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function insert($data) {
        if ($this->db->get_where('pengajuan_email', ['nim' => $data['nim']])->num_rows() > 0) {
            return FALSE;
        } else {
            if (!isset($data['tgl_Pengajuan'])) {
                $data['tgl_pengajuan'] = date('Y-m-d');
            }
            return $this->db->insert('pengajuan_email', $data);
        }
    }

    public function isEmailExist($email) {
        $this->db->where('email_diajukan', $email);
        $query = $this->db->get('pengajuan_email');
        return $query->num_rows() > 0;
    }

    public function getProgramStudi() {
        return [
            'Informatika' => 'Informatika',
            'Sistem Informasi' => 'Sistem Informasi',
            // Add more programs as needed
        ];
    }

    public function getAllPengajuan() {
        $query = $this->db->get('pengajuan_email');
        return $query->result_array();
    }

    public function getPengajuanByStatus($status) {
        $this->db->where('status_pengajuan', $status);
        return $this->db->get('pengajuan_email')->result_array();
    }

    public function updateStatus($id, $status) {
        $this->db->where('nim', $id);
        $this->db->update('pengajuan_email', array('status_pengajuan' => $status));
    }

    public function getPengajuanById($id) {
        $query = $this->db->get_where('pengajuan_email', array('nim' => $id));
        return $query->row(); // or ->result(), depending on your needs
    }
}
?>
