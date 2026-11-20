<?php
include 'koneksi.php';

if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    $sql = "DELETE FROM mapel WHERE id = $id";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: daftar_mapel.php");
        exit;
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }

} else {
    header("Location: daftar_mapel.php");
    exit;
}
?>
