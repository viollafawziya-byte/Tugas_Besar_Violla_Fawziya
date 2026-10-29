<?php
require_once 'koneksi.php';

$id = $_POST['id'];
$user_id = $_POST['user_id'];
$nip = $_POST['nip'];
$nama = $_POST['nama_lengkap'];
$jk = $_POST['jenis_kelamin'];
$username = $_POST['username'];
$pass = $_POST['password'];

if ($pass !== "") {
    $password_hash = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET username='$username',
    password='$password_hash'
    WHERE id='$user_id'";
} else {
    $sql = "UPDATE users SET username='$username'
    WHERE id='$user_id'";
}

$result = mysqli_query($koneksi, $sql);

$sql = "UPDATE guru SET nip='$nip',
nama='$nama', jenis_kelamin='$jk'
WHERE id='$id'";

$hasil = mysqli_query($koneksi, $sql);

if ($result && $hasil) {
    echo "<script>
    alert('Data Guru Berhasil Diubah');
    window.location.href='daftar_guru.php';
    </script>";
} else {
    echo "<script>
    alert('Data Guru Tidak Berhasil Diubah');
    window.location.href='daftar_guru.php';
    </script>";
}
?>
