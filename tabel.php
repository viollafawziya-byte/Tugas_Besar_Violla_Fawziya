<?php
require_once 'navbar.php';
?>

<!-- awal content -->
<div class="container-fluid">

  <!-- awal card -->
  <div class="card mt-4">
    <div class="card-header">
      <h3>Tabel</h3>
    </div>

    <div class="card-body">

      <!-- awal tabel -->
      <table class="table table-bordered w-100">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Depan</th>
            <th scope="col">Nama Belakang</th>
            <th scope="col">Kelas</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Akmal</td>
            <td>Putra</td>
            <td>11 RPL 4</td>
          </tr>

          <tr>
            <th scope="row">2</th>
            <td>Annisa</td>
            <td>Sally</td>
            <td>11 RPL 4</td>
          </tr>

          <tr>
            <th scope="row">3</th>
            <td>Ashar</td>
            <td>Andika</td>
            <td>11 RPL 4</td>
          </tr>
        </tbody>
      </table>
      <!-- akhir tabel -->

    </div>
  </div>
  <!-- akhir card -->

</div>
<!-- akhir content -->

<?php
require_once 'footer.php';
?>