<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?= base_url('assets/img/logo-unjani.png'); ?>" rel="icon" type="image/png">
    <title>Admin - Pengajuan Email</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
            background-color: #e0f5ec;
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
            border-radius: 5px;
            padding: 25px;
            background-color: #ffffff;
            margin-bottom: 30px;
            overflow-x: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
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
        .table td:nth-child(9),
        .table td:nth-child(10) {
            text-align: center;
        }

        .ktm-icon {
            cursor: pointer;
            color: #333;
        }

        .ktm-icon:hover {
            color: #0e6b47;
        }

        .custom-process-btn {
            background-color: #00aaff;
            color: #ffffff;
            border: none;
        }

        .custom-process-btn:hover {
            background-color: #0088cc;
            color: #ffffff;
            border: none;
        }

        .custom-verify-btn {
            background-color: #00aaff;
            color: #ffffff;
            border: none;
        }

        .custom-verify-btn:hover {
            background-color: #0088cc;
            color: #ffffff;
            border: none;
        }

        .send-email-btn,
        .send-email-btn:focus {
            background-color: #00aaff;
            color: #ffffff;
            border: none;
        }

        .send-email-btn:hover {
            background-color: #0088cc;
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
            padding: 0;
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

        .form-group {
            margin-bottom: 5px;
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
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Laporan</div>
            <li class="nav-item active">
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
                    <div class="tab-content" id="emailTabsContent">
                        <ul class="nav nav-tabs" id="emailTabs" role="tablist">
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
                                        <th>Program Studi</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Email yang Diajukan</th>
                                        <th>Email Pengguna</th>
                                        <th>KTM</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                        <th>Edit</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($email_diajukan as $email): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $email['prodi']; ?></td>
                                            <td><?= $email['nim']; ?></td>
                                            <td><?= $email['nama_lengkap']; ?></td>
                                            <td><?= $email['email_diajukan']; ?></td>
                                            <td><?= $email['email_pengguna']; ?></td>
                                            <td>
                                                <a href="#" class="ktm-icon" data-img="<?= $email['ktm']; ?>" data-type="<?= pathinfo($email['ktm'], PATHINFO_EXTENSION); ?>">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                            <td><?= $email['tgl_pengajuan']; ?></td>
                                            <td><?= $email['status_pengajuan']; ?></td>
                                            <td>
                                                <form method="post" action="<?= site_url('AdminPengajuanController/updateStatusEmail'); ?>">
                                                    <input type="hidden" name="id" value="<?= $email['nim']; ?>">
                                                    <input type="hidden" name="status_pengajuan" value="Diproses">
                                                    <button type="submit" class="btn custom-process-btn">Proses</button>
                                                </form>
                                            </td>
                                            <td>
                                                <button class="btn btn-warning" style="color: #ffffff;" data-toggle="modal" data-target="#editModal"
                                                    data-id="<?= $email['nim']; ?>"
                                                    data-prodi="<?= $email['prodi']; ?>"
                                                    data-nama-lengkap="<?= $email['nama_lengkap']; ?>"
                                                    data-email="<?= $email['email_diajukan']; ?>"
                                                    data-email-pengguna="<?= $email['email_pengguna']; ?>"
                                                    data-ktm="<?= $email['ktm']; ?>">Edit</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="<?= $email['nim']; ?>">Hapus</button>
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
                                        <th>Program Studi</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Email yang Diajukan</th>
                                        <th>Email Pengguna</th>
                                        <th>KTM</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                        <th>Edit</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($email_diproses as $email): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $email['prodi']; ?></td>
                                            <td><?= $email['nim']; ?></td>
                                            <td><?= $email['nama_lengkap']; ?></td>
                                            <td><?= $email['email_diajukan']; ?></td>
                                            <td><?= $email['email_pengguna']; ?></td>
                                            <td>
                                                <a href="#" class="ktm-icon" data-img="<?= $email['ktm']; ?>" data-type="<?= pathinfo($email['ktm'], PATHINFO_EXTENSION); ?>">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                            <td><?= $email['tgl_pengajuan']; ?></td>
                                            <td><?= $email['status_pengajuan']; ?></td>
                                            <td>
                                                <form method="post" action="<?= site_url('AdminPengajuanController/updateStatusEmail'); ?>">
                                                    <input type="hidden" name="id" value="<?= $email['nim']; ?>">
                                                    <input type="hidden" name="status_pengajuan" value="Diverifikasi">
                                                    <button type="submit" class="btn custom-verify-btn">Verifikasi</button>
                                                </form>
                                            </td>
                                            <td>
                                                <button class="btn btn-warning" style="color: #ffffff;" data-toggle="modal" data-target="#editModal"
                                                    data-id="<?= $email['nim']; ?>"
                                                    data-prodi="<?= $email['prodi']; ?>"
                                                    data-nama-lengkap="<?= $email['nama_lengkap']; ?>"
                                                    data-email="<?= $email['email_diajukan']; ?>"
                                                    data-email-pengguna="<?= $email['email_pengguna']; ?>"
                                                    data-ktm="<?= $email['ktm']; ?>">Edit</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="<?= $email['nim']; ?>">Hapus</button>
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
                                        <th>Program Studi</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Email yang Diajukan</th>
                                        <th>Email Pengguna</th>
                                        <th>KTM</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                        <th>Edit</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($email_diverifikasi as $email): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $email['prodi']; ?></td>
                                            <td><?= $email['nim']; ?></td>
                                            <td><?= $email['nama_lengkap']; ?></td>
                                            <td><?= $email['email_diajukan']; ?></td>
                                            <td><?= $email['email_pengguna']; ?></td>
                                            <td>
                                                <a href="#" class="ktm-icon" data-img="<?= $email['ktm']; ?>" data-type="<?= pathinfo($email['ktm'], PATHINFO_EXTENSION); ?>">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                            <td><?= $email['tgl_pengajuan']; ?></td>
                                            <td><?= $email['status_pengajuan']; ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn send-email-btn dropdown-toggle" type="button" id="dropdownFormButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Kirim Email
                                                    </button>
                                                    <div class="dropdown-menu p-4 dropdown-kirim" aria-labelledby="dropdownFormButton">
                                                        <form id="passwordForm" method="post" action="<?= site_url('AdminPengajuanController/sendEmailWithPassword'); ?>">
                                                            <input type="hidden" name="id" value="<?= $email['nim']; ?>">
                                                            <div class="mb-3">
                                                                <label for="emailDiajukan-<?= $email['nim']; ?>" class="form-label">Email yang Diajukan</label>
                                                                <input type="text" class="form-control" id="emailDiajukan-<?= $email['nim']; ?>" value="<?= $email['email_diajukan']; ?>" disabled style="width: calc(<?= strlen($email['email_diajukan']); ?>ch - 2ch); box-sizing: border-box;">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="password-<?= $email['nim']; ?>" class="form-label">Password</label>
                                                                <input type="text" class="form-control" id="password-<?= $email['nim']; ?>" name="password" required>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary send-btn w-100">Kirim</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-warning" style="color: #ffffff;" data-toggle="modal" data-target="#editModal"
                                                    data-id="<?= $email['nim']; ?>"
                                                    data-prodi="<?= $email['prodi']; ?>"
                                                    data-nama-lengkap="<?= $email['nama_lengkap']; ?>"
                                                    data-email="<?= $email['email_diajukan']; ?>"
                                                    data-email-pengguna="<?= $email['email_pengguna']; ?>"
                                                    data-ktm="<?= $email['ktm']; ?>">Edit</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="<?= $email['nim']; ?>">Hapus</button>
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
                                        <th>Program Studi</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Email yang Diajukan</th>
                                        <th>Email Pengguna</th>
                                        <th>KTM</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($email_dikirim as $email): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $email['prodi']; ?></td>
                                            <td><?= $email['nim']; ?></td>
                                            <td><?= $email['nama_lengkap']; ?></td>
                                            <td><?= $email['email_diajukan']; ?></td>
                                            <td><?= $email['email_pengguna']; ?></td>
                                            <td>
                                                <a href="#" class="ktm-icon" data-img="<?= $email['ktm']; ?>" data-type="<?= pathinfo($email['ktm'], PATHINFO_EXTENSION); ?>">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                            <td><?= $email['tgl_pengajuan']; ?></td>
                                            <td><?= $email['status_pengajuan']; ?></td>
                                            <td>
                                                <button class="btn btn-warning" style="color: #ffffff;" data-toggle="modal" data-target="#editModal"
                                                    data-id="<?= $email['nim']; ?>"
                                                    data-nama-lengkap="<?= $email['nama_lengkap']; ?>"
                                                    data-email="<?= $email['email_diajukan']; ?>"
                                                    data-email-pengguna="<?= $email['email_pengguna']; ?>"
                                                    data-prodi="<?= $email['prodi']; ?>"
                                                    data-ktm="<?= $email['ktm']; ?>">Edit</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="<?= $email['nim']; ?>">Hapus</button>
                                            </td>
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
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

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document" style="width: 100%; max-width: 700px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Pengajuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editForm" method="post" action="<?= site_url('AdminPengajuanController/editPengajuanEmail'); ?>">
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="editNim">Nomor Induk Mahasiswa (NIM)</label>
                                        <input type="text" class="form-control" id="editNim" disabled>
                                        <input type="hidden" name="nim" id="hiddenEditNim">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="editProdi">Program Studi</label>
                                        <select class="form-select" id="editProdi" name="prodi" required>
                                            <option value=""></option>
                                            <?php foreach ($program_studi as $value => $label): ?>
                                                <option value="<?= $value; ?>"><?= $label; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="editNamaLengkap">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="editNamaLengkap" name="nama_lengkap" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="editEmail">Email yang Diajukan</label>
                                        <input type="email" class="form-control" id="editEmail" name="email_diajukan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="editEmailPengguna">Email Pengguna</label>
                                        <input type="email" class="form-control" id="editEmailPengguna" name="email_pengguna" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus pengajuan ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <form id="deleteForm" method="post" action="<?= site_url('AdminPengajuanController/deletePengajuanEmail'); ?>">
                            <input type="hidden" name="id" id="deleteId">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi Aksi -->
        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Aksi</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modalBody">
                        Apakah Anda yakin ingin melanjutkan aksi ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="confirmActionBtn">Ya</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <i class="fas fa-exclamation-circle" style="color: #d9534f; font-size: 100px; margin-top: 30px;"></i>
                        <p class="status-text">Konfirmasi Logout</p>
                        <p>Apakah Anda yakin ingin keluar dari halaman ini?</p>
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
                $('#deleteModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var id = button.data('id');
                    var modal = $(this);
                    modal.find('#deleteId').val(id);
                });

                $('#editModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var nim = button.data('id');
                    var prodi = button.data('prodi');
                    var nama_lengkap = button.data('nama-lengkap');
                    var email = button.data('email');
                    var emailPengguna = button.data('email-pengguna');
                    var ktm = button.data('ktm');

                    var modal = $(this);
                    modal.find('#editNim').val(nim);
                    modal.find('#hiddenEditNim').val(nim);
                    modal.find('#editProdi').val(prodi);
                    modal.find('#editNamaLengkap').val(nama_lengkap);
                    modal.find('#editEmail').val(email);
                    modal.find('#editEmailPengguna').val(emailPengguna);
                });

                var formToSubmit;

                $('.custom-process-btn, .custom-verify-btn, .send-btn').on('click', function(e) {
                    e.preventDefault();
                    formToSubmit = $(this).closest('form');

                    var actionText = '';
                    if ($(this).hasClass('custom-process-btn')) {
                        actionText = 'Apakah anda yakin ingin memproses pengajuan ini?';
                    } else if ($(this).hasClass('custom-verify-btn')) {
                        actionText = 'Apakah anda yakin ingin memverifikasi pengajuan ini?';
                    } else if ($(this).hasClass('send-btn')) {
                        actionText = 'Apakah Anda yakin ingin mengirimkan email ini?';
                    }

                    $('#modalBody').text(actionText);
                    $('#confirmModal').modal('show');
                });

                $('#confirmActionBtn').on('click', function() {
                    formToSubmit.submit();
                    $('#confirmModal').modal('hide');
                });

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

                document.getElementById('sidebarToggle').addEventListener('click', function() {
                    document.body.classList.toggle('sidebar-collapsed');
                });

                $('#monthYearPicker').datepicker({
                    format: 'MM yyyy', // Set format to Month YYYY
                    startView: 'months', // Start in month view
                    minViewMode: 'months', // Only allow month and year selection
                    autoclose: true // Close the datepicker after selection
                });

                // Print report functions
                document.getElementById('printDiajukan').onclick = function() {
                    const monthYear = document.getElementById('monthYearPicker').value;
                    printTable('diajukanTable', 'Diajukan', monthYear);
                    $('#monthYearPicker').val('');
                };

                document.getElementById('printDiproses').onclick = function() {
                    const monthYear = document.getElementById('monthYearPicker').value;
                    printTable('diprosesTable', 'Diproses', monthYear);
                    $('#monthYearPicker').val('');
                };

                document.getElementById('printDiverifikasi').onclick = function() {
                    const monthYear = document.getElementById('monthYearPicker').value;
                    printTable('diverifikasiTable', 'Diverifikasi', monthYear);
                    $('#monthYearPicker').val('');
                };

                document.getElementById('printDikirim').onclick = function() {
                    const monthYear = document.getElementById('monthYearPicker').value;
                    printTable('dikirimTable', 'Dikirim', monthYear);
                    $('#monthYearPicker').val('');
                };

                document.getElementById('printAll').onclick = function() {
                    const monthYear = document.getElementById('monthYearPicker').value;
                    printAllTables(monthYear);
                    $('#monthYearPicker').val('');
                };
            });

            function printTable(tableId, status, monthYear) {
                const table = $(`#${tableId}`).DataTable(); // Use DataTable API
                const data = prepareDataForPrint(table, status, monthYear);
                createPrintDocument(data, status, monthYear);
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

                createPrintDocument(allData, 'Semua', monthYear);
            }

            function prepareDataForPrint(table, status, monthYear) {
                const data = table.rows().data(); // Get all data from DataTable
                const formattedData = [];

                if (monthYear) {
                    const selectedYear = monthYear.split(" ")[1]; // Extract year
                    const selectedMonth = monthYear.split(" ")[0]; // Extract month

                    data.each((row, index) => {
                        const tanggalPengajuan = new Date(row[7]); // Assuming tanggalPengajuan is at index 7
                        const year = tanggalPengajuan.getFullYear();
                        const month = tanggalPengajuan.toLocaleString('default', {
                            month: 'long'
                        }); // Get month name

                        // Filter data based on the selected month and year
                        if (year == selectedYear && month.toLowerCase() === selectedMonth.toLowerCase()) {
                            formattedData.push({
                                no: index + 1, // Penomoran
                                prodi: row[1], // Make sure columns are correctly mapped
                                nim: row[2],
                                nama: row[3],
                                emailDiajukan: row[4],
                                emailPengguna: row[5],
                                tanggalPengajuan: row[7], // Check index for submission date
                                status: status || row[8], // Status fallback
                            });
                        }
                    });
                } else {
                    data.each((row, index) => {
                        formattedData.push({
                            no: index + 1, // Penomoran
                            prodi: row[1], // Make sure columns are correctly mapped
                            nim: row[2],
                            nama: row[3],
                            emailDiajukan: row[4],
                            emailPengguna: row[5],
                            tanggalPengajuan: row[7], // Check index for submission date
                            status: status || row[8], // Status fallback
                        });
                    });
                }

                return formattedData;
            }

            function createPrintDocument(data, title, monthYear) {
                const currentDate = new Date();
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                const formattedDate = currentDate.toLocaleDateString('id-ID', options);

                let printContent = `
    <div style="text-align: center;">
        <h2>Yayasan Kartika Eka Paksi</h2>
        <h3>Universitas Jenderal Achmad Yani (Unjani)</h3>
        <p>Kampus Cimahi: Jl. Terusan Jend. Sudirman, Cimahi Telp: (022) 1663186 - 6656, Fax: (022) 6652069</p>
        <p>Kampus Bandung: Jl. Gatot Subroto, Bandung Telp: (022) 7312741, Fax: (022) 7312741</p>
        <hr style=" ont-weight: bold;"/>
        <h4 style="margin-top: 35px; margin-bottom: 35px;">Data Pengajuan Pembuatan Email - ${title} Pada Bulan ${monthYear}</h4>
    </div>
    <table border="1" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>No</th>
                <th>Program Studi</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Email yang Diajukan</th>
                <th>Email Pengguna</th>
                <th>Tanggal Pengajuan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>`;
                data.forEach(item => {
                    printContent += `
        <tr>
            <td>${item.no}</td>
            <td>${item.prodi}</td>
            <td>${item.nim}</td>
            <td>${item.nama}</td>
            <td>${item.emailDiajukan}</td>
            <td>${item.emailPengguna}</td>
            <td>${item.tanggalPengajuan}</td>
            <td>${item.status}</td>
        </tr>`;
                });
                printContent += `</tbody></table>`;
                printContent += `
    <div style="position: relative; right: 0; bottom: 0; text-align: right; margin-top: 35px;">
        <p>${formattedDate}</p>
        <img src="<?= base_url('assets/img/ttd.jpg') ?>" alt="Signature" style="width: 100px; height: auto; margin-top: 10px; margin-bottom: 15px;" />
        <p>Staf Administrasi SISFO UNJANI</p>
    </div>`;
                const printFrame = document.createElement('iframe');
                printFrame.style.display = 'none';
                document.body.appendChild(printFrame);
                const printWindow = printFrame.contentWindow || printFrame.contentDocument.parentWindow;
                printWindow.document.open();
                printWindow.document.write(`
    <html>
    <head>
        <title>Cetak Laporan</title>
        <style>
            body { font-family: Arial, sans-serif; position: relative;}
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

                let zoomLevel = 1;
                let rotation = 0;
                let isDragging = false;
                let startX, startY, initialX, initialY;
                const ktmImage = document.getElementById('ktmImage');

                // Zoom in
                document.getElementById('zoomIn').addEventListener('click', function() {
                    zoomLevel += 0.1;
                    ktmImage.style.transform = `scale(${zoomLevel}) rotate(${rotation}deg)`;
                    ktmImage.style.cursor = 'grab'; // Mengubah cursor saat zoom
                });

                // Zoom out
                document.getElementById('zoomOut').addEventListener('click', function() {
                    zoomLevel = Math.max(0.1, zoomLevel - 0.1);
                    ktmImage.style.transform = `scale(${zoomLevel}) rotate(${rotation}deg)`;
                    if (zoomLevel <= 1) {
                        ktmImage.style.cursor = 'default'; // Kembali ke cursor default saat zoom out
                    }
                });

                // Rotate left
                document.getElementById('rotateLeft').addEventListener('click', function() {
                    rotation -= 90;
                    ktmImage.style.transform = `scale(${zoomLevel}) rotate(${rotation}deg)`;
                });

                // Rotate right
                document.getElementById('rotateRight').addEventListener('click', function() {
                    rotation += 90;
                    ktmImage.style.transform = `scale(${zoomLevel}) rotate(${rotation}deg)`;
                });

                // Download image
                function downloadImage(format) {
                    const link = document.createElement('a');
                    link.download = `ktm-image.${format}`;
                    link.href = ktmImage.src;
                    link.click();
                }

                // Event listeners for download buttons
                document.getElementById('downloadPng').addEventListener('click', function() {
                    downloadImage('png');
                });

                document.getElementById('downloadJpg').addEventListener('click', function() {
                    downloadImage('jpg');
                });

                document.getElementById('downloadJpeg').addEventListener('click', function() {
                    downloadImage('jpeg');
                });

                // Fitur double tap untuk zoom
                let lastTapTime = 0;
                ktmImage.addEventListener('click', function(e) {
                    const now = new Date().getTime();
                    if (now - lastTapTime < 300) { // Deteksi dua kali tap
                        if (zoomLevel > 1) {
                            zoomLevel = 1; // Zoom out
                            ktmImage.style.transform = `scale(${zoomLevel}) rotate(${rotation}deg)`;
                            ktmImage.style.cursor = 'default';
                        } else {
                            zoomLevel += 0.1; // Zoom in
                            ktmImage.style.transform = `scale(${zoomLevel}) rotate(${rotation}deg)`;
                            ktmImage.style.cursor = 'grab'; // Mengubah cursor saat zoom
                        }
                    }
                    lastTapTime = now;
                });

                // Fitur drag
                ktmImage.addEventListener('mousedown', function(e) {
                    if (zoomLevel > 1) { // Hanya drag saat zoom in
                        isDragging = true;
                        startX = e.clientX;
                        startY = e.clientY;
                        initialX = ktmImage.offsetLeft;
                        initialY = ktmImage.offsetTop;
                        ktmImage.style.cursor = 'grabbing'; // Mengubah cursor saat drag
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
                    ktmImage.style.cursor = 'grab'; // Kembali ke cursor saat tidak dragging
                });

                // Reset image state when the modal is closed
                document.getElementById('ktmModal').addEventListener('hide.bs.modal', function() {
                    zoomLevel = 1;
                    rotation = 0;
                    ktmImage.style.transform = 'scale(1) rotate(0deg)';
                    ktmImage.style.left = '0';
                    ktmImage.style.top = '0';
                    ktmImage.style.cursor = 'default';
                });

                const ktmIcons = document.querySelectorAll('.ktm-icon');

                ktmIcons.forEach(icon => {
                    icon.addEventListener('click', function() {
                        const imgSrc = this.getAttribute('data-img');
                        const imgLink = this.getAttribute('data-link');

                        document.getElementById('ktmImage').src = imgSrc;

                        const ktmModal = new bootstrap.Modal(document.getElementById('ktmModal'));
                        ktmModal.show();
                    });
                });
            });
        </script>
</body>

</html>