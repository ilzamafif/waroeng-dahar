<?php

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "DELETE FROM tblpelanggan WHERE idpelanggan = $id";
  $db->runSql($sql);

  Flasher::setFlash('berhasil', 'di hapus', 'success');

  echo "
        <script>
           document.location.href = '?f=pelanggan&m=select';
        </script>
      ";
}
