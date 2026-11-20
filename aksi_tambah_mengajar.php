<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $mapel_id = (int) $_POST['mapel_id'];

    // Mengambil semua siswa berdasarkan kelas
    $sql_siswa = "SELECT id FROM siswa WHERE kelas = '$kelas'";
    $hasil_siswa = mysqli_query($koneksi, $sql_siswa);

    if (!$hasil_siswa) {
        die("Gagal mengambil data siswa: " . mysqli_error($koneksi));
    }

    if (mysqli_num_rows($hasil_siswa) == 0) {
        die("Data siswa untuk kelas tersebut tidak ditemukan.");
    }

    $jumlah = 0;

    while ($siswa = mysqli_fetch_assoc($hasil_siswa)) {

        $siswa_id = (int) $siswa['id'];

        // Memeriksa apakah data sudah ada
        $cek = mysqli_query($koneksi, "
            SELECT id FROM mengajar
            WHERE mapel_id = $mapel_id
            AND siswa_id = $siswa_id
        ");

        if (mysqli_num_rows($cek) == 0) {

            $sql = "INSERT INTO mengajar (mapel_id, siswa_id)
                    VALUES ($mapel_id, $siswa_id)";

            if (mysqli_query($koneksi, $sql)) {
                $jumlah++;
            } else {
                die("Gagal menyimpan data: " . mysqli_error($koneksi));
            }
        }
    }

    if ($jumlah > 0) {

        echo "<script>
                alert('Data berhasil ditambahkan!!!');
                window.location.href='daftar_mengajar.php';
              </script>";

    } else {

        echo "<script>
                alert('Data mengajar sudah ada!!!');
                window.location.href='daftar_mengajar.php';
              </script>";

    }

} else {

    echo "<script>
            alert('Tidak boleh langsung mengakses halaman ini!!!');
            window.location.href='tambah_mengajar.php';
          </script>";

}
?>