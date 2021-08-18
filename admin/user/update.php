<?php

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $row = $db->getItem("SELECT * FROM tbluser WHERE iduser = $id");

  if ($row['status'] == 0) {
    $aktif = 1;
  } else {
    $aktif = 0;
  }


  $sql = "UPDATE tbluser SET status=$aktif WHERE iduser =$id";
  $db->runSql($sql);

  Flasher::setFlash('berhasil', 'di update', 'success');

  echo "
        <script>
           document.location.href = '?f=user&m=select';
        </script>
      ";
}
