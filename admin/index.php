<?php

if (!session_id()) {
  session_start();
}

require_once "../Data/Database.php";
require_once "../Data/Flasher.php";

$db = new DB;
if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  exit;
}

if (isset($_GET['log'])) {
  $_SESSION = [];
  session_unset();
  session_destroy();
  header("Location: index.php");

  exit;
}

$label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November" ,"Desember"];

for($bulan = 1; $bulan < 13; $bulan++)
{
  $query = $db->getAll("SELECT SUM(total) AS total FROM tblorder WHERE MONTH(tglorder)='$bulan'");
  $jumlah_produk[] = $query[0]['total'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Waroeng Dahar - Dashboard</title>

  <?php include('./includes/styles.php'); ?>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php include('./includes/sidebar.php'); ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php include('./includes/navbar.php'); ?>

        <div class="col">
          <?php
          if (isset($_GET['f']) && isset($_GET['m'])) {
            $f = $_GET['f'];
            $m = $_GET['m'];
            $file = './' . $f . '/' . $m . '.php';
            require_once $file;
          }
          ?>
        </div>

      </div>
      <!-- End of Main Content -->

      <?php include('./includes/footer.php'); ?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <?php include('./includes/scripts.php'); ?>

</body>

</html>