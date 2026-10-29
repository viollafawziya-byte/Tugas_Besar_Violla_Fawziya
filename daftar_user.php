<?php
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

    .btn-edit-pink {
        background-color: #e9a6c1;
        border-color: #e9a6c1;
        color: white;
    }

    .btn-edit-pink:hover {
        background-color: #d982a5;
        border-color: #d982a5;
        color: white;
    }

    .btn-hapus-pink {
        background-color: #c75b83;
        border-color: #c75b83;
        color: white;
    }

    .btn-hapus-pink:hover {
        background-color: #a94068;
        border-color: #a94068;
        color: white;
    }

    .btn-cari-pink {
        background-color: #d982a5;
        border-color: #d982a5;
        color: white;
    }

    .btn-cari-pink:hover {
        background-color: #c75b83;
        border-color: #c75b83;
        color: white;
    }

    #cari, select[name="batas"] {
        border-color: #edb9ce;
        border-radius: 8px;
    }

    #cari:focus, select[name="batas"]:focus {
        border-color: #d982a5;
        box-shadow: 0 0 0 0.2rem rgba(217, 130, 165, 0.2);
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

    .pagination .page-item.disabled .page-link {
        color: #c9a5b4;
        background-color: #fff7fa;
    }
</style>

<?php
// Pilihan jumlah data per halaman
$batas = isset($_GET['batas']) ? (int)$_GET['batas'] : 10;

if (!in_array($batas, [10, 25, 50, 100])) {
    $batas = 10;
}

// Pencarian user
$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';
$cari_sql = mysqli_real_escape_string($koneksi, $cari);

$where = "";

if ($cari != '') {
    $where = "WHERE users.username LIKE '%$cari_sql%'
              OR COALESCE(siswa.nama, guru.nama, users.username)
                 LIKE '%$cari_sql%'
              OR users.role LIKE '%$cari_sql%'
              OR users.created_at LIKE '%$cari_sql%'";
}

// Menghitung jumlah user
$sql_jumlah = "SELECT COUNT(*) AS total
               FROM users
               LEFT JOIN siswa ON users.id = siswa.user_id
               LEFT JOIN guru ON users.id = guru.user_id
               $where";

$hasil_jumlah = mysqli_query($koneksi, $sql_jumlah);
$data_jumlah = mysqli_fetch_assoc($hasil_jumlah);
$total_data = (int)$data_jumlah['total'];

$total_halaman = max(1, ceil($total_data / $batas));

$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman = max(1, min($halaman, $total_halaman));

$mulai = ($halaman - 1) * $batas;

// Mengambil data user
$sql = "SELECT users.*,
        COALESCE(siswa.nama, guru.nama, users.username) AS nama_lengkap
        FROM users
        LEFT JOIN siswa ON users.id = siswa.user_id
        LEFT JOIN guru ON users.id = guru.user_id
        $where
        ORDER BY users.id DESC
        LIMIT $mulai, $batas";

$hasil = mysqli_query($koneksi, $sql);
?>

<div class="container-fluid mt-4">
    <div class="card pink-card">

        <div class="card-header">
            <h3>Tabel Data User</h3>
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
                               placeholder="Cari user..."
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
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Role</th>
                            <th>Created at</th>
                            <th>Aksi</th>
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

                            <td>
                                <?= htmlspecialchars($baris['username']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($baris['nama_lengkap'] ?? '-') ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($baris['role']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($baris['created_at'] ?? '-') ?>
                            </td>

                            <td>
                                <a href="form_edit_user.php?id=<?= $baris['id'] ?>&role=<?= urlencode($baris['role']) ?>"
                                   class="btn btn-edit-pink btn-sm">Edit</a>

                                <a href="aksi_hapus.php?id=<?= $baris['id'] ?>&role=<?= urlencode($baris['role']) ?>"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')"
                                   class="btn btn-hapus-pink btn-sm">Hapus</a>
                            </td>
                        </tr>
                    <?php
                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="6" class="text-center">
                                Tidak ada data user.
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
                dari <?= $total_data ?> data user.
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

            <br>
            <a href="logout.php">Logout</a>

        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>
