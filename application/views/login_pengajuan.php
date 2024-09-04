<!DOCTYPE html>
<html>
<head>
    <title>Login Admin Pengajuan</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f0f2f5;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}
.container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 360px;
    max-width: 100%;
    text-align: center;
}
h2 {
    margin-bottom: 20px;
    color: #333;
}
form {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 15px;
}
label {
    font-weight: bold;
    color: #555;
}
input[type="email"], 
input[type="password"], 
input[type="text"] {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
}
input[type="submit"] {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
    width: 100%; /* Memperlebar tombol hingga lebar maksimum kontainer */
}
input[type="submit"]:hover {
    background-color: #0056b3;
}
.captcha-container {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
    width: 100%; /* Memastikan lebar container captcha adalah 100% dari kontainer form */
}
.captcha-container img {
    border: 1px solid #ddd;
    border-radius: 5px;
    height: 40px;
    width: auto;
}
.captcha-container input {
    width: calc(100% - 60px); /* Mengurangi lebar input captcha sesuai dengan lebar gambar captcha dan jarak */
}
.error {
    color: #d9534f;
    margin-bottom: 15px;
    font-weight: bold;
}


    </style>
</head>
<body>
    <div class="container">
        <h2>Login Admin Pengajuan</h2>
        <?php if ($this->session->flashdata('error')): ?>
            <p class="error"><?php echo $this->session->flashdata('error'); ?></p>
        <?php endif; ?>
        <form method="post" action="<?php echo site_url('loginpengajuancontroller/login'); ?>">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="captcha">Captcha:</label>
            <div class="captcha-container">
                <img src="<?php echo site_url('captchacontroller/generateCaptcha'); ?>" alt="Captcha">
                <input type="text" id="captcha" name="captcha" required>
            </div>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
