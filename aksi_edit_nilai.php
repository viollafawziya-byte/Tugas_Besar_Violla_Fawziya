<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'koneksi.php';

// Memastikan yang mengakses adalah Guru
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true ||
    $_SESSION['role'] != 'guru') {
    header("Location: login.php");
    exit;
}

// Mengambil data dari form
$id = (int)($_POST['id'] ?? 0);
$kkm = $_POST['nilai_kkm'] ?? '';
$pengetahuan = $_POST['nilai_pengetahuan'] ?? ''; $keterampilan = $_POST['nilai_keterampilan'] ?? '';
$id_user = (int)$_SESSION['id'];

// Memeriksa apakah nilai berupa angka 0 sampai 100
if (
    !is_numeric($kkm) ||
    !is_numeric($pengetahuan) ||
    !is_numeric($keterampilan) ||
    $kkm < 0 || $kkm > 100 ||
    $pengetahuan < 0 || $pengetahuan > 100 ||
    $keterampilan < 0 || $keterampilan > 100
) {
    die("Nilai harus berupa angka antara 0 sampai 100.");
}

// Memeriksa kepemilikan nilai oleh Guru
$sql = "SELECT nilai_rapor.id, siswa.kelas, nilai_rapor.mapel_id
        FROM nilai_rapor
        JOIN siswa ON nilai_rapor.siswa_id = siswa.id
        JOIN mapel ON nilai_rapor.mapel_id = mapel.id
        JOIN guru ON mapel.guru_id = guru.id
        WHERE nilai_rapor.id = ?
        AND guru.user_id = ?";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "ii", $id, $id_user);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data nilai tidak ditemukan atau bukan milik Guru ini.");
}

// Menghitung nilai akhir
$nilai_akhir = round(($pengetahuan + $keterampilan) / 2);

// Menentukan keterangan
if ($nilai_akhir >= $kkm) {
    $keterangan = "Lulus";
} else {
    $keterangan = "Tidak Lulus";
}

// Memperbarui nilai
$sql_update = "UPDATE nilai_rapor
               SET nilai_kkm = ?,
                   nilai_pengetahuan = ?,
                   nilai_keterampilan = ?,
                   keterangan = ?
               WHERE id = ?";

$stmt_update = mysqli_prepare($koneksi, $sql_update);

mysqli_stmt_bind_param(
    $stmt_update,
    "dddsi",
    $kkm,
    $pengetahuan,
    $keterampilan,
    $keterangan,
    $id
);

if (mysqli_stmt_execute($stmt_update)) {

    $kelas = urlencode($data['kelas']);
    $mapel_id = $data['mapel_id'];

    header("Location: detail_nilai.php?kelas=$kelas&mapel_id=$mapel_id");
    exit;

} else {
    die("Gagal memperbarui nilai: " . mysqli_error($koneksi));
}
?>
