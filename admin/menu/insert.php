<?php

if (isset($_POST['submit'])) {
  $id = $_POST['id_kategori'];
  $menu = $_POST['name_menu'];
  $harga = $_POST['harga'];
  $gambar = $_FILES['gambar']['name'];
  $temp = $_FILES['gambar']['tmp_name'];

  if (empty($gambar)) {
    echo "gambar kososng";
  } else {
    $sql = "INSERT INTO `tblmenu` VALUES ('', $id, '$menu', '$gambar', $harga);";
    move_uploaded_file($temp, '../frontend/images/data/' . $gambar);
    $db->runSql($sql);
    Flasher::setFlash('berhasil', 'ditambahkan', 'success');

    echo "
        <script>
           document.location.href = '?f=menu&m=select';
        </script>
      ";
  }
}

$sql = "SELECT * FROM tblkategori";
$row = $db->getAll($sql);

?>

<div class="container-fluid">
  <div class="card shadow my-3 w-auto">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Tambah Data Menu</h6>
    </div>
    <div class="card-body">
      <form role="form" action="" method="POST" enctype="multipart/form-data">
        <div class="card-body">

          <div class="form-group">
            <label for="kategroi">kategori</label><br>
            <select name="id_kategori" id="kategori" onchange="this.form.submit" class="custom-select" style="width: auto;">
              <?php foreach ($row as $r) : ?>
                <option value="<?= $r['idkategori'] ?>"><?= $r['kategori'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="name_menu">Nama menu</label>
            <input type="text" name="name_menu" class="form-control" required id="name_menu">
          </div>

          <div class="form-group">
            <label for="harga">Harga</label>
            <input type="text" name="harga" class="form-control" required id="harga">
          </div>

          <div class="form-group">
            <label for="gambar">Gambar</label>
            <input type="file" name="gambar" class="form-control" required id="gambar">
          </div>
        </div>

        <div class="card-footer">
          <button class="btn btn-primary" type="submit" name="submit">Tambah Data</button>
        </div>
      </form>
    </div>
  </div>
</div>