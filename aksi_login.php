<?php

require_once 'koneksi.php';

session_start();

// Mengambil username dan password dari form
$username = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';

// Mengambil data dari tabel users, siswa, dan guru
$sql = "SELECT users.*,
        COALESCE(siswa.nama, guru.nama) AS nama,
        siswa.kelas, siswa.user_id
        FROM users
        LEFT JOIN siswa ON users.id = siswa.user_id
        LEFT JOIN guru ON users.id = guru.user_id
        WHERE users.username = '$username'";

$query = mysqli_query($koneksi, $sql);

// Mengubah hasil query menjadi array
$user = mysqli_fetch_assoc($query);

// Memeriksa username dan password
if ($user && password_verify($pass, $user['password'])) {

    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['kelas'] = $user['kelas'];
    $_SESSION['login'] = true;

// Beralih ke halaman sesuai role
    if ($user['role'] == 'admin') {
        header("Location: daftar_user.php");
    } elseif ($user['role'] == 'guru') {
        header("Location: index.php");
    } elseif ($user['role'] == 'siswa') {
        header("Location: index.php");
    } else {
        header("Location: login.php");
    }
    exit;

} else {

    echo "<script>
        alert('Username atau password salah!');
        window.location.href = 'login.php';
    </script>";

}