<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DomainModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function insert($data) {
        if ($this->db->get_where('pengajuan_domain', ['nomor_induk' => $data['nomor_induk']])->num_rows() > 0) {
            return FALSE;
        } else {
            if (!isset($data['tgl_pengajuan'])) {
                $data['tgl_pengajuan'] = date('Y-m-d');
            }
            return $this->db->insert('pengajuan_domain', $data);
        }
    }

    public function isSubDomainExist($sub_domain) {
        $this->db->where('sub_domain', $sub_domain);
        $query = $this->db->get('pengajuan_domain');
        return $query->num_rows() > 0;
    }

    public function getUnitKerja() {
        return [
            'Informatika' => 'Informatika',
            'Sistem Informasi' => 'Sistem Informasi',
            // Add more units as needed
        ];
    }

    public function getAllPengajuan() {
        $query = $this->db->get('pengajuan_domain');
        return $query->result_array();
    }

    public function getPengajuanByStatus($status) {
        $this->db->where('status_pengajuan', $status);
        return $this->db->get('pengajuan_domain')->result_array();
    }

    public function updateStatus($id, $status) {
        $this->db->where('nomor_induk', $id);
        $this->db->update('pengajuan_domain', array('status_pengajuan' => $status));
    }
}
?>
