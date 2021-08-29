<?php
require_once "./Data/Database.php";

$db = new DB;

if (isset($_POST["login"])) {
  $email = $_POST["email"];
  $password = hash('sha256', $_POST["password"]);

  $sql = "SELECT * FROM `tblpelanggan` WHERE email='$email' AND `password`='$password'";

  $count = $db->rowCount($sql);
  if ($count == 0) {
    Flasher::setFlash('Passowrd', 'Tidak sesuai', '', 'warning');
  } else {
    $sql = "SELECT * FROM `tblpelanggan` WHERE email = '$email' AND `password` = '$password'";
    $row = $db->getItem($sql);
    $_SESSION['pelanggan'] = $row['email'];
    $_SESSION['alamat'] = $row['alamat'];
    $_SESSION['telp'] = $row['telp'];
    $_SESSION['id_pelanggan'] = $row['idpelanggan'];

    header("Location: index.php");
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Halaman Login</title>

  <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap-grid.min.css">
</head>

<body>
  <div class="container">
    <div class="row justify-content-center" style="margin-top: 20vh;">
      <div class="col-md-4">
        <div class="card">

           <div class="row mt-3">
            <div class="col-lg-6">
              <?php Flasher::flash5(); ?>
            </div>
          </div>

          <div class="card-header bg-transparent mb-0">
            <h5 class="text-center">Please <span class="font-wight-bold text-primary">LOGIN</span></h5>
          </div>

          <div class="card-body">
          <form class="user" method="POST" action="">
            <div class="form-group">
              <input type="email" class="form-control mb-3" aria-describedby="emailHelp" placeholder="Email" name="email">
            </div>
            <div class="form-group">
              <input type="password" class="form-control mb-3" placeholder="Password" name="password">
            </div>
            <div class="form-group">
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
            <a href="?f=home&m=daftar" class="btn btn-warninggi btn-block" name="login">Daftar</a>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>