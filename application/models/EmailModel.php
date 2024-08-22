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
            return $this->db->insert('pengajuan_email', $data);
        }
    }

    public function isEmailExist($email) {
        $this->db->where('email_diajukan', $email);
        $query = $this->db->get('pengajuan_email');
        return $query->num_rows() > 0;
    }
}
?>
