<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';

// Memeriksa login Guru
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true ||
    $_SESSION['role'] != 'guru') {
    header("Location: login.php");
    exit;
}

// Mengambil data dari URL
$kelas = isset($_GET['kelas']) ? $_GET['kelas'] : '';
$mapel_id = isset($_GET['mapel_id']) ? (int)$_GET['mapel_id'] : 0;

$kelas_sql = mysqli_real_escape_string($koneksi, $kelas);
$id_user = (int)$_SESSION['id'];

// Memeriksa apakah kelas dan mapel benar-benar diajar guru
$cek = mysqli_query($koneksi, "
    SELECT mapel.nama_mapel
    FROM mengajar
    JOIN siswa ON mengajar.siswa_id = siswa.id
    JOIN mapel ON mengajar.mapel_id = mapel.id
    JOIN guru ON mapel.guru_id = guru.id
    WHERE siswa.kelas = '$kelas_sql'
    AND mapel.id = $mapel_id
    AND guru.user_id = $id_user
    LIMIT 1
");

if (!$cek || mysqli_num_rows($cek) == 0) {
    die("Data kelas atau mata pelajaran tidak ditemukan.");
}

$data_mapel = mysqli_fetch_assoc($cek);
$nama_mapel = $data_mapel['nama_mapel'];

// Mengambil semua siswa dalam kelas dan nilai masing-masing
$sql = "SELECT
            siswa.id AS siswa_id,
            siswa.nama AS nama_siswa,
            nilai_rapor.id AS nilai_id,
            nilai_rapor.nilai_kkm,
            nilai_rapor.nilai_pengetahuan,
            nilai_rapor.nilai_keterampilan,
            nilai_rapor.keterangan,
            '$nama_mapel' AS nama_mapel
        FROM siswa
        LEFT JOIN nilai_rapor
            ON nilai_rapor.siswa_id = siswa.id
            AND nilai_rapor.mapel_id = $mapel_id
        WHERE siswa.kelas = '$kelas_sql'
        ORDER BY siswa.nama ASC";

$hasil = mysqli_query($koneksi, $sql);

if (!$hasil) {
    die("Query gagal: " . mysqli_error($koneksi));
}

include 'navbar.php';
?>

<style>
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

    .tabel-pink thead th {
        background-color: #fce4ec;
        color: #8e4564;
        vertical-align: middle;
    }

    .tabel-pink {
        width: 100%;
        font-size: 14px;
        white-space: normal;
    }

    .tabel-pink th,
    .tabel-pink td {
        padding: 12px;
        vertical-align: middle;
    }

    .btn-edit-pink {
        background-color: #e9a6c1;
        color: white;
    }

    .btn-hapus-pink {
        background-color: #c75b83;
        color: white;
    }

    .btn-tambah-pink {
        background-color: #d982a5;
        color: white;
    }

    .btn-edit-pink:hover,
    .btn-hapus-pink:hover,
    .btn-tambah-pink:hover {
        background-color: #a94068;
        color: white;
    }

    .pink-card .card-body {
        padding: 22px;
    }
</style>

<div class="container mt-4 mb-4" style="max-width: 1200px;">

    <div class="card pink-card">

        <div class="card-header">
            <h3>Daftar Nilai Siswa</h3>
        </div>

        <div class="card-body">

            <p class="text-muted">
                Kelas:
                <strong><?= htmlspecialchars($kelas) ?></strong>
                &nbsp; | &nbsp;
                Mata Pelajaran:
                <strong><?= htmlspecialchars($nama_mapel) ?></strong>
            </p>

            <div class="table-responsive">

                <table class="table table-bordered table-striped tabel-pink">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>KKM</th>
                            <th>Pengetahuan</th>
                            <th>Keterampilan</th>
                            <th>Nilai Akhir</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php
                    $no = 1;

                    if (mysqli_num_rows($hasil) > 0) {
                        while ($baris = mysqli_fetch_assoc($hasil)) {
                    ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td>
                                <strong>
                                    <?= htmlspecialchars($baris['nama_siswa']) ?>
                                </strong>
                            </td>

                            <?php if ($baris['nilai_id'] != NULL) {

                                $kkm = $baris['nilai_kkm'];
                                $pengetahuan = $baris['nilai_pengetahuan'];
                                $keterampilan = $baris['nilai_keterampilan'];

                                $nilai_akhir = round(
                                    ($pengetahuan + $keterampilan) / 2
                                );
                            ?>

                                <td><?= htmlspecialchars($kkm) ?></td>

                                <td><?= htmlspecialchars($pengetahuan) ?></td>

                                <td><?= htmlspecialchars($keterampilan) ?></td>

                                <td>
                                    <strong><?= $nilai_akhir ?></strong>
                                </td>

                                <td>
                                    <?= htmlspecialchars($baris['keterangan'] ?? '-') ?>
                                </td>

                                <td>
                                    <a href="form_edit_nilai.php?id=<?= $baris['nilai_id'] ?>"
                                       class="btn btn-edit-pink btn-sm">
                                        Edit
                                    </a>

                                    <a href="aksi_hapus_nilai.php?id=<?= $baris['nilai_id'] ?>&kelas=<?= urlencode($kelas) ?>&mapel_id=<?= $mapel_id ?>"
                                       onclick="return confirm('Yakin ingin menghapus nilai ini?')"
                                       class="btn btn-hapus-pink btn-sm">
                                        Hapus
                                    </a>
                                </td>

                            <?php } else { ?>

                                <td>-</td>
                                <td>Belum ada</td>
                                <td>Belum ada</td>
                                <td>Belum ada</td>
                                <td>-</td>

                                <td>
                                    <a href="form_tambah_nilai.php?siswa_id=<?= $baris['siswa_id'] ?>&mapel_id=<?= $mapel_id ?>&kelas=<?= urlencode($kelas) ?>"
                                       class="btn btn-tambah-pink btn-sm">
                                        Tambah
                                    </a>
                                </td>

                            <?php } ?>

                        </tr>

                    <?php
                        }
                    } else {
                    ?>

                        <tr>
                            <td colspan="8" class="text-center">
                                Tidak ada siswa di kelas ini.
                            </td>
                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

            <div class="text-end mt-3">
                <a href="daftar_nilai.php" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
