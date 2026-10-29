<?php 
session_start();

//jika belum login
if (!isset($_SESSION['id'])) {
  header("Location: Login.php");
  exit;
}

//ambil role user yang akan login
$role = $_SESSION['role'] ?? '';

//cek role kemudian arahkan ke halaman sesuai dengan role yang login 
switch ($role) {
  case 'admin':
     header("Location: daftar_user.php");
     exit;
  case 'guru':
     header("Location: daftar_guru.php");
     exit;
  case 'siswa':
     header("Location: daftar_siswa.php");
     exit;
  default:
      session_destroy();//hapus atau hancurkan session yang ada
      header('Location: login.php');
      exit;
}