<?php

session_start();

require_once "../Data/Database.php";
require_once "../Data/Flasher.php";

$db = new DB;

if (isset($_POST["login"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $sql = "SELECT * FROM tbluser WHERE email = '$email' AND password = '$password'";

  $count = $db->rowCount($sql);
  if ($count == 0) {
    Flasher::setFlash('Email atau passoword', 'tidak sesuai', 'warning');
  } else {
    $row = $db->getItem($sql);

    $_SESSION['user'] = $row['email'];
    $_SESSION['level'] = $row['level'];
    $_SESSION['id_user'] = $row['iduser'];

    header("Location: index.php?f=kategori&m=select");
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

  <?php include('./includes/styles.php'); ?>

</head>

<body class="bg-gradient-primary">
  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-md-8">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">

          <div class="row pt-4 ml-3">
            <div class="col-lg-5">
              <?php Flasher::flash(); ?>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 d-none d-lg-block"></div>
            <div class="col-lg-6">
              <div class="p-5">
                <form class="user" method="POST" action="">
                  <div class="form-group">
                    <input type="email" class="form-control form-control-user" placeholder="Masukkan Email" name="email">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" placeholder="Masukkan Password" name="password">
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block" name="login"> Login</button>
                </form>
                <hr>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</body>

</html>