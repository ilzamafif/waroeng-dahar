<?php
require_once '../vendor/autoload.php';
require_once '../Data/Database.php';
$db = new DB;

if (isset($_GET['id'])) {
  $id = $_GET['id'];
}

$row = $db->getAll("SELECT * FROM tblorderdetail o inner join tblmenu p on o.idmenu = p.idmenu  where idorder =" . $_GET['id']);
$sumItem = $db->getAll("SELECT SUM(jumlah * hargajual) AS sum FROM tblorderdetail where idorder =" . $_GET['id']);
$viewOrder = "SELECT tblorder.idorder, tblorder.idpelanggan, tblorder.tglorder, tblorder.total, tblorder.bayar, tblorder.kembali, tblorder.status, tblpelanggan.pelanggan, tblpelanggan.alamat, tblpelanggan.telp, tblpelanggan.email, tblpelanggan.password, tblpelanggan.aktif
    FROM tblpelanggan INNER JOIN tblorder ON tblpelanggan.idpelanggan = tblorder.idpelanggan WHERE idorder = $id;";
$rows = $db->getAll($viewOrder);

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [90, 236]]);
$content = '
<body>
<div style="font-family: sans-serif;">

  <h4 style="text-align: center;">Cetak Order</h4>
  <div style="text-align: center; border-bottom: 3px dotted #000; margin-top: 1px;"></div>
  <div style="text-align: center; border-bottom: 3px dotted #000; margin: 1px 0 5px;"></div>

  <div style="">
    <div class="table-responsive">
      <table border="1" width="100%" cellspacing="0" cellpadding="10px">
        <tr>
          <th>No</th>
          <th width="40px">Menu</th>
          <th>Jml</th>
          <th>Harga</th>
          <th>Total</th>
        </tr>';
$i = 1;
foreach ($row as $data) {
  $content .= '
            <tr>
              <td>' . $i++ . '</td>
              <td width="100px">' . $data['menu'] . '</td>
              <td style="text-align: center;">' . $data['jumlah'] . '</td>
              <td>' . number_format($data['harga'], 0, ',', '.') . '</td>
              <td>' . number_format($data['jumlah'] * $data['harga'], 0, ',', '.') . '</td>
            </tr>
          ';
}
$content .= ' 
          <tr>
            <td colspan="4">Sub Total</td>
            <td>' . number_format($sumItem[0]['sum'], 2, ',', '.') . '</td>
          </tr>
          <tr>
            <td colspan="4">PPH 10%</td>
            <td>' . number_format($sumItem[0]['sum'] / 10, 2, ',', '.') . '</td>
          </tr>
          <tr>
            <td colspan="4">Grand Total</td>
            <td>' . number_format($sumItem[0]['sum'] / 10 + $sumItem[0]['sum'], 2, ',', '.') . '</td>
          </tr>
          ';

$content .= '  </table>
    </div>
  </div>

</div>
  
</body>
';
$mpdf->WriteHTML($content);
$mpdf->Output('cetak'. $id . '.pdf', \Mpdf\Output\Destination::INLINE);
