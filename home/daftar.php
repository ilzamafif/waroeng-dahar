<?php

if (isset($_POST['insert'])) {
  $user = strtolower(stripslashes($_POST['nama']));
  $alamat  = strtolower($_POST['alamat']);
  $email  = strtolower($_POST['email']);
  $telp = htmlspecialchars($_POST['telp']);
  $password = hash('sha256', $_POST['password']);
  $konfirmasi = hash('sha256', $_POST['konfirmasi']);

  if ($password === $konfirmasi) {
    $password = $password;
    $sql = "INSERT INTO `tblpelanggan` VALUES (NULL, '$user', '$alamat', '$telp', '$email', '$password', '1');";
    $db->runSql($sql);
    Flasher::setFlash('Berhasil', 'Silahkan login', 'success');
  } else {
    Flasher::setFlash('Passowrd', 'Tidak sesuai', 'warning');
  }

}



?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Halaman Registrasi</title>

  <link rel="stylesheet" href="admin/assets/bootstrap/css/bootstrap.min.css">
  <style>
    body {
      margin-top: 80px;
    }
  </style>

</head>

<body class=" bg-gradient-primary">

  <div class="container mt-5">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->

        <div class="row mt-3">
          <div class="col-lg-5 ml-3">
            <?php Flasher::flash(); ?>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-5 d-none d-lg-block"></div>
          <div class="col-lg-6">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" method="POST" action="">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" placeholder="name" name="nama">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-user" placeholder="alamat" name="alamat">
                </div>

                <div class="form-group">
                  <input type="email" class="form-control form-control-user" placeholder="Email Address" name="email">
                </div>

                <div class="form-group">
                  <input type="telp" class="form-control form-control-user" placeholder="No Telp" name="telp">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" placeholder="Password" name="password">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" placeholder="Konfirmasi Password" name="konfirmasi">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block" name="insert">
                  Register Account
                </button>
                <hr>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="?f=home&m=masuk">Sudah Punya Akun? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</body>

</html>