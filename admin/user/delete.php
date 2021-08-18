<?php

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "DELETE FROM tbluser WHERE iduser = $id";
  $db->runSql($sql);

  Flasher::setFlash('berhasil', 'di hapus', 'success');

  echo "
        <script>
           document.location.href = '?f=user&m=select';
        </script>
      ";
}
