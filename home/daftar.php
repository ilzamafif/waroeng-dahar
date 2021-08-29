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
    $db->runSql("INSERT INTO `tblpelanggan` (`idpelanggan`, `pelanggan`, `alamat`, `telp`, `email`, `password`, `aktif`) VALUES ('', '$user', '$alamat', '$telp', '$email', '$password', '1');");
    Flasher::setFlash('Berhasil didaftarkan', 'Silahkan login', 'pelanggan', 'success');
  } else {
    Flasher::setFlash('pelanggan', 'Tidak sesuai', 'password', 'warning');
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

<body>
  <div class="container">
    <div class="row justify-content-center" style="margin-top: 1vh;">
      <div class="col-md-6">
        <div class="card shadow p-1">

          <div class="row mt-3">
            <div class="col-lg text-center">
              <?php Flasher::flash5(); ?>
            </div>
          </div>

          <div class="card-header bg-transparent mb-0">
            <h5 class="text-center">Create an <span class="font-wight-bold text-primary">ACCOUNT</span></h5>
          </div>

          <div class="card-body">
            <form method="POST" action="">
              <div class="form-group">
                <input type="text" class="form-control mb-3" placeholder="name" name="nama">
              </div>

              <div class="form-group">
                <input type="text" class="form-control mb-3" placeholder="alamat" name="alamat">
              </div>

              <div class="form-group">
                <input type="email" class="form-control mb-3" placeholder="Email Address" name="email">
              </div>

              <div class="form-group">
                <input type="telp" class="form-control mb-3" placeholder="No Telp" name="telp">
              </div>

              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="password" class="form-control mb-3" placeholder="Password" name="password">
                </div>
                <div class="col-sm-6">
                  <input type="password" class="form-control mb-3" placeholder="Konfirmasi Password" name="konfirmasi">
                </div>
              </div>
              
              <div class="col d-grid">
                <button type="submit" class="btn btn-primary btn-block" name="insert">
                  Register Account
                </button>
                <a href="?f=home&m=masuk" class="btn btn-primary btn-block mt-2">
                  LOGIN!!
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>