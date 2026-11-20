<?php
session_start();
require_once 'koneksi.php';

$role = $_SESSION['role'] ?? '';
$kelas_login = $_SESSION['kelas'] ?? '';

require_once 'navbar.php';
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

    .btn-edit-pink {
        background-color: #e9a6c1;
        border-color: #e9a6c1;
        color: #fff;
    }

    .btn-edit-pink:hover {
        background-color: #d982a5;
        border-color: #d982a5;
        color: #fff;
    }

    .btn-hapus-pink {
        background-color: #c75b83;
        border-color: #c75b83;
        color: #fff;
    }

    .btn-hapus-pink:hover {
        background-color: #a94068;
        border-color: #a94068;
        color: #fff;
    }

    .btn-cari-pink {
        background-color: #d982a5;
        border-color: #d982a5;
        color: #fff;
    }

    .btn-cari-pink:hover {
        background-color: #c75b83;
        border-color: #c75b83;
        color: #fff;
    }

    #cari,
    select[name="batas"] {
        border-color: #edb9ce;
        border-radius: 8px;
    }

    #cari:focus,
    select[name="batas"]:focus {
        border-color: #d982a5;
        box-shadow: 0 0 0 0.2rem rgba(217, 130, 165, 0.2);
    }

    .tabel-pink thead th {
        background-color: #fce4ec;
        color: #8e4564;
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
        color: #fff;
    }

    .pagination .page-item.disabled .page-link {
        color: #c9a5b4;
        background-color: #fff7fa;
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

    .table-responsive {
        width: 100%;
    }
</style>

<?php

// Pilihan jumlah data per halaman
$batas = isset($_GET['batas']) ? (int)$_GET['batas'] : 10;

if (!in_array($batas, [10, 25, 50, 100])) {
    $batas = 10;
}

// Pencarian siswa
$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';
$cari_sql = mysqli_real_escape_string($koneksi, $cari);

// Mengatur data berdasarkan role
$where = "";

if ($role == 'siswa') {
    $kelas_sql = mysqli_real_escape_string($koneksi, $kelas_login);
    $where = "WHERE kelas = '$kelas_sql'";
}

elseif ($role == 'guru') {

    $guru_user_id = (int)$_SESSION['id'];

    $where = "WHERE kelas IN (
        SELECT s2.kelas
        FROM mengajar
        INNER JOIN mapel ON mengajar.mapel_id = mapel.id
        INNER JOIN siswa AS s2 ON mengajar.siswa_id = s2.id
        INNER JOIN guru ON mapel.guru_id = guru.id
        WHERE guru.user_id = $guru_user_id
        GROUP BY s2.kelas
    )";
}

// Menambahkan pencarian
if ($cari != '') {
    if ($where != '') {
        $where .= " AND ";
    } else {
        $where = "WHERE ";
    }

    $where .= "(nis LIKE '%$cari_sql%'
                OR nama LIKE '%$cari_sql%'
                OR kelas LIKE '%$cari_sql%'
                OR jenis_kelamin LIKE '%$cari_sql%')";
}

// Menghitung jumlah data
$sql_jumlah = "SELECT COUNT(*) AS total FROM siswa $where";
$hasil_jumlah = mysqli_query($koneksi, $sql_jumlah);
$data_jumlah = mysqli_fetch_assoc($hasil_jumlah);
$total_data = (int)$data_jumlah['total'];

$total_halaman = max(1, ceil($total_data / $batas));

$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman = max(1, min($halaman, $total_halaman));

$mulai = ($halaman - 1) * $batas;

// Mengambil data siswa
$sql = "SELECT * FROM siswa
        $where
        ORDER BY id DESC
        LIMIT $mulai, $batas";

$hasil = mysqli_query($koneksi, $sql);

// Judul daftar siswa
if ($role == 'siswa') {
    $judul = "Daftar Siswa Kelas " . htmlspecialchars($kelas_login);
} else {
    $judul = "Daftar Siswa";
}
?>

<div class="container mt-4 mb-4" style="max-width: 1100px;">
    <div class="card pink-card">

        <div class="card-header text-center">
            <h3><?= $judul ?></h3>
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
                            <option value="10"
                                <?= $batas == 10 ? 'selected' : '' ?>>10</option>
                            <option value="25"
                                <?= $batas == 25 ? 'selected' : '' ?>>25</option>
                            <option value="50"
                                <?= $batas == 50 ? 'selected' : '' ?>>50</option>
                            <option value="100"
                                <?= $batas == 100 ? 'selected' : '' ?>>100</option>
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
                               value="<?= htmlspecialchars($cari) ?>"
                               placeholder="Cari siswa...">
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
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Jenis Kelamin</th>

                            <?php if ($role == 'admin') { ?>
                                <th>Aksi</th>
                            <?php } ?>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    $no = $mulai + 1;

                    if ($hasil && mysqli_num_rows($hasil) > 0) {
                        while ($baris = mysqli_fetch_assoc($hasil)) {
                    ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($baris['nis']) ?></td>
                            <td><?= htmlspecialchars($baris['nama']) ?></td>
                            <td><?= htmlspecialchars($baris['kelas']) ?></td>
                            <td><?= htmlspecialchars($baris['jenis_kelamin']) ?></td>

                            <?php if ($role == 'admin') { ?>
                                <td>
                                    <a href="form_edit_siswa.php?id=<?= $baris['user_id'] ?>"
                                       class="btn btn-edit-pink btn-sm">
                                        Edit
                                    </a>

                                    <a href="aksi_hapus_siswa.php?id=<?= $baris['id'] ?>"
                                       onclick="return confirm('Yakin ingin menghapus siswa ini?')"
                                       class="btn btn-hapus-pink btn-sm">
                                        Hapus
                                    </a>
                                </td>
                            <?php } ?>
                        </tr>

                    <?php
                        }
                    } else {
                    ?>

                        <tr>
                            <td colspan="<?= $role == 'admin' ? 6 : 5 ?>"
                                class="text-center">
                                Data siswa tidak ditemukan.
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
                dari <?= $total_data ?> data siswa.
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

<?php require_once 'footer.php'; ?>
