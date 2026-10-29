<?php

require_once 'koneksi.php';

$id = $_GET['id'];
$role = $_GET['role'];

if ($role == 'siswa') {

    // Hapus data siswa terlebih dahulu
    $sql1 = "DELETE FROM siswa WHERE user_id = '$id'";
    $hapus_siswa = mysqli_query($koneksi, $sql1);

    // Hapus data user
    $sql2 = "DELETE FROM users WHERE id = '$id'";
    $hapus_user = mysqli_query($koneksi, $sql2);

    if ($hapus_siswa && $hapus_user) {
        echo "<script>
                alert('Siswa berhasil dihapus');
                window.location.href='daftar_user.php';
              </script>";
    } else {
        echo "<script>
                alert('Siswa tidak berhasil dihapus');
                window.location.href='daftar_user.php';
              </script>";
    }

} elseif ($role == 'guru') {

    // Hapus data guru terlebih dahulu
    $sql1 = "DELETE FROM guru WHERE user_id = '$id'";
    $hapus_guru = mysqli_query($koneksi, $sql1);

    // Hapus data user
    $sql2 = "DELETE FROM users WHERE id = '$id'";
    $hapus_user = mysqli_query($koneksi, $sql2);

    if ($hapus_guru && $hapus_user) {
        echo "<script>
                alert('Guru berhasil dihapus');
                window.location.href='daftar_user.php';
              </script>";
    } else {
        echo "<script>
                alert('Guru tidak berhasil dihapus');
                window.location.href='daftar_user.php';
              </script>";
    }

} elseif ($role == 'admin') {

    $sql = "DELETE FROM users WHERE id = '$id'";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>
                alert('Admin berhasil dihapus');
                window.location.href='daftar_user.php';
              </script>";
    } else {
        echo "<script>
                alert('Admin tidak berhasil dihapus');
                window.location.href='daftar_user.php';
              </script>";
    }
}

exit;
?>