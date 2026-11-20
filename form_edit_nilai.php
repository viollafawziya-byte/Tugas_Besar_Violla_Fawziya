<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true ||
    $_SESSION['role'] != 'guru') {
    header("Location: login.php");
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$id_user = (int)$_SESSION['id'];

// Mengambil data nilai
$sql = "SELECT
            nilai_rapor.*,
            siswa.nama,
            siswa.kelas,
            mapel.nama_mapel
        FROM nilai_rapor
        JOIN siswa ON nilai_rapor.siswa_id = siswa.id
        JOIN mapel ON nilai_rapor.mapel_id = mapel.id
        JOIN guru ON mapel.guru_id = guru.id
        WHERE nilai_rapor.id = $id
        AND guru.user_id = $id_user";

$query = mysqli_query($koneksi, $sql);

if (!$query || mysqli_num_rows($query) == 0) {
    die("Data nilai tidak ditemukan.");
}

$data = mysqli_fetch_assoc($query);

require_once 'navbar.php';
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

    .form-label {
        color: #8e4564;
        font-weight: 600;
    }

    .form-control:focus {
        border-color: #d982a5;
        box-shadow: 0 0 0 0.2rem rgba(217,130,165,0.2);
    }

    .btn-pink {
        background-color: #d982a5;
        color: white;
        border: none;
    }

    .btn-pink:hover {
        background-color: #c75b83;
        color: white;
    }
</style>

<div class="container mt-4 mb-5" style="max-width: 750px;">

    <div class="card pink-card">

        <div class="card-header">
            <h4>Form Edit Nilai Siswa</h4>
        </div>

        <div class="card-body">

            <div class="mb-3">
                <label class="form-label">Nama Siswa</label>
                <input type="text" class="form-control"
                       value="<?= htmlspecialchars($data['nama']) ?>"
                       readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <input type="text" class="form-control"
                       value="<?= htmlspecialchars($data['kelas']) ?>"
                       readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Mata Pelajaran</label>
                <input type="text" class="form-control"
                       value="<?= htmlspecialchars($data['nama_mapel']) ?>"
                       readonly>
            </div>

            <form action="aksi_edit_nilai.php" method="POST">

                <input type="hidden" name="id"
                       value="<?= $data['id'] ?>">

                <div class="mb-3">
                    <label class="form-label">KKM</label>
                    <input type="number" name="nilai_kkm"
                           class="form-control"
                           min="0" max="100"
                           value="<?= htmlspecialchars($data['nilai_kkm']) ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nilai Pengetahuan</label>
                    <input type="number" name="nilai_pengetahuan"
                           class="form-control"
                           min="0" max="100"
                           value="<?= htmlspecialchars($data['nilai_pengetahuan']) ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nilai Keterampilan</label>
                    <input type="number" name="nilai_keterampilan"
                           class="form-control"
                           min="0" max="100"
                           value="<?= htmlspecialchars($data['nilai_keterampilan']) ?>"
                           required>
                </div>

                <div class="text-end mt-4">

                    <a href="detail_nilai.php?kelas=<?= urlencode($data['kelas']) ?>&mapel_id=<?= $data['mapel_id'] ?>"
                       class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-pink">
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
