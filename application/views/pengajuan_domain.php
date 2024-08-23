<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Domain</title>
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
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row form-container justify-content-center">
            <div class="col-md-8">
                <div class="form-wrapper">
                    <h2>Form Pengajuan Pembuatan Domain</h2>
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
                    <?= form_open('DomainController/submit'); ?>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="penanggung_jawab" class="form-label">Penanggung Jawab Domain</label>
                                <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" value="<?= set_value('penanggung_jawab'); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="unit_kerja" class="form-label">Unit Kerja</label>
                                <select class="form-control" id="unit_kerja" name="unit_kerja" required>
                                    <option value="">Pilih Unit Kerja</option>
                                    <?php foreach ($units as $unit): ?>
                                        <option value="<?= $unit; ?>"><?= $unit; ?></option>
                                    <?php endforeach; ?>
                                </select>
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
                            <div class="col-md-12">
                                <label for="sub_domain" class="form-label">Sub Domain</label>
                                <input type="text" class="form-control" id="sub_domain" name="sub_domain" value="<?= set_value('sub_domain'); ?>" required>
                                <small class="form-text text-muted">Sub domain akan otomatis ditambahkan @if.unjani.ac.id jika belum ada.</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required><?= set_value('keterangan'); ?></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="ip_pointing" class="form-label">IP Pointing</label>
                                <input type="text" class="form-control" id="ip_pointing" name="ip_pointing" value="<?= set_value('ip_pointing'); ?>" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
