<?php

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "SELECT * FROM tblorder WHERE idorder = $id";
  $row = $db->getItem($sql);

  // var_dump($row);
}

if (isset($_POST['simpan'])) {
  $bayar = $_POST['bayar'];
  $kembali = $bayar - $row['total'];



  $sql = "UPDATE `tblorder` SET `bayar` = '$bayar', kembali=$kembali, `status`=1 WHERE idorder = $id";
  if ($kembali < 0) {
    echo '<h3>Pembayaran Kurang</h3>';
  } else {
    $db->runSql($sql);
    // header('Location:?f=kategori&m=select');
    // var_dump($sql);
  }
}

?>

<div class="container-fluid">
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Update Data Kategori</h1>
    </div>

    <div class="row">
      <form action="" method="POST">
        <div class="form-group">
          <label for="total">Total</label>
          <input type="number" name="total" value="<?= $row['total']; ?>" class="form-control" required id="name_kategori">
        </div>
        <div class="form-group">
          <label for="bayar">Bayar</label>
          <input type="number" name="bayar" value="<?= $row['bayar']; ?>" class="form-control" required id="name_kategori">
        </div>
        <button class="btn btn-primary" type="submit" name="simpan">Bayar</button>
      </form>
    </div>
  </div>

</div>