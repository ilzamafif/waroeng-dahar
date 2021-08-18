<?php
session_start();
require_once "./Data/Database.php";
require_once "./Data/Flasher.php";

$db = new DB;

$sql = "SELECT * FROM tblkategori";
$row = $db->getAll($sql);

if (isset($_GET['log'])) {
  $_SESSION = [];
  session_unset();
  session_destroy();
  header("Location: index.php");

  exit;
}

function cart()
{

  global $db;
  $cart = 0;
  foreach ($_SESSION as $key => $value) {
    if ($key != 'pelanggan' && $key != 'id_pelanggan' && $key != 'user' && $key != 'level' && $key != 'id_user' && $key != 'alamat' && $key != 'telp') {
      $id = substr($key, 1);
      $sql = "SELECT * FROM tblmenu WHERE idmenu = $id";
      $row =  $db->getAll($sql);

      foreach ($row as $r) {
        $cart++;
      }
    }
  }
  return $cart;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="Waroeng Dahar">
  <meta name="description" content="Website jual makanan, food ordering, POS, ">
  <title>Waroeng Dahar</title>
  <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
  <link rel="icon" href="./images/favicon.png" type="image/x-icon">
  <link rel="manifest" href="manifest.json">
  <link rel="apple-touch-icon" href="./images/icons/icon-192x192.png">
  <meta name="theme-color" content="#3074FF"/>

  <!-- bootstrap link file -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- font awesome link file -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- custom css link file -->
  <link rel="stylesheet" href="./frontend/styles/main.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
      <a class="logo text-decoration-none text-dark" href="index.php">
        <h4 class="font-weight-bold">Waroeng Dahar</h4>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item ">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?f=home&m=keranjang">
              <span style="font-size: 20px; color: gold;">
                <i class="fas fa-shopping-cart"></i>
              </span>
              <span id="cart_count" class="bg-dark px-2 text-warning"><?= cart(); ?></span>
            </a>
          </li>
          <?php if (isset($_SESSION['pelanggan'])) : ?>
            <li class="nav-item">
              <a class="nav-link" href="?log=logout">
                <?php
                echo "Welcome  " . $_SESSION['pelanggan'];
                ?>
                <i class="fas fa-sign-out-alt fa-fw mr-2 text-gray-600"></i>
              </a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <i class="fas fa-user-cart"></i>
            </li>
          <?php endif; ?>

        </ul>
      </div>
    </div>
  </nav>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Waroeng Dahar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse ms-auto" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <?php if (isset($_SESSION['pelanggan'])) : ?>
            <li class="nav-item">
              <a class="nav-link" href="?log=logout">
                <?php
                echo "Welcome  " . $_SESSION['pelanggan'];
                ?>
                <i class="fas fa-sign-out-alt fa-fw mr-2 text-gray-600"></i>
              </a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <i class="fas fa-user-cart"></i>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="row mt-3">
    <div class="col-lg-6">
      <?php Flasher::flash(); ?>
    </div>
  </div>

  <?php if (!empty($row)) : ?>

    <!-- <ul class="nav flex-column">
      <?php foreach ($row as $r) : ?>
        <li class="nav-item"><a href="?f=home&m=product&id=<?= $r['idkategori']; ?>"><?= $r['kategori']; ?></a></li>
      <?php endforeach; ?>
    </ul> -->

  <?php endif; ?>



  <?php

  if (isset($_GET['f']) && isset($_GET['m'])) {
    $f = $_GET['f'];
    $m = $_GET['m'];
    $file = $f . '/' . $m . '.php';
    require_once $file;
  } else {
    require_once "home/product.php";
  }

  ?>

  <script src="./frontend/scripts/main.js"></script>
  <!-- Bootstrap core JavaScript link-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>