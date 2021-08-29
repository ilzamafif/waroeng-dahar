<?php
$viewOrder = "SELECT tblorder.idorder, tblorder.idpelanggan, tblorder.tglorder, tblorder.total, tblorder.bayar, tblorder.kembali, tblorder.status, tblpelanggan.pelanggan, tblpelanggan.alamat, tblpelanggan.telp, tblpelanggan.email, tblpelanggan.password, tblpelanggan.aktif
    FROM tblpelanggan INNER JOIN tblorder ON tblpelanggan.idpelanggan = tblorder.idpelanggan;";
$row = $db->getAll($viewOrder);
$days = $db->getAll("SELECT tglorder,COUNT(*) AS jumlah_harian FROM tblorder GROUP BY tglorder;");
$weeks = $db->getAll("SELECT YEARWEEK(tglorder) AS tahun_minggu,COUNT(*) AS jumlah_mingguan FROM tblorder GROUP BY YEARWEEK(tglorder);");

$jumlahData = $db->rowCount("SELECT idorder FROM tblorder");

$banyak = 4;
$halaman = ceil($jumlahData / $banyak);

if (isset($_GET['p'])) {
  $p = $_GET['p'];
  $mulai = ($p * $banyak) - $banyak;
} else {
  $mulai = 0;
}

?>

<div class="container-fluid">

  <h1 class="h3 mb-2 text-gray-800">Detail Order Pembelian</h1>
  <div class="row mt-3">
    <div class="col-lg-6">
      <?php Flasher::flash(); ?>
    </div>
  </div>
   <div class="form-group">
      <label for="kategroi">Hari</label><br>
      <select name="id_kategori" id="kategori" onchange="this.form.submit" class="custom-select" style="width: auto;">
        <?php foreach ($days as $p) : ?>
        <option value="<?= $p['tglorder']; ?>"><?= $p['tglorder']; ?></option>
      <?php endforeach; ?>
      </select>
    </div>
   <div class="form-group">
      <label for="kategroi">Bulan</label><br>
      <select name="bulan" class="custom-select mb-3" style="width: auto;">
        <option value="01">Januari</option>
        <option value="02">Februari</option>
        <option value="03">Maret</option>
        <option value="04">April</option>
        <option value="05">Mei</option>
        <option value="06">Juni</option>
        <option value="07">Juli</option>
        <option value="08">Agustus</option>
        <option value="09">September</option>
        <option value="10">Oktober</option>
        <option value="12">November</option>
        <option value="12">Desember</option>
      </select>
  </div>
   <div class="form-group">
      <label for="kategroi">Bulan</label><br>
     <select name="tahun" class="custom-select mb-3" style="width: auto;">
      <?php
      $mulai= date('Y') - 20;
      for($i = $mulai;$i<$mulai + 100;$i++){
          $sel = $i == date('Y') ? ' selected="selected"' : '';
          echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
      }
      ?>
      </select>
  </div>

  <div class="card shadow my-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Order </h6>
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
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($row)) : ?>
              <?php $i = 1;
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
                  <td><?= $data['tglorder'] ?></td>
                  <td><?= $data['total'] ?></td>
                  <td><a class="btn btn-primary btn-sm" href="?f=order_detail&m=select&id=<?= $data['idorder'] ?>">Order Detail</a></td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td colspan="4">Total</td>
                  <td><?= $data['total'] ?></td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>

        <nav>
          <ul class="pagination justify-content-end">
            <li class="page-item">
              <a href="" class="page-link">Previous</a>
            </li>


            <?php

            for ($i = 1; $i <= $halaman; $i++) {
              echo '<li class="page-item"><a href="?f=order&m=select&p=' . $i . '" class="page-link">' . $i . '</a></li>';
            }

            ?>


            <li class=" page-item">
              <a href="" class="page-link">Next</a>
            </li>
          </ul>
        </nav>

      </div>
    </div>
  </div>

</div>