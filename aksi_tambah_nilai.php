<?php

session_start();
require_once 'koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true ||
    $_SESSION['role'] != 'guru') {
    header("Location: login.php");
    exit;
}

// Mengambil data dari form
$siswa_id = (int)($_POST['siswa_id'] ?? 0);
$mapel_id = (int)($_POST['mapel_id'] ?? 0);
$kelas = $_POST['kelas'] ?? '';

$kkm = (int)($_POST['nilai_kkm'] ?? -1);
$pengetahuan = (int)($_POST['nilai_pengetahuan'] ?? -1);
$keterampilan = (int)($_POST['nilai_keterampilan'] ?? -1);

$id_user = (int)$_SESSION['id'];

$kelas_sql = mysqli_real_escape_string($koneksi, $kelas);

// Memeriksa nilai
if (
    $siswa_id <= 0 ||
    $mapel_id <= 0 ||
    $kkm < 0 || $kkm > 100 ||
    $pengetahuan < 0 || $pengetahuan > 100 ||
    $keterampilan < 0 || $keterampilan > 100
) {
    die("Data nilai tidak valid.");
}

// Memastikan guru mengajar mata pelajaran di kelas tersebut
$cek = mysqli_query($koneksi, "
    SELECT mengajar.id
    FROM mengajar
    JOIN siswa AS siswa_diajar
        ON mengajar.siswa_id = siswa_diajar.id
    JOIN mapel ON mengajar.mapel_id = mapel.id
    JOIN guru ON mapel.guru_id = guru.id
    JOIN siswa AS siswa_dituju
        ON siswa_dituju.id = $siswa_id
    WHERE siswa_dituju.kelas = '$kelas_sql'
    AND siswa_diajar.kelas = siswa_dituju.kelas
    AND mapel.id = $mapel_id
    AND guru.user_id = $id_user
    LIMIT 1
");

if (!$cek || mysqli_num_rows($cek) == 0) {
    die("Kamu tidak memiliki akses untuk mengisi nilai ini.");
}

// Memeriksa apakah nilai sudah pernah ditambahkan
$cek_nilai = mysqli_query($koneksi, "
    SELECT id FROM nilai_rapor
    WHERE siswa_id = $siswa_id
    AND mapel_id = $mapel_id
");

if (!$cek_nilai) {
    die("Pemeriksaan nilai gagal: " . mysqli_error($koneksi));
}

if (mysqli_num_rows($cek_nilai) > 0) {
    echo "<script>
        alert('Nilai siswa sudah tersedia!');
        window.location.href = 'detail_nilai.php?kelas=" .
        urlencode($kelas) . "&mapel_id=$mapel_id';
    </script>";
    exit;
}

// Menghitung nilai akhir
$nilai_akhir = round(($pengetahuan + $keterampilan) / 2);

// Menentukan keterangan
if ($nilai_akhir >= $kkm) {
    $keterangan = 'Lulus';
} else {
    $keterangan = 'Tidak Lulus';
}

// Menyimpan nilai
$sql = mysqli_prepare($koneksi, "
    INSERT INTO nilai_rapor
    (siswa_id, mapel_id, nilai_kkm,
     nilai_pengetahuan, nilai_keterampilan, keterangan)
    VALUES (?, ?, ?, ?, ?, ?)
");

mysqli_stmt_bind_param(
    $sql,
    "iiiiis",
    $siswa_id,
    $mapel_id,
    $kkm,
    $pengetahuan,
    $keterampilan,
    $keterangan
);

if (mysqli_stmt_execute($sql)) {

    echo "<script>
        alert('Nilai siswa berhasil ditambahkan!');
        window.location.href = 'detail_nilai.php?kelas=" .
        urlencode($kelas) . "&mapel_id=$mapel_id';
    </script>";

} else {

    echo "<script>
        alert('Gagal menambahkan nilai!');
        window.location.href = 'form_tambah_nilai.php?siswa_id=$siswa_id&mapel_id=$mapel_id&kelas=" .
        urlencode($kelas) . "';
    </script>";

}

?>
