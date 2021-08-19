<?php

$totals = $db->getItem("SELECT SUM(total) AS totalorder FROM tblorder;");

$jumlahDataPerHalaman = 5;
$jumlahData = $db->rowCount("SELECT idorder FROM tblorder");
$JumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

?>

<div class="container-fluid">

  <h1 class="h3 mb-2 text-gray-800">Order Pembelian</h1>
  <form action="" method="post" class="form-inline">
    <div class="form-group mr-3">
      <label for="kategroi">Dari&nbsp;&nbsp;</label>
      <input type="date" class="form-control" name="tgl_dari" style="width: auto;" required>
    </div>
    <div class="form-group mr-3">
      <label for="kategroi">Sampai&nbsp;&nbsp;</label><br>
      <input type="date" class="form-control" name="tgl_sampai" style="width: auto;" required>
    </div>
    <div class="form-group mr-3">
      <button type="submit" name="filter" class="btn btn-primary btn-sm">Filter</button>
    </div>
  </form>


  <?php

  if (isset($_POST['filter'])) {
    $tgl_dari = $_POST['tgl_dari'];
    $tgl_sampai = $_POST['tgl_sampai'];
    $row = $db->getAll("SELECT * FROM vorder WHERE tglorder BETWEEN '$tgl_dari' AND '$tgl_sampai'");
    $sum = $db->getAll("SELECT SUM(total) AS sum FROM vorder WHERE tglorder BETWEEN '$tgl_dari' AND '$tgl_sampai'")[0];
  } else {
    $sql = "SELECT * FROM `vorder` ORDER BY tglorder";
    $row = $db->getAll($sql);
    $sum = $db->getAll("SELECT SUM(total) AS sum FROM vorder")[0];
  }

  ?>



  <div class="row mt-3">
    <div class="col-lg-6">
      <?php Flasher::flash(); ?>
    </div>
  </div>

  <div class="card shadow my-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Order
        <?php if (isset($_POST['filter'])) : ?>
          <?= date('d F Y', strtotime($tgl_dari)); ?>
          <?= ' sampai '; ?>
          <?= date('d F Y', strtotime($tgl_sampai)); ?>
        <?php endif; ?>
      </h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Pelanggan</th>
              <th>Tanggal Pembelian</th>
              <th>Total</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($row)) : ?>
              <?php $i = 1;
              $total = 0;
              foreach ($row as $data) : ?>
                <?php
                if ($data['status'] == 0) {
                  $status = '
                        <button class="badge badge-secondary">Konfirmasi Sekarang</button>
                      ';
                } else {
                  $status = '<button class="badge badge-success">Di Konfirmasi</button>';
                }
                ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $data['pelanggan'] ?></td>
                  <td><?= date('d F Y H:i:s', strtotime($data['tglorder'])) ?></td>
                  <td><?= number_format($data['total'], 2, ',', '.') ?></td>
                  <td><?= $status; ?></td>
                  <td><a class="btn btn-primary btn-sm" href="?f=order_detail&m=select&id=<?= $data['idorder'] ?>">Order Detail</a></td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td colspan="3" class="text-center">Total</td>
                <td colspan="2" class="text-center">Rp. <?= number_format($sum['sum'], 2, ',', '.') ?></td>
                <td>
                  <?php if (!isset($_POST['filter'])) : ?>
                    <a class="btn btn-info btn-sm" href="print_all.php" target="_blank">Catak Semua Order</a>
                  <?php else : ?>
                    <a class="btn btn-danger btn-sm" href="print_all.php?dariTgl=<?= $tgl_dari ?>&smpTgl=<?= $tgl_sampai ?>" target="_blank">Catak Semua Order</a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php else : ?>
              <tr>
                <td colspan="6" class="text-center">Data Kosong</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>

</div>