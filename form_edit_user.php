<?php

require_once 'koneksi.php';
require_once 'navbar.php';
if ($_GET['role'] == 'admin') {

  $id = $_GET['id'];

  $sql = "SELECT * FROM users WHERE id = $id";

  $admin = mysqli_fetch_assoc(mysqli_query($koneksi, $sql));
?>

<div class="container">
  <br>

  <div class="card">
    <div class="card-header">
      <h3>Form Edit User (Admin)</h3>
    </div>

    <div class="card-body">

      <form action="aksi_edit_user.php?aksi=editadmin" method="POST">

        <h3>Data Kredensial Akun</h3>

        <div class="mb-3">
          <label class="form-label">Username:</label>

          <input type="text"
                 class="form-control"
                 name="username"
                 value="<?= $admin['username'] ?>"
                 required>
        </div>

        <div class="mb-3">
          <label class="form-label">Password Baru:</label>

          <input type="password"
                 class="form-control"
                 name="password"
                 placeholder="Password Baru | jika tidak diubah, kosongkan saja">
        </div>

        <input type="hidden"
               name="role"
               value="admin">

        <input type="hidden"
               name="id"
               value="<?= $admin['id'] ?>">

        <button type="submit"
                name="edit"
                class="btn btn-primary me-2">
          Ubah Data
        </button>

        <a href="tabel.php"
           class="btn btn-secondary">
          Kembali
        </a>

      </form>

    </div>
  </div>
</div>

<?php
 // echo 'halaman edit admin';

  }elseif ($_GET['role'] == 'guru') {

  $id = $_GET['id'];

  $sql = "SELECT * FROM users 
          JOIN guru ON users.id = guru.user_id 
          WHERE users.id = $id";

  $guru = mysqli_fetch_assoc(mysqli_query($koneksi, $sql));
?>

<div class="container">
  <br>
  <div class="card">
    <div class="card-header">
      <h3>Form Edit User (Guru)</h3>
    </div>

    <div class="card-body">

      <form action="aksi_edit_user.php?aksi=editguru" method="POST">

        <h3>Data Profil Guru</h3>

        <div class="mb-3">
          <label class="form-label">NIP:</label>
          <input type="text" class="form-control" name="nip"
                 value="<?= $guru['nip'] ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Nama Lengkap:</label>
          <input type="text" class="form-control" name="nama"
                 value="<?= $guru['nama'] ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Jenis Kelamin:</label>

          <div class="form-check">
            <input class="form-check-input" type="radio"
                   name="jenis_kelamin" value="L"
                   <?= ($guru['jenis_kelamin'] == 'L') ? 'checked' : '' ?>>
            <label class="form-check-label">Laki-laki</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio"
                   name="jenis_kelamin" value="P"
                   <?= ($guru['jenis_kelamin'] == 'P') ? 'checked' : '' ?>>
            <label class="form-check-label">Perempuan</label>
          </div>
        </div>

        <hr>

        <h3>Data Akun</h3>

        <div class="mb-3">
          <label class="form-label">Username:</label>
          <input type="text" class="form-control" name="username"
                 value="<?= $guru['username'] ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Password Baru:</label>
          <input type="password" class="form-control" name="password"
                 placeholder="Kosongkan jika tidak diubah">
        </div>

        <input type="hidden" name="role" value="guru">
        <input type="hidden" name="id" value="<?= $guru['id'] ?>">
        <input type="hidden" name="user_id" value="<?= $guru['user_id'] ?>">

        <button type="submit" name="edit" class="btn btn-primary">
          Ubah Data
        </button>

        <a href="tabel.php" class="btn btn-secondary">Kembali</a>

      </form>

    </div>
  </div>
</div>

<?php
  //echo 'halaman edit guru';
}elseif ($_GET['role'] == 'siswa') {

  echo 'halaman edit siswa';
  //mengambil id siswa ketika tombil edit di tekan
  $id = $_GET['id'];

  //query untuk mengambil semua data dari tabel user dan siswa berdasarkan id users
  $sql = "SELECT * FROM users join siswa on users.id = siswa.user_id WHERE users.id = $id";

  $siswa = mysqli_fetch_assoc(mysqli_query($koneksi, $sql));
  ?>
<!-- form edit siswa -->
<div class="container">
<!-- awal kolom -->
<div class="container">
  <div class="row align-items-start">
    <div class="col-2">
      <!--One of three columns  1 -->
    </div>
    <div class="col-12">
       <br>
      <!-- awal card -->
       <div class="card">
         <div class="card-header">
          <h3>Form Edit User (siswa)</h3>
          </div>
        <div class="card-body">
            <!-- awal form -->
             <form action="aksi_edit_user.php?aksi=editsiswa" method="POST">
               <h3>data profil user 2</h3>
           <div class="mb-3">
                <label for="nis" class="form-label font-weight-bold">NIS:</label>
                <input type="text" class="form-control" id="nis" name="nis" value="<?= $siswa['nis'] ?>" placeholder="Nomor Induk Siswa | Contoh: 1234567890" required>
            </div>
            
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap:</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $siswa['nama'] ?>" placeholder="Nama Lengkap Siswa | Contoh: Ujang Asep" required>
            </div>
            
            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas:</label>
                <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $siswa['kelas'] ?>" placeholder="Kelas Siswa | Contoh: XI-RPL-1" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label d-block">Jenis Kelamin:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="L" <?= ($siswa['jenis_kelamin'] == 'L') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="laki">Laki-laki</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P" <?= ($siswa['jenis_kelamin'] == 'P') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
            </div>
               <hr>
               <h3>Data Kredensial Akun</h3>
               <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $siswa['username'] ?>"placeholder="Username Akun | Contoh: ujang123" required>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password Akun:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password Baru | jika tidak di ubah, maka kosongkan saja"
            </div>
            
            <div class="mb-4">
                <input type="text" class="form-control" name="role" value="siswa" hidden>
                <input type="text" class="form-control" name="id" value="<?= $siswa['id'] ?>" hidden>
                <input type="text" class="form-control" name="user_id" value="<?= $siswa['user_id'] ?>" hidden>
            </div>
            
            <!-- Tombol Aksi -->
            <button type="submit" name="edit" class="btn btn-primary me-2">Ubah Data</button>
            <a href="tabel.php" class="btn btn-secondary">Kembali</a>
            
             </form>
            <!-- akhir form -->
         </div>
       </div>
      <!-- akhir card -->
      
    </div>
    <div class="col-2">
      <!--One of three columns 3 -->
    </div>
  </div>
</div>
  <!-- akhir kolom -->
  
</div>
<!-- end form edit siswa -->
<?php
}

require_once 'footer.php';
?>