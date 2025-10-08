<?php
// hapus product dari keranjang
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  // echo $id;
  unset($_SESSION['_' . $id]);
  header('Location:?f=home&m=keranjang');
}

// nambah item di keranjang
if (isset($_GET['tambah'])) {
  $id = $_GET['tambah'];
  $_SESSION['_' . $id]++;
}

// kurang item dari keranjang
if (isset($_GET['kurang'])) {
  $id = $_GET['kurang'];
  $_SESSION['_' . $id]--;

  if ($_SESSION['_' . $id] == 0) {
    unset($_SESSION['_' . $id]);
  }
}

// jika login atau belum
if (!isset($_SESSION['pelanggan'])) {
  header("Location: ?f=home&m=masuk");
} else {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    isi($id);
    header('Location: ?f=home&m=keranjang');
  } else {
    // keranjang();
  }
}


// mengambil nilai id product
function isi($id)
{
  if (isset($_SESSION['_' . $id])) {
    $_SESSION['_' . $id]++;
  } else {
    $_SESSION['_' . $id] = 1;
  }
}

?>


<main>
  <section class="header">
  <div class="container text-center" style="margin-top: 100px;">
    <h3>your Cart</h3>  
    <p>pastikan barang anda terbayar lunas</p>
  </div>
  </section>

  <section class="checkout">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-7">
          <h4 class="mb-4">Your Item</h4>
          <?php $total = 0; foreach ($_SESSION as $key => $value) : ?>
            <?php if ($key != 'pelanggan' && $key != 'id_pelanggan' && $key != 'user' && $key != 'level' && $key != 'id_user' && $key != 'alamat' && $key != 'telp') : ?>
              <?php 
                $id = substr($key, 1); 
                if(is_numeric($id)) { 
                  $items = $db->getAll('SELECT * FROM tblmenu WHERE idmenu = ' . $id); 
                } else {
                  $items = array(); // Initialize as empty array if id is not numeric
                }
              ?>
              <?php foreach ($items as $item): ?>
                <div class="row mb-4 shadow-sm p-2">
                  <div class="col-2">
                    <img src="./frontend/images/data/<?= $item['gambar']; ?>" class="img-fluid">
                  </div>
                  <div class="col-3 justify-content-center ">
                    <h5 class="m-0"><?= $item['menu']; ?></h5 class="m-0">
                    <p class="m-0"><?= number_format($item['harga'], 2) ?></p>
                  </div>
                  <div class="col-4 text-right">
                    <a href="?f=home&m=keranjang&kurang=<?= $item['idmenu'] ?>" class="btn btn-sm" style="background-color: #EAEAEA; color: rgb(160, 112, 112);">
                      <i class="fas fa-minus-circle"></i>
                    </a>
                    <span class="mx-2"><?= $value; ?></span>
                    <a href="?f=home&m=keranjang&tambah=<?= $item['idmenu'] ?>" class="btn btn-sm btn-primary">
                      <i class="fas fa-plus-circle"></i>
                    </a>
                  </div>
                  <div class="col-2 justify-content-center px-2">
                    <p class="m-0"><?= number_format($item['harga'] * $value, 2) ?></p>
                  </div>
                  <div class="col-1 text-right">
                    <a href="?f=home&m=keranjang&hapus=<?= $item['idmenu'] ?>" class="btn btn-sm btn-danger"  style="color: white;">
                      <i class="fas fa-times-circle"></i>
                    </a>
                  </div>
                </div>
                <?php $total += ($value * $item['harga']); ?>
              <?php endforeach; ?>
            <?php endif; ?>
          <?php endforeach; ?>
          <div class="col d-grid mb-5">
            <a href="?f=home&m=product" class="btn btn-block rounded-0 text-white btn-warning">Belanja Kembali</a>
          </div>
        </div>
        
        <div class="col-lg-4 ms-4">
          <div class="card">
            <div class="card-body rounded-0 checkout-detail">
              <h5 class="card-title">Inforamsi Biaya</h5>
              <div class="row-mb-3 d-flex justify-content-between">
                <div class="col">
                  <h6 class="m-0">Subtotal</h6>
                </div>
                <div class="col">
                  <h6 class="m-0 text-success"><?= $total ?></h6>
                </div>
              </div>
              <hr>
              <div class="row-mb-3">
                <div class="col">
                  <h6 class="m-0">pajak PPH</h6>
                  <small style="color: #b7b7b7;">10 %</small>
                </div>
                <div class="col ">
                  <h6 class="m-0 d-flex justify-content-end align-self-center text-success"><?= number_format($total / 10, 2) ?></h6>
                </div>
              </div>
              <div class="row-mb-3">
                <div class="col">
                  <h6 class="m-0">Total Harga</h6>
                </div>
                <div class="col d-flex justify-content-end">
                  <h6 class="m-0 align-self-center text-primary"><?= number_format($total / 10 + $total, 2) ?></h6>
                </div>
              </div>
            </div>
          </div>

          <div class="row-mt-3">
            <?php if(!empty($total)) : ?>
              <div class="col d-grid">
                <a href="?f=home&m=info&total=<?= $total / 10 + $total; ?>" class="btn btn-block rounded-0 text-white btn-primary">Checkout</a>
                <a href="?f=home&m=product" class="btn btn-block rounded-0" style="color: #333;">Cancel</a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
