<?php

require_once 'koneksi.php';

if (isset($_POST['tambah'])) {

    // Data akun
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $role = $_POST['role'];

    // Simpan ke tabel users
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users 
            (id, username, password, role, created_at)
            VALUES 
            (null, '$username', '$pass', '$role', now())";

    $hasil_user = mysqli_query($koneksi, $sql);

    if ($hasil_user) {

        // Mengambil ID user yang baru dibuat
        $user_id = mysqli_insert_id($koneksi);

        $hasil = false;

        // =========================
        // JIKA ROLE SISWA
        // =========================
        if (strtolower($role) == 'siswa') {

            $nis = $_POST['nis'];
            $nama = $_POST['nama_lengkap'];
            $kelas = $_POST['kelas'];
            $jenis_kelamin = $_POST['jenis_kelamin'];

            $sql = "INSERT INTO siswa
                    (id, nis, nama, kelas, jenis_kelamin, user_id)
                    VALUES
                    (null, '$nis', '$nama', '$kelas',
                    '$jenis_kelamin', '$user_id')";

            $hasil = mysqli_query($koneksi, $sql);

            if (!$hasil) {
                die("Gagal menyimpan profil siswa: " . mysqli_error($koneksi));
            }

        // =========================
        // JIKA ROLE GURU
        // =========================
        } elseif (strtolower($role) == 'guru') {

            $nip = $_POST['nip'];
            $nama = $_POST['nama_guru'];
            $jenis_kelamin = $_POST['jenis_kelamin'];

            $sql = "INSERT INTO guru
                    (id, nip, nama, jenis_kelamin, user_id)
                    VALUES
                    (null, '$nip', '$nama',
                    '$jenis_kelamin', '$user_id')";

            $hasil = mysqli_query($koneksi, $sql);

            if (!$hasil) {
                die("Gagal menyimpan profil guru: " . mysqli_error($koneksi));
            }

        // =========================
        // JIKA ROLE ADMIN
        // =========================
        } elseif (strtolower($role) == 'admin') {

            // Admin hanya disimpan di tabel users
            $hasil = true;
        }

        // Cek hasil penyimpanan
        if ($hasil) {

            if (strtolower($role) == 'siswa') {
                $tujuan = 'daftar_siswa.php';
            } elseif (strtolower($role) == 'guru') {
                $tujuan = 'daftar_guru.php';
            } else {
                $tujuan = 'daftar_user.php';
            }

            echo "<script>
                    alert('Data berhasil ditambahkan!!!');
                    window.location.href='$tujuan';
                  </script>";

        } else {

            echo "Data profil gagal ditambahkan. Role: " . $role;
            echo "<br><a href='form_all.php?role=$role'>Kembali ke Form</a>";
        }

    } else {

        echo "<script>
                alert('Data user gagal ditambahkan!!!');
                window.location.href='form_all.php';
              </script>";
    }

} else {

    echo "<script>
            alert('Tidak boleh langsung mengakses halaman ini!!!');
            window.location.href='form_all.php';
          </script>";
}
