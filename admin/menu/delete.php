<?php

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "DELETE FROM tblmenu WHERE idmenu= $id";
  $db->runSql($sql);

  Flasher::setFlash('berhasil', 'di hapus', 'success');

  echo "
        <script>
           document.location.href = '?f=menu&m=select';
        </script>
      ";
}
