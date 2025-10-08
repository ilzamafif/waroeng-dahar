<?php

if (isset($_GET['id'])) {
  $id = $_GET['id'];
}

$row = $db->getAll("SELECT * FROM tblorderdetail INNER JOIN tblmenu ON tblorderdetail.idmenu = tblmenu.idmenu where idorder =" . $_GET['id']);
$sumItem = $db->getAll("SELECT SUM(jumlah * harga) AS sum FROM tblorderdetail where idorder =" . $_GET['id']);
$viewOrder = "SELECT tblorder.idorder, tblorder.idpelanggan, tblorder.tglorder, tblorder.total, tblorder.bayar, tblorder.kembali, tblorder.status, tblpelanggan.pelanggan, tblpelanggan.alamat, tblpelanggan.telp, tblpelanggan.email, tblpelanggan.password, tblpelanggan.aktif
    FROM tblpelanggan INNER JOIN tblorder ON tblpelanggan.idpelanggan = tblorder.idpelanggan WHERE idorder = $id;";
$rows = $db->getAll($viewOrder);
foreach ($rows as $r) {
  if ($r['status'] == 0) {
    $status = 0;
  } else {
    $status = 1;
  }
}
?>
<div class="container-fluid">

  <h1 class="h3 mb-2 text-gray-800">Detail Order</h1>

  <div class="card shadow my-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Detail Order</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Menu</th>
              <th>Jumlah</th>
              <th>Harga</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($row)) : ?>
              <?php $i = 1;
              foreach ($row as $data) : ?>
                <?php $subtot = $data['jumlah'] * $data['harga']; ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $data['menu'] ?></td>
                  <td><?= $data['jumlah'] ?></td>
                  <td><?= number_format($data['harga'], 2, ',', '.') ?></td>
                  <td><?= number_format($data['harga'] * $data['jumlah'], 2, ',', '.') ?></td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td colspan="4">Sub Total</td>
                <td><?= number_format($sumItem[0]['sum'], 2, ',', '.') ?></td>
              </tr>
              <tr>
                <td colspan="4">PPH</td>
                <td><?= number_format($sumItem[0]['sum'] / 10, 2, ',', '.') ?></td>
              </tr>
              <tr>
                <td colspan="4">Grand Total</td>
                <td><?= number_format($sumItem[0]['sum'] / 10 + $sumItem[0]['sum'], 2, ',', '.') ?></td>
              </tr>
          </tbody>
        </table>
        <a href="print.php?id=<?= $data['idorder'] ?>" target="_blank" class="btn btn-secondary float-right btn-sm ml-3">Cetak</a>
        <?php if ($r['status'] == 0) : ?>
          <a href="?f=order&m=update&status=<?= $status ?>&id=<?= $data['idorder'] ?>" class="btn btn-danger float-right btn-sm">Update pembayaran</a>
        <?php elseif ($r['status'] == 1) : ?>
          <button class="btn btn-success float-right btn-sm">Pembayaran Oke</button>
        <?php endif; ?>
      <?php else: ?>
        <tr>
          <td colspan="6" class="text-center">Data Kosong</td>
        </tr>
      <?php endif; ?>
      </div>
    </div>
  </div>

</div>