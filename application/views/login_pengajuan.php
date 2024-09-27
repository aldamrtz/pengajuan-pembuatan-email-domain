<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Pengajuan</title>
    <link rel="icon" href="./assets/img/logo-unjani.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('./assets/img/bg-unjani.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.8), rgba(0, 128, 128, 0.6));
            z-index: 0;
        }

        .logo {
            position: absolute;
            top: -65px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #ffffff;
            border-radius: 50%;
            padding: 10px;
            box-shadow: 0 -10px 10px rgba(0, 0, 0, 0.1);
        }

        .logo img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        .container {
            position: relative;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-sizing: border-box;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 550px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 350px;
            opacity: 0;
            transform: scale(0.8);
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
            z-index: 2;
        }

        .container.show {
            opacity: 1;
            transform: scale(1);
        }

        h2 {
            margin-top: 30px;
            margin-bottom: 30px;
            color: #333;
            font-size: 32px;
            font-weight: bold;
        }

        .mb-3 {
            position: relative;
            margin-bottom: 15px;
        }

        .mb-3 label {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            font-size: 16px;
            color: #13855c;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .mb-3 input {
            padding: 11px 50px 11px 15px;
            border: 1.5px solid #13855c;
            color: #333;
            border-radius: 4px;
            margin-bottom: 30px;
            width: 100%;
            box-sizing: border-box;
        }

        .mb-3 input:focus {
            box-shadow: 0 0 0 0.25rem rgba(0, 170, 255, 0.25);
            border-color: #00aaff;
        }

        .mb-3 input:not(:focus):not(:placeholder-shown)+label {
            color: #13855c;
        }

        .mb-3 input:focus+label,
        .mb-3 input:not(:placeholder-shown)+label {
            top: -10px;
            left: 10px;
            font-size: 13px;
            background-color: #ffffff;
            padding: 0 5px;
            transform: translateY(0);
            color: #00aaff;
        }

        .password-container {
            position: relative;
        }

        #togglePassword {
            color: #13855c;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 15px;
            z-index: 999 !important;
        }

        .mb-3 input:focus~#togglePassword {
            color: #00aaff;
        }

        .mb-3.error input:focus~#togglePassword {
            color: #d9534f;
        }

        .mb-3.error #togglePassword {
            color: #d9534f;
            margin-top: -10px;
        }

        .error {
            color: #d9534f;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .mb-3.error input {
            border-color: #d9534f;
            margin-bottom: 3px;
        }

        .mb-3.error label {
            color: #d9534f;
        }

        .mb-3.error input:focus {
            border-color: #d9534f;
            box-shadow: #d9534f;
            box-shadow: 0 0 0 0.2rem rgba(217, 83, 79, 0.25);
        }

        .mb-3.error input:focus+label,
        .mb-3.error input:not(:focus)+label {
            color: #d9534f;
        }

        .btn-custom {
            background: linear-gradient(135deg, #13855c, #1cc88a, #00aaff);
            color: #ffffff;
            border: none;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 20px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin-top: 25px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-custom:disabled {
            background: linear-gradient(135deg, #13855c, #1cc88a, #00aaff);
            cursor: not-allowed;
        }

        .btn-custom:hover,
        .btn-custom:active,
        .btn-custom:focus {
            background: linear-gradient(135deg, #13855c, #13855c, #13855c);
            color: #ffffff;
            transform: scale(1.03);
        }

        .btn-custom.loading {
            background: linear-gradient(135deg, #13855c, #1cc88a, #00aaff);
            color: transparent;
        }

        .spinner-border {
            position: absolute;
            width: 20px;
            height: 20px;
            border-width: 2px;
            border-color: #ffffff transparent transparent;
            border-radius: 50%;
            border-style: solid;
            display: none;
            animation: spinner-border 1s linear infinite;
        }

        .btn-custom.loading .spinner-border {
            display: inline-block;
        }

        .btn-custom .spinner-border {
            position: absolute;
            transform: translate(-50%, -50%);
        }

        @keyframes spinner-border {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 30px;
            }
        }

        @media (max-width: 576px) {
            .container {
                width: 90%;
                padding: 30px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="./assets/img/logo-unjani.png" alt="Logo Unjani">
        </div>
        <h2 class="text-center">Login Admin Pengajuan</h2>
        <form id="login-form" method="post">
            <div class="mb-3">
                <input type="email" class="form-control" id="email" name="email" required placeholder=" ">
                <label for="email">Email</label>
                <div id="email-error" class="error"></div>
            </div>
            <div class="mb-3 password-container">
                <input type="password" class="form-control" id="password" name="password" required placeholder=" ">
                <label for="password">Password</label>
                <i class="fas fa-eye" id="togglePassword"></i>
                <div id="password-error" class="error"></div>
            </div>
            <input type="hidden" id="recaptcha-token" name="recaptcha-token">
            <button type="submit" class="btn btn-custom btn-block">Login
                <div class="spinner-border"></div>
            </button>
        </form>
        <div id="error-message" class="error text-center" style="display: none;"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6Lf0PEQqAAAAANCvF8-NRJwRcVHMZDMbSD84j7gZ"></script>
    <script>
        window.onload = function() {
            document.querySelector('.container').classList.add('show');
        };

        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const submitButton = document.querySelector('.btn-custom');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            this.classList.toggle('fa-eye-slash');
        });

        // Event listener untuk input email
        document.getElementById('email').addEventListener('input', function() {
            const email = document.getElementById('email');
            if (email.value === '') {
                document.getElementById('email-error').innerText = '';
                email.closest('.mb-3').classList.remove('error');
            }
        });

        // Event listener untuk input password
        document.getElementById('password').addEventListener('input', function() {
            const password = document.getElementById('password');
            if (password.value === '') {
                document.getElementById('password-error').innerText = '';
                password.closest('.mb-3').classList.remove('error');
                document.querySelector('#togglePassword').classList.remove('error');
            }
        });

        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault();

            submitButton.classList.add('loading');
            submitButton.setAttribute('disabled', 'true');

            grecaptcha.ready(function() {
                grecaptcha.execute('6Lf0PEQqAAAAANCvF8-NRJwRcVHMZDMbSD84j7gZ', {
                    action: 'submit'
                }).then(function(token) {
                    const form = document.getElementById('login-form');
                    const formData = new FormData(form);
                    formData.append('recaptcha-token', token);

                    fetch('<?php echo site_url('LoginPengajuanController/login'); ?>', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.text())
                        .then(text => {
                            submitButton.classList.remove('loading');
                            submitButton.removeAttribute('disabled');
                            console.log(text);
                            try {
                                const data = JSON.parse(text);
                                if (data.success) {
                                    window.location.href = '<?php echo site_url('AdminPengajuanController'); ?>';
                                } else {
                                    document.querySelectorAll('.mb-3').forEach(group => {
                                        group.classList.remove('error');
                                        document.querySelector('#togglePassword').classList.remove('error');
                                    });
                                    document.getElementById('email-error').innerText = '';
                                    document.getElementById('password-error').innerText = '';
                                    document.getElementById('error-message').innerText = '';

                                    if (data.error.email) {
                                        document.getElementById('email-error').innerText = data.error.email;
                                        document.querySelector('#email').closest('.mb-3').classList.add('error');
                                    }
                                    if (data.error.password) {
                                        document.getElementById('password-error').innerText = data.error.password;
                                        const passwordGroup = document.querySelector('#password').closest('.mb-3');
                                        passwordGroup.classList.add('error');
                                        document.querySelector('#togglePassword').classList.add('error');
                                    }
                                    if (data.error.general) {
                                        document.getElementById('error-message').innerText = data.error.general;
                                    }
                                }
                            } catch (e) {
                                console.error('Error parsing JSON:', e);
                                document.getElementById('error-message').innerText = 'Terjadi kesalahan. Silakan coba lagi.';
                            }
                        })
                        .catch(error => {
                            submitButton.classList.remove('loading');
                            submitButton.removeAttribute('disabled');
                            console.error('Error:', error);
                            document.getElementById('error-message').innerText = 'Terjadi kesalahan. Silakan coba lagi.';
                        });
                });
            });
        });
    </script>
</body>

</html>