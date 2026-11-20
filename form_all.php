<?php
// Mengambil nilai role dari URL
$role = isset($_GET['role']) ? $_GET['role'] : '';

// Menentukan judul form
$title = "Form Tambah User";

if ($role === 'Siswa') {
    $title = "Form Tambah User (Siswa)";
} elseif ($role === 'Guru') {
    $title = "Form Tambah User (Guru)";
} elseif ($role === 'Admin') {
    $title = "Form Tambah User (Admin)";
}

// Menampilkan navbar
require_once 'navbar.php';

// Mengembalikan role sesuai URL form
$role = isset($_GET['role']) ? $_GET['role'] : '';
?>


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

<div class="container py-4" style="max-width: 550px;">
    <div class="card shadow-sm form-pink">

        <div class="card-header header-pink fw-bold fs-5">
            <?= htmlspecialchars($title); ?>
        </div>

        <div class="card-body">

            <form action="aksi_tambah_user.php" method="POST">

                <input type="hidden" name="role"
                       value="<?= htmlspecialchars($role); ?>">

                <?php if ($role === 'Siswa'): ?>

                    <h5 class="fw-bold mb-3">Data Profil Siswa</h5>

                    <div class="mb-3">
                        <label class="form-label">NIS:</label>
                        <input type="text" name="nis"
                               class="form-control"
                               placeholder="Contoh: 1234567890"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap:</label>
                        <input type="text" name="nama_lengkap"
                               class="form-control"
                               placeholder="Nama Lengkap Siswa"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kelas:</label>
                        <input type="text" name="kelas"
                               class="form-control"
                               placeholder="Contoh: XI-RPL-1"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">Jenis Kelamin:</label>

                        <div class="form-check">
                            <input class="form-check-input"
                                   type="radio"
                                   name="jenis_kelamin"
                                   id="laki-laki-siswa"
                                   value="L" required>
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
                                   value="P" required>
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
                               placeholder="Nomor Induk Pegawai"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap Guru:</label>
                        <input type="text" name="nama_guru"
                               class="form-control"
                               placeholder="Nama Lengkap Guru"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">Jenis Kelamin:</label>

                        <div class="form-check">
                            <input class="form-check-input"
                                   type="radio"
                                   name="jenis_kelamin"
                                   id="laki-laki-guru"
                                   value="L" required>
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
                                   value="P" required>
                            <label class="form-check-label"
                                   for="perempuan-guru">
                                Perempuan
                            </label>
                        </div>
                    </div>

                    <hr>

                <?php endif; ?>

                <h5 class="fw-bold mb-3">Data Akun User</h5>

                <div class="mb-3">
                    <label class="form-label">Username Akun:</label>
                    <input type="text" name="username"
                           class="form-control"
                           placeholder="Contoh: ujang123"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password Akun:</label>
                    <input type="password" name="password"
                           class="form-control"
                           placeholder="Masukkan password"
                           required>
                </div>

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
                        Pilih Siswa atau Guru untuk menampilkan data profil.
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

<?php require_once 'footer.php'; ?>