<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'koneksi.php';

// Memastikan hanya Siswa yang bisa membuka halaman ini
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true ||
    $_SESSION['role'] != 'siswa') {
    header("Location: login.php");
    exit;
}

$id_user = (int)$_SESSION['id'];

// Mengambil identitas siswa
$sql_siswa = "SELECT id, nama, nis, kelas
              FROM siswa
              WHERE user_id = ?
              LIMIT 1";

$stmt_siswa = mysqli_prepare($koneksi, $sql_siswa);
mysqli_stmt_bind_param($stmt_siswa, "i", $id_user);
mysqli_stmt_execute($stmt_siswa);

$result_siswa = mysqli_stmt_get_result($stmt_siswa);
$siswa = mysqli_fetch_assoc($result_siswa);

// Menyiapkan daftar nilai
$daftar_nilai = [];
$rata_rata = 0;

if ($siswa) {

    // Mengambil nilai milik siswa yang sedang login
    $sql_nilai = "SELECT
                      nilai_rapor.*,
                      mapel.nama_mapel
                  FROM nilai_rapor
                  JOIN mapel ON nilai_rapor.mapel_id = mapel.id
                  WHERE nilai_rapor.siswa_id = ?
                  ORDER BY mapel.nama_mapel ASC";

    $stmt_nilai = mysqli_prepare($koneksi, $sql_nilai);
    mysqli_stmt_bind_param($stmt_nilai, "i", $siswa['id']);
    mysqli_stmt_execute($stmt_nilai);

    $result_nilai = mysqli_stmt_get_result($stmt_nilai);

    $total_nilai = 0;

    while ($data = mysqli_fetch_assoc($result_nilai)) {

        // Menghitung rata-rata pengetahuan dan keterampilan
        $data['nilai_akhir'] = (
            $data['nilai_pengetahuan'] +
            $data['nilai_keterampilan']
        ) / 2;

        $total_nilai += $data['nilai_akhir'];

        $daftar_nilai[] = $data;
    }

    // Menghitung rata-rata seluruh mata pelajaran
    if (count($daftar_nilai) > 0) {
        $rata_rata = $total_nilai / count($daftar_nilai);
    }
}

require_once 'navbar.php';
?>

<!-- DataTables CSS -->
<link rel="stylesheet"
href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css">


<style>
    body 
  
    .judul-nilai {
        text-align: center;
        margin-top: 25px;
        margin-bottom: 10px;
        color: #8e4564;
    }

    .identitas-siswa {
        text-align: center;
        margin-bottom: 25px;
        color: #8e4564;
    }

    .identitas-siswa h4 {
        margin-bottom: 8px;
    }

    .identitas-siswa p {
        margin-bottom: 5px;
    }

    .card-rata-rata {
        max-width: 390px;
        margin: 0 auto 22px;
        text-align: center;
        border: 1px solid #f3c5d8;
        border-radius: 12px;
        background-color: #fce4ec;
        color: #8e4564;
    }

    .angka-rata-rata {
        font-size: 52px;
        font-weight: 300;
        margin: 0;
        color: #d982a5;
    }

    .card-daftar {
        max-width: 1210px;
        margin: 0 auto 30px;
        border: 1px solid #f3c5d8;
        border-radius: 12px;
        background-color: white;
    }

    .card-daftar .card-body {
        padding: 15px;
    }

    .card-daftar h4 {
        color: #8e4564;
    }

    .table {
        border-color: #f3c5d8;
    }

    .table thead th {
        background-color: #fce4ec;
        color: #8e4564;
        white-space: nowrap;
        vertical-align: middle;
    }

    .table tbody td {
        vertical-align: middle;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #fff7fa;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #d982a5;
        box-shadow: 0 0 0 0.2rem rgba(217,130,165,0.2);
    }

    .page-link {
        color: #c75b83;
    }

    .page-link:focus {
        box-shadow: 0 0 0 0.2rem rgba(217,130,165,0.2);
    }

    .active > .page-link,
    .page-link.active {
        background-color: #d982a5;
        border-color: #d982a5;
        color: white;
    }

    .page-link:hover {
        color: #8e4564;
        background-color: #fce4ec;
        border-color: #f3c5d8;
    }

    @media (max-width: 576px) {
        .angka-rata-rata {
            font-size: 40px;
        }
    }
</style>

<div class="container-fluid">

    <?php if ($siswa) : ?>

        <!-- Judul dan Identitas Siswa -->
        <div class="judul-nilai">
            <h1>Nilai Siswa</h1>
        </div>

        <div class="identitas-siswa">

            <h4>
                <?= htmlspecialchars($siswa['nama']) ?>
            </h4>

            <p>
                NIS:
                <strong>
                    <?= htmlspecialchars($siswa['nis']) ?>
                </strong>
            </p>

            <p>
                Kelas:
                <strong>
                    <?= htmlspecialchars($siswa['kelas']) ?>
                </strong>
            </p>

        </div>

        <!-- Kotak Rata-rata Nilai -->
        <div class="card card-rata-rata shadow-sm">

            <div class="card-body">

                <h5>Rata-rata Nilai</h5>

                <p class="angka-rata-rata">
                    <?= number_format($rata_rata, 2) ?>
                </p>

            </div>

        </div>

        <!-- Daftar Nilai -->
        <div class="card card-daftar shadow-sm">

            <div class="card-body">

                <h4 class="mb-3">Daftar Nilai</h4>

                <div class="table-responsive">

                    <table id="tabelNilai"
                           class="table table-bordered table-striped"
                           style="width:100%">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mata Pelajaran</th>
                                <th>KKM</th>
                                <th>Pengetahuan</th>
                                <th>Keterampilan</th>
                                <th>Rata-rata</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php $no = 1; ?>

                            <?php foreach ($daftar_nilai as $data) : ?>

                                <tr>
                                    <td><?= $no++ ?></td>

                                    <td>
                                        <?= htmlspecialchars($data['nama_mapel']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($data['nilai_kkm']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($data['nilai_pengetahuan']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($data['nilai_keterampilan']) ?>
                                    </td>

                                    <td>
                                        <strong>
                                            <?= number_format($data['nilai_akhir'], 2) ?>
                                        </strong>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($data['keterangan'] ?? '') ?>
                                    </td>
                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    <?php else : ?>

        <div class="alert alert-warning mt-4">
            Data siswa tidak ditemukan.
        </div>

    <?php endif; ?>

</div>

<!-- jQuery dan DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {

    $('#tabelNilai').DataTable({

        pageLength: 10,

        lengthMenu: [10, 25, 50, 100],

        language: {
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            search: "Cari:",
            zeroRecords: "Data nilai tidak ditemukan",
            info: "Menampilkan halaman _PAGE_ dari _PAGES_",
            infoEmpty: "Belum ada data nilai",
            infoFiltered: "(difilter dari _MAX_ total data)",
            paginate: {
                previous: "Sebelumnya",
                next: "Selanjutnya"
            }
        }

    });

});
</script>

<?php require_once 'footer.php'; ?>
