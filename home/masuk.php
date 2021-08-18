<?php
require_once "./dbcontroller.php";
$db = new DB;

if (isset($_POST["login"])) {
  $email = $_POST["email"];
  $password = hash('sha256', $_POST["password"]);

  $sql = "SELECT * FROM `tblpelanggan` WHERE email='$email' AND `password`='$password'";

  $count = $db->rowCount($sql);
  if ($count == 0) {
    Flasher::setFlash('Passowrd', 'Tidak sesuai', 'warning');
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

<body class="bg-gradient-primary mt-5">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->

            <div class="row mt-3">
              <div class="col-lg-5 ml-3">
                <?php Flasher::flash(); ?>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                  </div>
                  <form class="user" method="POST" action="">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                      <!-- <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                          Me</label>
                      </div> -->
                    </div>
                    <button href="" type="submit" class="btn btn-primary btn-user btn-block" name="login">Login</button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="?f=home&m=daftar">Buat Akun</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

</body>

</html>