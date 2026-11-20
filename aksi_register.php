<?php

require_once 'koneksi.php';

if (isset($_POST['daftar'])) {

    // Mengambil data dari form
    $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    // Memeriksa NIS
    $cek_nis = mysqli_query($koneksi, "
        SELECT id FROM siswa WHERE nis = '$nis'
    ");

    if (mysqli_num_rows($cek_nis) > 0) {
        die("NIS sudah terdaftar!");
    }

    // Memeriksa username
    $cek_username = mysqli_query($koneksi, "
        SELECT id FROM users WHERE username = '$username'
    ");

    if (mysqli_num_rows($cek_username) > 0) {
        die("Username sudah digunakan!");
    }

    // Mengamankan password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Role otomatis siswa
    $role = 'siswa';

    // Menyimpan akun ke tabel users
    $sql_user = "INSERT INTO users
                 (id, username, password, role, created_at)
                 VALUES
                 (null, '$username', '$password', '$role', NOW())";

    $hasil_user = mysqli_query($koneksi, $sql_user);

    if ($hasil_user) {

        // Mengambil ID user yang baru dibuat
        $user_id = mysqli_insert_id($koneksi);

        // Menyimpan profil ke tabel siswa
        $sql_siswa = "INSERT INTO siswa
                      (id, nis, nama, kelas, jenis_kelamin, user_id)
                      VALUES
                      (null, '$nis', '$nama', '$kelas',
                      '$jenis_kelamin', '$user_id')";

        $hasil_siswa = mysqli_query($koneksi, $sql_siswa);

        if ($hasil_siswa) {

            echo "<script>
                    alert('Register berhasil! Silakan login.');
                    window.location.href='login.php';
                  </script>";

        } else {

            // Menghapus akun jika profil siswa gagal disimpan
            mysqli_query($koneksi, "
                DELETE FROM users WHERE id = '$user_id'
            ");

            echo "Gagal menyimpan data siswa: " . mysqli_error($koneksi);
        }

    } else {

        echo "Gagal membuat akun: " . mysqli_error($koneksi);

    }

} else {

    echo "<script>
            alert('Tidak boleh langsung mengakses halaman ini!');
            window.location.href='register.php';
          </script>";

}

?>
