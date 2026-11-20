<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';
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

    .btn-cari-pink {
        background-color: #d982a5;
        border-color: #d982a5;
        color: white;
    }

    .btn-cari-pink:hover {
        background-color: #c75b83;
        color: white;
    }

    .btn-lihat-pink {
        background-color: #d982a5;
        border-color: #d982a5;
        color: white;
    }

    .btn-lihat-pink:hover {
        background-color: #c75b83;
        color: white;
    }

    #cari, select[name="batas"] {
        border-color: #edb9ce;
        border-radius: 8px;
    }

    #cari:focus, select[name="batas"]:focus {
        border-color: #d982a5;
        box-shadow: 0 0 0 0.2rem rgba(217,130,165,0.2);
    }

    .pagination .page-link {
        color: #bd6488;
        border-color: #f3c5d8;
    }

    .pagination .page-link:hover {
        background-color: #fce4ec;
        color: #8e4564;
    }

    .pagination .page-item.active .page-link {
        background-color: #d982a5;
        border-color: #d982a5;
        color: white;
    }

    .pink-card .card-body {
        padding: 22px;
    }

    .tabel-pink {
        width: 100%;
        margin-bottom: 0;
        white-space: normal;
        font-size: 15px;
    }

    .tabel-pink th,
    .tabel-pink td {
        padding: 12px;
        vertical-align: middle;
    }
</style>

<?php

// Pilihan jumlah data per halaman
$batas = isset($_GET['batas']) ? (int)$_GET['batas'] : 10;

if (!in_array($batas, [10, 25, 50, 100])) {
    $batas = 10;
}

// Pencarian
$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';
$cari_sql = mysqli_real_escape_string($koneksi, $cari);

// Hubungan tabel
$from = "FROM mengajar
         JOIN siswa s ON mengajar.siswa_id = s.id
         JOIN mapel ON mengajar.mapel_id = mapel.id
         JOIN guru ON mapel.guru_id = guru.id";

// Pencarian berdasarkan kelas dan mata pelajaran
$where = "WHERE 1=1";

if ($cari != '') {
    $where .= " AND (
        s.kelas LIKE '%$cari_sql%'
        OR mapel.nama_mapel LIKE '%$cari_sql%'
        OR mapel.kode_mapel LIKE '%$cari_sql%'
    )";
}

// Membatasi data sesuai guru yang login
if ($_SESSION['role'] == 'guru') {
    $id_user = (int)$_SESSION['id'];

    $where .= " AND guru.user_id = $id_user";
}

// Menghitung jumlah kelompok kelas dan mapel
$sql_jumlah = "SELECT COUNT(*) AS total
               FROM (
                   SELECT s.kelas, mengajar.mapel_id
                   $from
                   $where
                   GROUP BY s.kelas, mengajar.mapel_id
               ) AS data_nilai";

$hasil_jumlah = mysqli_query($koneksi, $sql_jumlah);

if (!$hasil_jumlah) {
    die("Query jumlah gagal: " . mysqli_error($koneksi));
}

$data_jumlah = mysqli_fetch_assoc($hasil_jumlah);
$total_data = (int)$data_jumlah['total'];

$total_halaman = max(1, ceil($total_data / $batas));

$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman = max(1, min($halaman, $total_halaman));

$mulai = ($halaman - 1) * $batas;

// Mengambil daftar kelas dan mata pelajaran
$sql = "SELECT
            s.kelas,
            mengajar.mapel_id,
            mapel.nama_mapel,
            (SELECT COUNT(*)
             FROM siswa AS semua_siswa
             WHERE semua_siswa.kelas = s.kelas) AS jumlah_siswa
        $from
        $where
        GROUP BY s.kelas, mengajar.mapel_id, mapel.nama_mapel
        ORDER BY s.kelas ASC
        LIMIT $mulai, $batas";

$hasil = mysqli_query($koneksi, $sql);

if (!$hasil) {
    die("Query data gagal: " . mysqli_error($koneksi));
}

?>

<div class="container mt-4 mb-4" style="max-width: 1100px;">

    <div class="card pink-card">

        <div class="card-header">
            <h3>Daftar Kelas yang Diajar</h3>
        </div>

        <div class="card-body">

            <form method="GET" class="mb-3">

                <div class="row g-2 align-items-center">

                    <div class="col-auto">
                        Tampilkan
                    </div>

                    <div class="col-auto">
                        <select name="batas" class="form-select"
                                onchange="this.form.submit()">
                            <option value="10" <?= $batas == 10 ? 'selected' : '' ?>>10</option>
                            <option value="25" <?= $batas == 25 ? 'selected' : '' ?>>25</option>
                            <option value="50" <?= $batas == 50 ? 'selected' : '' ?>>50</option>
                            <option value="100" <?= $batas == 100 ? 'selected' : '' ?>>100</option>
                        </select>
                    </div>

                    <div class="col-auto">
                        data per halaman
                    </div>

                    <div class="col-auto ms-auto">
                        <label for="cari">Cari:</label>
                    </div>

                    <div class="col-auto">
                        <input type="text" id="cari" name="cari"
                               class="form-control"
                               placeholder="Cari kelas atau mapel..."
                               value="<?= htmlspecialchars($cari) ?>">
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-cari-pink">
                            Cari
                        </button>
                    </div>

                </div>

            </form>

            <div class="table-responsive">

                <table class="table table-bordered table-striped tabel-pink">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Jumlah Siswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php
                    $no = $mulai + 1;

                    if (mysqli_num_rows($hasil) > 0) {
                        while ($baris = mysqli_fetch_assoc($hasil)) {
                    ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td>
                                <?= htmlspecialchars($baris['kelas']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($baris['nama_mapel']) ?>
                            </td>

                            <td>
                                <?= $baris['jumlah_siswa'] ?> siswa
                            </td>

                            <td>
                                <a href="detail_nilai.php?kelas=<?= urlencode($baris['kelas']) ?>&mapel_id=<?= $baris['mapel_id'] ?>"
                                   class="btn btn-lihat-pink btn-sm">
                                    Lihat
                                </a>
                            </td>

                        </tr>

                    <?php
                        }
                    } else {
                    ?>

                        <tr>
                            <td colspan="5" class="text-center">
                                Tidak ada data kelas yang diajar.
                            </td>
                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

            <p>
                Menampilkan
                <?= $total_data > 0 ? $mulai + 1 : 0 ?>
                -
                <?= min($mulai + $batas, $total_data) ?>
                dari <?= $total_data ?> data.
            </p>

            <nav>
                <ul class="pagination justify-content-center">

                    <li class="page-item <?= $halaman <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link"
                           href="?halaman=<?= $halaman - 1 ?>&batas=<?= $batas ?>&cari=<?= urlencode($cari) ?>">
                            Sebelumnya
                        </a>
                    </li>

                    <?php for ($i = 1; $i <= $total_halaman; $i++) { ?>

                        <li class="page-item <?= $halaman == $i ? 'active' : '' ?>">
                            <a class="page-link"
                               href="?halaman=<?= $i ?>&batas=<?= $batas ?>&cari=<?= urlencode($cari) ?>">
                                <?= $i ?>
                            </a>
                        </li>

                    <?php } ?>

                    <li class="page-item <?= $halaman >= $total_halaman ? 'disabled' : '' ?>">
                        <a class="page-link"
                           href="?halaman=<?= $halaman + 1 ?>&batas=<?= $batas ?>&cari=<?= urlencode($cari) ?>">
                            Selanjutnya
                        </a>
                    </li>

                </ul>
            </nav>

        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>
