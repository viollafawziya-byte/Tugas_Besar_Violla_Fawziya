<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$username = $_SESSION['username'] ?? 'User';
$nama = $_SESSION['nama'] ?? 'Admin';
$role = $_SESSION['role'] ?? '';

?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIPN</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>
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

        .nav-link.active {
            color: #c75b83 !important;
        }

        .menu-akun {
            background-color: #fff7fa;
            border: 1px solid #f3c5d8;
        }

        /* SEARCH NAVBAR */
        .navbar form[role="search"] {
            margin-bottom: 0 !important;
            width: auto;
        }

        .navbar form[role="search"] input {
            width: 180px;
        }

        /* Tampilan HP dan tablet */
        @media (max-width: 991.98px) {

            .navbar form[role="search"] {
                width: 100%;
                margin: 12px 0 !important;
            }

            .navbar form[role="search"] input {
                flex: 1;
                width: 1%;
            }

            .navbar form[role="search"] button {
                flex-shrink: 0;
            }

            .navbar .menu-akun {
                margin-bottom: 10px;
            }
        }
    </style>

</head>

<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">

    <div class="container-fluid">

        <a class="navbar-brand" href="index.php">
            SIPN
        </a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
            id="navbarSupportedContent">

            <!-- MENU SESUAI ROLE -->

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <?php if ($role === 'admin') { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#"
                            data-bs-toggle="dropdown">User</a>

                        <ul class="dropdown-menu">

                            <li>
                                <a class="dropdown-item" href="daftar_user.php">
                                    Daftar User
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="daftar_user2.php">
                                    Daftar User 2
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item" href="form.php">
                                    Tambah User 1
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="form2.php">
                                    Tambah User 2
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="form_all.php">
                                    Tambah User 3
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#"
                            data-bs-toggle="dropdown">Siswa</a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="daftar_siswa.php">
                                    Daftar Siswa
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="form_all.php?role=Siswa">
                                    Tambah Siswa
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#"
                            data-bs-toggle="dropdown">Guru</a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="daftar_guru.php">
                                    Daftar Guru
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="form_all.php?role=Guru">
                                    Tambah Guru
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#"
                            data-bs-toggle="dropdown">Mapel</a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="daftar_mapel.php">
                                    Daftar Mapel
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="tambah_mapel.php">
                                    Tambah Mapel
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#"
                            data-bs-toggle="dropdown">Mengajar</a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="daftar_mengajar.php">
                                    Daftar Mengajar
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="tambah_mengajar.php">
                                    Tambah Mengajar
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php } elseif ($role === 'guru') { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="daftar_nilai.php">
                            Kelola Nilai Siswa
                        </a>
                    </li>

                <?php } elseif ($role === 'siswa') { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="nilai_siswa.php">
                            Nilai Saya
                        </a>
                    </li>

                <?php } ?>

            </ul>

            <!-- KOLOM SEARCH -->

            <form class="d-flex my-2 my-lg-0" role="search"
                action="index.php" method="GET">

                <input class="form-control me-2"
                    type="search"
                    name="cari"
                    placeholder="Search..."
                    aria-label="Search">

                <button class="btn btn-outline-success"
                    type="submit">
                    Search
                </button>

            </form>

            <!-- DROPDOWN AKUN DI SEBELAH KANAN -->

            <?php if ($role === 'admin' || $role === 'guru' || $role === 'siswa') { ?>

                <ul class="navbar-nav ms-lg-3">

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#"
                            data-bs-toggle="dropdown">

                            <?= htmlspecialchars($nama) ?>
                            (<?= htmlspecialchars($role) ?>)

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end menu-akun">

                            <li>
                                <a class="dropdown-item" href="lihat_profile.php">
                                    Profile
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="pengaturan.php">
                                    Pengaturan
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item text-danger"
                                    href="logout.php">
                                    Logout
                                </a>
                            </li>

                        </ul>

                    </li>

                </ul>

            <?php } ?>

        </div>
    </div>

</nav>

</body>
</html>