<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmailController extends CI_Controller
{

    private $recaptcha_secret;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('EmailModel');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');

        $this->recaptcha_secret = '6Lf0PEQqAAAAACRlO3K96wdEZqJlS8qSfeD3IPCq'; // Change this to your own secret key
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

        $email_diajukan = $this->input->post('email_diajukan');
        $program_studi = $this->input->post('prodi');

        if ($this->input->post('email_option') == 'suggestion') {
            $email_diajukan = $this->input->post('email_saran');
        } else {
            $domain = $this->getDomainByProdi($program_studi);
            if (strpos($email_diajukan, $domain) === false) {
                $email_diajukan .= $domain;
            }
        }

        $_POST['email_diajukan'] = $email_diajukan;
        $this->form_validation->set_rules('email_diajukan', 'Email yang Diajukan', 'required|valid_email|callback_checkEmailExistence');
        $this->form_validation->set_rules('nama_depan', 'Nama Depan', 'required');
        $this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'required');
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

            // Extract email prefix (part before '@')
            $email_prefix = explode('@', $email_diajukan)[0];

            // Check if the prefix already exists across any domain
            if ($this->EmailModel->isEmailExist($email_prefix)) {
                // Set error message and reload the form if prefix already exists
                $this->form_validation->set_message('checkEmailExistence', 'Email prefix sudah terdaftar dengan domain yang berbeda.');
                $this->load->view('pengajuan_email');
                return;
            }

            // Retrieve the selected program of study (Prodi)
            $program_studi = $this->input->post('program_studi');

            // Get the domain based on the selected program of study
            $domain = $this->getDomainByProdi($program_studi);

            // Combine prefix and domain to form the full email
            $email_diajukan = $email_prefix . $domain;

            $data = array(
                'nama_depan' => $this->input->post('nama_depan'),
                'nama_belakang' => $this->input->post('nama_belakang'),
                'nim' => $this->input->post('nim'),
                'prodi' => $this->input->post('prodi'),
                'email_diajukan' => $email_diajukan,
                'email_pengguna' => $this->input->post('email_pengguna'),
                'ktm' => $ktm,
                'tgl_pengajuan' => date('Y-m-d')
            );

            if ($this->EmailModel->insert($data)) {
                $this->session->set_flashdata('success', 'Pengajuan pembuatan akun email Anda telah berhasil dikirim!');
                $this->sendNotificationEmail($data['email_pengguna'], $data);
            } else {
                $this->session->set_flashdata('error', 'Pengajuan pembuatan akun email gagal. NIM Anda sudah terdaftar');
            }

            $this->load->model('NotificationModel');
            $notification_data = [
                'user' => $this->input->post('email_pengguna'),
                'type' => 'email',
            ];
            $this->NotificationModel->insertNotification($notification_data);

            redirect('EmailController');
        }
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


    public function sendNotificationEmail($email_pengguna, $data)
    {
        $this->load->library('email');

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'aldaamorita@gmail.com', // Ganti dengan email kamu
            'smtp_pass' => 'iftxvtcfydxwalsy', // Ganti dengan password email kamu
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'wordwrap'  => TRUE
        );

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from($email_pengguna, 'Pengajuan Email');
        $this->email->to('aldaamorita@gmail.com'); // Ganti dengan email admin
        $this->email->subject('Pengajuan Pembuatan Akun Email Baru');

        // Message with more details and a "View Details" button
        $message = '<p>Halo Admin,</p>';
        $message .= '<p style="font-size: 14px; color: #333;">Terdapat pengajuan baru untuk pembuatan akun email dari seorang mahasiswa dengan rincian sebagai berikut:</p>';

        // Create table to align the colons
        $message .= '<table style="font-size: 14px; color: #333;">';
        $message .= '<tr><td style="padding-right: 20px;"><strong>Nama</strong></td><td>:</td><td>' . $data['nama_depan'] . ' ' . $data['nama_belakang'] . '</td></tr>';
        $message .= '<tr><td style="padding-right: 20px;"><strong>NIM</strong></td><td>:</td><td>' . $data['nim'] . '</td></tr>';
        $message .= '<tr><td style="padding-right: 20px;"><strong>Program Studi</strong></td><td>:</td><td>' . $data['prodi'] . '</td></tr>';
        $message .= '</table>';

        // View Details button linking to the admin dashboard
        $message .= '<p>Untuk meninjau lebih lanjut, silakan klik tombol di bawah ini:</p>';
        $message .= '<p><a href="' . base_url('AdminPengajuanController/data_pengajuan_email') . '" style="display: inline-block; padding: 10px 20px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px;">Lihat Selengkapnya</a></p>';

        // Footer
        $message .= '<p>Terima kasih atas perhatian Anda.</p>';
        $message .= '<p style="font-size: 12px; color: #888;">Email ini dikirim secara otomatis. Mohon untuk tidak membalas email ini.</p>';

        $this->email->message($message);

        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function validateEmailDiajukan($email)
    {
        $lengthPattern = '/^.{6,30}$/';
        $contentPattern = '/^[a-z0-9.]+$/';
        $consecutiveDotPattern = '/\.\./';
        $startEndDotPattern = '/^\.|\.$/';

        // Cek panjang karakter
        if (!preg_match($lengthPattern, $email)) {
            $this->form_validation->set_message('validateEmailDiajukan', 'Nama pengguna yang diajukan harus terdiri dari 6-30 karakter.');
            return FALSE;
        }

        // Cek konten yang diizinkan (huruf kecil, angka, titik)
        if (!preg_match($contentPattern, $email)) {
            $this->form_validation->set_message('validateEmailDiajukan', 'Hanya huruf (a-z), angka (0-9), dan titik (.) yang diizinkan.');
            return FALSE;
        }

        // Cek apakah ada titik berurutan
        if (preg_match($consecutiveDotPattern, $email)) {
            $this->form_validation->set_message('validateEmailDiajukan', 'Tanda titik (.) tidak boleh berurutan.');
            return FALSE;
        }

        // Cek apakah titik di awal atau akhir
        if (preg_match($startEndDotPattern, $email)) {
            $this->form_validation->set_message('validateEmailDiajukan', 'Tanda titik (.) tidak boleh di awal atau di akhir username.');
            return FALSE;
        }

        return TRUE;
    }

    public function checkEmailExistence($email_prefix)
    {
        // Cek di tabel pengajuan_email
        if ($this->EmailModel->isEmailExist($email_prefix)) {
            $this->form_validation->set_message('checkEmailExistence', 'Email yang diajukan sudah ada dalam pengajuan.');
            return FALSE;
        }

        // Cek di tabel email_terdaftar
        if ($this->EmailModel->isEmailExistInRegistered($email_prefix)) {
            $this->form_validation->set_message('checkEmailExistence', 'Email sudah terdaftar, silahkan coba email lain.');
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

    public function check_email_availability()
    {
        $email_prefix = $this->input->post('email_prefix');
        $program_studi = $this->input->post('prodi');
        $domain = $this->getDomainByProdi($program_studi);

        if ($this->EmailModel->isEmailExist($email_prefix)) {
            $suggestions = [];
            $nama_depan = strtolower(str_replace(' ', '', $this->input->post('nama_depan')));
            $nama_belakang = strtolower(str_replace(' ', '', $this->input->post('nama_belakang')));

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

            // Existing suggestions from the domain checks
            $existingSuggestions = array_map(function ($suggestion) {
                return explode('@', $suggestion)[0]; // Get the prefix only
            }, $suggestionsWithDomain);

            // Generate suggestions for email feedback (without domain)
            $suggestionsWithoutDomain = array_filter($suggestionsWithoutDomain, function ($suggestion) use ($existingSuggestions) {
                // Check if the suggestion already exists in the existing suggestions array or in the database
                return !in_array($suggestion, $existingSuggestions) && !$this->EmailModel->isEmailExist($suggestion);
            });

            shuffle($suggestionsWithoutDomain);

            // Ensure unique suggestions
            $suggestionsWithoutDomain = array_unique($suggestionsWithoutDomain);


            // Check if we have at least three suggestions
            while (count($suggestionsWithoutDomain) < 3) {
                $random_suffix = rand(100, 999); // Larger random number range
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
        $nama_depan = strtolower(str_replace(' ', '', $this->input->post('nama_depan')));
        $nama_belakang = strtolower(str_replace(' ', '', $this->input->post('nama_belakang')));
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
            // Extract the prefix
            $prefix = $suggestion;

            // Combine with domain to form the full email
            $full_email = $prefix . $domain;

            // Check if the prefix exists in the database, not the full email
            if (!$this->EmailModel->isEmailExist($prefix)) {
                $valid_suggestions[] = $full_email;
            }
        }

        // Pastikan valid_suggestions berbeda dari saran di radio buttons
        $valid_suggestions = array_slice(array_unique($valid_suggestions), 0, 3);

        echo json_encode([
            'status' => 'success',
            'suggestions' => $valid_suggestions
        ]);
    }

    private function verifyRecaptcha($recaptcha_token)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => $this->recaptcha_secret,
            'response' => $recaptcha_token
        );

        // Kirim permintaan POST ke server Google reCAPTCHA
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
            // Jika gagal menghubungi API reCAPTCHA
            return ['success' => false];
        }

        return json_decode($result, true);
    }
}
