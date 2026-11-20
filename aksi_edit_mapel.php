<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = (int) $_POST['id'];

    $kode_mapel = mysqli_real_escape_string(
        $koneksi,
        $_POST['kode_mapel']
    );

    $nama_mapel = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama_mapel']
    );

    $guru_id = (int) $_POST['guru_id'];

    $sql = "UPDATE mapel SET
            kode_mapel = '$kode_mapel',
            nama_mapel = '$nama_mapel',
            guru_id = $guru_id
            WHERE id = $id";

    if (mysqli_query($koneksi, $sql)) {

        echo "<script>
                alert('Data berhasil diubah!!!');
                window.location.href='daftar_mapel.php';
              </script>";

    } else {

        echo "<script>
                alert('Data mata pelajaran gagal diedit!!!');
                window.location.href='daftar_mapel.php';
              </script>";

    }

} else {

    echo "<script>
            alert('Tidak boleh langsung mengakses halaman ini!!!');
            window.location.href='daftar_mapel.php';
          </script>";

}
?>