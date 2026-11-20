<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $kode_mapel = mysqli_real_escape_string(
        $koneksi,
        $_POST['kode_mapel']
    );

    $nama_mapel = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama_mapel']
    );

    $guru_id = (int) $_POST['guru_id'];

    $sql = "INSERT INTO mapel (kode_mapel, nama_mapel, guru_id)
            VALUES ('$kode_mapel', '$nama_mapel', $guru_id)";

    if (mysqli_query($koneksi, $sql)) {

        echo "<script>
                alert('Data berhasil ditambahkan!!!');
                window.location.href='daftar_mapel.php';
              </script>";

    } else {

        echo "<script>
                alert('Data mata pelajaran gagal ditambahkan!!!');
                window.location.href='tambah_mapel.php';
              </script>";

    }

} else {

    echo "<script>
            alert('Tidak boleh langsung mengakses halaman ini!!!');
            window.location.href='tambah_mapel.php';
          </script>";

}
?>```