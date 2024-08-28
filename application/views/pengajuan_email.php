<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
        .title {
            text-align: center;
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
        .suggestion-radio {
            display: flex;
            flex-direction: column;
        }
        .suggestion-radio input[type="radio"] {
            margin-bottom: 0.5rem;
        }
        .email-options {
            display: none;
        }
        #emailSuggestions input[type="radio"] {
            margin-right: 0.25rem;
        }
        .feedback {
            font-size: 0.875rem;
        }
        .feedback.error {
            color: red;
        }
        .feedback.success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row form-container justify-content-center">
            <div class="col-md-8">
                <div class="form-wrapper">
                    <h2 class="title">Form Pengajuan Pembuatan Email</h2>
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
                                <label for="nim" class="form-label">Nomor Induk Mahasiswa (NIM)</label>
                                <input type="text" class="form-control" id="nim" name="nim" value="<?= set_value('nim'); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="prodi" class="form-label">Program Studi</label>
                                <select class="form-select" id="prodi" name="prodi" required>
                                    <option value="">Pilih Program Studi</option>
                                    <?php foreach ($program_studi as $value => $label): ?>
                                        <option value="<?= $value; ?>"><?= $label; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama_depan" class="form-label">Nama Depan</label>
                                <input type="text" class="form-control" id="nama_depan" name="nama_depan" value="<?= set_value('nama_depan'); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nama_belakang" class="form-label">Nama Belakang</label>
                                <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" value="<?= set_value('nama_belakang'); ?>" required>
                            </div>
                        </div>
                        <div class="mb-3 suggestion-radio">
                            <div id="emailSuggestions">
                            </div>
                            <div>
                                <input type="radio" id="customEmail" name="email_option" value="custom">
                                <label for="customEmail">Buat email Anda sendiri</label>
                            </div>
                        </div>
                        <div id="customEmailField" class="email-options">
                            <div class="mb-3">
                                <label for="email_diajukan" class="form-label">Email yang Diajukan</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="email_diajukan" name="email_diajukan" value="<?= set_value('email_diajukan'); ?>" required>
                                    <span class="input-group-text" id="emailDomain">@if.unjani.ac.id</span>
                                </div>
                                <div id="emailFeedback"></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email_pengguna" class="form-label">Email Pengguna</label>
                                <input type="email" class="form-control" id="email_pengguna" name="email_pengguna" value="<?= set_value('email_pengguna'); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="ktm" class="form-label">Kartu Tanda Mahasiswa (KTM)</label>
                                <input type="file" class="form-control" id="ktm" name="ktm" required>
                            </div>
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            $('#email_diajukan').on('input', function() {
                var emailPrefix = $(this).val();
                var prodi = $('#prodi').val();
                if (emailPrefix.length > 0) {
                    $.ajax({
                        url: '<?= site_url('EmailController/check_email_availability'); ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            email_prefix: emailPrefix,
                            prodi: prodi,
                            nama_depan: $('#nama_depan').val(),
                            nama_belakang: $('#nama_belakang').val()
                        },
                        success: function(response) {
                            var feedback = '';
                            var suggestionsHtml = '';
                            if (response.status === 'taken') {
                                feedback = '<span class="feedback error">Email sudah terdaftar</span><br>';
                                if (response.suggestions.length > 0) {
                                    suggestionsHtml = '<br><span class="feedback success">Saran Email: </span>';
                                    response.suggestions.forEach(function(suggestion) {
                                        suggestionsHtml = '<span class="feedback success">Saran Email: ' + response.suggestions.join(', ') + '</span>';
                                    });
                                }
                            } else {
                                feedback = '<span class="feedback success">Email tersedia</span>';
                            }
                            $('#emailFeedback').html(feedback + suggestionsHtml);
                        }
                    });
                } else {
                    $('#emailFeedback').empty();
                }
            });

            $('#prodi').on('change', function() {
                $('#email_diajukan').trigger('input');
            });

            function updateDomain() {
                var prodi = $('#prodi').val();
                var domain = '';
                switch(prodi) {
                    case 'Informatika':
                        domain = '@if.unjani.ac.id';
                        break;
                    case 'Sistem Informasi':
                        domain = '@si.unjani.ac.id';
                        break;
                    // Add more programs if needed
                }
                $('#emailDomain').text(domain);
                updateSuggestions();
            }

            function updateSuggestions() {
                var namaDepan = $('#nama_depan').val();
                var namaBelakang = $('#nama_belakang').val();
                var prodi = $('#prodi').val();

                // Check if all required fields are filled
                if (namaDepan.trim() && namaBelakang.trim() && prodi.trim()) {
                    $.ajax({
                        url: '<?= base_url('EmailController/generateSuggestions'); ?>',
                        type: 'POST',
                        data: {
                            nama_depan: namaDepan,
                            nama_belakang: namaBelakang,
                            prodi: prodi
                        },
                        success: function(response) {
                            var data = JSON.parse(response);
                            if (data.status === 'success') {
                                var suggestionsHtml = '';
                                data.suggestions.forEach(function(suggestion, index) {
                                    if (index < 2) { // Show only 2 suggestions
                                        suggestionsHtml += '<div><input type="radio" name="email_option" id="suggestion' + (index + 1) + '" value="' + suggestion + '"><label for="suggestion' + (index + 1) + '">' + suggestion + '</label></div>';
                                    }
                                });
                                $('#emailSuggestions').html(suggestionsHtml);
                                $('.suggestion-radio').show();
                            } else {
                                $('#emailSuggestions').html('<p>Email tersedia.</p>');
                                $('.suggestion-radio').hide();
                            }
                        }
                    });
                } else {
                    $('#emailSuggestions').html('');
                    $('.suggestion-radio').hide();
                }
            }

            function toggleEmailField() {
                if ($('#customEmail').is(':checked')) {
                    $('#customEmailField').show();
                    $('#email_diajukan').prop('required', true);
                } else {
                    $('#customEmailField').hide();
                    $('#email_diajukan').prop('required', false);
                }
            }

            $('#prodi, #nama_depan, #nama_belakang').on('change keyup', updateDomain);
            $('#customEmail').change(toggleEmailField);
            $('#emailSuggestions').on('change', 'input[name="email_option"]', function() {
                toggleEmailField();
                var selectedEmail = $(this).val();
                $('#email_diajukan').val(selectedEmail);
            });

            updateDomain();
            toggleEmailField();
        });
    </script>
</body>
</html>
