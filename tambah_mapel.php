<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';
include 'navbar.php';

$sql_guru = "SELECT id, nama FROM guru ORDER BY nama ASC";
$hasil_guru = mysqli_query($koneksi, $sql_guru);
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
    }

    .pink-card .form-control,
    .pink-card .form-select {
        border-color: #edb9ce;
        border-radius: 8px;
    }

    .pink-card .form-control:focus,
    .pink-card .form-select:focus {
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

<div class="container mt-4 mb-4" style="max-width: 550px;">
    <div class="card pink-card">

        <div class="card-header">
            <h5>Form Tambah Mata Pelajaran</h5>
        </div>

        <div class="card-body">

            <h5>Data Mata Pelajaran</h5>

            <form action="aksi_tambah_mapel.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Kode Mata Pelajaran</label>

                    <input
                        type="text"
                        name="kode_mapel"
                        class="form-control"
                        placeholder="Kode Mapel | Contoh: MP001"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Mata Pelajaran</label>

                    <input
                        type="text"
                        name="nama_mapel"
                        class="form-control"
                        placeholder="Nama Mata Pelajaran | Contoh: Pemrograman Web"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label class="form-label">Pilih Guru</label>

                    <select name="guru_id" class="form-select" required>
                        <option value="">Pilih Guru...</option>

                        <?php
                        if ($hasil_guru) {
                            while ($guru = mysqli_fetch_assoc($hasil_guru)) {
                        ?>
                            <option value="<?= $guru['id'] ?>">
                                <?= htmlspecialchars($guru['nama']) ?>
                            </option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-simpan-pink">
                    Simpan Data
                </button>

                <a href="daftar_mapel.php" class="btn btn-kembali-pink">
                    Kembali
                </a>

            </form>

        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>
