<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';
include 'navbar.php';

// Mengambil daftar kelas
$sql_kelas = "SELECT DISTINCT kelas FROM siswa ORDER BY kelas ASC";
$hasil_kelas = mysqli_query($koneksi, $sql_kelas);

// Mengambil daftar guru dan mata pelajaran
$sql_mapel = "SELECT mapel.id, mapel.nama_mapel, guru.nama
              FROM mapel
              JOIN guru ON mapel.guru_id = guru.id
              ORDER BY guru.nama ASC";

$hasil_mapel = mysqli_query($koneksi, $sql_mapel);
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
    }

    .pink-card .card-header {
        background-color: #fce4ec;
        color: #8e4564;
        border-bottom: 1px solid #f3c5d8;
        padding: 12px 15px;
    }

    .pink-card .card-body {
        padding: 18px;
    }

    .pink-card .form-select {
        border-color: #edb9ce;
        border-radius: 8px;
    }

    .pink-card .form-select:focus {
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
        color: white;
    }

    .btn-kembali-pink {
        background-color: #e9a6c1;
        border-color: #e9a6c1;
        color: white;
    }

    .btn-kembali-pink:hover {
        background-color: #d982a5;
        color: white;
    }
</style>

<div class="container mt-4 mb-4" style="max-width: 550px;">
    <div class="card pink-card">

        <div class="card-header">
            <h5 class="mb-0">Form Tambah Mengajar</h5>
        </div>

        <div class="card-body">

            <h5>Pengajar</h5>

            <?php if (isset($_GET['status']) && $_GET['status'] === 'berhasil') { ?>
                <div class="alert alert-success">
                    Data mengajar berhasil ditambahkan!
                </div>
            <?php } ?>

            <?php if (isset($_GET['status']) && $_GET['status'] === 'duplikat') { ?>
                <div class="alert alert-warning">
                    Data mengajar sudah tersedia untuk kelas tersebut.
                </div>
            <?php } ?>

            <form action="aksi_tambah_mengajar.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Pilih Kelas</label>

                    <select name="kelas" class="form-select" required>
                        <option value="">Pilih Kelas...</option>

                        <?php
                        if ($hasil_kelas) {
                            while ($kelas = mysqli_fetch_assoc($hasil_kelas)) {
                        ?>
                            <option value="<?= htmlspecialchars($kelas['kelas']) ?>">
                                <?= htmlspecialchars($kelas['kelas']) ?>
                            </option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Pilih Guru</label>

                    <select name="mapel_id" class="form-select" required>
                        <option value="">Pilih Guru...</option>

                        <?php
                        if ($hasil_mapel) {
                            while ($mapel = mysqli_fetch_assoc($hasil_mapel)) {
                        ?>
                            <option value="<?= $mapel['id'] ?>">
                                <?= htmlspecialchars($mapel['nama']) ?>
                                | <?= htmlspecialchars($mapel['nama_mapel']) ?>
                            </option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-simpan-pink">
                    Simpan Data
                </button>

                <a href="daftar_mengajar.php" class="btn btn-kembali-pink">
                    Kembali
                </a>

            </form>

        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>
