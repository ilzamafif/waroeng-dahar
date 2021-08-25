<?php

if (isset($_GET['total'])) {
  $total = $_GET['total'];
}


?>

<body class="mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6 p-4">
      <div class="card o-hidden border-0 shadow-lg  p-5 my-5">
        <div class="card-body">
          <div class="form-group mb-3">
            <label for="nama">Email</label>
            <input type="text" name="nama" class="form-control" readonly value="<?= $_SESSION['pelanggan'] ?>" id="nama">
          </div>

          <div class="form-group mb-3">
            <label for="nama">Alamat</label>
            <input type="text" name="nama" class="form-control" value="<?= $_SESSION['alamat'] ?>" id="nama">
          </div>

          <div class="form-group mb-3">
            <label for="nama">No Telepon</label>
            <input type="text" name="nama" class="form-control" value="<?= $_SESSION['telp'] ?>" id="nama">
          </div>
          
          <div class="col d-grid">
            <a href="?f=home&m=checkout&total=<?= $total ?>" class="btn btn-primary" type="submit" name="insert">Beli</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>