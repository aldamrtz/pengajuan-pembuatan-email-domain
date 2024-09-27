<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?= base_url('assets/img/logo-unjani.png'); ?>" rel="icon" type="image/png">
    <title>Admin - Pengajuan Sub Domain</title>

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
        .table td:nth-child(11) {
            text-align: center;
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

        .custom-send-btn {
            background-color: #1cc88a;
            color: #ffffff;
            border: none;
        }

        .custom-send-btn:hover {
            background-color: #17a673;
            color: #ffffff;
            border: none;
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
            <li class="nav-item">
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
            <li class="nav-item active">
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

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">DASHBOARD</h1>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownCetakLaporan" data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownCetakLaporan">
                                <li>
                                    <div class="px-3 py-2">
                                        <div class="input-group">
                                            <input type="text" id="monthYearPicker" class="form-control" placeholder="Pilih Bulan dan Tahun" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a class="dropdown-item" href="#" id="printDiajukan">Cetak Diajukan</a></li>
                                <li><a class="dropdown-item" href="#" id="printDiproses">Cetak Diproses</a></li>
                                <li><a class="dropdown-item" href="#" id="printDiverifikasi">Cetak Diverifikasi</a></li>
                                <li><a class="dropdown-item" href="#" id="printDikirim">Cetak Dikirim</a></li>
                                <li><a class="dropdown-item" href="#" id="printAll">Cetak Semua</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content" id="subdomainTabsContent">
                        <ul class="nav nav-tabs" id="subdomainTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="diajukan-tab" data-bs-toggle="tab" data-bs-target="#diajukan" type="button" role="tab" aria-controls="diajukan" aria-selected="true">Diajukan</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="diproses-tab" data-bs-toggle="tab" data-bs-target="#diproses" type="button" role="tab" aria-controls="diproses" aria-selected="false">Diproses</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="diverifikasi-tab" data-bs-toggle="tab" data-bs-target="#diverifikasi" type="button" role="tab" aria-controls="diverifikasi" aria-selected="false">Diverifikasi</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="dikirim-tab" data-bs-toggle="tab" data-bs-target="#dikirim" type="button" role="tab" aria-controls="dikirim" aria-selected="false">Dikirim</button>
                            </li>
                        </ul>
                        <div class="tab-pane fade show active" id="diajukan" role="tabpanel" aria-labelledby="diajukan-tab">
                            <table id="diajukanTable" class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Unit Kerja</th>
                                        <th>Nomor Induk</th>
                                        <th>Nama Penanggung Jawab</th>
                                        <th>Email Penanggung Jawab</th>
                                        <th>Kontak Penanggung Jawab</th>
                                        <th>Sub Domain yang Diajukan</th>
                                        <th>IP Pointing</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($subdomain_diajukan as $subdomain): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $subdomain['unit_kerja']; ?></td>
                                            <td><?= $subdomain['nomor_induk']; ?></td>
                                            <td><?= $subdomain['penanggung_jawab']; ?></td>
                                            <td><?= $subdomain['email_penanggung_jawab']; ?></td>
                                            <td><?= $subdomain['kontak_penanggung_jawab']; ?></td>
                                            <td><?= $subdomain['sub_domain']; ?></td>
                                            <td><?= $subdomain['ip_pointing']; ?></td>
                                            <td><?= $subdomain['keterangan']; ?></td>
                                            <td><?= $subdomain['tgl_pengajuan']; ?></td>
                                            <td><?= $subdomain['status_pengajuan']; ?></td>
                                            <td>
                                                <form method="post" action="<?= site_url('AdminPengajuanController/updateStatusSubDomain'); ?>">
                                                    <input type="hidden" name="id" value="<?= $subdomain['id_pengajuan_subdomain']; ?>">
                                                    <input type="hidden" name="status_pengajuan" value="Diproses">
                                                    <button type="submit" class="btn custom-process-btn">Proses Subdomain</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="diproses" role="tabpanel" aria-labelledby="diproses-tab">
                            <table id="diprosesTable" class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Unit Kerja</th>
                                        <th>Nomor Induk</th>
                                        <th>Nama Penanggung Jawab</th>
                                        <th>Email Penanggung Jawab</th>
                                        <th>Kontak Penanggung Jawab</th>
                                        <th>Sub Domain yang Diajukan</th>
                                        <th>IP Pointing</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($subdomain_diproses as $subdomain): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $subdomain['unit_kerja']; ?></td>
                                            <td><?= $subdomain['nomor_induk']; ?></td>
                                            <td><?= $subdomain['penanggung_jawab']; ?></td>
                                            <td><?= $subdomain['email_penanggung_jawab']; ?></td>
                                            <td><?= $subdomain['kontak_penanggung_jawab']; ?></td>
                                            <td><?= $subdomain['sub_domain']; ?></td>
                                            <td><?= $subdomain['ip_pointing']; ?></td>
                                            <td><?= $subdomain['keterangan']; ?></td>
                                            <td><?= $subdomain['tgl_pengajuan']; ?></td>
                                            <td><?= $subdomain['status_pengajuan']; ?></td>
                                            <td>
                                                <form method="post" action="<?= site_url('AdminPengajuanController/updateStatusSubDomain'); ?>">
                                                    <input type="hidden" name="id" value="<?= $subdomain['id_pengajuan_subdomain']; ?>">
                                                    <input type="hidden" name="status_pengajuan" value="Diverifikasi">
                                                    <button type="submit" class="btn custom-verify-btn">Verifikasi Subdomain</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="diverifikasi" role="tabpanel" aria-labelledby="diverifikasi-tab">
                            <table id="diverifikasiTable" class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Unit Kerja</th>
                                        <th>Nomor Induk</th>
                                        <th>Nama Penanggung Jawab</th>
                                        <th>Email Penanggung Jawab</th>
                                        <th>Kontak Penanggung Jawab</th>
                                        <th>Sub Domain yang Diajukan</th>
                                        <th>IP Pointing</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($subdomain_diverifikasi as $subdomain): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $subdomain['unit_kerja']; ?></td>
                                            <td><?= $subdomain['nomor_induk']; ?></td>
                                            <td><?= $subdomain['penanggung_jawab']; ?></td>
                                            <td><?= $subdomain['email_penanggung_jawab']; ?></td>
                                            <td><?= $subdomain['kontak_penanggung_jawab']; ?></td>
                                            <td><?= $subdomain['sub_domain']; ?></td>
                                            <td><?= $subdomain['ip_pointing']; ?></td>
                                            <td><?= $subdomain['keterangan']; ?></td>
                                            <td><?= $subdomain['tgl_pengajuan']; ?></td>
                                            <td><?= $subdomain['status_pengajuan']; ?></td>
                                            <td>
                                                <form method="post" action="<?= site_url('AdminPengajuanController/updateStatusSubDomain'); ?>">
                                                    <input type="hidden" name="id" value="<?= $subdomain['id_pengajuan_subdomain']; ?>">
                                                    <input type="hidden" name="status_pengajuan" value="Selesai">
                                                    <button type="submit" class="btn custom-send-btn">Kirim Subdomain</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="dikirim" role="tabpanel" aria-labelledby="dikirim-tab">
                            <table id="dikirimTable" class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Unit Kerja</th>
                                        <th>Nomor Induk</th>
                                        <th>Nama Penanggung Jawab</th>
                                        <th>Email Penanggung Jawab</th>
                                        <th>Kontak Penanggung Jawab</th>
                                        <th>Sub Domain yang Diajukan</th>
                                        <th>IP Pointing</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($subdomain_dikirim as $subdomain): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $subdomain['unit_kerja']; ?></td>
                                            <td><?= $subdomain['nomor_induk']; ?></td>
                                            <td><?= $subdomain['penanggung_jawab']; ?></td>
                                            <td><?= $subdomain['email_penanggung_jawab']; ?></td>
                                            <td><?= $subdomain['kontak_penanggung_jawab']; ?></td>
                                            <td><?= $subdomain['sub_domain']; ?></td>
                                            <td><?= $subdomain['ip_pointing']; ?></td>
                                            <td><?= $subdomain['keterangan']; ?></td>
                                            <td><?= $subdomain['tgl_pengajuan']; ?></td>
                                            <td><?= $subdomain['status_pengajuan']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
            $(document).ready(function() {
                $('#diajukanTable, #diprosesTable, #diverifikasiTable, #dikirimTable').DataTable({
                    "pagingType": "simple_numbers",
                    "lengthMenu": [5, 10, 25, 50, 100],
                    "language": {
                        "search": "Cari:",
                        "lengthMenu": "Tampilkan _MENU_ entri per halaman",
                        "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                        "infoEmpty": "Tidak ada entri tersedia",
                        "infoFiltered": "(disaring dari _MAX_ total entri)",
                        "paginate": {
                            "next": "Selanjutnya",
                            "previous": "Sebelumnya"
                        }
                    }
                });

                // Inisialisasi datepicker
                $('#monthYearPicker').datepicker({
                    format: 'MM yyyy', // Set format to Month YYYY
                    startView: 'months', // Start in month view
                    minViewMode: 'months', // Only allow month and year selection
                    autoclose: true // Close the datepicker after selection
                });

                // Cetak laporan
                document.getElementById('printDiajukan').onclick = function() {
                    const monthYear = $('#monthYearPicker').val();
                    printTable('diajukanTable', 'Diajukan', monthYear);
                    $('#monthYearPicker').val('');
                };

                document.getElementById('printDiproses').onclick = function() {
                    const monthYear = $('#monthYearPicker').val();
                    printTable('diprosesTable', 'Diproses', monthYear);
                    $('#monthYearPicker').val('');
                };

                document.getElementById('printDiverifikasi').onclick = function() {
                    const monthYear = $('#monthYearPicker').val();
                    printTable('diverifikasiTable', 'Diverifikasi', monthYear);
                    $('#monthYearPicker').val('');
                };

                document.getElementById('printDikirim').onclick = function() {
                    const monthYear = $('#monthYearPicker').val();
                    printTable('dikirimTable', 'Dikirim', monthYear);
                    $('#monthYearPicker').val('');
                };

                document.getElementById('printAll').onclick = function() {
                    const monthYear = $('#monthYearPicker').val();
                    printAllTables(monthYear);
                    $('#monthYearPicker').val('');
                };
            });

            document.getElementById('sidebarToggle').addEventListener('click', function() {
                document.body.classList.toggle('sidebar-collapsed');
            });

            function printTable(tableId, status, monthYear) {
                const table = $(`#${tableId}`).DataTable(); // Use DataTable API
                const data = prepareDataForPrint(table, status, monthYear);
                createPrintDocument(data, status);
            }

            function printAllTables(monthYear) {
                const allData = [];
                ['diajukanTable', 'diprosesTable', 'diverifikasiTable', 'dikirimTable'].forEach(tableId => {
                    const table = $(`#${tableId}`).DataTable(); // Use DataTable API
                    const data = prepareDataForPrint(table, null, monthYear);
                    allData.push(...data);
                });

                allData.sort((a, b) => new Date(b.tanggalPengajuan) - new Date(a.tanggalPengajuan));

                allData.forEach((item, index) => {
                    item.no = index + 1; // Nomor urut mulai dari 1
                });

                createPrintDocument(allData, 'Semua');
            }

            function prepareDataForPrint(table, status, monthYear) {
                const data = table.rows().data(); // Get all data from DataTable
                const formattedData = [];

                // Jika bulan dan tahun dipilih, filter berdasarkan itu
                if (monthYear) {
                    const selectedYear = monthYear.split(" ")[1]; // Extract year
                    const selectedMonth = monthYear.split(" ")[0]; // Extract month

                    data.each((row, index) => {
                        const tanggalPengajuan = new Date(row[9]); // Assuming tanggalPengajuan is at index 9
                        const year = tanggalPengajuan.getFullYear();
                        const month = tanggalPengajuan.toLocaleString('default', {
                            month: 'long'
                        }); // Get month name

                        if (year == selectedYear && month.toLowerCase() === selectedMonth.toLowerCase()) {
                            formattedData.push({
                                no: index + 1, // Penomoran
                                unitKerja: row[1],
                                nomorInduk: row[2],
                                penanggungJawab: row[3],
                                emailPenanggungJawab: row[4],
                                kontakPenanggungJawab: row[5],
                                subDomain: row[6],
                                ipPointing: row[7],
                                keterangan: row[8],
                                tanggalPengajuan: row[9],
                                status: status || row[10],
                            });
                        }
                    });
                } else {
                    // Jika tidak ada bulan dan tahun yang dipilih, ambil semua data
                    data.each((row, index) => {
                        formattedData.push({
                            no: index + 1, // Penomoran
                            unitKerja: row[1],
                            nomorInduk: row[2],
                            penanggungJawab: row[3],
                            emailPenanggungJawab: row[4],
                            kontakPenanggungJawab: row[5],
                            subDomain: row[6],
                            ipPointing: row[7],
                            keterangan: row[8],
                            tanggalPengajuan: row[9],
                            status: status || row[10],
                        });
                    });
                }

                return formattedData;
            }

            function createPrintDocument(data, title) {
                let printContent = `
        <div style="text-align: center;">
            <h2>Yayasan Kartika Eka Paksi</h2>
            <h3>Universitas Jenderal Achmad Yani (Unjani)</h3>
            <p>Kampus Cimahi: Jl. Terusan Jend. Sudirman, Cimahi Telp: (022) 1663186 - 6656, Fax: (022) 6652069</p>
            <p>Kampus Bandung: Jl. Gatot Subroto, Bandung Telp: (022) 7312741, Fax: (022) 7312741</p>
            <hr style="border: 1px solid black;"/>
            <h4 style="margin-top: 35px; margin-bottom: 35px;">Data Pengajuan Pembuatan Email - ${title}</h4>
        </div>
        <table border="1" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Unit Kerja</th>
                    <th>Nomor Induk</th>
                    <th>Nama Penanggung Jawab</th>
                    <th>Email Penanggung Jawab</th>
                    <th>Kontak Penanggung Jawab</th>
                    <th>Sub Domain yang Diajukan</th>
                    <th>IP Pointing</th>
                    <th>Keterangan</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>`;
                data.forEach(item => {
                    printContent += `
            <tr>
                <td>${item.no}</td>
                <td>${item.unitKerja}</td>
                <td>${item.nomorInduk}</td>
                <td>${item.penanggungJawab}</td>
                <td>${item.emailPenanggungJawab}</td>
                <td>${item.kontakPenanggungJawab}</td>
                <td>${item.subDomain}</td>
                <td>${item.ipPointing}</td>
                <td>${item.keterangan}</td>
                <td>${item.tanggalPengajuan}</td>
                <td>${item.status}</td>
            </tr>`;
                });
                printContent += `</tbody></table>`;

                const printFrame = document.createElement('iframe');
                printFrame.style.display = 'none'; // Sembunyikan iframe
                document.body.appendChild(printFrame);
                const printWindow = printFrame.contentWindow || printFrame.contentDocument.parentWindow;
                printWindow.document.open();
                printWindow.document.write(`
        <html>
        <head>
            <title>Cetak Laporan</title>
            <style>
                body { font-family: Arial, sans-serif; }
                table { width: 100%; border-collapse: collapse; }
                th, td { padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; text-align: center; }
                @media print {
                    @page { size: A4 landscape; margin: 9mm; }
                }
            </style>
        </head>
        <body onload="window.print(); window.parent.document.body.removeChild(window.frameElement);">
            ${printContent}
        </body>
        </html>`);
                printWindow.document.close();
            }

            document.addEventListener('DOMContentLoaded', function() {
                activateSavedTab();

                function loadNotifications() {
                    fetch('<?= site_url('AdminPengajuanController/getNotifications'); ?>')
                        .then(response => response.json())
                        .then(data => {
                            const notificationList = document.getElementById('notification-list');
                            const notificationCount = document.getElementById('notification-count');
                            notificationList.innerHTML = '';
                            notificationCount.textContent = data.length;

                            if (data.length === 0) {
                                notificationList.innerHTML = '<a class="dropdown-item text-center small text-gray-500">No Notifications</a>';
                                document.getElementById('clear-all').style.display = 'none';
                            } else {
                                data.forEach(notification => {
                                    const item = document.createElement('a');
                                    item.className = 'dropdown-item d-flex align-items-center';
                                    item.href = '#';
                                    item.innerHTML = `
                                    <div class="mr-3">
                                        <div class="icon-circle ${notification.type === 'email' ? 'bg-primary' : 'bg-secondary'}">
                                            <i class="${notification.type === 'email' ? 'fas fa-envelope text-white' : 'fas fa-globe text-white'}"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">${notification.date}</div>
                                        <span>${notification.user} mengajukan pembuatan ${notification.type === 'email' ? 'akun Email' : 'Sub Domain'}</span>
                                    </div>
                                `;
                                    notificationList.appendChild(item);
                                });

                                document.getElementById('clear-all').style.display = 'block';
                            }
                        });
                }

                function clearAllNotifications() {
                    fetch('<?= site_url('AdminPengajuanController/clearAllNotifications'); ?>', {
                        method: 'POST'
                    }).then(response => response.json()).then(() => loadNotifications());
                }

                document.getElementById('clear-all').addEventListener('click', clearAllNotifications);
                loadNotifications();
            });

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
                    }
                }
            }

            document.addEventListener('shown.bs.tab', function(event) {
                const tabId = event.target.getAttribute('data-bs-target');
                saveActiveTab(tabId);
            });
        </script>
</body>

</html>