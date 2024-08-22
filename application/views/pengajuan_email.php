<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
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
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama'); ?>">
                <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">Nomor Induk Mahasiswa (NIM)</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?= set_value('nim'); ?>">
                <?= form_error('nim', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="prodi" class="form-label">Program Studi</label>
                <select class="form-control" id="prodi" name="prodi">
                    <option value="">Pilih Program Studi</option>
                    <option value="Informatika">Informatika</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <!-- Tambahkan program studi lainnya di sini -->
                </select>
                <?= form_error('prodi', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="email_diajukan" class="form-label">Email yang Diajukan</label>
                <input type="text" class="form-control" id="email_diajukan" name="email_diajukan" placeholder="Contoh: alda.azza" value="<?= set_value('email_diajukan'); ?>">
                <?= form_error('email_diajukan', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="email_pengguna" class="form-label">Email Pengguna</label>
                <input type="email" class="form-control" id="email_pengguna" name="email_pengguna" value="<?= set_value('email_pengguna'); ?>">
                <?= form_error('email_pengguna', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="ktm" class="form-label">Kartu Tanda Mahasiswa (KTM)</label>
                <input type="file" class="form-control" id="ktm" name="ktm">
                <?= form_error('ktm', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <img src="<?= site_url('CaptchaController/generateCaptcha') . '?t=' . time(); ?>" alt="Captcha">
                <div class="mt-2">
                    <label for="captcha" class="form-label">Masukkan Captcha</label>
                    <input type="text" class="form-control" id="captcha" name="captcha">
                    <?= form_error('captcha', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
        <?= form_close(); ?>
    </div>
</body>
</html>
