<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?= base_url('assets/img/logo-unjani.png'); ?>" rel="icon" type="image/png">
    <title>Admin - Home</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.5/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .sidebar {
            background: linear-gradient(135deg, #13855c, #1cc88a);
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            z-index: 1000;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-brand-icon img {
            display: inline-block;
            width: 40px;
            height: auto;
        }

        .sidebar-brand-text {
            margin-left: 7px;
            margin-right: 3px;
        }

        .sidebar-collapsed .navbar {
            width: calc(100% - 104px);
        }

        .sidebar-collapsed #content-wrapper {
            margin-left: 104px;
        }

        .sidebar-divider {
            height: 0px;
            background-color: #ffffff !important;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: calc(100% - 224px);
            z-index: 1000;
        }

        .navbar-nav .nav-item {
            display: flex;
            align-items: center;
        }

        .admin-name {
            margin-right: 8px;
            display: inline;
            font-size: 15px;
            font-weight: bold;
            color: #333;
        }

        .img-profile {
            width: 30px !important;
            height: 30px !important;
            margin-left: 7px;
            border-radius: 50%;
            background-color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 15px;
        }

        .dropdown-header {
            background-color: #00aaff !important;
            border-color: #00aaff !important;
            color: white !important;
        }

        #content {
            padding-top: 100px;
        }

        #content-wrapper {
            margin-left: 224px;
            z-index: 999;
        }

        .nav-tabs {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            border-bottom: none;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .nav-tabs .nav-link {
            background-color: #e0f5ec;
            margin-bottom: 15px;
            margin-right: 10px;
            color: #13855c;
            outline: none;
            font-size: 15px;
        }

        .nav-tabs .nav-link.active {
            background-color: #1cc88a;
            color: #ffffff;
            outline: none;
        }

        .nav-tabs .nav-link:hover {
            background-color: #13855c;
            color: #ffffff;
        }

        .tab-content {
            border: 1px solid #1cc88a;
            padding: 25px;
            background-color: #ffffff;
            margin-bottom: 30px;
            overflow-x: auto;
        }

        .table {
            width: 100%;
            table-layout: auto;
            overflow-x: auto;
            border: 1px solid #ddd;
            width: 100%;
        }

        .table-bordered {
            border: 1px solid #ddd;
        }

        .table th {
            font-size: 13px;
            text-align: center !important;
            vertical-align: middle !important;
            background-color: #13855c;
            color: #ffffff;
        }

        .table td {
            font-size: 13px;
            background-color: #1cc88a;
            color: #333333;
        }

        .table tbody tr:nth-child(odd) td {
            background-color: #e0f5ec;
            color: #333333;
        }

        .table tbody tr:nth-child(even) td {
            background-color: #ffffff;
            color: #333333;
        }

        .table td:nth-child(1),
        .table td:nth-child(7),
        .table td:nth-child(9) {
            text-align: center;
        }

        .ktm-icon {
            cursor: pointer;
            color: #007bff;
        }

        .ktm-icon:hover {
            color: #0056b3;
        }

        .custom-process-btn {
            background-color: #00aaff;
            color: #ffffff;
            border: none;
        }

        .custom-process-btn:hover {
            background-color: #2e59d9;
            color: #ffffff;
            border: none;
        }

        .custom-verify-btn {
            background-color: #f6c23e;
            color: #ffffff;
            border: none;
        }

        .custom-verify-btn:hover {
            background-color: #f4b619;
            color: #ffffff;
            border: none;
        }

        .send-email-btn {
            background-color: #1cc88a;
            color: #ffffff;
            border: none;
        }

        .send-email-btn:hover {
            background-color: #17a673;
            color: #ffffff;
            border: none;
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
        }

        .modal-ktm .modal-body img {
            max-width: 100%;
            max-height: 70vh;
            transition: transform 0.3s ease;
            position: relative;
            cursor: default;
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
            color: #333;
            font-weight: bold;
        }

        .btn-ya {
            background-color: #d9534f;
            color: #ffffff;
            width: 70px;
            margin-top: 30px;
        }

        .btn-ya:hover {
            background-color: #0e6b47;
            color: #ffffff;
            transition: background-color 0.3s ease;
        }

        .btn-tidak {
            background-color: #13855c;
            color: #ffffff;
            width: 70px;
            margin-top: 30px;
        }

        .btn-tidak:hover {
            background-color: #c9302c;
            color: #ffffff;
            transition: background-color 0.3s ease;
        }

        .dataTables_filter input {
            border-radius: 5px;
            width: 200px;
        }

        .dataTables_filter input:focus {
            border-color: #13855c;
            box-shadow: 0 0 0 0.25rem rgba(19, 133, 92, 0.25);
            outline: none;
        }

        .dataTables_length select {
            border: 2px solid #ccc;
            border-radius: 5px;
        }

        .dataTables_length select:focus {
            border-color: #13855c;
            box-shadow: 0 0 0 0.25rem rgba(19, 133, 92, 0.25);
            outline: none;
        }

        .dataTables_paginate .paginate_button {
            border-radius: 5px !important;
            padding: 5px 10px !important;
            margin: 5px 5px !important;
            background-color: #fff !important;
            color: #13855c !important;
            transition: background-color 0.3s !important;
        }

        .dataTables_paginate .paginate_button:hover {}

        .dataTables_paginate .paginate_button.current {}
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand" href="<?= site_url('AdminPengajuanController'); ?>">
                <div class="sidebar-brand-icon">
                    <img src="<?= base_url('assets/img/logo-unjani.png') ?>">
                </div>
                <div class="sidebar-brand-text">Access Track</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="<?= site_url('AdminPengajuanController'); ?>">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Laporan</div>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('AdminPengajuanController/data_pengajuan_email'); ?>">
                    <i class="fas fa-envelope"></i>
                    <span>Pengajuan Email</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('AdminPengajuanController/data_pengajuan_subdomain'); ?>">
                    <i class="fas fa-globe"></i>
                    <span>Pengajuan Sub Domain</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="text-center d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <span class="badge badge-danger badge-counter" id="notification-count">0</span>
                            </a>
                            <div class="dropdown-list dropdown-menu shadow animated--grow-in" aria-labelledby="alertsDropdown" style="right: 0 !important; left: auto !important;">
                                <h6 class="dropdown-header">Notifikasi</h6>
                                <div id="notification-list"></div>
                                <a class="dropdown-item text-center small text-gray-500" id="clear-all" href="#">Clear All</a>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="admin-name"><?= $this->session->userdata('admin_name'); ?></span>
                                <div class="img-profile">
                                    <i class="fas fa-user"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> <!-- Close button -->
                        <i class="fas fa-exclamation-circle" style="color: #d9534f; font-size: 100px; margin-top: 30px;"></i> <!-- Circle exclamation icon -->
                        <p class="status-text">Konfirmasi Logout</p> <!-- Status text -->
                        <p>Apakah Anda yakin ingin keluar dari halaman ini?</p> <!-- Confirmation text -->
                        <a class="btn btn-ya" href="<?= site_url('LoginPengajuanController/logout'); ?>">Ya</a>
                        <button type="button" class="btn btn-tidak" data-bs-dismiss="modal">Tidak</button>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-easing@1.4.1/jquery.easing.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.5/js/sb-admin-2.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

        <script>

        </script>
</body>

</html>