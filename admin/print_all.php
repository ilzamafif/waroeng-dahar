<?php
require_once '../vendor/autoload.php';
require_once '../Data/Database.php';
$db = new DB;
$mpdf = new \Mpdf\Mpdf();

if (isset($_GET['dariTgl']) && isset($_GET['smpTgl'])) {
  $tgl_dari = $_GET['dariTgl'];
  $tgl_sampai = $_GET['smpTgl'];
    $viewOrder = "SELECT tblorder.idorder, tblorder.idpelanggan, tblorder.tglorder, tblorder.total, tblorder.bayar, tblorder.kembali, tblorder.status, tblpelanggan.pelanggan, tblpelanggan.alamat, tblpelanggan.telp, tblpelanggan.email, tblpelanggan.password, tblpelanggan.aktif
  FROM tblpelanggan INNER JOIN tblorder ON (tblpelanggan.idpelanggan = tblorder.idpelanggan) WHERE tglorder BETWEEN '$tgl_dari' AND '$tgl_sampai';";
  $row = $db->getAll($viewOrder);
  $sum = $db->getAll("SELECT SUM(total) AS sum FROM tblorder")[0];
  $c = 'Cetak Order<br>' . date("d F Y ", strtotime($tgl_dari)) . ' sampai ' . date("d F Y ", strtotime($tgl_sampai));
}else{
  $c = 'Cetak Order<br>';
  $totals = $db->getItem("SELECT SUM(total) AS totalorder FROM tblorder;");
  $vorder = "SELECT tblorder.idorder, tblorder.idpelanggan, tblorder.tglorder, tblorder.total, tblorder.bayar, tblorder.kembali, tblorder.status, tblpelanggan.pelanggan, tblpelanggan.alamat, tblpelanggan.telp, tblpelanggan.email, tblpelanggan.password, tblpelanggan.aktif
  FROM tblpelanggan INNER JOIN tblorder ON (tblpelanggan.idpelanggan = tblorder.idpelanggan);";
  $row = $db->getAll($vorder);
  $sum = $db->getAll("SELECT SUM(total) AS sum FROM tblorder")[0];
}
$content = '
<div style="font-family: sans-serif;">

  <h4 style="text-align: center;">
  '. $c .'
    
  </h4>

  <div class="card shadow my-3">
    <div class="table-responsive">
      <table border="1" width="100%" cellspacing="0" cellpadding="5px">
        <tr>
          <th style="text-align: left;">No</th>
          <th style="text-align: left;">pelanggan</th>
          <th style="text-align: left;">Tanggal</th>
          <th style="text-align: left;">Pembelian</th>
        </tr>';
$i = 1;
foreach ($row as $data) {
  $content .= '
            <tr>
              <td>' . $i++ . '</td>
              <td>' . $data['pelanggan'] . '</td>
              <td>' . date('d F Y', strtotime($data['tglorder']))  . '</td>
              <td>' . number_format($data['total'], 2, ',', '.')  . '</td>
            </tr>
          ';
}
$content .= ' 
          <tr>
            <td colspan="3">Sub Total</td>
            <td>' . number_format($sum['sum'], 2, ',', '.') . '</td>
          </tr>
          ';

$content .= '  </table>
    </div>
  </div>

</div>

';
// $content .=
$mpdf->WriteHTML($content);
$mpdf->Output('cetak'. $id . '.pdf', \Mpdf\Output\Destination::INLINE);
