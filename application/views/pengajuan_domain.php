<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Domain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
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
        .input-group-text {
            width: 135px; /* Adjust the width as needed */
        }
        .btn-primary {
            width: 100%;
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
                    <h2 class="title">Pengajuan Pembuatan Domain</h2>
                    <?= form_open_multipart('DomainController/submit'); ?>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nomor_induk" class="form-label">Nomor Induk</label>
                                <input type="text" class="form-control" id="nomor_induk" name="nomor_induk" value="<?= set_value('nomor_induk'); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="unit_kerja" class="form-label">Unit Kerja</label>
                                <select class="form-select" id="unit_kerja" name="unit_kerja" required>
                                    <option value="">Pilih Unit Kerja</option>
                                    <?php foreach ($unit_kerja as $value => $label): ?>
                                        <option value="<?= $value; ?>" <?= set_select('unit_kerja', $value); ?>><?= $label; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="penanggung_jawab" class="form-label">Penanggung Jawab</label>
                                <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" value="<?= set_value('penanggung_jawab'); ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email_penanggung_jawab" class="form-label">Email Penanggung Jawab</label>
                                <input type="email" class="form-control" id="email_penanggung_jawab" name="email_penanggung_jawab" value="<?= set_value('email_penanggung_jawab'); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="kontak_penanggung_jawab" class="form-label">Kontak Penanggung Jawab</label>
                                <input type="text" class="form-control" id="kontak_penanggung_jawab" name="kontak_penanggung_jawab" value="<?= set_value('kontak_penanggung_jawab'); ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="sub_domain" class="form-label">Sub Domain</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="sub_domain" name="sub_domain" value="<?= set_value('sub_domain'); ?>" required>
                                    <span class="input-group-text" id="subdomainDomain"></span>
                                </div>
                                <div id="domainValidationFeedback" class="feedback"></div>
                                <div id="domainAvailabilityFeedback" class="feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="ip_pointing" class="form-label">IP Pointing</label>
                                <input type="text" class="form-control" id="ip_pointing" name="ip_pointing" value="<?= set_value('ip_pointing'); ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" rows="3" name="keterangan" value="<?= set_value('keterangan'); ?>" required></textarea>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
        $(document).ready(function() {
            const unitKerjaSelect = $('#unit_kerja');
            const subdomainSpan = $('#subdomainDomain');
            const subDomainInput = $('#sub_domain');
            const domainValidationFeedback = $('#domainValidationFeedback');
            const domainAvailabilityFeedback = $('#domainAvailabilityFeedback');

            subDomainInput.on('input', function() {
                const subDomainValue = subDomainInput.val();
                const lengthPattern = /^.{6,30}$/; // Untuk memeriksa panjang karakter
                const contentPattern = /^[a-zA-Z0-9.]+$/; // Untuk memeriksa karakter yang diizinkan

                if (!lengthPattern.test(subDomainValue)) {
                    domainValidationFeedback.text('Sub Domain yang diajukan harus terdiri dari 6-30 karakter.');
                    domainValidationFeedback.removeClass('success').addClass('error');
                    domainAvailabilityFeedback.text(''); // Clear availability feedback
                } else if (!contentPattern.test(subDomainValue)) {
                    domainValidationFeedback.text('Hanya berisi huruf, angka, atau titik yang diizinkan.');
                    domainValidationFeedback.removeClass('success').addClass('error');
                    domainAvailabilityFeedback.text(''); // Clear availability feedback
                } else {
                    domainValidationFeedback.text('');
                    // Check domain availability if validation passes
                    checkDomainAvailability(subDomainValue);
                }
            });

            function checkDomainAvailability(subDomainPrefix) {
                var unitKerja = $('#unit_kerja').val();
                if (subDomainPrefix.length > 0) {
                    $.ajax({
                        url: '<?= site_url('DomainController/check_domain_availability'); ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            sub_domain_prefix: subDomainPrefix,
                            unit_kerja: unitKerja
                        },
                        success: function(response) {
                            var availabilityFeedback = '';
                            if (response.status === 'taken') {
                                availabilityFeedback = '<span class="feedback error">Sub Domain sudah terdaftar</span><br>';
                                if (response.suggestions.length > 0) {
                                    var suggestionsHtml = '<span class="feedback success">Saran Sub Domain: ' + response.suggestions.join(', ') + '</span>';
                                    availabilityFeedback += suggestionsHtml;
                                }
                            } else {
                                availabilityFeedback = '<span class="feedback success">Domain tersedia</span>';
                            }
                            $('#domainAvailabilityFeedback').html(availabilityFeedback);
                        }
                    });
                } else {
                    $('#domainAvailabilityFeedback').empty();
                }
            }
        
            const domainMap = {
                'Informatika': '@if.unjani.ac.id',
                'Sistem Informasi': '@si.unjani.ac.id'
                // Tambahkan domain lain sesuai kebutuhan
            };

            unitKerjaSelect.change(function() {
                const selectedUnitKerja = $(this).val();
                const domain = domainMap[selectedUnitKerja] || '';
                subdomainSpan.text(domain);
            });

            const initialUnitKerja = unitKerjaSelect.val();
            if (initialUnitKerja) {
                const initialDomain = domainMap[initialUnitKerja] || '';
                subdomainSpan.text(initialDomain);
            }

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
