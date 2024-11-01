<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Status Pengajuan Email</title>

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

        .btn-keluar {
            margin-left: auto;
            background-color: #00aaff;
            color: #ffffff;
            margin-top: -13px !important;
        }

        .btn-keluar:hover {
            background-color: #003366;
            color: #ffffff;
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
            width: 230px;
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
            width: 1000px;
            background: #ffffff;
            padding: 30px;
            margin-top: 80px;
            margin-bottom: 7px;
            margin-left: 25px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
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
        .form-group button {
            color: #333;
            border-color: #003366;
            padding: 10px 15px 10px 15px;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
            z-index: 0;
        }

        .form-group input:not(:focus):not(:placeholder-shown)+label,
        .form-group button:not(:focus)+label {
            color: #003366;
        }

        .form-group input:focus+label,
        .form-group input:not(:placeholder-shown)+label,
        .form-group button:focus+label,
        .form-group button:valid+label {
            top: -10px;
            left: 10px;
            font-size: 13px;
            background-color: #ffffff;
            padding: 0 5px;
            transform: translateY(0);
            color: #00aaff;
        }

        .form-group button:not(:focus):valid+label {
            color: #003366;
        }

        .form-group input.shake+label,
        .form-group button.shake+label {
            color: #d9534f !important;
            box-shadow: none;
        }

        .input-group-text {
            background-color: #003366;
            border-color: #003366;
            color: #ffffff;
            width: 100px;
        }

        .input-group-text:hover {
            background-color: #ffffff;
            border-color: #003366;
            color: #003366;
            width: 100px;
        }

        .input-group-text i {
            margin-top: 7px;
            font-size: 20px;
        }

        .form-group input:disabled {
            background-color: white;
            cursor: not-allowed;
        }

        .email-group {
            margin-bottom: 37px;
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

        .status-history {
            padding: 20px;
            background-color: #f0f0f0;
            margin-bottom: 15px;
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

        .modal-ktm {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .modal-ktm .modal-header,
        .modal-ktm .modal-footer {
            padding: 15px;
        }

        .modal-ktm .modal-body {
            overflow: hidden;
            padding: 0;
        }

        .modal-ktm .modal-body img {
            max-width: 100%;
            max-height: 70vh;
            transition: transform 0.3s ease;
            position: relative;
            cursor: default;
        }

        .modal.fade {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal.show {
            opacity: 1;
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
                <a href="<?= site_url('EmailController/logout'); ?>" class="btn btn-keluar">
                    Keluar
                </a>
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
                    <a class="nav-link" href="<?= site_url('EmailController'); ?>" style="text-decoration: none;">
                        <i class="fas fa-envelope"></i>
                        <span>Pengajuan Email</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= site_url('EmailController/status_pengajuan_email'); ?>" style="text-decoration: none;">
                        <i class="fas fa-tasks"></i>
                        <span>Status Pengajuan Email</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">LAPORAN</div>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('EmailController/kendala_pengajuan_email'); ?>">
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
                            <button class="nav-link active" id="status-tab" data-bs-toggle="tab" data-bs-target="#status" type="button" role="tab" aria-controls="status" aria-selected="true">Status</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab" aria-controls="data" aria-selected="false">Data</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="status" role="tabpanel" aria-labelledby="status-tab">
                            <div class="status-box">
                                <h4>Status Pengajuan</h4>
                                <p>Informasi di bawah ini merupakan update pengajuan anda terkini</p>
                                <div id="status-history">
                                    <?php
                                    $bulan = [
                                        1 => 'Januari',
                                        'Februari',
                                        'Maret',
                                        'April',
                                        'Mei',
                                        'Juni',
                                        'Juli',
                                        'Agustus',
                                        'September',
                                        'Oktober',
                                        'November',
                                        'Desember'
                                    ];

                                    foreach ($status_history_email as $status):
                                        $date = new DateTime($status['tgl_update']);
                                        $hari = $date->format('d');
                                        $bulanIndo = $bulan[(int)$date->format('m')];
                                        $tahun = $date->format('Y');
                                        $jam = $date->format('H:i');
                                    ?>
                                        <div class="status-history">
                                            <p>Status: <strong><?= $status['status']; ?></strong></p>
                                            <p><?= "$hari $bulanIndo $tahun, $jam"; ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="data" role="tabpanel" aria-labelledby="data-tab">
                            <h4 class="h4-data">Data Pengajuan</h4>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="number" min="7" class="form-control" id="nim" name="nim" placeholder=" " value="<?= $pengajuan_email->nim; ?>" disabled pattern="\d*" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        <label for="nim" class="form-label">Nomor Induk Mahasiswa (NIM)</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="prodi" name="prodi" placeholder=" " value="<?= $pengajuan_email->prodi; ?>" disabled>
                                        <label for="prodi" class="form-label">Program Studi</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder=" " value="<?= $pengajuan_email->nama_lengkap; ?>" disabled>
                                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class=" col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="email_diajukan" style="z-index: 0;" name="email_diajukan" placeholder=" " value="<?= $pengajuan_email->email_diajukan; ?>" disabled>
                                        <label for="email_diajukan" class="form-label">Email yang Diajukan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3" style="margin-bottom: -5px !important;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email_pengguna" name="email_pengguna" placeholder=" " value="<?= $pengajuan_email->email_pengguna; ?>" disabled>
                                        <label for="email_pengguna" class="form-label">Email Pengguna</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="ktm" name="ktm" placeholder=" " disabled>
                                            <label for="ktm" class="form-label">Kartu Tanda Mahasiswa (KTM)</label>
                                            <span type="button" class="input-group-text btn ktm-icon" data-img="<?= $pengajuan_email->ktm; ?>" data-bs-toggle="modal" data-bs-target="#ktmModal"><i class="fas fa-id-card"></i></span>
                                        </div>
                                    </div>
                                </div>
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
            const ktmButton = document.querySelector('.ktm-icon');
            const ktmImage = document.getElementById('ktmImage');

            ktmButton.addEventListener('click', function() {
                const imgSrc = this.getAttribute('data-img');
                ktmImage.src = imgSrc;

                const ktmModal = new bootstrap.Modal(document.getElementById('ktmModal'));
                ktmModal.show();
            });

            let zoomLevel = 1;
            let rotation = 0;
            let isDragging = false;
            let startX, startY, initialX, initialY;

            document.getElementById('zoomIn').addEventListener('click', function() {
                zoomLevel += 0.1;
                ktmImage.style.transform = `scale(${zoomLevel}) rotate(${rotation}deg)`;
                ktmImage.style.cursor = 'grab'; // Mengubah cursor saat zoom
            });

            document.getElementById('zoomOut').addEventListener('click', function() {
                zoomLevel = Math.max(0.1, zoomLevel - 0.1);
                ktmImage.style.transform = `scale(${zoomLevel}) rotate(${rotation}deg)`;
                if (zoomLevel <= 1) {
                    ktmImage.style.cursor = 'default';
                }
            });

            document.getElementById('rotateLeft').addEventListener('click', function() {
                rotation -= 90;
                ktmImage.style.transform = `scale(${zoomLevel}) rotate(${rotation}deg)`;
            });

            document.getElementById('rotateRight').addEventListener('click', function() {
                rotation += 90;
                ktmImage.style.transform = `scale(${zoomLevel}) rotate(${rotation}deg)`;
            });

            function downloadImage(format) {
                const link = document.createElement('a');
                link.download = `ktm-image.${format}`;
                link.href = ktmImage.src;
                link.click();
            }

            document.getElementById('downloadPng').addEventListener('click', function() {
                downloadImage('png');
            });

            document.getElementById('downloadJpg').addEventListener('click', function() {
                downloadImage('jpg');
            });

            document.getElementById('downloadJpeg').addEventListener('click', function() {
                downloadImage('jpeg');
            });

            let lastTapTime = 0;
            ktmImage.addEventListener('click', function(e) {
                const now = new Date().getTime();
                if (now - lastTapTime < 300) {
                    if (zoomLevel > 1) {
                        zoomLevel = 1;
                        ktmImage.style.transform = `scale(${zoomLevel}) rotate(${rotation}deg)`;
                        ktmImage.style.cursor = 'default';
                    } else {
                        zoomLevel += 0.1;
                        ktmImage.style.transform = `scale(${zoomLevel}) rotate(${rotation}deg)`;
                        ktmImage.style.cursor = 'grab';
                    }
                }
                lastTapTime = now;
            });

            ktmImage.addEventListener('mousedown', function(e) {
                if (zoomLevel > 1) {
                    isDragging = true;
                    startX = e.clientX;
                    startY = e.clientY;
                    initialX = ktmImage.offsetLeft;
                    initialY = ktmImage.offsetTop;
                    ktmImage.style.cursor = 'grabbing';
                }
            });

            document.addEventListener('mousemove', function(e) {
                if (isDragging) {
                    const dx = e.clientX - startX;
                    const dy = e.clientY - startY;
                    ktmImage.style.left = `${initialX + dx}px`;
                    ktmImage.style.top = `${initialY + dy}px`;
                }
            });

            document.addEventListener('mouseup', function() {
                isDragging = false;
                ktmImage.style.cursor = 'grab';
            });

            document.getElementById('ktmModal').addEventListener('hide.bs.modal', function() {
                zoomLevel = 1;
                rotation = 0;
                ktmImage.style.transform = 'scale(1) rotate(0deg)';
                ktmImage.style.left = '0';
                ktmImage.style.top = '0';
                ktmImage.style.cursor = 'default';
            });

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