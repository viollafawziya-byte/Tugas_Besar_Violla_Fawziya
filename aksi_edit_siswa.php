
<?php

require_once 'koneksi.php';

$id = $_POST['id'];
$user_id = $_POST['user_id'];
$nis = $_POST['nis'];
$nama = $_POST['nama_lengkap'];
$kelas = $_POST['kelas'];
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

$sql = "UPDATE siswa SET nis='$nis',
nama='$nama', kelas='$kelas',
jenis_kelamin='$jk'
WHERE id='$id'";

$hasil = mysqli_query($koneksi, $sql);

if ($result && $hasil) {
    echo "<script>alert('Data Siswa Berhasil Diubah');
    window.location.href='daftar_siswa.php';</script>";
} else {
    echo "<script>alert('Data Siswa Tidak Berhasil Diubah');
    window.location.href='daftar_siswa.php';</script>";
}

?>
