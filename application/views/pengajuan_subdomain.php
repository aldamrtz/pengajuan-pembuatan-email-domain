<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengajuan Sub Domain</title>

    <link rel="icon" href="<?= base_url('assets/img/logo-unjani.png'); ?>" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #e0f5ec;
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

        .sidebar {
            background: linear-gradient(135deg, #13855c, #13855c, #1cc88a);
            height: 100vh;
            padding: 15px;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1100;
            width: 267px;
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
            text-shadow: #ffffff
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
            margin-left: -10px;
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
            width: 962px;
            background: #ffffff;
            padding: 30px;
            margin-top: 80px;
            margin-bottom: 7px;
            margin-left: 63px;
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

        .form-group .keterangan-label {
            position: absolute;
            top: 25%;
            left: 15px;
            transform: translateY(-50%);
            font-size: 16px;
            transition: all 0.3s ease;
            pointer-events: none;
            color: #003366;
            z-index: 1;
        }

        .form-group input,
        .form-group textarea {
            color: #333;
            border-color: #003366;
            padding: 10px 15px 10px 15px;
            border-radius: 7px;
            width: 100%;
            box-sizing: border-box;
            z-index: 0;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            box-shadow: 0 0 0 0.25rem rgba(0, 170, 255, 0.25);
            border-color: #00aaff;
        }

        .form-group input:not(:focus):not(:placeholder-shown)+label,
        .form-group select:not(:focus)+label,
        .form-group textarea:not(:focus):not(:placeholder-shown)+label {
            color: #003366;
        }

        .form-group input:focus+label,
        .form-group input:not(:placeholder-shown)+label,
        .form-group select:focus+label,
        .form-group select:valid+label,
        .form-group textarea:focus+label,
        .form-group textarea:not(:placeholder-shown)+label {
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
        .form-group select.error-border,
        .form-group textarea.error-border {
            border-color: #d9534f;
        }

        .form-group input.error-border:focus,
        .form-group select.error-border:focus,
        .form-group textarea.error-border:focus {
            box-shadow: 0 0 0 0.2rem rgba(217, 83, 79, 0.25);
            border-color: #d9534f;
        }

        .form-group input.error-border+label,
        .form-group select.error-border+label,
        .form-group textarea.error-border+label {
            color: #d9534f !important;
        }

        .form-group input.shake+label,
        .form-group select.shake+label,
        .form-group textarea.shake+label {
            color: #d9534f !important;
            box-shadow: none;
        }

        .input-group-text {
            background-color: rgba(0, 51, 102, 0.25);
            border-color: #003366;
            color: #003366;
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
            .form-wrapper {
                width: 100%;
                max-width: 100%;
                margin-left: 0;
            }

            .navbar-toggler {
                display: inline-block;
                position: absolute;
                top: 15px;
                left: 20px;
                z-index: 1000;
            }

            .sidebar {
                transform: translateX(-100%);
                display: block;
            }

            .sidebar.show {
                transform: translateX(0);
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
            .form-wrapper {
                width: 100%;
                max-width: 100%;
                margin-left: 0;
            }

            .navbar-toggler {
                display: inline-block;
                position: absolute;
                top: 15px;
                left: 20px;
                z-index: 1000;
            }

            .sidebar {
                transform: translateX(-100%);
                display: block;
            }

            .sidebar.show {
                transform: translateX(0);
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
    <div class="container-fluid">
        <nav class="navbar fixed-top">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" aria-label="Toggle sidebar">
                    <span class="navbar-toggler-icon"></span> <!-- Icon burger -->
                </button>
            </div>
        </nav>

        <!-- Sidebar -->
        <div class="sidebar d-md-block" id="sidebar">
            <a class="sidebar-brand" href="<?= site_url('SubDomainController'); ?>" style="text-decoration: none;">
                <div class="sidebar-brand-icon">
                    <img src="<?= base_url('assets/img/logo-unjani.png') ?>">
                </div>
                <div class="sidebar-brand-text">ACCESS TRACK</div>
            </a>
            <ul class="nav flex-column">
                <hr class="sidebar-divider">
                <div class="sidebar-heading">PENGAJUAN</div>
                <li class="nav-item active" style="margin-bottom: 5px !important;">
                    <a class="nav-link" href="<?= site_url('SubDomainController'); ?>" style="text-decoration: none;">
                        <i class="fas fa-globe"></i>
                        <span>Pengajuan Sub Domain</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('SubDomainController/status_pengajuan_subdomain'); ?>" style="text-decoration: none;">
                        <i class="fas fa-tasks"></i>
                        <span>Status Pengajuan Sub Domain</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">LAPORAN</div>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('SubDomainController/kendala_pengajuan_subdomain'); ?>">
                        <i class="fas fa-file-alt"></i>
                        <span>Kendala Pengajuan</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
            </ul>
        </div>
        <div class="row form-container justify-content-center">
            <div class="col-md-8">
                <div class="form-wrapper">
                    <h2></i>Pengajuan Pembuatan Domain</h2>
                    <?= form_open_multipart('SubDomainController/submit'); ?>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="nomor_induk" name="nomor_induk" placeholder=" " value="<?= set_value('nomor_induk'); ?>" required pattern="\d*" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                <label for="nomor_induk" class="form-label">Nomor Induk</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="unit_kerja" name="unit_kerja" placeholder=" " required value="<?= set_value('unit_kerja'); ?>">
                                <label for="unit_kerja" class="form-label">Unit Kerja</label>
                                <div id="unitKerjaFeedback" class="feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" placeholder=" " value="<?= set_value('penanggung_jawab'); ?>" required>
                                <label for="penanggung_jawab" class="form-label">Penanggung Jawab</label>
                                <div id="penanggungJawabFeedback" class="feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control" id="email_penanggung_jawab" name="email_penanggung_jawab" placeholder=" " value="<?= set_value('email_penanggung_jawab'); ?>" required>
                                <label for="email_penanggung_jawab" class="form-label">Email Penanggung Jawab</label>
                                <div id="emailFeedback" class="feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="kontak_penanggung_jawab" name="kontak_penanggung_jawab" placeholder=" " value="<?= set_value('kontak_penanggung_jawab'); ?>" required pattern="\d*" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                <label for="kontak_penanggung_jawab" class="form-label">Kontak Penanggung Jawab</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text" style="width: 75px">https://</span>
                                    <input type="text" class="form-control" id="sub_domain" name="sub_domain" style="z-index: 0;" placeholder=" " value="<?= set_value('sub_domain'); ?>" required>
                                    <label for="sub_domain" class="form-label" style="margin-left: 75px;">Sub Domain</label>
                                    <span class="input-group-text">.unjani.ac.id</span>
                                </div>
                                <div id="subdomainValidationFeedback" class="feedback"></div>
                                <div id="subdomainAvailabilityFeedback" class="feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="ip_pointing" name="ip_pointing" placeholder=" " value="<?= set_value('ip_pointing'); ?>" required>
                                <label for="ip_pointing" class="form-label">IP Pointing</label>
                                <div id="ipPointingFeedback" class="feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" id="keterangan" rows="3" name="keterangan" placeholder=" " required><?= set_value('keterangan'); ?></textarea>
                                <label for="keterangan" class="form-label keterangan-label">Keterangan</label>
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
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const penanggungJawabInput = document.getElementById('penanggung_jawab');
            const penanggungJawabFeedback = document.getElementById('penanggungJawabFeedback');

            const unitKerjaInput = document.getElementById('unit_kerja');
            const unitKerjaFeedback = document.getElementById('unitKerjaFeedback');

            const emailInput = document.getElementById('email_penanggung_jawab');
            const emailFeedback = document.getElementById('emailFeedback');

            const subdomainInput = document.getElementById('sub_domain');
            const validationFeedback = document.getElementById('subdomainValidationFeedback');
            const availabilityFeedback = document.getElementById('subdomainAvailabilityFeedback');

            const ipPointingInput = document.getElementById('ip_pointing');
            const ipPointingFeedback = document.getElementById('ipPointingFeedback');

            penanggungJawabInput.addEventListener('input', function() {
                if (penanggungJawabInput.value === '') {
                    // Kosongkan feedback jika input kosong
                    penanggungJawabFeedback.textContent = '';
                } else if (!/^[A-Za-z\s]+$/.test(penanggungJawabInput.value)) {
                    penanggungJawabFeedback.textContent = 'Hanya boleh berisi huruf';
                    penanggungJawabFeedback.className = 'feedback error';
                } else {
                    penanggungJawabFeedback.textContent = '';
                    penanggungJawabInput.classList.remove('error-border');
                }
            });

            unitKerjaInput.addEventListener('input', function() {
                const unitKerjaPattern = /^[A-Za-z0-9.,&\-\(\)\s]*$/; // Memungkinkan huruf, angka, dan karakter yang ditentukan

                if (unitKerjaInput.value === '') {
                    // Kosongkan feedback jika input kosong
                    unitKerjaFeedback.textContent = '';
                } else if (!unitKerjaPattern.test(unitKerjaInput.value)) {
                    unitKerjaFeedback.textContent = 'Hanya boleh berisi huruf, angka, dan karakter (.), (,), (&), (-), serta (()).';
                    unitKerjaFeedback.className = 'feedback error';
                } else {
                    unitKerjaFeedback.textContent = '';
                    unitKerjaInput.classList.remove('error-border');
                }
            });

            // Validasi Email Input
            emailInput.addEventListener('input', function() {
                const emailValue = emailInput.value;

                const lengthPattern = /^.{6,30}$/;
                const contentPattern = /^[a-z0-9.@]+$/;
                const consecutiveDotPattern = /\.\./;
                const startEndDotPattern = /^\.|\.$/;

                if (emailValue === '') {
                    emailFeedback.textContent = '';
                } else if (!contentPattern.test(emailValue)) {
                    emailFeedback.textContent = 'Hanya huruf (a-z), angka (0-9), dan tanda titik (.) yang diizinkan.';
                    emailFeedback.className = 'feedback error';
                } else if (startEndDotPattern.test(emailValue)) {
                    emailFeedback.textContent = 'Tanda titik (.) tidak boleh di awal atau di akhir email.';
                    emailFeedback.className = 'feedback error';
                } else if (!lengthPattern.test(emailValue)) {
                    emailFeedback.textContent = 'Email harus terdiri dari 6-30 karakter.';
                    emailFeedback.className = 'feedback error';
                } else if (consecutiveDotPattern.test(emailValue)) {
                    emailFeedback.textContent = 'Tanda titik (.) tidak boleh berurutan.';
                    emailFeedback.className = 'feedback error';
                } else {
                    emailFeedback.textContent = '';
                    emailInput.classList.remove('error-border');
                }
            });

            ipPointingInput.addEventListener('input', function() {
                const ipPattern = /^(\d{1,3}\.){3}\d{1,3}$/;
                if (ipPointingInput.value === '') {
                    // Kosongkan feedback jika input kosong
                    ipPointingFeedback.textContent = '';
                } else if (!ipPattern.test(ipPointingInput.value)) {
                    ipPointingFeedback.textContent = 'Hanya boleh mengandung angka dan tanda titik';
                    ipPointingFeedback.className = 'feedback error';
                } else {
                    ipPointingFeedback.textContent = '';
                    ipPointingInput.classList.remove('error-border');
                }
            });

            subdomainInput.addEventListener('input', function() {
                const subdomainValue = subdomainInput.value;
                const lengthPattern = /^.{6,63}$/;
                const contentPattern = /^[a-z0-9\-\.]+$/; // Memungkinkan titik
                const consecutiveHyphenPattern = /--/;
                const consecutiveDotPattern = /\.\./; // Memastikan titik tidak berurutan
                const startEndHyphenPattern = /^-|-$/;
                const startEndDotPattern = /^\.|\.$/; // Memastikan titik tidak di awal atau akhir
                const hyphenDotFollowingPattern = /[-]\./; // Tanda hubung (-) tidak boleh diikuti oleh titik (.)
                const dotHyphenFollowingPattern = /\.[-]/; // Titik (.) tidak boleh diikuti oleh tanda hubung (-)

                // Reset pesan
                validationFeedback.textContent = '';
                availabilityFeedback.textContent = '';

                // Validasi urutan prioritas
                if (subdomainValue === '') {
                    validationFeedback.textContent = '';
                    availabilityFeedback.textContent = '';
                } else if (!contentPattern.test(subdomainValue)) {
                    validationFeedback.textContent = 'Hanya huruf kecil (a-z), angka (0-9), tanda hubung (-), dan titik (.) yang diizinkan.';
                    validationFeedback.className = 'feedback error';
                } else if (startEndHyphenPattern.test(subdomainValue)) {
                    validationFeedback.textContent = 'Sub domain tidak boleh dimulai atau diakhiri dengan tanda hubung (-).';
                    validationFeedback.className = 'feedback error';
                } else if (startEndDotPattern.test(subdomainValue)) {
                    validationFeedback.textContent = 'Titik (.) tidak boleh di awal atau akhir sub domain.';
                    validationFeedback.className = 'feedback error';
                } else if (!lengthPattern.test(subdomainValue)) {
                    validationFeedback.textContent = 'Sub domain yang diajukan harus terdiri dari 6-63 karakter.';
                    validationFeedback.className = 'feedback error';
                } else if (consecutiveHyphenPattern.test(subdomainValue)) {
                    validationFeedback.textContent = 'Sub domain tidak boleh mengandung dua tanda hubung berturut-turut.';
                    validationFeedback.className = 'feedback error';
                } else if (consecutiveDotPattern.test(subdomainValue)) {
                    validationFeedback.textContent = 'Sub domain tidak boleh mengandung dua titik berturut-turut.';
                    validationFeedback.className = 'feedback error';
                } else if (hyphenDotFollowingPattern.test(subdomainValue)) {
                    validationFeedback.textContent = 'Tanda hubung (-) tidak boleh diikuti oleh titik (.).';
                    validationFeedback.className = 'feedback error';
                } else if (dotHyphenFollowingPattern.test(subdomainValue)) {
                    validationFeedback.textContent = 'Titik (.) tidak boleh diikuti oleh tanda hubung (-).';
                    validationFeedback.className = 'feedback error';
                } else {
                    validationFeedback.textContent = '';
                    checkSubDomainAvailability(subdomainValue);
                }
            });

            function checkSubDomainAvailability(subDomainPrefix) {
                if (subDomainPrefix.length > 0) {
                    $.ajax({
                        url: '<?= site_url('SubDomainController/check_subdomain_availability'); ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            sub_domain_prefix: subDomainPrefix
                        },
                        success: function(response) {
                            var availabilityFeedback = '';
                            if (response.status === 'taken') {
                                availabilityFeedback = '<span class="feedback error">Sub Domain sudah terdaftar</span><br>';
                            } else {
                                availabilityFeedback = '<span class="feedback success">Sub Domain tersedia</span>';
                                subdomainInput.classList.remove('error-border');
                            }
                            $('#subdomainAvailabilityFeedback').html(availabilityFeedback);
                        }
                    });
                } else {
                    $('#subdomainAvailabilityFeedback').empty();
                    subdomainInput.classList.remove('error-border');
                }
            }

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                const subdomainAvailabilityFeedback = document.getElementById('subdomainAvailabilityFeedback');

                let hasError = false;

                // Cek apakah email sudah terdaftar
                if (subdomainAvailabilityFeedback.textContent.includes('Sub domain sudah terdaftar')) {
                    subdomainInput.classList.add('shake', 'error-border');
                    document.querySelector('label[for="sub_domain"]').classList.add('shake');

                    setTimeout(() => {
                        subdomainInput.classList.remove('shake');
                        document.querySelector('label[for="sub_domain"]').classList.remove('shake');
                    }, 500);
                    hasError = true;
                }

                if (
                    validationFeedback.textContent.includes('Sub domain yang diajukan harus terdiri dari 6-63 karakter.') ||
                    validationFeedback.textContent.includes('Hanya huruf kecil (a-z), angka (0-9), tanda hubung (-), dan titik (.) yang diizinkan.') ||
                    validationFeedback.textContent.includes('Sub domain tidak boleh mengandung dua tanda hubung berturut-turut.') ||
                    validationFeedback.textContent.includes('Sub domain tidak boleh mengandung dua titik berturut-turut.') ||
                    validationFeedback.textContent.includes('Sub domain tidak boleh dimulai atau diakhiri dengan tanda hubung (-).') ||
                    validationFeedback.textContent.includes('Titik (.) tidak boleh di awal atau akhir sub domain.') ||
                    validationFeedback.textContent.includes('Tanda hubung (-) tidak boleh diikuti oleh titik (.).') ||
                    validationFeedback.textContent.includes('Titik (.) tidak boleh diikuti oleh tanda hubung (-).')
                ) {
                    subdomainInput.classList.add('shake', 'error-border');
                    document.querySelector('label[for="sub_domain"]').classList.add('shake');

                    setTimeout(() => {
                        subdomainInput.classList.remove('shake');
                        document.querySelector('label[for="sub_domain"]').classList.remove('shake');
                    }, 500);
                    hasError = true;
                }

                if (penanggungJawabFeedback.textContent.includes('Hanya boleh berisi huruf')) {
                    penanggungJawabInput.classList.add('shake', 'error-border');
                    document.querySelector('label[for="penanggung_jawab"]').classList.add('shake', 'error-border');

                    setTimeout(() => {
                        penanggungJawabInput.classList.remove('shake');
                        document.querySelector('label[for="penanggung_jawab"]').classList.remove('shake');
                    }, 500);
                    hasError = true;
                }

                if (unitKerjaFeedback.textContent.includes('Hanya boleh berisi huruf, angka, dan karakter (.), (,), (&), (-), serta (()).')) {
                    unitKerjaInput.classList.add('shake', 'error-border');
                    document.querySelector('label[for="unit_kerja"]').classList.add('shake', 'error-border');

                    setTimeout(() => {
                        unitKerjaInput.classList.remove('shake');
                        document.querySelector('label[for="unit_kerja"]').classList.remove('shake');
                    }, 500);
                    hasError = true;
                }

                if (emailFeedback.textContent.includes('Email hanya boleh berisi huruf (a-z), angka(0-9), dan (.)')) {
                    emailInput.classList.add('shake', 'error-border');
                    document.querySelector('label[for="email_penanggung_jawab"]').classList.add('shake', 'error-border');

                    setTimeout(() => {
                        emailInput.classList.remove('shake');
                        document.querySelector('label[for="email_penanggung_jawab"]').classList.remove('shake');
                    }, 500);
                    hasError = true;
                }

                if (ipPointingFeedback.textContent.includes('Hanya boleh mengandung angka dan tanda titik')) {
                    ipPointingInput.classList.add('shake', 'error-border');
                    document.querySelector('label[for="ip_pointing"]').classList.add('shake', 'error-border');

                    setTimeout(() => {
                        ipPointingInput.classList.remove('shake');
                        document.querySelector('label[for="ip_pointing"]').classList.remove('shake');
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
        });

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
    </script>
</body>

</html>