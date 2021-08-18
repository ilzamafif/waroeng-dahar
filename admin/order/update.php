<?php

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $row = $db->getItem("SELECT * FROM `tblorder` WHERE idorder = $id");

  if ($row['status'] == 0) {
    $aktif = 1;
  } else {
    $aktif = 0;
  }


  $sql = "UPDATE `tblorder` SET `status` =$aktif WHERE `tblorder`.`idorder` = $id";
  $db->runSql($sql);
  Flasher::setFlash('berhasil', 'di update', 'success');
  echo
  "
      <script>
         document.location.href = '?f=order&m=select';
      </script>
    ";
}
