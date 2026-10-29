<?php
require_once 'koneksi.php';
require_once 'navbar.php';

$id = $_GET['id'];

$sql = "SELECT users.id AS id_user, users.username,
        siswa.id AS id_siswa, siswa.nis, siswa.nama,
        siswa.kelas, siswa.jenis_kelamin, siswa.user_id
        FROM users
        JOIN siswa ON users.id = siswa.user_id
        WHERE siswa.user_id = $id";

$hasil = mysqli_query($koneksi, $sql);
$siswa = mysqli_fetch_assoc($hasil);

if (!$siswa) {
    echo "<div class='container mt-4'>";
    echo "<div class='alert alert-warning'>Data siswa tidak ditemukan.</div>";
    echo "<a href='daftar_siswa.php' class='btn btn-secondary'>Kembali</a>";
    echo "</div>";
    require_once 'footer.php';
    exit;
}
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Form Edit Siswa</h3>
        </div>

        <div class="card-body">
            <form action="aksi_edit_siswa.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">NIS</label>
                    <input type="text" class="form-control"
                        name="nis"
                        value="<?= $siswa['nis'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control"
                        name="nama_lengkap"
                        value="<?= $siswa['nama'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kelas</label>
                    <input type="text" class="form-control"
                        name="kelas"
                        value="<?= $siswa['kelas'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label><br>

                    <input type="radio" name="jenis_kelamin" value="L"
                        <?= $siswa['jenis_kelamin'] == 'L' ? 'checked' : '' ?>>
                    Laki-laki

                    <input type="radio" name="jenis_kelamin" value="P"
                        <?= $siswa['jenis_kelamin'] == 'P' ? 'checked' : '' ?>>
                    Perempuan
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control"
                        name="username"
                        value="<?= $siswa['username'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control"
                        name="password"
                        placeholder="Kosongkan jika tidak diubah">
                </div>

                <input type="hidden" name="id"
                    value="<?= $siswa['id_siswa'] ?>">

                <input type="hidden" name="user_id"
                    value="<?= $siswa['user_id'] ?>">

                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="daftar_siswa.php" class="btn btn-secondary">Kembali</a>

            </form>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
