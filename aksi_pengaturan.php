<?php

session_start();
require_once 'koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['id'];

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username == '') {
    echo "<script>
        alert('Username tidak boleh kosong!');
        window.location.href = 'pengaturan.php';
    </script>";
    exit;
}

// Memeriksa apakah username sudah digunakan user lain
$cek = mysqli_prepare($koneksi, 
    "SELECT id FROM users WHERE username = ? AND id != ?"
);

mysqli_stmt_bind_param($cek, "si", $username, $id);
mysqli_stmt_execute($cek);

$hasil = mysqli_stmt_get_result($cek);

if (mysqli_num_rows($hasil) > 0) {
    echo "<script>
        alert('Username sudah digunakan!');
        window.location.href = 'pengaturan.php';
    </script>";
    exit;
}

// Jika password kosong, hanya username yang diubah
if ($password == '') {

    $sql = mysqli_prepare($koneksi,
        "UPDATE users SET username = ? WHERE id = ?"
    );

    mysqli_stmt_bind_param($sql, "si", $username, $id);

} else {

    // Jika password diisi, password akan diubah juga
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = mysqli_prepare($koneksi,
        "UPDATE users SET username = ?, password = ? WHERE id = ?"
    );

    mysqli_stmt_bind_param($sql, "ssi", $username, $password_hash, $id);
}

// Menjalankan update
if (mysqli_stmt_execute($sql)) {

    $_SESSION['username'] = $username;

    echo "<script>
        alert('Data akun berhasil diperbarui!');
        window.location.href = 'lihat_profile.php';
    </script>";

} else {

    echo "<script>
        alert('Gagal memperbarui data akun!');
        window.location.href = 'pengaturan.php';
    </script>";

}

?>
