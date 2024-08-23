<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-vWmp6s/XFzVGm8LCx6RtSx/1PfgI3rU2W5W2HZFYJf5kIVnx6hU19Y8ftAA0ItyI/lh4HzC/tk6D4VEfxXXITw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="icon" href="./assets/img/Unjani.png" type="image/png">
    <style>
        body {
            background-image: linear-gradient(180deg, #1cc88a 10%, #13855c 100%);
            font-size: 0.875rem;
        }
        .form-container {
            display: flex;
            align-items: center;
            height: 100vh;
        }
        .form-wrapper {
            max-width: 100%;
            width: 100%;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-size: 0.875rem;
        }
        .form-control, .btn {
            font-size: 0.875rem;
            padding: 0.375rem 0.75rem;
            height: auto;
        }
        .form-label {
            font-size: 0.875rem;
        }
        .form-select {
            font-size: 0.875rem;
        }
        .form-control::placeholder {
            font-size: 0.875rem;
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row form-container justify-content-center">
            <div class="col-md-8">
                <div class="form-wrapper">
                    <h2>Form Pengajuan Pembuatan Email</h2>
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <?= form_open_multipart('EmailController/submit'); ?>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama'); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nim" class="form-label">Nomor Induk Mahasiswa (NIM)</label>
                                <input type="text" class="form-control" id="nim" name="nim" value="<?= set_value('nim'); ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="prodi" class="form-label">Program Studi</label>
                            <select class="form-select" id="prodi" name="prodi" required>
                                <option value="">Pilih Program Studi</option>
                                <?php foreach ($program_studi as $value => $label): ?>
                                    <option value="<?= $value; ?>"><?= $label; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email_diajukan" class="form-label">Email yang Diajukan</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="email_diajukan" name="email_diajukan" value="<?= set_value('email_diajukan'); ?>" required>
                                    <span class="input-group-text">@if.unjani.ac.id</span>
                                </div>
                                <div id="emailFeedback"></div>
                                <div id="emailSuggestions"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="email_pengguna" class="form-label">Email Pengguna</label>
                                <input type="email" class="form-control" id="email_pengguna" name="email_pengguna" value="<?= set_value('email_pengguna'); ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="ktm" class="form-label">Kartu Tanda Mahasiswa (KTM)</label>
                            <input type="file" class="form-control" id="ktm" name="ktm" required>
                        </div>
                        <div class="mb-3">
                            <img src="<?= site_url('CaptchaController/generateCaptcha') . '?t=' . time(); ?>" alt="Captcha">
                            <div class="mt-2">
                                <label for="captcha" class="form-label">Masukkan Captcha</label>
                                <input type="text" class="form-control" id="captcha" name="captcha" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#email_diajukan').on('keyup', function() {
                var email_diajukan = $(this).val();
                if(email_diajukan) {
                    $.ajax({
                        url: '<?= base_url('check_email_availability'); ?>',
                        type: 'POST',
                        data: {email_diajukan: email_diajukan},
                        dataType: 'json',
                        success: function(response) {
                            if(response.status === 'taken') {
                                $('#emailFeedback').text('That email is taken, try another.').css('color', 'red');
                                $('#emailSuggestions').html('Available: ' + response.suggestions.join(', ')).css('color', 'green');
                            } else {
                                $('#emailFeedback').text('Email is available').css('color', 'green');
                                $('#emailSuggestions').empty();
                            }
                        }
                    });
                } else {
                    $('#emailFeedback').empty();
                    $('#emailSuggestions').empty();
                }
            });
        });
    </script>
</body>
</html>
