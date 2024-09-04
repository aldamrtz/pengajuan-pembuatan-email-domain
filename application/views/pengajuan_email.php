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
            background-size: cover;
            background-attachment: fixed;
        }
        .form-container {
            display: flex;
            align-items: center;
            height: 100vh;
        }
        .title {
            text-align: center;
        }
        .container-fluid {
            padding: 20px;
        }
        .form-wrapper {
            max-width: 100%;
            width: 100%;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-control, .btn {
            padding: 0.375rem 0.75rem;
            height: auto;
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
        .feedback.error {
            color: red;
        }
        .feedback.success {
            color: green;
        }
        .captcha-container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row form-container justify-content-center">
            <div class="col-md-8">
                <div class="form-wrapper">
                    <h2 class="title">Pengajuan Pembuatan Email</h2>
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
                                        <option value="<?= $value; ?>" <?= set_select('prodi', $value); ?>><?= $label; ?></option>
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
                                <input type="radio" id="customEmail" name="email_option" value="custom" <?= set_radio('email_option', 'custom'); ?>>
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
                            <div id="emailValidationFeedback" class="feedback"></div>
                            <div id="emailAvailabilityFeedback" class="feedback"></div>
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
                        <div class="mb-3 captcha-container">
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

    <!-- Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Pesan</h5>
                </div>
                <div class="modal-body">
                    <!-- Pesan akan di sini -->
                    <?php if ($this->session->flashdata('success')): ?>
                        <p class="text-success"><?= $this->session->flashdata('success'); ?></p>
                    <?php elseif ($this->session->flashdata('error')): ?>
                        <p class="text-danger"><?= $this->session->flashdata('error'); ?></p>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('email_diajukan');
            const validationFeedback = document.getElementById('emailValidationFeedback');
            const availabilityFeedback = document.getElementById('emailAvailabilityFeedback');
            const customEmailOption = document.getElementById('customEmail');
            const emailSuggestions = document.getElementById('emailSuggestions');

            customEmailOption.addEventListener('change', function () {
                if (this.checked) {
                    document.getElementById('customEmailField').style.display = 'block';
                    emailInput.value = ''; // Clear value when switching to custom email
                }
            });

            emailInput.addEventListener('input', function() {
                const emailValue = emailInput.value;
                const lengthPattern = /^.{6,30}$/; // Untuk memeriksa panjang karakter
                const contentPattern = /^[a-zA-Z0-9.]+$/; // Untuk memeriksa karakter yang diizinkan

                if (!lengthPattern.test(emailValue)) {
                    validationFeedback.textContent = 'Email yang diajukan harus terdiri dari 6-30 karakter.';
                    validationFeedback.className = 'feedback error';
                    availabilityFeedback.textContent = ''; // Clear availability feedback
                } else if (!contentPattern.test(emailValue)) {
                    validationFeedback.textContent = 'Hanya berisi huruf, angka, atau titik yang diizinkan.';
                    validationFeedback.className = 'feedback error';
                    availabilityFeedback.textContent = ''; // Clear availability feedback
                } else {
                    validationFeedback.textContent = '';
                    // Check email availability if validation passes
                    checkEmailAvailability(emailValue);
                }
            });

            function checkEmailAvailability(emailPrefix) {
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
                            var availabilityFeedback = '';
                            if (response.status === 'taken') {
                                availabilityFeedback = '<span class="feedback error">Email sudah terdaftar</span><br>';
                                if (response.suggestions.length > 0) {
                                    var suggestionsHtml = '<span class="feedback success">Saran Email: ' + response.suggestions.join(', ') + '</span>';
                                    availabilityFeedback += suggestionsHtml;
                                }
                            } else {
                                availabilityFeedback = '<span class="feedback success">Email tersedia</span>';
                            }
                            $('#emailAvailabilityFeedback').html(availabilityFeedback);
                        }
                    });
                } else {
                    $('#emailAvailabilityFeedback').empty();
                }
            }

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

            <?php if ($this->session->flashdata('success') || $this->session->flashdata('error')): ?>
                var messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
                messageModal.show();

                document.getElementById('messageModal').addEventListener('hidden.bs.modal', function () {
                    location.reload();
                });
            <?php endif; ?>
        });
    </script>
</body>
</html>
