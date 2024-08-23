<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DomainModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function insert($data) {
        return $this->db->insert('pengajuan_domain', $data);
    }

    public function isDomainExist($domain) {
        $this->db->where('sub_domain', $domain);
        $query = $this->db->get('pengajuan_domain');
        return $query->num_rows() > 0;
    }

    public function getUnits() {
        // Daftar unit kerja yang bisa dipilih
        return [
            'Informatika',
            'Sistem Informasi',
            'Fakultas Teknik',
            'Himpunan Mahasiswa'
            // Tambahkan unit kerja lainnya di sini
        ];
    }
}
?>
