<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css') ?>">
    <style>
        .login-page {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .card {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-color: #adb5bd;
        }

        .card-header {
            background-color: #343a40;
            color: #ffffff;
            font-weight: bold;
            text-align: center;
            font-size: 25px;
        }

        .form-control {
            margin-bottom: 10px;
            border-color: #adb5bd;
        }

        .form-group label {
            margin-bottom: 5px; 
            width: 300px;
        }

        .form-group-pp label {
            margin-bottom: 5px; 
            width: auto;
        }

        .full-width-btn {
            width: 100%;
            box-sizing: border-box;
            margin-top: 10px;
            margin-bottom: 5px; 
        }
        
        @media (max-width: 768px) {
            .form-group label {
                width: auto; 
            }
        }
    </style>
</head>

<body class="login-page">
    <div class="card">
        <div class="card-header text-center">Register</div>
        <div class="card-body">
            <?php if ($this->session->flashdata('error')): ?>
                <p class="error text-danger"><?php echo $this->session->flashdata('error'); ?></p>
            <?php endif; ?>
            <form action="<?php echo site_url('RegisterPengajuanController/prosesDaftar') ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>
                <div class="form-group-pp">
                    <label>Profil Picture</label>
                    <input type="file" class="form-control" name="url" required>
                </div>
                <div>
                    <input type="submit" class="btn btn-primary full-width-btn" value="Register">
                </div>
            </form>
        </div>
        <div class="card-footer text-center"> Sudah Punya Akun?
            <br><a href="<?php echo site_url('LoginPengajuanController') ?>">Sign In</a>
        </div>
    </div>
</body>
</html>
