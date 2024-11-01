<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengajuan Email</title>

    <link rel="icon" href="<?= base_url('assets/img/logo-unjani.png'); ?>" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #00aaff;
            background-size: cover;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            align-items: flex-start;
            height: 100vh;
            margin: 0;
            overflow: auto;
        }

        .navbar {
            background-color: white;
            height: 70px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1050;
        }

        .navbar-toggler {
            display: none;
        }

        @media (min-width: 768px) {
            .navbar-toggler {
                display: none;
            }

            .sidebar {
                display: block;
                width: 250px;
            }

            .content {
                margin-left: 250px;
            }
        }

        @media (max-width: 767px) {
            .navbar-toggler {
                display: block;
            }

            .sidebar {
                display: none;
                position: fixed;
                width: 250px;
                height: 100%;
                z-index: 1000;
                top: 0;
                left: 0;
                transition: transform 0.3s ease;
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
            }
        }

        .sidebar {
            background: linear-gradient(135deg, #13855c, #1cc88a);
            height: 100vh;
            padding: 15px;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1100;
            width: 225px;
            transition: transform 0.3s ease;
            display: none;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .sidebar-brand-icon img {
            display: inline-block;
            width: 40px;
            height: auto;
        }

        .sidebar-brand-text {
            margin-left: 10px;
            margin-right: 3px;
            color: #ffffff;
            text-decoration: none !important;
            font-size: 18px;
        }

        .sidebar-divider {
            height: 0px;
            background-color: #ffffff !important;
        }

        .sidebar-heading {
            margin-top: 3px;
            margin-bottom: 3px;
            opacity: 0.5;
            font-size: 12px;
            font-weight: bold;
        }

        .nav-item .nav-link {
            color: #ffffff;
            text-decoration: none;
            opacity: 0.7;
            font-size: 14px;
        }

        .nav-item .nav-link i {
            margin-right: 7px;
        }

        .nav-item .nav-link:hover {
            opacity: 1;
        }

        .nav-item.active .nav-link {
            opacity: 1;
            font-weight: bold;
        }

        .content {
            padding: 20px;
            flex-grow: 1;
        }

        .container-fluid {
            padding: 20px;
        }

        h2 {
            margin-bottom: 30px;
            color: #333;
            font-size: 32px;
            font-weight: bold;
            text-align: center;
        }

        h2 i {
            margin-right: 15px;
        }

        .form-wrapper {
            position: static;
            max-width: 100%;
            width: 100%;
            background: #ffffff;
            padding: 30px;
            margin-top: 100px;
            margin-bottom: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            align-items: center;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-group label {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            font-size: 16px;
            transition: all 0.3s ease;
            pointer-events: none;
            color: #003366;
            z-index: 1;
        }

        .form-group input,
        .form-group select {
            color: #333;
            border-color: #003366;
            padding: 10px 15px 10px 15px;
            border-radius: 7px;
            width: 100%;
            box-sizing: border-box;
            z-index: 0;
        }

        .form-group input:focus,
        .form-group select:focus {
            box-shadow: 0 0 0 0.25rem rgba(0, 170, 255, 0.25);
            border-color: #00aaff;
        }

        .form-group input:not(:focus):not(:placeholder-shown)+label,
        .form-group select:not(:focus)+label {
            color: #003366;
        }

        .form-group input:focus+label,
        .form-group input:not(:placeholder-shown)+label,
        .form-group select:focus+label,
        .form-group select:valid+label {
            top: -10px;
            left: 10px;
            font-size: 13px;
            background-color: #ffffff;
            padding: 0 5px;
            transform: translateY(0);
            color: #00aaff;
        }

        .form-group select:not(:focus):valid+label {
            color: #003366;
        }

        .form-group input.error-border,
        .form-group select.error-border {
            border-color: #d9534f;
        }

        .form-group input.error-border:focus,
        .form-group select.error-border:focus {
            box-shadow: 0 0 0 0.2rem rgba(217, 83, 79, 0.25);
            border-color: #d9534f;
        }

        .form-group input.error-border+label,
        .form-group select.error-border+label {
            color: #d9534f !important;
        }

        .form-group input.shake+label,
        .form-group select.shake+label {
            color: #d9534f !important;
            box-shadow: none;
        }

        .input-group-text {
            background-color: rgba(0, 51, 102, 0.25);
            border-color: #003366;
            color: #003366;
        }

        .suggestion-radio {
            margin-top: -15px;
        }

        .suggestion-radio input[type="radio"] {
            cursor: pointer;
            appearance: none;
            border-color: #003366;
            margin-right: 0.5rem;
        }

        .suggestion-radio input[type="radio"]:checked {
            background-color: #003366;
            border-color: #003366;
        }

        .suggestion-radio input[type="radio"]:focus {
            box-shadow: 0 0 0 0.25rem rgba(0, 170, 255, 0.25);
        }

        .email-group {
            margin-bottom: 37px;
        }

        .email-options {
            display: block;
            max-height: 0;
            transition: max-height 0.5s ease-out;
        }

        .email-options.show {
            max-height: 300px;
        }

        #emailSuggestions input[type="radio"] {
            margin-right: 0.25rem;
        }

        .feedback {
            font-size: 12px;
            margin-top: 4px;
        }

        .feedback.success {
            color: green;
        }

        .feedback.error {
            color: #d9534f;
        }

        .error-border {
            border-color: #d9534f;
        }

        input[type="file"] {
            border-color: #003366;
            color: rgba(0, 51, 102, 0.35);
            width: 100%;
        }

        input[type="file"]:focus {
            box-shadow: 0 0 0 0.25rem rgba(0, 170, 255, 0.25);
            border-color: #00aaff;
            color: #003366;
        }

        input[type="file"]::-webkit-file-upload-button {
            background-color: rgba(0, 51, 102, 0.25);
            cursor: pointer;
            border-radius: 7px;
            padding: 1px 10px;
            margin-left: -7px;
            border: none;
            color: #003366;
            transition: background-color 0.3s;
        }

        input[type="file"]::-webkit-file-upload-button:hover {
            background-color: rgba(0, 51, 102, 0.4);
        }

        input[type="file"].error-border {
            border-color: #d9534f;
        }

        .shake {
            animation: shake 0.5s;
            border-color: #d9534f;
            box-shadow: 0 0 0 0.2rem rgba(217, 83, 79, 0.25);
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            50% {
                transform: translateX(5px);
            }

            75% {
                transform: translateX(-5px);
            }
        }

        .btn-form {
            background: linear-gradient(135deg, #333, #003366, #00aaff);
            color: #ffffff;
            border: none;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 20px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-form:hover,
        .btn-form:active,
        .btn-form:focus {
            background: linear-gradient(135deg, #333, #333, #333);
            color: #ffffff;
            transform: scale(1.03);
        }

        .btn-form.loading {
            background: linear-gradient(135deg, #13855c, #13855c, #13855c);
            color: transparent;
        }

        .spinner-border {
            position: absolute;
            width: 20px;
            height: 20px;
            border-width: 2px;
            border-color: #ffffff transparent transparent;
            border-radius: 50%;
            border-style: solid;
            display: none;
            animation: spinner-border 1s linear infinite;
        }

        .btn-form.loading .spinner-border {
            display: inline-block;
        }

        .btn-form .spinner-border {
            position: absolute;
            transform: translate(-50%, -50%);
        }

        .modal-dialog {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            max-width: 400px;
            width: 100%;
        }

        .modal-content {
            border: none;
            border-radius: 10px;
        }

        .btn-close {
            position: absolute;
            top: 15px;
            right: 20px;
            color: #aaa;
            font-size: 15px;
            cursor: pointer;
        }

        .modal-body {
            padding: 30px;
        }

        .modal-body i {
            font-size: 100px;
            margin-top: 30px;
        }

        .modal-body p {
            font-size: 17px;
            color: #333;
        }

        .modal-body .status-text {
            font-size: 25px;
            margin-top: 15px;
            color: #13855c;
            font-weight: bold;
        }

        .modal-body .status-text.error {
            color: #d9534f;
        }

        .btn-success {
            background-color: #13855c;
            border-color: #13855c;
            color: #ffffff;
            width: 100%;
            margin-top: 30px;
        }

        .btn-success:hover {
            background-color: #0e6b47;
            color: #ffffff;
            transition: background-color 0.3s ease;
        }

        .btn-error {
            background-color: #d9534f;
            border-color: #d9534f;
            color: #ffffff;
            width: 100%;
            margin-top: 30px;
        }

        .btn-error:hover {
            background-color: #c9302c;
            color: #ffffff;
            transition: background-color 0.3s ease;
        }

        @keyframes spinner-border {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 30px;
            }

            .form-group {
                position: relative;
                margin-bottom: 33px;
            }

            .row.mb-3 {
                margin-bottom: 1px !important;
            }

        }

        @media (max-width: 576px) {
            .container {
                width: 90%;
                padding: 30px;
            }

            .form-group {
                position: relative;
                margin-bottom: 33px;
            }

            .row.mb-3 {
                margin-bottom: 1px !important;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar fixed-top">
        <div class="container-fluid">
            <!-- Tombol toggle untuk layar kecil -->
            <button class="navbar-toggler" type="button" aria-label="Toggle sidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar d-md-block" id="sidebar">
        <a class="sidebar-brand" href="<?= site_url('EmailController'); ?>" style="text-decoration: none;">
            <div class="sidebar-brand-icon">
                <img src="<?= base_url('assets/img/logo-unjani.png') ?>">
            </div>
            <div class="sidebar-brand-text">ACCESS TRACK</div>
        </a>
        <ul class="nav flex-column">
            <hr class="sidebar-divider">
            <div class="sidebar-heading">PENGAJUAN</div>
            <li class="nav-item active" style="margin-bottom: 5px !important;">
                <a class="nav-link" href="<?= site_url('EmailController/pengajuan_email'); ?>" style="text-decoration: none;">
                    <i class="fas fa-envelope"></i>
                    <span>Pengajuan Email</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('EmailController'); ?>" style="text-decoration: none;">
                    <i class="fas fa-globe"></i>
                    <span>Status Pengajuan</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">LAPORAN</div>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('EmailController'); ?>">
                    <i class="fas fa-home"></i>
                    <span>Pesan</span>
                </a>
            </li>
            <hr class="sidebar-divider">
        </ul>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row form-container justify-content-center">
                <div class="col-md-8">
                    <div class="form-wrapper">
                        <h2>Pengajuan Pembuatan Email</h2>
                        <?= form_open_multipart('EmailController/submit'); ?>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="number" min="7" class="form-control" id="nim" name="nim" placeholder=" " value="<?= set_value('nim'); ?>" required pattern="\d*" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    <label for="nim" class="form-label">Nomor Induk Mahasiswa (NIM)</label>
                                    <div id="nimValidationFeedback" class="feedback feedback-spacing"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-select" id="prodi" name="prodi" placeholder=" " required>
                                        <option value=""></option> <!-- Empty option -->
                                        <?php foreach ($program_studi as $value => $label): ?>
                                            <option value="<?= $value; ?>" <?= set_select('prodi', $value); ?>><?= $label; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="prodi" class="form-label">Program Studi</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nama_depan" name="nama_depan" placeholder=" " value="<?= set_value('nama_depan'); ?>" required>
                                    <label for="nama_depan" class="form-label">Nama Depan</label>
                                    <div id="namaDepanFeedback" class="feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" placeholder=" " value="<?= set_value('nama_belakang'); ?>" required>
                                    <label for="nama_belakang" class="form-label">Nama Belakang</label>
                                    <div id="namaBelakangFeedback" class="feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 suggestion-radio">
                            <div id="emailSuggestions">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="customEmail" name="email_option" value="custom" <?= set_radio('email_option', 'custom'); ?>>
                                <label class="form-check-label" for="customEmail" style="margin-bottom: 13px !important;">Buat username Anda sendiri</label>
                            </div>
                        </div>
                        <div id="customEmailField" class="mb-3 email-options">
                            <div class=" col-md-12">
                                <div class="form-group email-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="email_diajukan" style="z-index: 0;" name="email_diajukan" placeholder=" " value="<?= set_value('email_diajukan'); ?>" required>
                                        <label for="email_diajukan" class="form-label">Username</label>
                                        <span class="input-group-text" id="emailDomain">@if.unjani.ac.id</span>
                                    </div>
                                    <div id="emailValidationFeedback" class="feedback"></div>
                                    <div id="emailAvailabilityFeedback" class="feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email_pengguna" name="email_pengguna" placeholder=" " value="<?= set_value('email_pengguna'); ?>" required>
                                    <label for="email_pengguna" class="form-label">Email Pengguna</label>
                                    <div id="emailPenggunaFeedback" class="feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="ktm" name="ktm" placeholder=" " accept=".jpeg,.jpg,.png,.pdf" required>
                                    <label for="ktm" class="form-label" style="padding-bottom: 0px;">Kartu Tanda Mahasiswa (KTM)</label>
                                    <div id="ktmFeedback" class="feedback"></div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="recaptcha-token" name="recaptcha-token">
                        <button type="submit" class="btn btn-form btn-block">Kirim
                            <div class="spinner-border"></div>
                        </button>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> <!-- Close button -->
                    <?php if ($this->session->flashdata('success')): ?>
                        <i class="fas fa-check-circle" style="color: #13855c;"></i>
                        <p class="status-text">Terkirim!</p> <!-- Green success text -->
                        <p><?= $this->session->flashdata('success'); ?></p> <!-- Flashdata text, default color -->
                    <?php elseif ($this->session->flashdata('error')): ?>
                        <i class="fas fa-exclamation-circle" style="color: #d9534f;"></i>
                        <p class="status-text error">Gagal Terkirim!</p> <!-- Red error text -->
                        <p><?= $this->session->flashdata('error'); ?></p> <!-- Flashdata text, default color -->
                    <?php endif; ?>
                    <button type="button" class="btn <?= $this->session->flashdata('error') ? 'btn-error' : 'btn-success'; ?>" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6Lf0PEQqAAAAANCvF8-NRJwRcVHMZDMbSD84j7gZ"></script>
    <script>
        document.querySelector('.navbar-toggler').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');

            const nimInput = document.getElementById('nim');
            const nimFeedback = document.getElementById('nimValidationFeedback');

            const namaDepanInput = document.getElementById('nama_depan');
            const namaDepanFeedback = document.getElementById('namaDepanFeedback');

            const namaBelakangInput = document.getElementById('nama_belakang');
            const namaBelakangFeedback = document.getElementById('namaBelakangFeedback');

            const customEmailOption = document.getElementById('customEmail');
            const emailInput = document.getElementById('email_diajukan');
            const validationFeedback = document.getElementById('emailValidationFeedback');
            const availabilityFeedback = document.getElementById('emailAvailabilityFeedback');
            const emailSuggestions = document.getElementById('emailSuggestions');

            const emailPenggunaInput = document.getElementById('email_pengguna');
            const emailPenggunaFeedback = document.getElementById('emailPenggunaFeedback');

            const ktmInput = document.getElementById('ktm');
            const ktmFeedback = document.getElementById('ktmFeedback');

            nimInput.addEventListener('input', function() {
                const nimValue = nimInput.value;

                if (nimValue.length > 0) {
                    checkNimAvailability(nimValue);
                } else {
                    nimFeedback.textContent = '';
                    nimInput.classList.remove('error-border');
                }
            });

            function checkNimAvailability(nim) {
                $.ajax({
                    url: '<?= site_url('EmailController/check_nim_availability'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        nim: nim
                    },
                    success: function(response) {
                        if (response.status === 'taken') {
                            nimFeedback.textContent = 'NIM sudah terdaftar';
                            nimFeedback.className = 'feedback error';
                        } else {
                            nimFeedback.textContent = '';
                            nimInput.classList.remove('error-border');
                        }
                    }
                });
            }

            namaDepanInput.addEventListener('input', function() {
                if (namaDepanInput.value === '') {
                    // Kosongkan feedback jika input kosong
                    namaDepanFeedback.textContent = '';
                } else if (!/^[A-Za-z\s]+$/.test(namaDepanInput.value)) {
                    namaDepanFeedback.textContent = 'Nama depan hanya boleh berisi huruf dan spasi.';
                    namaDepanFeedback.className = 'feedback error';
                } else {
                    namaDepanFeedback.textContent = '';
                    namaDepanInput.classList.remove('error-border');
                }
            });

            // Validasi Nama Belakang
            namaBelakangInput.addEventListener('input', function() {
                if (namaBelakangInput.value === '') {
                    // Kosongkan feedback jika input kosong
                    namaBelakangFeedback.textContent = '';
                } else if (!/^[A-Za-z\s]+$/.test(namaBelakangInput.value)) {
                    namaBelakangFeedback.textContent = 'Nama belakang hanya boleh berisi huruf dan spasi.';
                    namaBelakangFeedback.className = 'feedback error';
                } else {
                    namaBelakangFeedback.textContent = '';
                    namaBelakangInput.classList.remove('error-border');
                }
            });

            function toggleEmailField() {
                if ($('#customEmail').is(':checked')) {
                    $('#customEmailField').show();
                    $('#email_diajukan').prop('required', true);
                } else {
                    $('#customEmailField').hide();
                    $('#email_diajukan').prop('required', false);
                }
            }

            $('#prodi, #nama_depan, #nama_belakang').on('change keyup', updateDomain);
            $('#customEmail').change(toggleEmailField);
            $('#emailSuggestions').on('change', 'input[name="email_option"]', function() {
                toggleEmailField();
                var selectedEmail = $(this).val();
                $('#email_diajukan').val(selectedEmail);
            });

            updateDomain();
            toggleEmailField();

            $('#emailSuggestions').on('change', 'input[name="email_option"]', function() {
                var selectedEmail = $(this).val();
                $('#email_diajukan').val(selectedEmail);
                validationFeedback.textContent = '';
                availabilityFeedback.textContent = '';
                emailInput.classList.remove('error-border');
            });

            customEmailOption.addEventListener('change', function() {
                if (this.checked) {
                    document.getElementById('customEmailField').classList.add('show');
                    emailInput.value = ''; // Reset input email
                    validationFeedback.textContent = '';
                    availabilityFeedback.textContent = '';
                    emailInput.classList.remove('error-border');
                } else {
                    emailInput.value = '';
                    validationFeedback.textContent = '';
                    availabilityFeedback.textContent = '';
                    emailInput.classList.remove('error-border');
                }
            });

            emailInput.addEventListener('input', function() {
                const emailValue = emailInput.value;

                const lengthPattern = /^.{6,30}$/;
                const contentPattern = /^[a-z0-9.]+$/;
                const consecutiveDotPattern = /\.\./;
                const startEndDotPattern = /^\.|\.$/;

                if (emailValue === '') {
                    validationFeedback.textContent = '';
                    availabilityFeedback.textContent = '';
                } else if (!contentPattern.test(emailValue)) {
                    validationFeedback.textContent = 'Hanya huruf (a-z), angka (0-9), dan tanda titik (.) yang diizinkan.';
                    validationFeedback.className = 'feedback error';
                    availabilityFeedback.textContent = '';
                } else if (startEndDotPattern.test(emailValue)) {
                    validationFeedback.textContent = 'Tanda titik (.) tidak boleh di awal atau di akhir username.';
                    validationFeedback.className = 'feedback error';
                    availabilityFeedback.textContent = '';
                } else if (!lengthPattern.test(emailValue)) {
                    validationFeedback.textContent = 'Nama pengguna yang diajukan harus terdiri dari 6-30 karakter.';
                    validationFeedback.className = 'feedback error';
                    availabilityFeedback.textContent = '';
                } else if (consecutiveDotPattern.test(emailValue)) {
                    validationFeedback.textContent = 'Tanda titik (.) tidak boleh berurutan.';
                    validationFeedback.className = 'feedback error';
                    availabilityFeedback.textContent = '';
                } else {
                    validationFeedback.textContent = '';
                    checkEmailAvailability(emailValue);
                    emailInput.classList.remove('error-border');
                }
            });

            function checkEmailAvailability(emailPrefix) {
                var prodi = $('#prodi').val();
                if (emailPrefix.length > 0) {
                    $.ajax({
                        url: '<?= site_url('EmailController/check_email_availability'); ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            email_prefix: emailPrefix,
                            prodi: prodi,
                            nama_depan: $('#nama_depan').val(),
                            nama_belakang: $('#nama_belakang').val()
                        },
                        success: function(response) {
                            var availabilityFeedback = '';
                            if (response.status === 'taken') {
                                availabilityFeedback = '<span class="feedback error">Username sudah terdaftar</span><br>';
                                if (response.suggestions.length > 0) {
                                    var suggestionsHtml = '<span class="feedback success">Saran Email: ' + response.suggestions.join(', ') + '</span>';
                                    availabilityFeedback += suggestionsHtml;
                                }
                            } else {
                                availabilityFeedback = '<span class="feedback success">Username tersedia</span>';
                                emailInput.classList.remove('error-border');
                            }
                            $('#emailAvailabilityFeedback').html(availabilityFeedback);
                        }
                    });
                } else {
                    $('#emailAvailabilityFeedback').empty();
                    emailInput.classList.remove('error-border');
                }
            }

            // Validasi Email Pengguna
            emailPenggunaInput.addEventListener('input', function() {
                const emailPattern = /^[a-z0-9.@]+$/;
                if (emailPenggunaInput.value === '') {
                    // Kosongkan feedback jika input kosong
                    emailPenggunaFeedback.textContent = '';
                } else if (!emailPattern.test(emailPenggunaInput.value)) {
                    emailPenggunaFeedback.textContent = 'Email hanya boleh berisi huruf (a-z), angka(0-9), dan (.)';
                    emailPenggunaFeedback.className = 'feedback error';
                } else {
                    emailPenggunaFeedback.textContent = '';
                    emailPenggunaInput.classList.remove('error-border');
                }
            });

            // Validasi KTM (hanya format file png, jpg, jpeg)
            ktmInput.addEventListener('change', function() {
                const file = ktmInput.files[0];
                const allowedExtensions = ['image/jpeg', 'image/png', 'image/jpg'];
                if (file && !allowedExtensions.includes(file.type)) {
                    ktmFeedback.textContent = 'File KTM harus dalam format .png, .jpg, atau .jpeg.';
                    ktmFeedback.className = 'feedback error';
                } else {
                    ktmFeedback.textContent = '';
                    ktmInput.classList.remove('error-border');
                }
            });

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                const emailAvailabilityFeedback = document.getElementById('emailAvailabilityFeedback');
                const nimAvailabilityFeedback = nimFeedback.textContent; // Ambil pesan validasi NIM

                let hasError = false;

                // Cek apakah email sudah terdaftar
                if (emailAvailabilityFeedback.textContent.includes('Username sudah terdaftar')) {
                    emailInput.classList.add('shake', 'error-border');
                    document.querySelector('label[for="email_diajukan"]').classList.add('shake');

                    setTimeout(() => {
                        emailInput.classList.remove('shake');
                        document.querySelector('label[for="email_diajukan"]').classList.remove('shake');
                    }, 500);
                    hasError = true;
                }

                // Cek apakah ada feedback error untuk email
                if (validationFeedback.textContent.includes('Nama pengguna yang diajukan harus terdiri dari 6-30 karakter.') ||
                    validationFeedback.textContent.includes('Hanya huruf (a-z), angka (0-9), dan tanda titik (.) yang diizinkan.') ||
                    validationFeedback.textContent.includes('Tanda titik (.) tidak boleh di awal atau di akhir username.') ||
                    validationFeedback.textContent.includes('Tanda titik (.) tidak boleh berurutan.')) {

                    emailInput.classList.add('shake', 'error-border');
                    document.querySelector('label[for="email_diajukan"]').classList.add('shake');

                    setTimeout(() => {
                        emailInput.classList.remove('shake');
                        document.querySelector('label[for="email_diajukan"]').classList.remove('shake');
                    }, 500);

                    hasError = true;
                }

                // NIM validation
                if (nimFeedback.textContent.includes('NIM sudah terdaftar')) {
                    nimInput.classList.add('shake', 'error-border');
                    document.querySelector('label[for="nim"]').classList.add('shake', 'error-border');

                    setTimeout(() => {
                        nimInput.classList.remove('shake');
                        document.querySelector('label[for="nim"]').classList.remove('shake');
                    }, 500);
                    hasError = true;
                }

                if (namaDepanFeedback.textContent.includes('Nama depan hanya boleh berisi huruf dan spasi.')) {
                    namaDepanInput.classList.add('shake', 'error-border');
                    document.querySelector('label[for="nama_depan"]').classList.add('shake', 'error-border');

                    setTimeout(() => {
                        namaDepanInput.classList.remove('shake');
                        document.querySelector('label[for="nama_depan"]').classList.remove('shake');
                    }, 500);
                    hasError = true;
                }

                // Nama Belakang validation
                if (namaBelakangFeedback.textContent.includes('Nama belakang hanya boleh berisi huruf dan spasi.')) {
                    namaBelakangInput.classList.add('shake', 'error-border');
                    document.querySelector('label[for="nama_belakang"]').classList.add('shake', 'error-border');

                    setTimeout(() => {
                        namaBelakangInput.classList.remove('shake');
                        document.querySelector('label[for="nama_belakang"]').classList.remove('shake');
                    }, 500);
                    hasError = true;
                }

                // Email Pengguna validation
                if (emailPenggunaFeedback.textContent.includes('Email hanya boleh berisi huruf (a-z), angka(0-9), dan (.)')) {
                    emailPenggunaInput.classList.add('shake', 'error-border');
                    document.querySelector('label[for="email_pengguna"]').classList.add('shake', 'error-border');

                    setTimeout(() => {
                        emailPenggunaInput.classList.remove('shake');
                        document.querySelector('label[for="email_pengguna"]').classList.remove('shake');
                    }, 500);
                    hasError = true;
                }

                // KTM validation
                if (ktmFeedback.textContent.includes('File KTM harus dalam format .png, .jpg, atau .jpeg.')) {
                    ktmInput.classList.add('shake', 'error-border');
                    document.querySelector('label[for="ktm"]').classList.add('shake', 'error-border');

                    setTimeout(() => {
                        ktmInput.classList.remove('shake');
                        document.querySelector('label[for="ktm"]').classList.remove('shake');
                    }, 500);
                    hasError = true;
                }

                // Jika tidak ada error, kirim form
                if (!hasError) {
                    const submitButton = event.target.querySelector('.btn-form');
                    submitButton.classList.add('loading');
                    submitButton.disabled = true;
                    setTimeout(() => {
                        form.submit();
                    }, 1000);
                }
            });

            $('#prodi').on('change', function() {
                $('#email_diajukan').trigger('input');
            });

            function updateDomain() {
                var prodi = $('#prodi').val();
                var domain = '';
                switch (prodi) {
                    case 'Teknik Elektro S-1':
                        domain = '@te.unjani.ac.id';
                        break;
                        // dst...
                    default:
                        domain = '@student.unjani.ac.id';
                        break;

                }
                $('#emailDomain').text(domain);
                updateSuggestions();
            }

            function updateSuggestions() {
                var namaDepan = $('#nama_depan').val();
                var namaBelakang = $('#nama_belakang').val();
                var prodi = $('#prodi').val();

                var isNamaDepanValid = /^[A-Za-z\s]+$/.test(namaDepan.trim());
                var isNamaBelakangValid = /^[A-Za-z\s]+$/.test(namaBelakang.trim());

                if (isNamaDepanValid && isNamaBelakangValid && prodi.trim()) {
                    $.ajax({
                        url: '<?= base_url('EmailController/generateSuggestions'); ?>',
                        type: 'POST',
                        data: {
                            nama_depan: namaDepan,
                            nama_belakang: namaBelakang,
                            prodi: prodi
                        },
                        success: function(response) {
                            var data = JSON.parse(response);
                            if (data.status === 'success') {
                                var suggestionsHtml = '';
                                data.suggestions.forEach(function(suggestion, index) {
                                    if (index < 2) {
                                        suggestionsHtml += '<div class="form-check"><input class="form-check-input" type="radio" name="email_option" id="suggestion' + (index + 1) + '" value="' + suggestion + '"><label class="form-check-label" for="suggestion' + (index + 1) + '">' + suggestion + '</label></div>';
                                    }
                                });
                                $('#emailSuggestions').html(suggestionsHtml);
                                $('.suggestion-radio').show();
                            } else {
                                $('#emailSuggestions').html('<p>Username tersedia.</p>');
                                $('.suggestion-radio').hide();
                            }
                        }
                    });
                    if ($('#customEmail').is(':checked')) {
                        $('#customEmailField').show();
                    }

                } else {
                    $('.suggestion-radio').hide();
                    $('#customEmailField').hide();
                }
            }

            <?php if ($this->session->flashdata('success') || $this->session->flashdata('error')): ?>
                var messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
                messageModal.show();

                document.getElementById('messageModal').addEventListener('hidden.bs.modal', function() {
                    location.reload();
                });
            <?php endif; ?>

            grecaptcha.ready(function() {
                grecaptcha.execute('6Lf0PEQqAAAAANCvF8-NRJwRcVHMZDMbSD84j7gZ', {
                    action: 'submit'
                }).then(function(token) {
                    document.getElementById('recaptcha-token').value = token;
                });
            });
        });
    </script>
</body>

</html>