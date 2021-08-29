<?php

if (isset($_POST['btn-kategori'])) {
  $kategori = $_POST['name_kategori'];

  $sql = " INSERT INTO `tblkategori` VALUES (NULL, '$kategori');";

  $db->runSql($sql);

  Flasher::setFlash('berhasil', 'ditambahkan', 'Kategori', 'success');

  echo "
        <script>
           document.location.href = '?f=kategori&m=select';
        </script>
      ";
}

?>

<div class="container-fluid">
  <div class="card shadow my-3 w-auto">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Tambah Data kategori</h6>
    </div>
    <div class="card-body">
      <form action="" method="POST">
        <div class="form-group">
          <label for="name_kategori">Nama Kategori</label>
          <input type="text" name="name_kategori" class="form-control" required id="name_kategori">
        </div>
        <button class="btn btn-primary" type="submit" name="btn-kategori">Tambah Data</button>
      </form>
    </div>
  </div>
</div>