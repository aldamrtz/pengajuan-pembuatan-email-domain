<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SubDomainModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert($data)
    {
        if (!isset($data['tgl_pengajuan'])) {
            $data['tgl_pengajuan'] = date('Y-m-d');
        }
        return $this->db->insert('pengajuan_subdomain', $data);
    }

    public function isSubDomainExist($sub_domain)
    {
        $this->db->where('sub_domain', $sub_domain);
        $query = $this->db->get('pengajuan_subdomain');
        return $query->num_rows() > 0;
    }

    public function checkSubDomainExists($sub_domain)
    {
        $this->db->where('sub_domain', 'https://' . $sub_domain . '.unjani.ac.id');
        $query = $this->db->get('pengajuan_subdomain');

        return $query->num_rows() > 0; // Returns true if exists
    }


    public function isSubDomainExistInRegistered($sub_domain)
    {
        $this->db->where('sub_domain', $sub_domain);
        $query = $this->db->get('subdomain_terdaftar');
        return $query->num_rows() > 0;
    }

    public function insertToRegistered($data)
    {
        return $this->db->insert('subdomain_terdaftar', $data);
    }

    public function getUnitKerja()
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

    public function getAllPengajuan()
    {
        $this->db->order_by('tgl_pengajuan', 'DESC'); // Order by the latest date
        $query = $this->db->get('pengajuan_subdomain');
        return $query->result_array();
    }

    public function getPengajuanByStatus($status)
    {
        $this->db->where('status_pengajuan', $status);
        $this->db->order_by('tgl_pengajuan', 'DESC'); // Order by the latest date
        return $this->db->get('pengajuan_subdomain')->result_array();
    }

    public function updateStatus($id, $status)
    {
        $this->db->where('id_pengajuan_subdomain', $id);
        $this->db->update('pengajuan_subdomain', array('status_pengajuan' => $status));
    }

    public function getPengajuanById($id)
    {
        $this->db->where('id_pengajuan_subdomain', $id);
        $query = $this->db->get('pengajuan_subdomain');
        return $query->row(); // Return a single row object
    }
}
