<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $kelas_lama = mysqli_real_escape_string($koneksi, $_POST['kelas_lama']);
    $kelas_baru = mysqli_real_escape_string($koneksi, $_POST['kelas_baru']);

    $mapel_id_lama = (int) $_POST['mapel_id_lama'];
    $mapel_id_baru = (int) $_POST['mapel_id_baru'];

    // Mengambil semua siswa di kelas baru
    $sql_siswa = "SELECT id FROM siswa WHERE kelas = '$kelas_baru'";
    $hasil_siswa = mysqli_query($koneksi, $sql_siswa);

    if (!$hasil_siswa || mysqli_num_rows($hasil_siswa) == 0) {
        echo "<script>
            alert('Data siswa di kelas baru tidak ditemukan');
            window.location.href='daftar_mengajar.php';
        </script>";
        exit;
    }

    // Memulai transaksi
    mysqli_begin_transaction($koneksi);

    // Menghapus data mengajar yang lama
    $sql_hapus = "DELETE FROM mengajar
                  WHERE mapel_id = $mapel_id_lama
                  AND siswa_id IN (
                      SELECT id FROM siswa
                      WHERE kelas = '$kelas_lama'
                  )";

    $hasil_hapus = mysqli_query($koneksi, $sql_hapus);

    if (!$hasil_hapus) {
        mysqli_rollback($koneksi);

        echo "<script>
            alert('Data Mengajar Tidak Berhasil Diubah');
            window.location.href='daftar_mengajar.php';
        </script>";
        exit;
    }

    // Menambahkan data mengajar untuk kelas baru
    $berhasil = true;

    while ($siswa = mysqli_fetch_assoc($hasil_siswa)) {

        $siswa_id = (int) $siswa['id'];

        // Memeriksa data agar tidak duplikat
        $cek = mysqli_query($koneksi, "
            SELECT id FROM mengajar
            WHERE mapel_id = $mapel_id_baru
            AND siswa_id = $siswa_id
        ");

        if (!$cek) {
            $berhasil = false;
            break;
        }

        if (mysqli_num_rows($cek) == 0) {

            $sql_tambah = "INSERT INTO mengajar (mapel_id, siswa_id)
                           VALUES ($mapel_id_baru, $siswa_id)";

            if (!mysqli_query($koneksi, $sql_tambah)) {
                $berhasil = false;
                break;
            }
        }
    }

    if ($berhasil) {

        mysqli_commit($koneksi);

        echo "<script>
            alert('Data Mengajar Berhasil Diubah');
            window.location.href='daftar_mengajar.php';
        </script>";

    } else {

        mysqli_rollback($koneksi);

        echo "<script>
            alert('Data Mengajar Tidak Berhasil Diubah');
            window.location.href='daftar_mengajar.php';
        </script>";
    }
}
?>
