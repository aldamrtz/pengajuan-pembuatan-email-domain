<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kendala Pengajuan Subdomain</title>

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

        .nav-tabs {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            margin-bottom: 35px;
            margin-top: 10px;
            border-color: #003366;
        }

        .nav-tabs .nav-link {
            margin-left: -1px;
            color: #003366;
            font-size: 15px;
            font-weight: bold;
            width: 100px;
            border-top: 5px solid transparent;
        }

        .nav-tabs .nav-link.active {
            border-color: #003366;
            border-top: 5px solid #003366;
            color: #003366 !important;
            opacity: 1;
            border-bottom-color: white;
        }

        .nav-tabs .nav-link:hover {
            color: #003366;
            border-color: #003366;
        }

        .status-box {
            margin-top: -10px;
        }

        #status-history {
            padding: 20px;
            background-color: #f0f0f0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        h4 {
            font-weight: bold;
            color: #333;
        }

        .h4-data {
            font-weight: bold;
            color: #333;
            margin-top: -10px;
            margin-bottom: 25px;
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

        .form-group input,
        .form-group select,
        .form-group textarea {
            color: #333;
            border-color: #003366;
            padding: 10px 15px 10px 15px;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
            z-index: 0;
        }

        .form-group input:focus,
        .form-group select:focus,
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
            border-radius: 5px;
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
            <a class="sidebar-brand" href="<?= site_url('EmailController'); ?>" style="text-decoration: none;">
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
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('SubDomainController/status_pengajuan_subdomain'); ?>" style="text-decoration: none;">
                        <i class="fas fa-tasks"></i>
                        <span>Status Pengajuan Sub Domain</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">LAPORAN</div>
                <li class="nav-item active">
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
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="status-tab" data-bs-toggle="tab" data-bs-target="#status" type="button" role="tab" aria-controls="status" aria-selected="true">Form</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab" aria-controls="data" aria-selected="false">Status</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="status" role="tabpanel" aria-labelledby="status-tab">
                            <h4 class="h4-data">Kendala Pengajuan</h4>
                            <?= form_open_multipart('EmailController/submit'); ?>
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
                                        <textarea class="form-control" id="keterangan" rows="3" name="keterangan" placeholder=" " required><?= set_value('keterangan'); ?></textarea>
                                        <label for="keterangan" class="form-label keterangan-label">Keterangan</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="recaptcha-token" name="recaptcha-token">
                            <button type="submit" class="btn btn-form btn-block">Kirim<div class="spinner-border"></div></button>
                            <?= form_close(); ?>
                        </div>
                        <div class="tab-pane fade" id="data" role="tabpanel" aria-labelledby="data-tab">
                            <h4 class="h4-data">Status Kendala Pengajuan</h4>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="ktmModal" tabindex="-1" aria-labelledby="ktmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-ktm modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownDownload" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-download"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownDownload">
                            <li><a class="dropdown-item" href="#" id="downloadPng">Download PNG</a></li>
                            <li><a class="dropdown-item" href="#" id="downloadJpg">Download JPG</a></li>
                            <li><a class="dropdown-item" href="#" id="downloadJpeg">Download JPEG</a></li>
                        </ul>
                    </div>
                </div>
                <div class="modal-body text-center">
                    <img id="ktmImage" src="" class="img-fluid" alt="KTM">
                </div>
                <div class="modal-footer justify-content-center">
                    <button id="zoomIn" class="btn btn-light">
                        <i class="fas fa-search-plus"></i>
                    </button>
                    <button id="zoomOut" class="btn btn-light">
                        <i class="fas fa-search-minus"></i>
                    </button>
                    <button id="rotateLeft" class="btn btn-light">
                        <i class="fas fa-undo"></i>
                    </button>
                    <button id="rotateRight" class="btn btn-light">
                        <i class="fas fa-redo"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
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

            activateSavedTab();

            function saveActiveTab(tabId) {
                localStorage.setItem('activeTab', tabId);
            }

            function activateSavedTab() {
                const activeTabId = localStorage.getItem('activeTab');
                if (activeTabId) {
                    const tabTrigger = document.querySelector(`button[data-bs-target="${activeTabId}"]`);
                    if (tabTrigger) {
                        const tab = new bootstrap.Tab(tabTrigger);
                        tab.show();

                        // Hide other tab panes
                        const tabPanes = document.querySelectorAll('.tab-pane');
                        tabPanes.forEach(pane => {
                            pane.classList.remove('show', 'active');
                        });
                        const activePane = document.querySelector(activeTabId);
                        if (activePane) {
                            activePane.classList.add('show', 'active');
                        }
                    }
                }
            }

            document.addEventListener('shown.bs.tab', function(event) {
                const tabId = event.target.getAttribute('data-bs-target');
                saveActiveTab(tabId);
            });
        });
    </script>
</body>

</html>