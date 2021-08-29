<?php

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $rows = $db->getItem("SELECT * FROM tblmenu WHERE idmenu = $id");
  $id = $rows['idmenu'];
  $gambar = $rows['gambar'];
}


if (isset($_POST['submit'])) {
  $idkategori = $_POST['id_kategori'];
  $menu = $_POST['name_menu'];
  $harga = $_POST['harga'];
  $gambar = $rows['gambar'];
  $temp = $_FILES['gambar']['tmp_name'];

  if (!empty($temp)) {
    $gambar = $_FILES['gambar']['name'];
    move_uploaded_file($temp, '../frontend/images/data/' . $gambar);
  }


  $sql = "UPDATE `tblmenu` SET `idkategori` = '$idkategori', `menu` = '$menu', `gambar` = '$gambar', `harga` = '$harga' WHERE `tblmenu`.`idmenu` = $id;";
  $db->runSql($sql);

  Flasher::setFlash('berhasil', 'di update', 'Menu', 'success');

  echo "
        <script>
           document.location.href = '?f=menu&m=select';
        </script>
      ";
}

$sql = "SELECT * FROM tblkategori";
$row = $db->getAll($sql);

?>

<div class="container-fluid">

  <div class="card shadow my-3">
    <div class="card-header py-3 ">
      <h6 class="font-weight-bold text-primary ">Update Data Menu</h6>
    </div>
    <div class="card-body">
      <form action="" method="POST" enctype="multipart/form-data">

        <label for="kategroi">kategori</label><br>
        <select name="id_kategori" id="kategori" style="width: auto;" class="custom-select mb-3" onchange="this.form.submit">
          <?php foreach ($row as $r) : ?>
            <option <?php if ($rows['idmenu'] == $r['idkategori']) echo "selected"; ?> value="<?= $r['idkategori'] ?>"><?= $r['kategori'] ?></option>
          <?php endforeach; ?>
        </select>

        <div class="form-group">
          <label for="name_menu">Nama menu</label>
          <input type="text" name="name_menu" value="<?= $rows['menu'] ?>" class="form-control" required id="name_menu">
        </div>

        <div class="form-group">
          <label for="harga">Harga</label>
          <input type="number" name="harga" value="<?= $rows['harga'] ?>" class="form-control" required id="harga">
        </div>

        <div class="form-group">
          <label for="gambar">Gambar</label>
          <input type="file" name="gambar" class="form-control" id="gambar">
        </div>

        <button class="btn btn-primary" type="submit" name="submit">Update Data</button>
      </form>
    </div>
  </div>

</div>