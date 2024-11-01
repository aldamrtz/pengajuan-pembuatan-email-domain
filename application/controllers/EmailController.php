<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmailController extends CI_Controller
{
    private $recaptcha_secret;

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('EmailModel');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->recaptcha_secret = '6Lf0PEQqAAAAACRlO3K96wdEZqJlS8qSfeD3IPCq';
    }

    public function index()
    {
        $data['program_studi'] = $this->EmailModel->getProgramStudi();
        $this->load->view('pengajuan_email', $data);
    }

    public function submit()
    {
        $recaptcha_token = $this->input->post('recaptcha-token');
        if (empty($recaptcha_token)) {
            $this->session->set_flashdata('error', 'Token reCAPTCHA tidak ditemukan.');
            redirect('EmailController');
        }
        $response = $this->verifyRecaptcha($recaptcha_token);
        if (!$response['success'] || $response['score'] < 0.5) {
            $this->session->set_flashdata('error', 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.');
            redirect('EmailController');
        }

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $random_code = substr(str_shuffle($characters), 0, 7);

        $email_diajukan = $this->input->post('email_diajukan');
        $program_studi = $this->input->post('prodi');
        $domain = $this->getDomainByProdi($program_studi); // Mendapatkan domain sesuai program studi

        if ($this->input->post('email_option') == 'suggestion') {
            $email_diajukan = $this->input->post('email_saran');
        } else {
            if (strpos($email_diajukan, $domain) === false) {
                $email_diajukan = $this->input->post('email_diajukan') . $domain;
            }
        }

        $_POST['email_diajukan'] = $email_diajukan;
        $this->form_validation->set_rules('email_diajukan', 'Email yang Diajukan', 'required|valid_email|callback_checkEmailExistence');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('nim', 'Nomor Induk Mahasiswa', 'required');
        $this->form_validation->set_rules('prodi', 'Program Studi', 'required');
        $this->form_validation->set_rules('email_pengguna', 'Email Pengguna', 'required|valid_email');

        if ($this->input->post('email_option') == 'custom') {
            $this->form_validation->set_rules('email_diajukan', 'Email yang Diajukan', 'required|valid_email|callback_checkEmailExistence');
        } else {
            $this->form_validation->set_rules('email_diajukan', 'Email yang Diajukan', 'callback_checkEmailExistence');
        }

        if (empty($_FILES['ktm']['name'])) {
            $this->form_validation->set_rules('ktm', 'Kartu Tanda Mahasiswa', 'required');
        }

        $allowed_types = ['jpeg', 'jpg', 'png'];
        if (!empty($_FILES['ktm']['name'])) {
            $file_extension = strtolower(pathinfo($_FILES['ktm']['name'], PATHINFO_EXTENSION));
            if (!in_array($file_extension, $allowed_types)) {
                $this->session->set_flashdata('error', 'Format file tidak didukung. Hanya jpeg, jpg, png, atau pdf yang diperbolehkan.');
                redirect('EmailController');
            }
        }

        if ($this->form_validation->run() == FALSE) {
            $data['program_studi'] = $this->EmailModel->getProgramStudi();
            $data['form_data'] = $this->input->post();
            $this->load->view('pengajuan_email', $data);
        } else {
            $ktm = '';
            if (!empty($_FILES['ktm']['name'])) {
                $file = $_FILES['ktm']['tmp_name'];
                $fileData = file_get_contents($file);
                $ktm = 'data:application/' . $file_extension . ';base64,' . base64_encode($fileData);
            }

            $email_prefix = explode('@', $email_diajukan)[0];

            if ($this->EmailModel->isEmailExist($email_prefix)) {
                $this->form_validation->set_message('checkEmailExistence', 'Email prefix sudah terdaftar dengan domain yang berbeda.');
                $this->load->view('pengajuan_email');
                return;
            }

            $email_diajukan = $email_prefix . $domain;
            $data = array(
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'nim' => $this->input->post('nim'),
                'prodi' => $this->input->post('prodi'),
                'email_diajukan' => $email_diajukan,
                'email_pengguna' => $this->input->post('email_pengguna'),
                'ktm' => $ktm,
                'tgl_pengajuan' => date('Y-m-d H:i:s'),
                'status_pengajuan' => 'Diajukan',
                'kode_pengajuan' => $random_code
            );

            if ($this->EmailModel->insert($data)) {
                $status_data = array(
                    'id' => $this->db->insert_id(), // Get the last inserted email ID
                    'nim' => $this->input->post('nim'),
                    'status' => 'Diajukan',
                    'tgl_update' => date('Y-m-d H:i:s')
                );
                $this->EmailModel->insertStatusHistoryEmail($status_data);

                $this->session->set_flashdata('success', 'Pengajuan pembuatan akun email Anda telah berhasil dikirim!');
                $this->sendNotificationEmail($data['email_pengguna'], $data);
                $this->sendUserNotificationEmail($data['email_pengguna'], $data, $random_code);
            } else {
                $this->session->set_flashdata('error', 'Pengajuan pembuatan akun email gagal. NIM Anda sudah terdaftar');
            }

            redirect('EmailController');
        }
    }

    public function sendNotificationEmail($email_pengguna, $data)
    {
        $this->load->library('email');

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'aldaamorita@gmail.com',
            'smtp_pass' => 'iftxvtcfydxwalsy',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'wordwrap'  => TRUE
        );

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from($email_pengguna, 'Pengajuan Email');
        $this->email->to('aldaamorita@gmail.com');
        $this->email->subject('Pengajuan Pembuatan Akun Email Baru');

        $message = '<p>Halo Admin,</p>';
        $message .= '<p style="font-size: 14px; color: #333;">Terdapat pengajuan baru untuk pembuatan akun email dari seorang mahasiswa dengan rincian sebagai berikut:</p>';

        $message .= '<table style="font-size: 14px; color: #333;">';
        $message .= '<tr><td style="padding-right: 20px;"><strong>Nama</strong></td><td>:</td><td>' . $data['nama_lengkap'] . '</td></tr>';
        $message .= '<tr><td style="padding-right: 20px;"><strong>NIM</strong></td><td>:</td><td>' . $data['nim'] . '</td></tr>';
        $message .= '<tr><td style="padding-right: 20px;"><strong>Program Studi</strong></td><td>:</td><td>' . $data['prodi'] . '</td></tr>';
        $message .= '</table>';

        $message .= '<p>Untuk meninjau lebih lanjut, silakan klik tombol di bawah ini:</p>';
        $message .= '<p><a href="' . base_url('AdminPengajuanController/data_pengajuan_email') . '" style="display: inline-block; padding: 10px 20px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px;">Lihat Selengkapnya</a></p>';

        $message .= '<p>Terima kasih atas perhatian Anda.</p>';
        $message .= '<p style="font-size: 12px; color: #888;">Email ini dikirim secara otomatis. Mohon untuk tidak membalas email ini.</p>';

        $this->email->message($message);
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function sendUserNotificationEmail($email_pengguna, $data, $random_code)
    {
        $this->load->library('email');
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'aldaamorita@gmail.com',
            'smtp_pass' => 'iftxvtcfydxwalsy',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'wordwrap'  => TRUE
        );

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from('aldaamorita@gmail.com', 'Pengajuan Email');
        $this->email->to($email_pengguna);
        $this->email->subject('Pengajuan Email Anda Telah Dikirim');

        $message = '<p>Halo ' . $data['nama_lengkap'] . ',</p>';
        $message .= '<p>Pengajuan pembuatan akun email Anda telah berhasil dikirim!</p>';
        $message .= '<p>Gunakan kode berikut untuk memeriksa status pengajuan Anda: <strong>' . $random_code . '</strong></p>';
        $message .= '<p>Silakan kunjungi <a href="' . base_url('EmailController/status_pengajuan_email') . '">halaman status pengajuan</a> untuk informasi lebih lanjut.</p>';
        $message .= '<p>Terima kasih.</p>';
        $message .= '<p style="font-size: 12px; color: #888;">Email ini dikirim secara otomatis. Mohon untuk tidak membalas email ini.</p>';

        $this->email->message($message);
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function status_pengajuan_email_login()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('email_pengguna', 'Email Pengguna', 'required|valid_email');
            $this->form_validation->set_rules('kode_pengajuan', 'Kode Pengajuan', 'required');

            if ($this->form_validation->run() == FALSE) {
                echo json_encode(['success' => false, 'error' => [
                    'email' => form_error('email_pengguna'),
                    'kode' => form_error('kode_pengajuan'),
                    'general' => ''
                ]]);
                return;
            }

            $email_pengguna = $this->input->post('email_pengguna');
            $kode_pengajuan = $this->input->post('kode_pengajuan');

            $result = $this->EmailModel->checkEmailAndCode($email_pengguna, $kode_pengajuan);

            if ($result === 'success') {
                $pengajuan_email = $this->EmailModel->getPengajuanByEmailAndCode($email_pengguna, $kode_pengajuan);
                $this->session->set_userdata('pengajuan_email', $pengajuan_email);
                echo json_encode(['success' => true]);
            } else {
                if ($result === 'email_not_found') {
                    echo json_encode(['success' => false, 'error' => ['email' => 'Email tidak ditemukan.', 'kode' => '', 'general' => '']]);
                } else if ($result === 'kode_salah') {
                    echo json_encode(['success' => false, 'error' => ['email' => '', 'kode' => 'Kode salah.', 'general' => '']]);
                }
            }
        } else {
            $this->load->view('status_pengajuan_email_login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('EmailController/status_pengajuan_email_login');
    }

    public function status_pengajuan_email()
    {
        if (!$this->session->userdata('pengajuan_email')) {
            redirect('EmailController/status_pengajuan_email_login');
        }

        $data['pengajuan_email'] = $this->session->userdata('pengajuan_email');
        $data['pengajuan_email'] = $this->EmailModel->getPengajuanById($data['pengajuan_email']->nim);

        $nim = $data['pengajuan_email']->nim;
        $data['status_history_email'] = $this->EmailModel->getStatusHistory($nim);

        $this->load->view('status_pengajuan_email', $data);
    }

    public function updateStatus($id, $status)
    {
        $this->EmailModel->updateStatus($id, $status);

        $this->session->set_flashdata('success', 'Status pengajuan berhasil diperbarui dan email telah dikirim.');
        redirect('AdminPengajuanController/data_pengajuan_email');
    }

    public function kendala_pengajuan_email()
    {
        $this->load->view('kendala_pengajuan_email');
    }

    public function check_nim_availability()
    {
        $nim = $this->input->post('nim');
        if ($this->EmailModel->isNimTaken($nim)) {
            echo json_encode(['status' => 'taken']);
        } else {
            echo json_encode(['status' => 'available']);
        }
    }

    public function checkEmailExistence($email_prefix)
    {
        if ($this->EmailModel->isEmailExist($email_prefix)) {
            $this->form_validation->set_message('checkEmailExistence', 'Email yang diajukan sudah ada dalam pengajuan.');
            return FALSE;
        }
        if ($this->EmailModel->isEmailExistInRegistered($email_prefix)) {
            $this->form_validation->set_message('checkEmailExistence', 'Email sudah terdaftar, silahkan coba email lain.');
            return FALSE;
        }
        return TRUE;
    }

    public function check_email_availability()
    {
        $email_prefix = $this->input->post('email_prefix');
        $program_studi = $this->input->post('prodi');
        $domain = $this->getDomainByProdi($program_studi);

        $nama_lengkap = strtolower(str_replace(' ', '', $this->input->post('nama_lengkap')));
        $syllables = explode(' ', $this->input->post('nama_lengkap'));

        if ($this->EmailModel->isEmailExist($email_prefix)) {
            $suggestions = [];

            if (count($syllables) > 1) {
                $nama_depan = strtolower($syllables[0]);
                $nama_belakang = strtolower(implode('', array_slice($syllables, 1)));
            } else {
                $nama_depan = strtolower($nama_lengkap);
                $nama_belakang = strlen($nama_lengkap) < 6 ? $nama_lengkap . rand(1, 9) : $nama_lengkap;
            }

            $suggestionsWithDomain = [
                $nama_depan . $nama_belakang . $domain,
                $nama_belakang . $nama_depan . $domain,

                $nama_depan . '.' . $nama_belakang . $domain,
                $nama_belakang . '.' . $nama_depan . $domain,

                $nama_depan . rand(100, 999) . $domain,
                $nama_belakang . rand(100, 999) . $domain,

                $nama_depan . '.' . rand(100, 999) . $domain,
                $nama_belakang . '.' . rand(100, 999) . $domain,

                $nama_depan . $nama_belakang . rand(100, 999) . $domain,
                $nama_belakang . $nama_depan . rand(100, 999) . $domain,

                $nama_depan . '.' . $nama_belakang . rand(100, 999) . $domain,
                $nama_belakang . '.' . $nama_depan . rand(100, 999) . $domain,

                $nama_depan . $nama_belakang . '.' . rand(100, 999) . $domain,
                $nama_belakang . $nama_depan . '.' . rand(100, 999) . $domain,

                $nama_depan . substr($nama_belakang, 0, 1) . $domain,
                $nama_belakang . substr($nama_depan, 0, 1) . $domain,

                substr($nama_depan, 0, 1) . '.' . $nama_belakang . $domain,
                substr($nama_belakang, 0, 1) . '.' . $nama_depan . $domain,
            ];

            $suggestionsWithDomain = array_filter($suggestionsWithDomain, function ($suggestion) {
                $prefix = explode('@', $suggestion)[0];
                return !$this->EmailModel->isEmailExist($prefix);
            });

            $suggestionsWithoutDomain = [
                $nama_depan . $nama_belakang,
                $nama_belakang . $nama_depan,

                $nama_depan . '.' . $nama_belakang,
                $nama_belakang . '.' . $nama_depan,

                $nama_depan . rand(100, 999),
                $nama_belakang . rand(100, 999),

                $nama_depan . '.' . rand(100, 999),
                $nama_belakang . '.' . rand(100, 999),

                $nama_depan . $nama_belakang . rand(100, 999),
                $nama_belakang . $nama_depan . rand(100, 999),

                $nama_depan . '.' . $nama_belakang . rand(100, 999),
                $nama_belakang . '.' . $nama_depan . rand(100, 999),

                $nama_depan . $nama_belakang . '.' . rand(100, 999),
                $nama_belakang . $nama_depan . '.' . rand(100, 999),

                $nama_depan . substr($nama_belakang, 0, 1),
                $nama_belakang . substr($nama_depan, 0, 1),

                substr($nama_depan, 0, 1) . '.' . $nama_belakang,
                substr($nama_belakang, 0, 1) . '.' . $nama_depan,
            ];

            $existingSuggestions = array_map(function ($suggestion) {
                return explode('@', $suggestion)[0];
            }, $suggestionsWithDomain);

            $suggestionsWithoutDomain = array_filter($suggestionsWithoutDomain, function ($suggestion) use ($existingSuggestions) {
                return !in_array($suggestion, $existingSuggestions) && !$this->EmailModel->isEmailExist($suggestion);
            });

            shuffle($suggestionsWithoutDomain);

            $suggestionsWithoutDomain = array_unique($suggestionsWithoutDomain);

            while (count($suggestionsWithoutDomain) < 3) {
                $random_suffix = rand(100, 999);
                $new_suggestion = $nama_depan . $random_suffix;
                if (!in_array($new_suggestion, $suggestionsWithoutDomain) && !$this->EmailModel->isEmailExist($new_suggestion)) {
                    $suggestionsWithoutDomain[] = $new_suggestion;
                }
            }

            echo json_encode([
                'status' => 'taken',
                'suggestions' => array_slice($suggestionsWithoutDomain, 0, 3),
                'radioSuggestions' => $suggestionsWithDomain
            ]);
        } else {
            echo json_encode(['status' => 'available']);
        }
    }

    public function generateSuggestions()
    {
        $nama_lengkap = strtolower(str_replace(' ', '', $this->input->post('nama_lengkap')));
        $syllables = explode(' ', $this->input->post('nama_lengkap'));

        if (count($syllables) > 1) {
            $nama_depan = strtolower($syllables[0]);
            $nama_belakang = strtolower(implode('', array_slice($syllables, 1)));
        } else {
            $nama_depan = strtolower($nama_lengkap);
            $nama_belakang = strlen($nama_lengkap) < 6 ? $nama_lengkap . rand(1, 9) : $nama_lengkap;
        }

        $prodi = $this->input->post('prodi');
        $domain = $this->getDomainByProdi($prodi);

        $suggestions = [
            $nama_depan . $nama_belakang,
            $nama_belakang . $nama_depan,

            $nama_depan . '.' . $nama_belakang,
            $nama_belakang . '.' . $nama_depan,

            $nama_depan . rand(100, 999),
            $nama_belakang . rand(100, 999),

            $nama_depan . '.' . rand(100, 999),
            $nama_belakang . '.' . rand(100, 999),

            $nama_depan . $nama_belakang . rand(100, 999),
            $nama_belakang . $nama_depan . rand(100, 999),

            $nama_depan . '.' . $nama_belakang . rand(100, 999),
            $nama_belakang . '.' . $nama_depan . rand(100, 999),

            $nama_depan . $nama_belakang . '.' . rand(100, 999),
            $nama_belakang . $nama_depan . '.' . rand(100, 999),

            $nama_depan . substr($nama_belakang, 0, 1),
            $nama_belakang . substr($nama_depan, 0, 1),

            substr($nama_depan, 0, 1) . '.' . $nama_belakang,
            substr($nama_belakang, 0, 1) . '.' . $nama_depan,
        ];

        $valid_suggestions = array();
        foreach ($suggestions as $suggestion) {
            $prefix = $suggestion;
            $full_email = $prefix . $domain;
            if (!$this->EmailModel->isEmailExist($prefix)) {
                $valid_suggestions[] = $full_email;
            }
        }

        $valid_suggestions = array_slice(array_unique($valid_suggestions), 0, 3);

        echo json_encode([
            'status' => 'success',
            'suggestions' => $valid_suggestions
        ]);
    }

    public function validateEmailDiajukan($email)
    {
        $lengthPattern = '/^.{6,30}$/';
        $contentPattern = '/^[a-z0-9.]+$/';
        $consecutiveDotPattern = '/\.\./';
        $startEndDotPattern = '/^\.|\.$/';

        if (!preg_match($lengthPattern, $email)) {
            $this->form_validation->set_message('validateEmailDiajukan', 'Nama pengguna yang diajukan harus terdiri dari 6-30 karakter.');
            return FALSE;
        }
        if (!preg_match($contentPattern, $email)) {
            $this->form_validation->set_message('validateEmailDiajukan', 'Hanya huruf (a-z), angka (0-9), dan titik (.) yang diizinkan.');
            return FALSE;
        }
        if (preg_match($consecutiveDotPattern, $email)) {
            $this->form_validation->set_message('validateEmailDiajukan', 'Tanda titik (.) tidak boleh berurutan.');
            return FALSE;
        }
        if (preg_match($startEndDotPattern, $email)) {
            $this->form_validation->set_message('validateEmailDiajukan', 'Tanda titik (.) tidak boleh di awal atau di akhir username.');
            return FALSE;
        }
        return TRUE;
    }

    public function getDomainByProdi($prodi)
    {
        $domains = [
            'Teknik Elektro S-1' => '@te.unjani.ac.id',
            'Teknik Kimia S-1' => '@student.unjani.ac.id',
            'Teknik Sipil S-1' => '@ts.unjani.ac.id',
            'Magister Teknik Sipil S-2' => '@mts.unjani.ac.id',
            'Teknik Geomatika S-1' => '@student.unjani.ac.id',
            'Teknik Mesin S-1' => '@tms.unjani.ac.id',
            'Teknik Industri S-1' => '@ti.unjani.ac.id',
            'Teknik Metalurgi S-1' => '@tme.unjani.ac.id',
            'Magister Manajemen Teknologi S-2' => '@mmt.unjani.ac.id',
            'Akuntansi S-1' => '@ak.unjani.ac.id',
            'Manajemen S-1' => '@mn.unjani.ac.id',
            'Magister Manajemen S-2' => '@mm.unjani.ac.id',
            'Ilmu Pemerintahan S-1' => '@ip.unjani.ac.id',
            'Ilmu Hubungan Internasional S-1' => '@hi.unjani.ac.id',
            'Magister Hubungan Internasional S-2' => '@mhi.unjani.ac.id',
            'Ilmu Hukum S-1' => '@hk.unjani.ac.id',
            'Magister Ilmu Pemerintahan S-2' => '@mip.unjani.ac.id',
            'Kimia S-1' => '@ki.unjani.ac.id',
            'Magister Kimia S-2' => '@mk.unjani.ac.id',
            'Informatika S-1' => '@if.unjani.ac.id',
            'Sistem Informasi S-1' => '@si.unjani.ac.id',
            'Psikologi S-1' => '@ps.unjani.ac.id',
            'Farmasi S-1' => '@fa.unjani.ac.id',
            'Profesi Apoteker' => '@student.unjani.ac.id',
            'Magister Farmasi S-2' => '@student.unjani.ac.id',
            'Pendidikan Dokter S-1' => '@fk.unjani.ac.id',
            'Profesi Dokter' => '@fk.unjani.ac.id',
            'Administrasi Rumah Sakit S-1' => '@fk.unjani.ac.id',
            'Magister Penuaan Kulit dan Estetika S-2' => '@student.unjani.ac.id',
            'Kedokteran Gigi S-1' => '@fkg.unjani.ac.id',
            'Profesi Dokter Gigi' => '@fkg.unjani.ac.id',
            'Magister Keperawatan S-2' => '@fts.unjani.ac.id',
            'Profesi Ners' => '@fts.unjani.ac.id',
            'Ilmu Keperawatan S-1' => '@fts.unjani.ac.id',
            'Keperawatan D-3' => '@fts.unjani.ac.id',
            'Kesehatan Masyarakat S-1' => '@student.unjani.ac.id',
            'Magister Kesehatan Masyarakat S-2' => '@student.unjani.ac.id',
            'Teknologi Laboratorium Medis D-4' => '@student.unjani.ac.id',
            'Teknologi Laboratorium Medis D-3' => '@student.unjani.ac.id',
            'Kebidanan S-1' => '@fts.unjani.ac.id',
            'Profesi Bidan' => '@fts.unjani.ac.id',
            'Kebidanan D-3' => '@fts.unjani.ac.id'
        ];

        return isset($domains[$prodi]) ? $domains[$prodi] : '@student.unjani.ac.id'; // Default domain
    }

    private function verifyRecaptcha($recaptcha_token)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => $this->recaptcha_secret,
            'response' => $recaptcha_token
        );

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ),
        );

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            return ['success' => false];
        }

        return json_decode($result, true);
    }
}
