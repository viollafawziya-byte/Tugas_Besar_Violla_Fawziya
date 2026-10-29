<?php

  $host="127.0.0.1"; //nama server yg kita gunakan
  $username="root"; //usernake atau akun pengguna
  $pass="root"; //password pengguna
//untuk database disesuaikan dengan nama database yg kalian akan gunakan
  $database="violla_sipn";

//perintah untuk menghubungkan database yg kita gunakan dengan project PHP kita
$koneksi = mysqli_connect($host, $username, $pass, $database, 3306);

//untuk mengecek apakah koneksi kedatabasenya berhasil atau gagal
if (!$koneksi) {
  die("koneksi ke database gagal". mysqli_connect_error());
} else {
  
}