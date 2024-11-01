<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmailModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert($data)
    {
        if ($this->db->get_where('pengajuan_email', ['nim' => $data['nim']])->num_rows() > 0) {
            return FALSE;
        } else {
            if (!isset($data['tgl_Pengajuan'])) {
                $data['tgl_pengajuan'] = date('Y-m-d');
            }
            return $this->db->insert('pengajuan_email', $data);
        }
    }

    public function isNimTaken($nim)
    {
        $this->db->where('nim', $nim);
        $query1 = $this->db->get('pengajuan_email');
        $this->db->where('nim', $nim);
        $query2 = $this->db->get('email_terdaftar');
        return $query1->num_rows() > 0 || $query2->num_rows() > 0;
    }

    public function isEmailExist($email_prefix)
    {
        $this->db->like('email_diajukan', $email_prefix . '@', 'after');
        $query = $this->db->get('pengajuan_email');
        return $query->num_rows() > 0;
    }

    public function isEmailExistInRegistered($email_prefix)
    {
        $this->db->where('email', $email_prefix, 'after');
        $query = $this->db->get('email_terdaftar');
        return $query->num_rows() > 0;
    }

    public function insertToRegistered($data)
    {
        return $this->db->insert('email_terdaftar', $data);
    }

    public function getAllPengajuan()
    {
        $this->db->order_by('tgl_pengajuan', 'DESC');
        $query = $this->db->get('pengajuan_email');
        return $query->result_array();
    }

    public function getPengajuanByStatus($status)
    {
        $this->db->where('status_pengajuan', $status);
        $this->db->order_by('tgl_pengajuan', 'DESC');
        return $this->db->get('pengajuan_email')->result_array();
    }

    public function updateStatus($id, $status)
    {
        $this->db->where('nim', $id);
        $this->db->update('pengajuan_email', array('status_pengajuan' => $status));
        $this->db->insert('status_history_email', array('nim' => $id, 'status' => $status));
    }

    public function getStatusHistory($nim)
    {
        $this->db->where('nim', $nim);
        $this->db->order_by('tgl_update', 'DESC'); // pastikan ada kolom tgl_update di tabel
        return $this->db->get('status_history_email')->result_array();
    }

    public function insertStatusHistoryEmail($data)
    {
        return $this->db->insert('status_history_email', $data);
    }

    public function getPengajuanById($id)
    {
        $query = $this->db->get_where('pengajuan_email', array('nim' => $id));
        return $query->row();
    }

    public function checkEmailAndCode($email_pengguna, $kode_pengajuan)
    {
        $this->db->where('email_pengguna', $email_pengguna);
        $query = $this->db->get('pengajuan_email');

        if ($query->num_rows() == 0) {
            return 'email_not_found';
        }

        $this->db->where('kode_pengajuan', $kode_pengajuan);
        $query = $this->db->get('pengajuan_email');

        if ($query->num_rows() == 0) {
            return 'kode_salah';
        }

        return 'success';
    }

    public function getPengajuanByEmailAndCode($email_pengguna, $kode_pengajuan)
    {
        $this->db->where('email_pengguna', $email_pengguna);
        $this->db->where('kode_pengajuan', $kode_pengajuan);
        $query = $this->db->get('pengajuan_email');
        return $query->row();
    }

    public function updatePengajuan($nim, $prodi, $nama_lengkap, $email_diajukan, $email_pengguna)
    {
        $this->db->where('nim', $nim);
        $this->db->update('pengajuan_email', [
            'prodi' => $prodi,
            'nama_lengkap' => $nama_lengkap,
            'email_diajukan' => $email_diajukan,
            'email_pengguna' => $email_pengguna
        ]);
    }

    public function deletePengajuan($nim)
    {
        $this->db->where('nim', $nim);
        $this->db->delete('status_history_email');

        $this->db->where('nim', $nim);
        return $this->db->delete('pengajuan_email');
    }

    public function getProgramStudi()
    {
        return [
            'Teknik Elektro S-1' => 'Teknik Elektro S-1',
            'Teknik Kimia S-1' => 'Teknik Kimia S-1',
            'Teknik Sipil S-1' => 'Teknik Sipil S-1',
            'Magister Teknik Sipil S-2' => 'Magister Teknik Sipil S-2',
            'Teknik Geomatika S-1' => 'Teknik Geomatika S-1',
            'Teknik Mesin S-1' => 'Teknik Mesin S-1',
            'Teknik Industri S-1' => 'Teknik Industri S-1',
            'Teknik Metalurgi S-1' => 'Teknik Metalurgi S-1',
            'Magister Manajemen Teknologi S-2' => 'Magister Manajemen Teknologi S-2',
            'Akuntansi S-1' => 'Akuntansi S-1',
            'Manajemen S-1' => 'Manajemen S-1',
            'Magister Manajemen S-2' => 'Magister Manajemen S-2',
            'Ilmu Pemerintahan S-1' => 'Ilmu Pemerintahan S-1',
            'Ilmu Hubungan Internasional S-1' => 'Ilmu Hubungan Internasional S-1',
            'Magister Hubungan Internasional S-2' => 'Magister Hubungan Internasional S-2',
            'Ilmu Hukum S-1' => 'Ilmu Hukum S-1',
            'Magister Ilmu Pemerintahan S-2' => 'Magister Ilmu Pemerintahan S-2',
            'Kimia S-1' => 'Kimia S-1',
            'Magister Kimia S-2' => 'Magister Kimia S-2',
            'Informatika S-1' => 'Informatika S-1',
            'Sistem Informasi S-1' => 'Sistem Informasi S-1',
            'Psikologi S-1' => 'Psikologi S-1',
            'Farmasi S-1' => 'Farmasi S-1',
            'Profesi Apoteker' => 'Profesi Apoteker',
            'Magister Farmasi S-2' => 'Magister Farmasi S-2',
            'Pendidikan Dokter S-1' => 'Pendidikan Dokter S-1',
            'Profesi Dokter' => 'Profesi Dokter',
            'Administrasi Rumah Sakit S-1' => 'Administrasi Rumah Sakit S-1',
            'Magister Penuaan Kulit dan Estetika S-2' => 'Magister Penuaan Kulit dan Estetika S-2',
            'Kedokteran Gigi S-1' => 'Kedokteran Gigi S-1',
            'Profesi Dokter Gigi' => 'Profesi Dokter Gigi',
            'Magister Keperawatan S-2' => 'Magister Keperawatan S-2',
            'Profesi Ners' => 'Profesi Ners',
            'Ilmu Keperawatan S-1' => 'Ilmu Keperawatan S-1',
            'Keperawatan D-3' => 'Keperawatan D-3',
            'Kesehatan Masyarakat S-1' => 'Kesehatan Masyarakat S-1',
            'Magister Kesehatan Masyarakat S-2' => 'Magister Kesehatan Masyarakat S-2',
            'Teknologi Laboratorium Medis D-4' => 'Teknologi Laboratorium Medis D-4',
            'Teknologi Laboratorium Medis D-3' => 'Teknologi Laboratorium Medis D-3',
            'Kebidanan S-1' => 'Kebidanan S-1',
            'Profesi Bidan' => 'Profesi Bidan',
            'Kebidanan D-3' => 'Kebidanan D-3'
        ];
    }
}
