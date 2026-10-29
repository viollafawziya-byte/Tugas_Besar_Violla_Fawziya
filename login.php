<?php
session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: index.php");
    exit;
}

$error = $_GET['error'] ?? '';
?><!DOCTYPE html><html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SIPN</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        margin: 0;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #fce7f3;
        font-family: Arial, sans-serif;
        padding: 20px;
    }

    .login-card {
        width: 100%;
        max-width: 400px;
        background-color: #ffffff;
        padding: 35px 30px;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(190, 80, 130, 0.15);
    }

    .login-title {
        color: #d9468f;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .login-subtitle {
        color: #9d7188;
        font-size: 14px;
        margin-bottom: 25px;
    }

    .form-label {
        color: #70465b;
        font-weight: 600;
    }

    .form-control {
        border: 1px solid #f3c4dc;
        border-radius: 10px;
        padding: 11px 12px;
    }

    .form-control:focus {
        border-color: #ec83b5;
        box-shadow: 0 0 0 3px rgba(236, 131, 181, 0.2);
    }

    .btn-login {
        background-color: #e879ac;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 11px;
        font-weight: bold;
    }

    .btn-login:hover {
        background-color: #d95795;
        color: white;
    }

    .register-text {
        color: #8c6a7b;
        font-size: 14px;
    }

    .register-link {
        color: #d9468f;
        font-weight: bold;
        text-decoration: none;
    }

    .register-link:hover {
        text-decoration: underline;
    }

    .alert {
        border-radius: 10px;
    }
</style>

</head><body><div class="login-card">

    <h3 class="text-center login-title">Login SIPN</h3>

    <p class="text-center login-subtitle">
        Silakan masuk ke akun kamu
    </p>

    <?php if ($error == 'gagal') { ?>
        <div class="alert alert-danger">
            Username atau password salah!
        </div>
    <?php } ?>

    <form action="aksi_login.php" method="POST">

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input
                type="text"
                id="username"
                name="username"
                class="form-control"
                placeholder="Masukkan username"
                required
            >
        </div>

        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                class="form-control"
                placeholder="Masukkan password"
                required
            >
        </div>

        <button type="submit" name="login" class="btn btn-login w-100">
            Login
        </button>

        <p class="text-center mt-4 mb-0 register-text">
            Belum punya akun?
            <a href="register.php" class="register-link">Register</a>
        </p>

    </form>

</div>

</body>
</html>