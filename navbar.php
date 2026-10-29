<?php

// Mengecek apakah session sudah dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Mengambil data dari variabel session
$username = $_SESSION['username'] ?? 'User';
$nama = $_SESSION['nama'] ?? 'Admin';
$role = $_SESSION['role'] ?? '';

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
  
<style>
    /* Warna tombol seluruh halaman SIPN */
    .btn-primary,
    .btn-success,
    .btn-info,
    .btn-warning,
    .btn-secondary {
        background-color: #d982a5 !important;
        border-color: #d982a5 !important;
        color: white !important;
    }

    .btn-primary:hover,
    .btn-success:hover,
    .btn-info:hover,
    .btn-warning:hover,
    .btn-secondary:hover {
        background-color: #c75b83 !important;
        border-color: #c75b83 !important;
        color: white !important;
    }

    /* Tombol outline */
    .btn-outline-primary,
    .btn-outline-success,
    .btn-outline-info,
    .btn-outline-secondary {
        color: #c75b83 !important;
        border-color: #d982a5 !important;
    }

    .btn-outline-primary:hover,
    .btn-outline-success:hover,
    .btn-outline-info:hover,
    .btn-outline-secondary:hover {
        background-color: #fce4ec !important;
        color: #8e4564 !important;
    }

    /* Warna link menu aktif */
    .nav-link.active {
        color: #c75b83 !important;
    }
</style>

</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php
        if ($role === 'admin') {
            /// code untuk menu admin
        }
        elseif ($role === 'guru') {
            /// code untuk menu guru
        }
        elseif ($role === 'siswa') {
            /// code untuk menu siswa
        }
        ?>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="daftar_user.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">User</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item"
                                href="daftar_user.php">Daftar User</a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                                href="daftar_user2.php">Daftar User2</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="form.php">Tambahkan User 1</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="form2.php">Tambahkan User 2</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="form_all.php">Tambahkan User 3</a>
                        </li>
                    </ul>
                </li>
                 <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Siswa</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item"
                                href="daftar_siswa.php">Daftar Siswa</a>
                        </li>
                        <hr class="dropdown-divider">
                        <li>
                            <a class="dropdown-item"
   href="form_all.php?role=Siswa">Tambah Siswa</a>
                        </li>
                    </ul>
                 </li>
                 <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Guru</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item"
                                href="daftar_guru.php">Daftar Guru</a>
                        </li>
                        <hr class="dropdown-divider">
                        <li>
                            <a class="dropdown-item"
                                href="form_all.php?role=Guru">Tambah Guru</a>
                        </li>
                    </ul>
                 </li>
                 <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Mapel</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item"
                                href="daftar_mapel.php">Daftar Mapel</a>
                        </li>
                        <hr class="dropdown-divider">
                        <li>
                            <a class="dropdown-item"
                                href="tambah_mapel.php">Tambah Mapel</a>
                        </li>
                    </ul>
                 </li>
                 <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Mengajar</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item"
                                href="daftar_mengajar.php">Daftar Mengajar</a>
                        </li>
                        <hr class="dropdown-divider">
                        <li>
                            <a class="dropdown-item"
                                href="tambah_mengajar.php">Tambah Mengajar</a>
                        </li>
                    </ul>
                 </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true"></a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input
                    class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button
                    class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
</nav>
