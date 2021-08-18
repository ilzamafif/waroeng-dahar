<?php

if (isset($_POST['insert'])) {
  $user = $_POST['nama'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $konfirmasi = $_POST['konfirmasi'];
  $level = $_POST['level'];

  if ($password === $konfirmasi) {
    $sql = "INSERT INTO `tbluser` VALUES (NULL, '$user', '$email', '$password', ' $level', '1');";
    $db->runSql($sql);
    Flasher::setFlash('berhasil', 'di tambahkan', 'success');

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
}

?>

<div class="container-fluid">
  <div class="card shadow my-3 w-auto">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Tambah Data User</h6>
    </div>
    <div class="card-body">
      <form action="" method="POST">
        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" name="nama" class="form-control" required id="nama">
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" required id="email">
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" required id="password">
        </div>

        <div class="form-group">
          <label for="konfirmasi">konfirmasi Password</label>
          <input type="password" name="konfirmasi" class="form-control" required id="konfirmasi">
        </div>

        <div class="form-group">
          <label for="level">Level</label>
          <select name="level" id="level" class="custom-select mb-3" style="width: auto;">
            <option value="owner">Owner</option>
            <option value="karyawan">karyawan</option>
          </select>
        </div>

        <button class="btn btn-primary" type="submit" name="insert">Tambah Data</button>
      </form>
    </div>
  </div>
</div>