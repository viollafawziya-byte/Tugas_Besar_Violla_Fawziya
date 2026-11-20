<?php
require_once 'navbar.php';
?>

<style>
    body {
        background-color: #fff7fa;
    }

    .pink-card {
        border: 1px solid #f3c5d8;
        border-radius: 12px;
        overflow: hidden;
        background-color: white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.08);
    }

    .pink-card .card-header {
        background-color: #fce4ec;
        color: #8e4564;
        border-bottom: 1px solid #f3c5d8;
        padding: 10px 15px;
    }

    .pink-card .card-header h5 {
        font-weight: bold;
        margin: 0;
    }

    .pink-card .card-body {
        padding: 15px;
    }

    .pink-card .card-body h5 {
        font-weight: bold;
        margin-bottom: 18px;
        color: #8e4564;
    }

    .pink-card .form-control {
        border-color: #edb9ce;
        border-radius: 8px;
    }

    .pink-card .form-control:focus {
        border-color: #d982a5;
        box-shadow: 0 0 0 0.2rem rgba(217, 130, 165, 0.2);
    }

    .btn-simpan-pink {
        background-color: #d982a5;
        border-color: #d982a5;
        color: white;
    }

    .btn-simpan-pink:hover {
        background-color: #c75b83;
        border-color: #c75b83;
        color: white;
    }

    .btn-kembali-pink {
        background-color: #c75b83;
        border-color: #c75b83;
        color: white;
    }

    .btn-kembali-pink:hover {
        background-color: #d982a5;
        border-color: #d982a5;
        color: white;
    }
</style>

<div class="container mt-4 mb-4" style="max-width: 550px;">
    <div class="card pink-card">

        <div class="card-header">
            <h5>Form Tambah User (Admin)</h5>
        </div>

        <div class="card-body">

            <h5>Data Kredensial Akun</h5>

            <form action="aksi_tambah_user.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Username Akun</label>

                    <input
                        type="text"
                        name="username"
                        class="form-control"
                        placeholder="Username Akun | Contoh: admin123"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label class="form-label">Password Akun</label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Password Akun"
                        required
                    >
                </div>

                <input type="hidden" name="role" value="admin">

                <button type="submit" name="tambah"
                        class="btn btn-simpan-pink">
                    Simpan Data
                </button>

                <a href="daftar_user.php" class="btn btn-kembali-pink">
                    Kembali
                </a>

            </form>

        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
