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

<div class="container mt-4">
    <div class="card">
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

                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="daftar_guru.php" class="btn btn-secondary">Kembali</a>

            </form>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
