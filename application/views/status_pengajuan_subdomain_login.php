<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Status Pengajuan Subdomain</title>

    <link rel="icon" href="<?= base_url('assets/img/logo-unjani.png'); ?>" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #e0f5ec, #e0f5ec, #00aaff);
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

        .form-wrapper {
            position: static;
            width: 962px;
            background: #ffffff;
            padding: 30px;
            margin-top: 80px;
            margin-bottom: 7px;
            margin-left: 63px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .form-container {
            align-items: center;
        }

        h3 {
            font-weight: bold;
            color: #13855c;
        }

        p {
            margin-bottom: 30px;
            color: #333;
        }

        .mb-3 {
            position: relative;
            margin-bottom: 15px;
        }

        .mb-3 label {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            font-size: 16px;
            color: #13855c;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .mb-3 input {
            padding: 11px 50px 11px 15px;
            border: 1.5px solid #13855c;
            color: #333;
            border-radius: 4px;
            margin-bottom: 30px;
            width: 100%;
            box-sizing: border-box;
        }

        .mb-3 input:focus {
            box-shadow: 0 0 0 0.25rem rgba(0, 170, 255, 0.25);
            border-color: #00aaff;
        }

        .mb-3 input:not(:focus):not(:placeholder-shown)+label {
            color: #13855c;
        }

        .mb-3 input:focus+label,
        .mb-3 input:not(:placeholder-shown)+label {
            top: -10px;
            left: 10px;
            font-size: 13px;
            background-color: #ffffff;
            padding: 0 5px;
            transform: translateY(0);
            color: #00aaff;
        }

        .kode-container {
            position: relative;
        }

        #togglePassword {
            color: #13855c;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 15px;
            z-index: 999 !important;
        }

        .mb-3 input:focus~#togglePassword {
            color: #00aaff;
        }

        .mb-3.error input:focus~#togglePassword {
            color: #d9534f;
        }

        .mb-3.error #togglePassword {
            color: #d9534f;
            margin-top: -10px;
        }

        .error {
            color: #d9534f;
            font-size: 12px;
            margin-bottom: 25px !important;
        }

        .mb-3.error input {
            border-color: #d9534f;
            margin-bottom: 3px;
        }

        .mb-3.error label {
            color: #d9534f;
        }

        .mb-3.error input:focus {
            border-color: #d9534f;
            box-shadow: #d9534f;
            box-shadow: 0 0 0 0.2rem rgba(217, 83, 79, 0.25);
        }

        .mb-3.error input:focus+label,
        .mb-3.error input:not(:focus)+label {
            color: #d9534f;
        }

        .btn-custom {
            background: linear-gradient(135deg, #13855c, #1cc88a, #00aaff);
            color: #ffffff;
            border: none;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 20px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin-top: 25px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-custom:disabled {
            background: linear-gradient(135deg, #13855c, #1cc88a, #00aaff);
            cursor: not-allowed;
        }

        .btn-custom:hover,
        .btn-custom:active,
        .btn-custom:focus {
            background: linear-gradient(135deg, #13855c, #13855c, #13855c);
            color: #ffffff;
            transform: scale(1.03);
        }

        .btn-custom.loading {
            background: linear-gradient(135deg, #13855c, #1cc88a, #00aaff);
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

        .btn-custom.loading .spinner-border {
            display: inline-block;
        }

        .btn-custom .spinner-border {
            position: absolute;
            transform: translate(-50%, -50%);
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

            .form-container {
                flex-direction: column;
                align-items: center;
            }

            .form-container img {
                width: 100%;
                height: auto;
                max-width: 200px;
                margin-bottom: -45px;
                display: block;
                margin-left: auto;
                margin-right: auto;
            }

            .col-md-6 {
                margin-left: 0 !important;
            }

            .row.mb-3 {
                margin-bottom: 1px !important;
            }
        }

        @media (max-width: 576px) {
            .form-wrapper {
                width: 100%;
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

            .form-container {
                flex-direction: column;
                align-items: center;
            }

            .form-container img {
                width: 100%;
                height: auto;
                max-width: 200px;
                margin-bottom: -45px;
                display: block;
                margin-left: auto;
                margin-right: auto;
            }

            .col-md-6 {
                margin-left: 0 !important;
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
                <li class="nav-item" style="margin-bottom: 5px !important;">
                    <a class="nav-link" href="<?= site_url('SubDomainController'); ?>" style="text-decoration: none;">
                        <i class="fas fa-globe"></i>
                        <span>Pengajuan Sub Domain</span>
                    </a>
                </li>
                <li class="nav-item active">
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
                    <div class="row">
                        <div class="col-md-6">
                            <img src="<?= base_url('assets/img/login_user.gif') ?>" alt="Logo Unjani" style="width: 390px; height: auto;">
                        </div>
                        <div class="col-md-6" style="margin-top: 25px; margin-left: -50px;">
                            <h3>Halo!</h3>
                            <p>Silakan masuk menggunakan email pribadi Anda dan kode yang telah dikirim dari email.</p>
                            <form action="<?= base_url('SubDomainController/status_pengajuan_subdomain_login'); ?>" id="login-form" method="post">
                                <div class="mb-3">
                                    <input type="email" class="form-control" id="email" name="email_penanggung_jawab" required placeholder=" ">
                                    <label for="email">Email Penanggung Jawab</label>
                                    <div id="email-error" class="error"></div>
                                </div>
                                <div class="mb-3 kode-container">
                                    <input type="password" class="form-control" id="kode" name="kode_pengajuan" required placeholder=" ">
                                    <label for="kode">Kode Pengajuan</label>
                                    <i class="fas fa-eye" id="togglePassword"></i>
                                    <div id="kode-error" class="error"></div>
                                </div>
                                <input type="hidden" id="recaptcha-token" name="recaptcha-token">
                                <button type="submit" class="btn btn-custom btn-block">Masuk
                                    <div class="spinner-border"></div>
                                </button>
                            </form>
                            <div id="error-message" class="error text-center" style="display: none;"></div>
                        </div>
                    </div>
                    <div id="error-message" class="error text-center" style="display: none;"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6Lf0PEQqAAAAANCvF8-NRJwRcVHMZDMbSD84j7gZ"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggler = document.querySelector('.navbar-toggler');
            const sidebar = document.getElementById('sidebar');

            toggler.addEventListener('click', function(event) {
                sidebar.classList.toggle('show');
                event.stopPropagation();
            });

            document.addEventListener('click', function(event) {
                if (!sidebar.contains(event.target) && !toggler.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            });

            const togglePassword = document.querySelector('#togglePassword');
            const kode = document.querySelector('#kode');

            togglePassword.addEventListener('click', function() {
                const type = kode.getAttribute('type') === 'password' ? 'text' : 'password';
                kode.setAttribute('type', type);

                this.classList.toggle('fa-eye-slash');
            });
        });

        const submitButton = document.querySelector('.btn-custom');

        // Event listener untuk input email
        document.getElementById('email').addEventListener('input', function() {
            const email = document.getElementById('email');
            if (email.value === '') {
                document.getElementById('email-error').innerText = '';
                email.closest('.mb-3').classList.remove('error');
            }
        });

        // Event listener untuk input password
        document.getElementById('kode').addEventListener('input', function() {
            const kode = document.getElementById('kode');
            if (kode.value === '') {
                document.getElementById('kode-error').innerText = '';
                kode.closest('.mb-3').classList.remove('error');
                document.querySelector('#togglePassword').classList.remove('error');
            }
        });

        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault();

            submitButton.classList.add('loading');
            submitButton.setAttribute('disabled', 'true');

            grecaptcha.ready(function() {
                grecaptcha.execute('6Lf0PEQqAAAAANCvF8-NRJwRcVHMZDMbSD84j7gZ', {
                    action: 'submit'
                }).then(function(token) {
                    const form = document.getElementById('login-form');
                    const formData = new FormData(form);
                    formData.append('recaptcha-token', token);

                    fetch('<?php echo site_url('SubDomainController/status_pengajuan_subdomain_login'); ?>', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.text())
                        .then(text => {
                            submitButton.classList.remove('loading');
                            submitButton.removeAttribute('disabled');
                            console.log(text);
                            try {
                                const data = JSON.parse(text);
                                if (data.success) {
                                    window.location.href = '<?php echo site_url('SubDomainController/status_pengajuan_subdomain'); ?>';
                                } else {
                                    // Menghapus error sebelumnya
                                    document.getElementById('email-error').innerText = '';
                                    document.getElementById('kode-error').innerText = '';

                                    if (data.error.email) {
                                        document.getElementById('email-error').innerText = data.error.email;
                                        document.querySelector('#email').closest('.mb-3').classList.add('error');
                                    }
                                    if (data.error.kode) {
                                        document.getElementById('kode-error').innerText = data.error.kode;
                                        const passwordGroup = document.querySelector('#kode').closest('.mb-3');
                                        passwordGroup.classList.add('error');
                                        document.querySelector('#togglePassword').classList.add('error');
                                    }
                                    if (data.error.general) {
                                        document.getElementById('error-message').innerText = data.error.general;
                                    }
                                }
                            } catch (e) {
                                console.error('Error parsing JSON:', e);
                                document.getElementById('error-message').innerText = 'Terjadi kesalahan. Silakan coba lagi.';
                            }
                        })
                        .catch(error => {
                            submitButton.classList.remove('loading');
                            submitButton.removeAttribute('disabled');
                            console.error('Error:', error);
                            document.getElementById('error-message').innerText = 'Terjadi kesalahan. Silakan coba lagi.';
                        });
                });
            });
        });
    </script>
</body>

</html>