<?php
session_start();
require_once 'koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['id'];

$sql = "SELECT * FROM users WHERE id = '$id'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($query);

require_once 'navbar.php';
?>

<style>
    body {
        background-color: #fff7fa;
    }

    .pengaturan-card {
        max-width: 750px;
        width: 100%;
        margin: auto;
        background-color: white;
        border: 1px solid #f3c5d8;
        border-radius: 10px;
        overflow: hidden;
    }

    .pengaturan-header {
        background-color: #fce4ec;
        color: #8e4564;
        padding: 15px;
        border-bottom: 1px solid #f3c5d8;
        font-weight: bold;
    }

    .pengaturan-body {
        padding: 20px;
    }

    .form-label {
        font-weight: 600;
        color: #8e4564;
    }

    .form-control:focus {
        border-color: #d982a5;
        box-shadow: 0 0 0 0.2rem rgba(217, 130, 165, 0.2);
    }

    .btn-pink {
        background-color: #d982a5;
        color: white;
        border: none;
    }

    .btn-pink:hover {
        background-color: #c75b83;
        color: white;
    }
</style>

<div class="container mt-4 mb-5">

    <h4 class="fw-bold">Pengaturan</h4>
    <p class="text-muted">Ubah informasi akun kamu</p>

    <div class="pengaturan-card mt-4">

        <div class="pengaturan-header">
            Edit Data User
        </div>

        <div class="pengaturan-body">

            <form action="aksi_pengaturan.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text"
                           name="username"
                           class="form-control"
                           value="<?= htmlspecialchars($data['username']) ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>

                <div class="text-end mt-4">

                    <a href="lihat_profile.php" class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-pink">
                        Simpan Data
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?php require_once 'footer.php'; ?>
