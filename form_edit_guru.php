<?php
session_start();
require_once 'koneksi.php';
require_once 'navbar.php';

$id = $_GET['id'];

$sql = "SELECT users.id AS id_user, users.username,
        guru.id AS id_guru, guru.nip, guru.nama,
        guru.jenis_kelamin, guru.user_id
        FROM users
        JOIN guru ON users.id = guru.user_id
        WHERE guru.user_id = $id";

$hasil = mysqli_query($koneksi, $sql);
$guru = mysqli_fetch_assoc($hasil);

if (!$guru) {
    echo "<div class='container mt-4'>";
    echo "<div class='alert alert-warning'>Data guru tidak ditemukan.</div>";
    echo "<a href='daftar_guru.php' class='btn btn-secondary'>Kembali</a>";
    echo "</div>";
    require_once 'footer.php';
    exit;
}
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
        box-shadow: 0 3px 10px rgba(217, 130, 165, 0.12);
    }

    .pink-card .card-header {
        background-color: #fce4ec;
        color: #8e4564;
        border-bottom: 1px solid #f3c5d8;
        padding: 10px 15px;
    }

    .pink-card .card-header h3 {
        margin: 0;
        font-weight: bold;
    }

    .pink-card .card-body {
        padding: 20px;
    }

    .form-control {
        border: 1px solid #edb9ce;
        border-radius: 8px;
    }

    .form-control:focus {
        border-color: #d982a5;
        box-shadow: 0 0 0 0.2rem rgba(217, 130, 165, 0.2);
    }

    input[type="radio"] {
        accent-color: #d982a5;
    }

    .btn-simpan-pink {
        background-color: #d982a5;
        color: white;
        border: none;
        border-radius: 8px;
    }

    .btn-simpan-pink:hover {
        background-color: #c75b83;
        color: white;
    }

    .btn-kembali-pink {
        background-color: #c75b83;
        color: white;
        border: none;
        border-radius: 8px;
    }

    .btn-kembali-pink:hover {
        background-color: #d982a5;
        color: white;
    }
</style>

<div class="container mt-4 mb-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card pink-card">
                <div class="card-header">
                    <h3>Form Edit Guru</h3>
                </div>

                <div class="card-body">
                    <form action="aksi_edit_guru.php" method="POST">

                        <div class="mb-3">
                            <label class="form-label">NIP</label>
                            <input type="text" class="form-control"
                                   name="nip" value="<?= $guru['nip'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control"
                                   name="nama_lengkap" value="<?= $guru['nama'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label><br>

                            <input type="radio" name="jenis_kelamin" value="L"
                                <?= $guru['jenis_kelamin'] == 'L' ? 'checked' : '' ?>>
                            Laki-laki

                            <input type="radio" name="jenis_kelamin" value="P"
                                <?= $guru['jenis_kelamin'] == 'P' ? 'checked' : '' ?>>
                            Perempuan
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control"
                                   name="username" value="<?= $guru['username'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control"
                                   name="password" placeholder="Kosongkan jika tidak diubah">
                        </div>

                        <input type="hidden" name="id" value="<?= $guru['id_guru'] ?>">
                        <input type="hidden" name="user_id" value="<?= $guru['user_id'] ?>">

                        <button type="submit" class="btn btn-simpan-pink">Edit</button>
                        <a href="daftar_guru.php" class="btn btn-kembali-pink">Kembali</a>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
