<?php
require_once 'koneksi.php';
require_once 'navbar.php';

$keyword = isset($_GET['cari']) ? trim($_GET['cari']) : '';

$batas = isset($_GET['batas']) ? (int)$_GET['batas'] : 10;
if (!in_array($batas, [10, 25, 50, 100])) {
    $batas = 10;
}

$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
if ($halaman < 1) {
    $halaman = 1;
}

$where = '';

if ($keyword !== '') {
    $cari_sql = mysqli_real_escape_string($koneksi, $keyword);

    $where = "WHERE username LIKE '%$cari_sql%'
              OR role LIKE '%$cari_sql%'
              OR created_at LIKE '%$cari_sql%'";
}

$sql_total = "SELECT COUNT(*) AS total FROM users $where";
$hasil_total = mysqli_query($koneksi, $sql_total);
$total_data = mysqli_fetch_assoc($hasil_total)['total'];

$total_halaman = max(1, ceil($total_data / $batas));

if ($halaman > $total_halaman) {
    $halaman = $total_halaman;
}

$mulai = ($halaman - 1) * $batas;

$sql = "SELECT * FROM users $where
        ORDER BY id DESC
        LIMIT $mulai, $batas";

$hasil = mysqli_query($koneksi, $sql);
?>

<style>
    .pink-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(214, 80, 140, 0.12);
    }

    .pink-header {
        background-color: #f4b6d2;
        color: #713d56;
        padding: 18px 22px;
    }

    .pink-header h3 {
        margin: 0;
        font-size: 23px;
        font-weight: bold;
    }

    .pink-body {
        background-color: #fffafd;
        padding: 22px;
    }

    .tabel-pink {
        width: 100%;
        margin-bottom: 0;
        white-space: nowrap;
        font-size: 16px;
    }

    .tabel-pink thead th {
        background-color: #f8d5e5;
        color: #713d56;
        padding: 16px 18px;
        vertical-align: middle;
        font-size: 16px;
    }

    .tabel-pink tbody td,
    .tabel-pink tbody th {
        padding: 15px 18px;
        vertical-align: middle;
        font-size: 16px;
    }

    .tabel-pink tbody tr:nth-child(even) {
        background-color: #fff0f6;
    }

    .tabel-pink tbody tr:hover {
        background-color: #fde3ef;
    }

    .btn-cari-pink {
        background-color: #e879ac;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 18px;
    }

    .btn-cari-pink:hover {
        background-color: #d95795;
        color: white;
    }

    .btn-edit-pink {
        background-color: #f5b6d2;
        color: #713d56;
        border: none;
    }

    .btn-edit-pink:hover {
        background-color: #ed9fc3;
        color: #713d56;
    }

    .btn-hapus-pink {
        background-color: #dc6b91;
        color: white;
        border: none;
    }

    .btn-hapus-pink:hover {
        background-color: #c94d78;
        color: white;
    }

    .pagination .page-link {
        color: #d95795;
        border-color: #f3c4dc;
        padding: 8px 13px;
    }

    .pagination .page-item.active .page-link {
        background-color: #e879ac;
        border-color: #e879ac;
        color: white;
    }

    .form-control,
    .form-select {
        border-color: #f3c4dc;
        border-radius: 8px;
        padding: 10px 12px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #e879ac;
        box-shadow: 0 0 0 3px rgba(232, 121, 172, 0.15);
    }

    @media (max-width: 576px) {
        .pink-body {
            padding: 15px;
        }

        .pink-header h3 {
            font-size: 21px;
        }

        .tabel-pink {
            font-size: 15px;
        }

        .tabel-pink thead th,
        .tabel-pink tbody td,
        .tabel-pink tbody th {
            padding: 13px 15px;
        }
    }
</style>

<div class="container mt-4 mb-4">

    <div class="card pink-card">

        <div class="pink-header">
            <h3>Tabel Daftar User</h3>
        </div>

        <div class="pink-body">

            <form method="GET" class="row g-3 mb-4">

                <div class="col-12 col-md-6">
                    <input
                        type="text"
                        name="cari"
                        class="form-control"
                        placeholder="Cari username, role, atau tanggal..."
                        value="<?= htmlspecialchars($keyword) ?>"
                    >
                </div>

                <div class="col-6 col-md-3">
                    <select name="batas" class="form-select">
                        <option value="10" <?= $batas == 10 ? 'selected' : '' ?>>10 data</option>
                        <option value="25" <?= $batas == 25 ? 'selected' : '' ?>>25 data</option>
                        <option value="50" <?= $batas == 50 ? 'selected' : '' ?>>50 data</option>
                        <option value="100" <?= $batas == 100 ? 'selected' : '' ?>>100 data</option>
                    </select>
                </div>

                <div class="col-6 col-md-3">
                    <button type="submit" class="btn btn-cari-pink w-100">
                        Cari
                    </button>
                </div>

            </form>

            <p class="text-muted mb-3">
                Jumlah data: <?= $total_data ?>
            </p>

            <div class="table-responsive">

                <table class="table table-bordered tabel-pink">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Created At</th>
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
                                <?= htmlspecialchars($baris['username']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($baris['password']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($baris['role']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($baris['created_at']) ?>
                            </td>

                            <td>
                                <a
                                    href="form_edit_user.php?id=<?= $baris['id'] ?>&role=<?= urlencode($baris['role']) ?>"
                                    class="btn btn-edit-pink btn-sm"
                                >
                                    Edit
                                </a>

                                <a
                                    href="aksi_hapus.php?id=<?= $baris['id'] ?>&role=<?= urlencode($baris['role']) ?>"
                                    onclick="return confirm('Yakin ingin menghapus user ini?')"
                                    class="btn btn-hapus-pink btn-sm"
                                >
                                    Hapus
                                </a>
                            </td>
                        </tr>

                    <?php
                        }
                    } else {
                    ?>

                        <tr>
                            <td colspan="6" class="text-center">
                                Data user tidak ditemukan.
                            </td>
                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

            <?php if ($total_data > 0) { ?>

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-4">

                    <small class="text-muted">
                        Halaman <?= $halaman ?> dari <?= $total_halaman ?>
                    </small>

                    <nav>
                        <ul class="pagination pagination-sm mb-0">

                            <li class="page-item <?= $halaman <= 1 ? 'disabled' : '' ?>">
                                <a
                                    class="page-link"
                                    href="?halaman=<?= max(1, $halaman - 1) ?>&batas=<?= $batas ?>&cari=<?= urlencode($keyword) ?>"
                                >
                                    Sebelumnya
                                </a>
                            </li>

                            <li class="page-item <?= $halaman >= $total_halaman ? 'disabled' : '' ?>">
                                <a
                                    class="page-link"
                                    href="?halaman=<?= min($total_halaman, $halaman + 1) ?>&batas=<?= $batas ?>&cari=<?= urlencode($keyword) ?>"
                                >
                                    Berikutnya
                                </a>
                            </li>

                        </ul>
                    </nav>

                </div>

            <?php } ?>

        </div>
    </div>

</div>

<?php require_once 'footer.php'; ?>
