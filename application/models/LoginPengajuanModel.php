<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginPengajuanModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getAdmin($email, $password) {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('login_pengajuan');
        return $query->row_array();
    }
}
?>
