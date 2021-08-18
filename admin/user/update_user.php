<?php

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "SELECT * FROM tbluser WHERE iduser =$id";
  $row = $db->getItem($sql);
}

if (isset($_POST['insert'])) {
  $user = $_POST['nama'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $konfirmasi = $_POST['konfirmasi'];

  if ($password === $konfirmasi) {
    $sql = "UPDATE `tbluser` SET `nama`='$user', `email`='$email', `password`='$password' WHERE iduser =$id";
    $db->runSql($sql);
    Flasher::setFlash('berhasil', 'di update', 'success');

    echo "
        <script>
           document.location.href = '?f=user&m=select';
        </script>
      ";
  } else {
    Flasher::setFlash('passowrd', 'tidak sesuai', 'danger');

    echo "
        <script>
           document.location.href = '?f=user&m=select';
        </script>
      ";
  }



  // header('Location:?f=kategori&m=select');
}

?>


<div class="container-fluid">
  <div class="card shadow my-3 w-auto">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Update Data User</h6>
    </div>
    <div class="card-body">
      <form action="" method="POST">
        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" name="nama" class="form-control" required id="nama" value="<?= $row['nama']; ?>">
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" required id="email" value="<?= $row['email']; ?>">
        </div>

        <div class=" form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" required id="password" value="<?= $row['password']; ?>">
        </div>

        <div class=" form-group">
          <label for="konfirmasi">konfirmasi Password</label>
          <input type="password" name="konfirmasi" class="form-control" required id="konfirmasi" value="<?= $row['password']; ?>">
        </div>

        <button class="btn btn-primary" type="submit" name="insert">Ubah Data</button>
      </form>
    </div>
  </div>
</div>