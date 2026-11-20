<?php
include 'koneksi.php';

$kelas = isset($_GET['kelas']) ? mysqli_real_escape_string($koneksi, $_GET['kelas']) : '';
$mapel_id = isset($_GET['mapel_id']) ? (int) $_GET['mapel_id'] : 0;

// Menghapus data mengajar berdasarkan kelas dan mata pelajaran
$sql = "DELETE FROM mengajar
        WHERE mapel_id = $mapel_id
        AND siswa_id IN (
            SELECT id FROM siswa
            WHERE kelas = '$kelas'
        )";

$hasil = mysqli_query($koneksi, $sql);

if ($hasil) {
    echo "<script>
        alert('Data Mengajar Berhasil Dihapus');
        window.location.href='daftar_mengajar.php';
    </script>";
} else {
    echo "<script>
        alert('Data Mengajar Tidak Berhasil Dihapus');
        window.location.href='daftar_mengajar.php';
    </script>";
}
?>
