<?php
require_once 'koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM guru WHERE id='$id'";
$hasil = mysqli_query($koneksi, $sql);

if ($hasil) {
    echo "<script>
    alert('Data Guru Berhasil Dihapus');
    window.location.href='daftar_guru.php';
    </script>";
} else {
    echo "<script>
    alert('Data Guru Tidak Berhasil Dihapus');
    window.location.href='daftar_guru.php';
    </script>";
}
?>
