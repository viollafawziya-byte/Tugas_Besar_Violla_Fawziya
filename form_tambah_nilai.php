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

$siswa_id = isset($_GET['siswa_id']) ? (int)$_GET['siswa_id'] : 0;
$mapel_id = isset($_GET['mapel_id']) ? (int)$_GET['mapel_id'] : 0;
$kelas = $_GET['kelas'] ?? '';

$kelas_sql = mysqli_real_escape_string($koneksi, $kelas);
$id_user = (int)$_SESSION['id'];


// Memeriksa apakah guru mengajar mata pelajaran di kelas tersebut
$cek = mysqli_query($koneksi, "
    SELECT mapel.nama_mapel
    FROM mengajar
    JOIN siswa AS siswa_diajar
        ON mengajar.siswa_id = siswa_diajar.id
    JOIN mapel ON mengajar.mapel_id = mapel.id
    JOIN guru ON mapel.guru_id = guru.id
    WHERE siswa_diajar.kelas = '$kelas_sql'
    AND mapel.id = $mapel_id
    AND guru.user_id = $id_user
    LIMIT 1
");

if (!$cek || mysqli_num_rows($cek) == 0) {
    die("Guru tidak mengajar mata pelajaran ini di kelas tersebut.");
}

// Mengambil nama mata pelajaran
$data_mapel = mysqli_fetch_assoc($cek);
$nama_mapel = $data_mapel['nama_mapel'];


// Mengambil data siswa yang akan diberi nilai
$sql = "SELECT nama, kelas
        FROM siswa
        WHERE id = $siswa_id
        AND kelas = '$kelas_sql'";

$query = mysqli_query($koneksi, $sql);

if (!$query || mysqli_num_rows($query) == 0) {
    die("Data siswa tidak ditemukan.");
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
            <h4>Form Tambah Nilai Siswa</h4>
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
                       value="<?= htmlspecialchars($nama_mapel) ?>"
                       readonly>
            </div>

            <form action="aksi_tambah_nilai.php" method="POST">

                <input type="hidden" name="siswa_id"
                       value="<?= $siswa_id ?>">

                <input type="hidden" name="mapel_id"
                       value="<?= $mapel_id ?>">

                <input type="hidden" name="kelas"
                       value="<?= htmlspecialchars($kelas) ?>">

                <div class="mb-3">
                    <label class="form-label">KKM</label>
                    <input type="number" name="nilai_kkm"
                           class="form-control"
                           min="0" max="100" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nilai Pengetahuan</label>
                    <input type="number" name="nilai_pengetahuan"
                           class="form-control"
                           min="0" max="100" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nilai Keterampilan</label>
                    <input type="number" name="nilai_keterampilan"
                           class="form-control"
                           min="0" max="100" required>
                </div>

                <div class="text-end mt-4">

                    <a href="detail_nilai.php?kelas=<?= urlencode($kelas) ?>&mapel_id=<?= $mapel_id ?>"
                       class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-pink">
                        Simpan Data
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
