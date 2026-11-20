<?php
session_start();
require_once 'koneksi.php';
require_once 'navbar.php';

$kelas = mysqli_real_escape_string($koneksi, $_GET['kelas']);
$mapel_id = (int) $_GET['mapel_id'];

// Mengambil data mengajar
$sql = "SELECT siswa.kelas, mengajar.mapel_id
        FROM mengajar
        JOIN siswa ON mengajar.siswa_id = siswa.id
        WHERE siswa.kelas = '$kelas'
        AND mengajar.mapel_id = $mapel_id
        LIMIT 1";

$hasil = mysqli_query($koneksi, $sql);
$mengajar = mysqli_fetch_assoc($hasil);

if (!$mengajar) {
    echo "<div class='container mt-4'>";
    echo "<div class='alert alert-warning'>Data mengajar tidak ditemukan.</div>";
    echo "<a href='daftar_mengajar.php' class='btn btn-secondary'>Kembali</a>";
    echo "</div>";
    require_once 'footer.php';
    exit;
}

// Mengambil daftar kelas
$sql_kelas = "SELECT DISTINCT kelas FROM siswa ORDER BY kelas ASC";
$hasil_kelas = mysqli_query($koneksi, $sql_kelas);

// Mengambil daftar guru dan mata pelajaran
$sql_mapel = "SELECT mapel.id, mapel.nama_mapel,
              mapel.kode_mapel, guru.nama
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
    }

    .pink-card .card-header {
        background-color: #fce4ec;
        color: #8e4564;
        border-bottom: 1px solid #f3c5d8;
    }

    .pink-card .card-body {
        padding: 22px;
    }

    .pink-card .form-control,
    .pink-card .form-select {
        border-color: #edb9ce;
        border-radius: 8px;
    }

    .pink-card .form-control:focus,
    .pink-card .form-select:focus {
        border-color: #d982a5;
        box-shadow: 0 0 0 0.2rem rgba(217,130,165,0.2);
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
        background-color: #e9a6c1;
        border-color: #e9a6c1;
        color: white;
    }

    .btn-kembali-pink:hover {
        background-color: #c75b83;
        border-color: #c75b83;
        color: white;
    }
</style>

<div class="container mt-4 mb-4" style="max-width: 600px;">

    <div class="card pink-card">

        <div class="card-header">
            <h3 class="mb-0">Form Edit Mengajar</h3>
        </div>

        <div class="card-body">

            <form action="aksi_edit_mengajar.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Pilih Kelas</label>

                    <select name="kelas_baru" class="form-select" required>

                        <?php while ($baris = mysqli_fetch_assoc($hasil_kelas)) { ?>
                            <option value="<?= htmlspecialchars($baris['kelas']) ?>"
                                <?= $baris['kelas'] == $kelas ? 'selected' : '' ?>>
                                <?= htmlspecialchars($baris['kelas']) ?>
                            </option>
                        <?php } ?>

                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Guru dan Mata Pelajaran</label>

                    <select name="mapel_id_baru" class="form-select" required>

                        <?php while ($mapel = mysqli_fetch_assoc($hasil_mapel)) { ?>
                            <option value="<?= $mapel['id'] ?>"
                                <?= $mapel['id'] == $mapel_id ? 'selected' : '' ?>>

                                <?= htmlspecialchars($mapel['nama']) ?>
                                - <?= htmlspecialchars($mapel['nama_mapel']) ?>
                                (<?= htmlspecialchars($mapel['kode_mapel']) ?>)

                            </option>
                        <?php } ?>

                    </select>
                </div>

                <input type="hidden" name="kelas_lama"
                       value="<?= htmlspecialchars($kelas) ?>">

                <input type="hidden" name="mapel_id_lama"
                       value="<?= $mapel_id ?>">

                <button type="submit" class="btn btn-simpan-pink">
                    Edit
                </button>

                <a href="daftar_mengajar.php"
                   class="btn btn-kembali-pink">
                    Kembali
                </a>

            </form>

        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>