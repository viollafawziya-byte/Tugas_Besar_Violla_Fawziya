<?php

require_once 'koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM siswa WHERE id='$id'";
$hasil = mysqli_query($koneksi, $sql);

if ($hasil) {
    echo "<script>alert('Data Siswa Berhasil Dihapus');
    window.location.href='daftar_siswa.php';</script>";
} else {
    echo "<script>alert('Data Siswa Tidak Berhasil Dihapus');
    window.location.href='daftar_siswa.php';</script>";
}

?>
