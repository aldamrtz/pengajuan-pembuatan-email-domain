<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content>
    <meta name="author" content>
    <title>Admin Pengajuan Email</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome from CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- SB Admin 2 CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.5/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/img/Unjani.png'); ?>" rel="icon" type="image/png">
    <style>
        .btn-custom {
            background-color: #007bff; /* Warna biru tua */
            color: #ffffff; /* Warna teks putih */
            border: 1px solid #007bff; /* Border dengan warna yang sama */
        }

        .btn-custom:hover {
            background-color: #0056b3; /* Warna biru tua yang lebih gelap saat hover */
            color: #ffffff; /* Warna teks putih saat hover */
            border: 1px solid #0056b3; /* Border yang sesuai saat hover */
        }
        .custom-process-btn {
            background-color: #4e73df; /* Ganti dengan warna yang diinginkan */
            color: #ffffff; /* Warna teks putih */
            border: 1px solid #4e73df; /* Border dengan warna yang sama */
        }

        .custom-process-btn:hover {
            background-color: #2e59d9; /* Warna biru tua yang lebih gelap saat hover */
            color: #ffffff; /* Warna teks putih saat hover */
            border: 1px solid #2e59d9; /* Border yang sesuai saat hover */
        }

        .custom-verify-btn {
            background-color: #f6c23e; /* Ganti dengan warna yang diinginkan */
            color: #ffffff; /* Warna teks putih */
            border: 1px solid #f6c23e; /* Border dengan warna yang sama */
        }

        .custom-verify-btn:hover {
            background-color: #f4b619; /* Warna kuning tua saat hover */
            color: #ffffff; /* Warna teks putih saat hover */
            border: 1px solid #f4b619; /* Border yang sesuai saat hover */
        }

        .custom-send-btn {
            background-color: #1cc88a; /* Ganti dengan warna yang diinginkan */
            color: #ffffff; /* Warna teks putih */
            border: 1px solid #1cc88a; /* Border dengan warna yang sama */
        }

        .custom-send-btn:hover {
            background-color: #17a673; /* Warna hijau tua saat hover */
            color: #ffffff; /* Warna teks putih saat hover */
            border: 1px solid #17a673; /* Border yang sesuai saat hover */
        }
        .navbar-nav .nav-item {
            display: flex;
            align-items: center;
        }
        .nav-tabs .nav-link {
            background-color: #e0f5ec; /* Background color for inactive tabs */
            color: #13855c; /* Text color for inactive tabs */
            border: 1px solid #1cc88a; 
            border-bottom: 1px solid transparent;
            outline: none; /* Remove outline on tabs */
        }

        .nav-tabs .nav-link.active {
            background-color: #1cc88a; /* Background color for active tab */
            color: #ffffff; /* Text color for active tab */
            border: 1px solid #1cc88a; /* Set the border color to match .tab-content */
            border-bottom: 1px solid #1cc88a;
            outline: none; /* Remove outline on active tab */
        }

        .nav-tabs .nav-link:hover {
            background-color: #13855c; /* Background color on hover */
            color: #ffffff; /* Text color on hover */
            border-bottom: 1px solid transparent;
        }

        .tab-content {
            border: 1px solid #1cc88a; /* Border color for the tab content */
            padding: 1rem;
            background-color: #ffffff;
            margin-bottom: 30px;
        }
        .sidebar-brand-icon {
            margin-left: 3px;
        }
        .sidebar-brand-text {
            margin-left: 7px;
        }
        .table th {
            padding: 0.5rem;
            font-size: 0.875rem;
            text-align: center;
            background-color: #13855c; /* Green for headers */
            color: #ffffff; /* White text color for headers */
        }
        .table td {
            padding: 0.5rem;
            font-size: 0.875rem;
            background-color: #1cc88a; /* Green for cells */
            color: #333333; /* Darker color for text */
        }
        .table tbody tr:nth-child(odd) td {
            background-color: #e0f5ec; /* Alternating row color (light green) */
            color: #333333; /* Darker color for text */
        }
        .table tbody tr:nth-child(even) td {
            background-color: #ffffff; /* Alternating row color (white) */
            color: #333333; /* Darker color for text */
        }
        .table {
            table-layout: auto;
            width: 100%;
            overflow-x: auto;
            border: 1px solid #ddd;
        }
        .table-bordered {
            border: 1px solid #ddd;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #ddd; /* Border color for table headers and cells */
        }
        .ktm-icon {
            cursor: pointer;
            color: #007bff;
        }
        .ktm-icon:hover {
            color: #0056b3;
        }
        .table th:nth-child(1), .table td:nth-child(1) { 
            width: 2%; 
            text-align: center;
        }
        .table th:nth-child(2), .table td:nth-child(2) { width: 10%; } /* Program Studi */
        .table th:nth-child(3), .table td:nth-child(3) { width: 10%; } /* NIM */
        .table th:nth-child(4), .table td:nth-child(4) { width: 20%; } /* Nama */
        .table th:nth-child(5), .table td:nth-child(5) { width: 20%; } /* Email yang Diajukan */
        .table th:nth-child(6), .table td:nth-child(6) { width: 20%; } /* Email Pengguna */
        .table th:nth-child(7), .table td:nth-child(7) { 
            width: 2%; 
            text-align: center;
        }

        .table th:nth-child(8), .table td:nth-child(8) { width: 15%; } /* Tanggal Pengajuan */
        .table th:nth-child(9), .table td:nth-child(9) { width: 10%; } /* Aksi */
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('AdminPengajuanController'); ?>">
                <div class="sidebar-brand-icon d-inline-block">
                    <img src="<?= base_url('assets/img/Unjani.png') ?>" style="width: 40px; height: auto;">
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
            <li class="nav-item active">
                <a class="nav-link" href="<?= site_url('AdminPengajuanController/data_pengajuan_email'); ?>">
                    <i class="fas fa-envelope"></i>
                    <span>Data Pengajuan Email</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('AdminPengajuanController/data_pengajuan_domain'); ?>">
                    <i class="fas fa-globe"></i>
                    <span>Pengajuan Domain</span>
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
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">Alerts Center</h6>
                                <div id="notification-list"></div>
                                <a class="dropdown-item text-center small text-gray-500" id="clear-all" href="#">Clear All</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('admin_name'); ?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url('uploads/profile/' . $this->session->userdata('profile_image')); ?>" alt="Profile Image" style="width: 25px; height: 25px;">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="<?= site_url('ProfileController/index'); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profil
                                </a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                                </a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid" style="padding-left: 20px; padding-right: 20px;">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">DASHBOARD</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-custom shadow-sm">
                            <i class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan
                        </a>
                    </div>
                    <ul class="nav nav-tabs" id="emailTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="diajukan-tab" data-bs-toggle="tab" data-bs-target="#diajukan" type="button" role="tab" aria-controls="diajukan" aria-selected="true">Email Diajukan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="diproses-tab" data-bs-toggle="tab" data-bs-target="#diproses" type="button" role="tab" aria-controls="diproses" aria-selected="false">Email Diproses</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="diverifikasi-tab" data-bs-toggle="tab" data-bs-target="#diverifikasi" type="button" role="tab" aria-controls="diverifikasi" aria-selected="false">Email Diverifikasi</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="dikirim-tab" data-bs-toggle="tab" data-bs-target="#dikirim" type="button" role="tab" aria-controls="dikirim" aria-selected="false">Email Dikirim</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="emailTabsContent">
                        <!-- Tab Email Diajukan -->
                        <div class="tab-pane fade show active" id="diajukan" role="tabpanel" aria-labelledby="diajukan-tab">
                            <table class="table table-bordered mt-3">
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
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach ($email_diajukan as $email): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $email['prodi']; ?></td>
                                        <td><?= $email['nim']; ?></td>
                                        <td><?= $email['nama_depan'] . ' ' . $email['nama_belakang']; ?></td>
                                        <td><?= $email['email_diajukan']; ?></td>
                                        <td><?= $email['email_pengguna']; ?></td>
                                        <td>
                                            <a href="#" class="ktm-icon" data-img="<?= base_url('uploads/ktm/' . $email['ktm']); ?>" data-link="<?= base_url('uploads/' . $email['ktm']); ?>">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                        <td><?= $email['tgl_pengajuan']; ?></td>
                                        <td>
                                            <form method="post" action="<?= site_url('AdminPengajuanController/updateStatusEmail'); ?>">
                                                <input type="hidden" name="id" value="<?= $email['nim']; ?>">
                                                <input type="hidden" name="status_pengajuan" value="Email Diproses">
                                                <button type="submit" class="btn btn-primary custom-process-btn">Proses Email</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="diproses" role="tabpanel" aria-labelledby="diproses-tab">
                            <table class="table table-bordered mt-3">
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
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach ($email_diproses as $email): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $email['prodi']; ?></td>
                                        <td><?= $email['nim']; ?></td>
                                        <td><?= $email['nama_depan'] . ' ' . $email['nama_belakang']; ?></td>
                                        <td><?= $email['email_diajukan']; ?></td>
                                        <td><?= $email['email_pengguna']; ?></td>
                                        <td>
                                            <a href="#" class="ktm-icon" data-img="<?= base_url('uploads/' . $email['ktm']); ?>" data-link="<?= base_url('uploads/' . $email['ktm']); ?>">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                        <td><?= $email['tgl_pengajuan']; ?></td>
                                        <td>
                                            <form method="post" action="<?= site_url('AdminPengajuanController/updateStatusEmail'); ?>">
                                                <input type="hidden" name="id" value="<?= $email['nim']; ?>">
                                                <input type="hidden" name="status_pengajuan" value="Email Diverifikasi">
                                                <button type="submit" class="btn btn-warning custom-verify-btn">Verifikasi Email</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="diverifikasi" role="tabpanel" aria-labelledby="diverifikasi-tab">
                            <table class="table table-bordered mt-3">
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
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach ($email_diverifikasi as $email): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $email['prodi']; ?></td>
                                        <td><?= $email['nim']; ?></td>
                                        <td><?= $email['nama_depan'] . ' ' . $email['nama_belakang']; ?></td>
                                        <td><?= $email['email_diajukan']; ?></td>
                                        <td><?= $email['email_pengguna']; ?></td>
                                        <td>
                                            <a href="#" class="ktm-icon" data-img="<?= base_url('uploads/' . $email['ktm']); ?>" data-link="<?= base_url('uploads/' . $email['ktm']); ?>">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                        <td><?= $email['tgl_pengajuan']; ?></td>
                                        <td>
                                            <form method="post" action="<?= site_url('AdminPengajuanController/updateStatusEmail'); ?>">
                                                <input type="hidden" name="id" value="<?= $email['nim']; ?>">
                                                <input type="hidden" name="status_pengajuan" value="Email Dikirim">
                                                <button type="submit" class="btn btn-success custom-send-btn">Kirim Email</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="dikirim" role="tabpanel" aria-labelledby="dikirim-tab">
                            <table class="table table-bordered mt-3">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach ($email_dikirim as $email): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $email['prodi']; ?></td>
                                        <td><?= $email['nim']; ?></td>
                                        <td><?= $email['nama_depan'] . ' ' . $email['nama_belakang']; ?></td>
                                        <td><?= $email['email_diajukan']; ?></td>
                                        <td><?= $email['email_pengguna']; ?></td>
                                        <td>
                                            <a href="#" class="ktm-icon" data-img="<?= base_url('uploads/' . $email['ktm']); ?>" data-link="<?= base_url('uploads/' . $email['ktm']); ?>">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                        <td><?= $email['tgl_pengajuan']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2024</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="ktmModal" tabindex="-1" aria-labelledby="ktmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ktmModalLabel">View KTM</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="ktmImage" src="" class="img-fluid" alt="KTM">
                </div>
                <div class="modal-footer">
                    <a id="ktmDownloadLink" href="" class="btn btn-primary" download>Download</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin logout?
                </div>
                <div class="modal-footer">
                    <a class="btn btn-secondary" href="<?= site_url('LoginPengajuanController/logout'); ?>">Ya</a>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/jquery-easing@1.4.1/jquery.easing.min.js"></script>
    <!-- SB Admin 2 JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.5/js/sb-admin-2.min.js"></script>
    <script>
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

        document.addEventListener('shown.bs.tab', function (event) {
            const tabId = event.target.getAttribute('data-bs-target');
            saveActiveTab(tabId);
        });

        document.addEventListener('DOMContentLoaded', function () {
            activateSavedTab();
            function loadNotifications() {
                fetch('<?= site_url('AdminPengajuanController/getNotifications'); ?>')
                    .then(response => response.json())
                    .then(data => {
                        const notificationList = document.getElementById('notification-list');
                        const notificationCount = document.getElementById('notification-count');
                        notificationList.innerHTML = '';
                        notificationCount.textContent = data.length;

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
                                    <span>${notification.user} mengajukan pembuatan ${notification.type === 'email' ? 'akun Email' : 'Domain'}</span>
                                </div>
                                <button class="btn btn-link btn-sm" onclick="deleteNotification(${notification.id})">
                                    <i class="fas fa-times text-danger"></i>
                                </button>
                            `;
                            notificationList.appendChild(item);
                        });

                        if (data.length === 0) {
                            document.getElementById('clear-all').style.display = 'none';
                        } else {
                            document.getElementById('clear-all').style.display = 'block';
                        }
                    });
            }

            function deleteNotification(id) {
                fetch(`<?= site_url('AdminPengajuanController/deleteNotification'); ?>${id}`, {
                    method: 'POST'
                }).then(response => response.json()).then(() => loadNotifications());
            }

            function clearAllNotifications() {
                fetch('<?= site_url('AdminPengajuanController/clearAllNotifications'); ?>', {
                    method: 'POST'
                }).then(response => response.json()).then(() => loadNotifications());
            }

            document.getElementById('clear-all').addEventListener('click', clearAllNotifications);

            loadNotifications();

            const ktmIcons = document.querySelectorAll('.ktm-icon');

            ktmIcons.forEach(icon => {
                icon.addEventListener('click', function() {
                    const imgSrc = this.getAttribute('data-img');
                    const imgLink = this.getAttribute('data-link');

                    document.getElementById('ktmImage').src = imgSrc;
                    document.getElementById('ktmDownloadLink').href = imgLink;

                    const ktmModal = new bootstrap.Modal(document.getElementById('ktmModal'));
                    ktmModal.show();
                });
            });
        });
</script>

</body>
</html>
