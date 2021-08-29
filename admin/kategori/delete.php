<?php

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "DELETE FROM tblkategori WHERE idkategori = $id";
  $db->runSql($sql);
  Flasher::setFlash('berhasil', 'dihapus', 'Kategori', 'success');

  echo "
        <script>
           document.location.href = '?f=kategori&m=select';
        </script>
      ";
}
