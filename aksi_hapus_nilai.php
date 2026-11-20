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

// Mengambil ID nilai
$id = (int)($_GET['id'] ?? 0);
$id_user = (int)$_SESSION['id'];

// Memeriksa apakah nilai milik Guru yang sedang login
$sql = "SELECT
            nilai_rapor.id,
            siswa.kelas,
            nilai_rapor.mapel_id
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

// Menghapus nilai
$sql_hapus = "DELETE FROM nilai_rapor WHERE id = ?";
$stmt_hapus = mysqli_prepare($koneksi, $sql_hapus);
mysqli_stmt_bind_param($stmt_hapus, "i", $id);

if (mysqli_stmt_execute($stmt_hapus)) {

    $kelas = urlencode($data['kelas']);
    $mapel_id = $data['mapel_id'];

    header("Location: detail_nilai.php?kelas=$kelas&mapel_id=$mapel_id");
    exit;

} else {
    die("Gagal menghapus nilai: " . mysqli_error($koneksi));
}
?>
