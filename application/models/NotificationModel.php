<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NotificationModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insertNotification($data)
    {
        return $this->db->insert('notifications', $data);
    }

    public function getAllNotifications()
    {
        $query = $this->db->get('notifications');
        return $query->result_array();
    }

    public function clearAllNotifications()
    {
        return $this->db->empty_table('notifications');
    }
}
