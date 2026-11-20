<?php
include 'koneksi.php';
include 'navbar.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT * FROM mapel WHERE id = $id";
$hasil = mysqli_query($koneksi, $sql);
$mapel = mysqli_fetch_assoc($hasil);

if (!$mapel) {
    echo "<div class='container mt-4'>
          <div class='alert alert-danger'>Data mata pelajaran tidak ditemukan.</div>
          </div>";
    require_once 'footer.php';
    exit;
}

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
    }

    .pink-card .card-header {
        background-color: #fce4ec;
        color: #8e4564;
        border-bottom: 1px solid #f3c5d8;
    }

    .pink-card .card-body {
        padding: 22px;
    }

    .pink-card .form-control,
    .pink-card .form-select {
        border-color: #edb9ce;
        border-radius: 8px;
    }

    .pink-card .form-control:focus,
    .pink-card .form-select:focus {
        border-color: #d982a5;
        box-shadow: 0 0 0 0.2rem rgba(217,130,165,0.2);
    }

    .btn-simpan-pink {
        background-color: #d982a5;
        border-color: #d982a5;
        color: white;
    }

    .btn-simpan-pink:hover {
        background-color: #c75b83;
        color: white;
    }

    .btn-kembali-pink {
        background-color: #e9a6c1;
        border-color: #e9a6c1;
        color: white;
    }
</style>

<div class="container mt-4 mb-4" style="max-width: 600px;">
    <div class="card pink-card">

        <div class="card-header">
            <h4 class="mb-0">Form Edit Mata Pelajaran</h4>
        </div>

        <div class="card-body">

            <h4>Mata Pelajaran</h4>

            <form action="aksi_edit_mapel.php" method="POST">

                <input type="hidden" name="id"
                       value="<?= $mapel['id'] ?>">

                <div class="mb-3">
                    <label class="form-label">Kode Mata Pelajaran</label>

                    <input type="text" name="kode_mapel"
                           class="form-control"
                           value="<?= htmlspecialchars($mapel['kode_mapel']) ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Mata Pelajaran</label>

                    <input type="text" name="nama_mapel"
                           class="form-control"
                           value="<?= htmlspecialchars($mapel['nama_mapel']) ?>"
                           required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Pilih Guru</label>

                    <select name="guru_id" class="form-select" required>

                        <option value="">Pilih Guru...</option>

                        <?php while ($guru = mysqli_fetch_assoc($hasil_guru)) { ?>
                            <option value="<?= $guru['id'] ?>"
                                <?= $mapel['guru_id'] == $guru['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($guru['nama']) ?>
                            </option>
                        <?php } ?>

                    </select>
                </div>

                <button type="submit" class="btn btn-simpan-pink">
                  Edit
                </button>

                <a href="daftar_mapel.php"
                   class="btn btn-kembali-pink">
                    Kembali
                </a>

            </form>

        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>
