<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content>
    <meta name="author" content>
    <title>Admin Pengajuan</title>
    <!-- FontAwesome from CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- SB Admin 2 CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.0.5/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/img/Unjani.png'); ?>" rel="icon" type="image/png">
    <style>
        .navbar-nav .nav-item {
            display: flex;
            align-items: center;
        }
        .sidebar-brand-icon {
            margin-left: 3px
        }
        .sidebar-brand-text {
            margin-left: 7px;
        }
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

                        <!-- Nav Item - User Information -->
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
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" style="padding-left: 20px; padding-right: 20px;">
                </div>
            <!-- /.container-fluid -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

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
        
        // Fungsi untuk menyimpan tab yang aktif ke localStorage
        function saveActiveTab(tabId) {
            localStorage.setItem('activeTab', tabId);
        }

        // Fungsi untuk mengaktifkan tab dari localStorage
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

        // Event listener untuk menyimpan tab yang aktif
        document.addEventListener('shown.bs.tab', function (event) {
            const tabId = event.target.getAttribute('data-bs-target');
            saveActiveTab(tabId);
        });

        // Aktifkan tab yang tersimpan ketika halaman dimuat
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
                                        <span>${notification.user} mengajukan pembuatan ${notification.type === 'email' ? 'akun Email' : 'Domain'}</span>
                                    </div>
                                    <button class="btn btn-link btn-sm" onclick="deleteNotification(${notification.id})">
                                        <i class="fas fa-times text-danger"></i>
                                    </button>
                                `;
                                notificationList.appendChild(item);
                            });

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
        });
</script>

</body>
</html>
