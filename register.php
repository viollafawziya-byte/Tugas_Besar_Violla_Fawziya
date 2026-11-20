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

<div class="container mt-4 mb-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card pink-card">

                <div class="card-header">
                    <h5>Register Siswa</h5>
                </div>

                <div class="card-body">

                    <h5>Data Profil Siswa</h5>

                    <form action="aksi_register.php" method="POST">

                        <div class="mb-3">
                            <label class="form-label">NIS:</label>
                            <input type="text"
                                   class="form-control"
                                   name="nis"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap:</label>
                            <input type="text"
                                   class="form-control"
                                   name="nama_lengkap"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kelas:</label>
                            <input type="text"
                                   class="form-control"
                                   name="kelas"
                                   placeholder="Contoh: XI RPL 4"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin:</label>

                            <div class="form-check">
                                <input class="form-check-input"
                                       type="radio"
                                       name="jenis_kelamin"
                                       value="L"
                                       required>
                                <label class="form-check-label">
                                    Laki-laki
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input"
                                       type="radio"
                                       name="jenis_kelamin"
                                       value="P">
                                <label class="form-check-label">
                                    Perempuan
                                </label>
                            </div>
                        </div>

                        <hr style="border-color: #f3c5d8;">

                        <h5>Data Akun Siswa</h5>

                        <div class="mb-3">
                            <label class="form-label">Username:</label>
                            <input type="text"
                                   class="form-control"
                                   name="username"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password:</label>
                            <input type="password"
                                   class="form-control"
                                   name="password"
                                   required>
                        </div>

                        <div class="text-end mt-4">

                            <a href="login.php"
                               class="btn btn-kembali-pink">
                                Kembali
                            </a>

                            <button type="submit"
                                    name="daftar"
                                    class="btn btn-simpan-pink">
                                Daftar
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>
