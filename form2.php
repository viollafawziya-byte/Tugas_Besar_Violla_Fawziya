<?php
require_once 'navbar.php';
?>

<style>
    body {
        background-color: #fff7fa;
    }

    .pink-card {
        border: 1px solid #f3c5d8;
        border-radius: 12px;
        overflow: hidden;
        background-color: white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.08);
    }

    .pink-card .card-header {
        background-color: #fce4ec;
        color: #8e4564;
        border-bottom: 1px solid #f3c5d8;
        padding: 10px 15px;
    }

    .pink-card .card-header h5 {
        font-weight: bold;
        margin: 0;
    }

    .pink-card .card-body {
        padding: 15px;
    }

    .pink-card .card-body h5 {
        font-weight: bold;
        margin-bottom: 18px;
        color: #8e4564;
    }

    .pink-card .form-control {
        border-color: #edb9ce;
        border-radius: 8px;
    }

    .pink-card .form-control:focus {
        border-color: #d982a5;
        box-shadow: 0 0 0 0.2rem rgba(217, 130, 165, 0.2);
    }

    .pink-card .form-check-input:checked {
        background-color: #d982a5;
        border-color: #d982a5;
    }

    .pink-card .form-check-input:focus {
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
        background-color: #d982a5;
        border-color: #d982a5;
        color: white;
    }
</style>

<!-- awal content -->
<div class="container mt-4 mb-4">

    <!-- awal kolom -->
    <div class="row justify-content-center">

        <div class="col-md-8">

            <!-- awal card -->
            <div class="card pink-card">

                <div class="card-header">
                    <h5>Form Tambah User (Siswa)</h5>
                </div>

                <div class="card-body">

                    <h5>Data Profil User 2</h5>

                    <form action="aksi_tambah_user.php" method="POST">

                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS:</label>

                            <input type="text"
                                   class="form-control"
                                   id="nis"
                                   name="nis"
                                   placeholder="Nomor Induk Siswa | Contoh: 1234567890"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap:</label>

                            <input type="text"
                                   class="form-control"
                                   id="nama_lengkap"
                                   name="nama_lengkap"
                                   placeholder="Nama Lengkap Siswa | Contoh: Ujang Asep"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas:</label>

                            <input type="text"
                                   class="form-control"
                                   id="kelas"
                                   name="kelas"
                                   placeholder="Kelas Siswa | Contoh: XI-RPL-1"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin:</label>

                            <div class="form-check">
                                <input class="form-check-input"
                                       type="radio"
                                       name="jenis_kelamin"
                                       id="laki"
                                       value="L"
                                       required>

                                <label class="form-check-label" for="laki">
                                    Laki-laki
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input"
                                       type="radio"
                                       name="jenis_kelamin"
                                       id="perempuan"
                                       value="P">

                                <label class="form-check-label" for="perempuan">
                                    Perempuan
                                </label>
                            </div>
                        </div>

                        <hr style="border-color: #f3c5d8;">

                        <h5>Data Kredensial Akun</h5>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>

                            <input type="text"
                                   class="form-control"
                                   id="username"
                                   name="username"
                                   placeholder="Username Akun | Contoh: ujang123"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password Akun:</label>

                            <input type="password"
                                   class="form-control"
                                   id="password"
                                   name="password"
                                   placeholder="Password Akun | Contoh: password123"
                                   required>
                        </div>

                        <div class="mb-3">
                            <input type="text"
                                   class="form-control"
                                   name="role"
                                   value="siswa"
                                   readonly>
                        </div>

                        <button type="submit"
                                name="tambah"
                                class="btn btn-simpan-pink">
                            Simpan Data
                        </button>

                        <a href="daftar_siswa.php"
                           class="btn btn-kembali-pink">
                            Kembali
                        </a>

                    </form>

                </div>
            </div>
            <!-- akhir card -->

        </div>

    </div>
    <!-- akhir kolom -->

</div>
<!-- akhir content -->

<?php
require_once 'footer.php';
?>
