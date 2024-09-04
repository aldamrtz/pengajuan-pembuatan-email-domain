<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterPengajuanModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insertUser($data) {
        return $this->db->insert('login_pengajuan', $data);
    }
}
