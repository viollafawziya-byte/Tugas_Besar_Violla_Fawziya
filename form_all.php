<?php
require_once 'navbar.php';

// Mengambil nilai role dari query string URL (GET)
$role = isset($_GET['role']) ? $_GET['role'] : '';

// Menentukan judul form sesuai role yang dipilih
$title = "Form Tambah User";

if ($role === 'Siswa') {
    $title = "Form Tambah User (Siswa)";
} elseif ($role === 'Guru') {
    $title = "Form Tambah User (Guru)";
} elseif ($role === 'Admin') {
    $title = "Form Tambah User (Admin)";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #fff7fa !important;
        }

        .form-pink {
            border: 1px solid #f3c5d8;
            border-radius: 12px;
            overflow: hidden;
        }

        .header-pink {
            background-color: #fce4ec;
            color: #8e4564;
            border-bottom: 1px solid #f3c5d8;
        }

        .form-control,
        .form-select {
            border-color: #edb9ce;
            border-radius: 8px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #d982a5;
            box-shadow: 0 0 0 0.2rem rgba(217, 130, 165, 0.2);
        }

        .form-check-input:checked {
            background-color: #d982a5;
            border-color: #d982a5;
        }

        .form-check-input:focus {
            border-color: #d982a5;
            box-shadow: 0 0 0 0.2rem rgba(217, 130, 165, 0.2);
        }

        .btn-simpan-pink {
            background-color: #d982a5;
            border-color: #d982a5;
            color: white;
        }

        .btn-simpan-pink:hover {
            background-color: #c75b83;
            border-color: #c75b83;
            color: white;
        }

        .btn-kembali-pink {
            background-color: #c75b83;
            border-color: #c75b83;
            color: white;
        }

        .btn-kembali-pink:hover {
            background-color: #a94068;
            border-color: #a94068;
            color: white;
        }

        hr {
            border-color: #edb9ce;
        }
    </style>
</head>

<body class="p-3 p-md-5">

    <div class="container" style="max-width: 600px;">
        <div class="card shadow-sm form-pink">

            <div class="card-header header-pink fw-bold fs-5">
                <?= htmlspecialchars($title); ?>
            </div>

            <div class="card-body">

                <form action="aksi_tambah_user.php" method="POST">

                    <!-- Role mengikuti pilihan sebelumnya -->
                    <input type="hidden" name="role"
                           value="<?= htmlspecialchars($role); ?>">

                    <?php if ($role === 'Siswa'): ?>

                        <h5 class="fw-bold mb-3">Data Profil User 2</h5>

                        <div class="mb-3">
                            <label class="form-label">NIS:</label>
                            <input type="text" name="nis"
                                   class="form-control"
                                   placeholder="Nomor Induk Siswa | Contoh: 1234567890"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap:</label>
                            <input type="text" name="nama_lengkap"
                                   class="form-control"
                                   placeholder="Nama Lengkap Siswa | Contoh: Ujang Asep"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kelas:</label>
                            <input type="text" name="kelas"
                                   class="form-control"
                                   placeholder="Kelas Siswa | Contoh: XI-RPL-1"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label d-block">Jenis Kelamin:</label>

                            <div class="form-check">
                                <input class="form-check-input"
                                       type="radio"
                                       name="jenis_kelamin"
                                       id="laki-laki-siswa"
                                       value="L"
                                       required>
                                <label class="form-check-label"
                                       for="laki-laki-siswa">
                                    Laki-laki
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input"
                                       type="radio"
                                       name="jenis_kelamin"
                                       id="perempuan-siswa"
                                       value="P"
                                       required>
                                <label class="form-check-label"
                                       for="perempuan-siswa">
                                    Perempuan
                                </label>
                            </div>
                        </div>

                        <hr>

                    <?php elseif ($role === 'Guru'): ?>

                        <h5 class="fw-bold mb-3">Data Profil Guru</h5>

                        <div class="mb-3">
                            <label class="form-label">NIP:</label>
                            <input type="text" name="nip"
                                   class="form-control"
                                   placeholder="Nomor Induk Pegawai | Contoh: 198501012010011001"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap Guru:</label>
                            <input type="text" name="nama_guru"
                                   class="form-control"
                                   placeholder="Nama Lengkap Guru | Contoh: Budi Santoso, S.Kom"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label d-block">Jenis Kelamin:</label>

                            <div class="form-check">
                                <input class="form-check-input"
                                       type="radio"
                                       name="jenis_kelamin"
                                       id="laki-laki-guru"
                                       value="L"
                                       required>
                                <label class="form-check-label"
                                       for="laki-laki-guru">
                                    Laki-laki
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input"
                                       type="radio"
                                       name="jenis_kelamin"
                                       id="perempuan-guru"
                                       value="P"
                                       required>
                                <label class="form-check-label"
                                       for="perempuan-guru">
                                    Perempuan
                                </label>
                            </div>
                        </div>

                        <hr>

                    <?php endif; ?>

                    <h5 class="fw-bold mb-3">Data Kredensial Akun (Tabel Users)</h5>

                    <div class="mb-3">
                        <label class="form-label">Username Akun:</label>
                        <input type="text" name="username"
                               class="form-control"
                               placeholder="Username Akun | Contoh: ujang123"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password Akun:</label>
                        <input type="password" name="password"
                               class="form-control"
                               placeholder="Password Akun | Contoh: password123"
                               required>
                    </div>

                    <!-- Pilihan role tetap seperti kode sebelumnya -->
                    <div class="mb-3">
                        <label class="form-label">Pilih Role</label>

                        <select name="role" class="form-select"
                                onchange="this.form.action='form_all.php'; this.form.method='GET'; this.form.submit();"
                                required>

                            <option value="" disabled
                                <?= empty($role) ? 'selected' : ''; ?>>
                                Pilih Role
                            </option>

                            <option value="Siswa"
                                <?= ($role === 'Siswa') ? 'selected' : ''; ?>>
                                Siswa
                            </option>

                            <option value="Guru"
                                <?= ($role === 'Guru') ? 'selected' : ''; ?>>
                                Guru
                            </option>

                            <option value="Admin"
                                <?= ($role === 'Admin') ? 'selected' : ''; ?>>
                                Admin
                            </option>

                        </select>

                        <small class="text-muted d-block mt-1">
                            Pilih role Siswa atau Guru untuk menampilkan form data profil.
                        </small>
                    </div>

                    <div class="mt-4">
                        <button type="submit" name="tambah"
                                class="btn btn-simpan-pink px-4 me-2">
                            Simpan Data
                        </button>

                        <a href="daftar_siswa.php"
                           class="btn btn-kembali-pink px-4">
                            Kembali
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php require_once 'footer.php'; ?>

</body>
</html>
