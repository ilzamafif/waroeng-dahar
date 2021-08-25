<?php
if (isset($_GET['total'])) {
  $idorder = idorder();
  $idPelanggan = $_SESSION['id_pelanggan'];
  $tglorder = '2021-05-06 15:58:26';
  $total = $_GET['total'];

  $sql = "SELECT * FROM tblorder WHERE idorder = $idorder";
  $count = $db->rowCount($sql);

  if ($count == 0) {
    insertOrder($idorder, $idPelanggan, $total);
    insertOrderDetail($idorder);
  } else {
    insertOrderDetail($idorder);
  }
  hapusSession();
  // Flasher::setFlash('berhasil', 'di order', 'success');
  echo
  "
  <script>
  alert('order berhasil');
  document.location.href = '?f=home&m=product';
  </script>
  ";
  // header('Location: ?f=home&m=product');
} else {
  hapusSession();
}

function idorder()
{
  global $db;
  $sql = "SELECT idorder FROM tblorder ORDER BY idorder DESC";
  $jumlah = $db->rowCount($sql);
  if ($jumlah === 0) {
    $id = 1;
  } else {
    $item = $db->getItem($sql);
    $id = $item['idorder'] + 1;
  }
  return $id;
}

function insertOrder($idorder, $id_pelanggan, $total)
{
  global $db;
  date_default_timezone_set('Asia/jakarta');
  $tgl = date("Y-m-d H:i:s");
  $sql = "INSERT INTO `tblorder` VALUES($idorder, $id_pelanggan, '$tgl', $total, '0', '0', '0')";
  $db->runSql($sql);
}

function insertOrderDetail($idorder)
{

  global $db;
  foreach ($_SESSION as $key => $value) {
    if ($key != 'pelanggan' && $key != 'id_pelanggan' && $key != 'user' && $key != 'level' && $key != 'id_user' && $key != 'alamat' && $key != 'telp') {
      $id = substr($key, 1);
      $sql = "SELECT * FROM tblmenu WHERE idmenu = $id";

      $row =  $db->getAll($sql);
      // echo '<pre>';
      // print_r($row);
      // echo '</pre>';

      foreach ($row as $r) {
        $id_menu = $r['idmenu'];
        $harga = $r['harga'];
        $sql = "INSERT INTO tblorderdetail VALUES('', $idorder, $id_menu, $value, $harga)";
        $db->runSql($sql);
      }
    }
  }
}

function hapusSession()
{
  foreach ($_SESSION as $key => $value) {
    if ($key != 'pelanggan' && $key != 'id_pelanggan' && $key != 'user' && $key != 'level' && $key != 'id_user' && $key != 'alamat' && $key != 'telp') {
      $id = substr($key, 1);

      unset($_SESSION['_' . $id]);
    }
  }
}
