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
    keranjang();
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

// detail barang
function keranjang()
{
  global $db;

  $total = 0;
  $pph = 10;
  echo '
          <main id="main">
            <div class="section-cart mt-5">
              <div class="container">
                <div class="row px-md-5 px-sm-3">
                  <div class="col-md-7 mr-4 mt-5">
                    <h6>My Cart</h6>
                    <hr>
                    <form action="keranjang.php" method="post" class="cart-items">';
                    foreach ($_SESSION as $key => $value) {
                      if ($key != 'pelanggan' && $key != 'id_pelanggan' && $key != 'user' && $key != 'level' && $key != 'id_user' && $key != 'alamat' && $key != 'telp') {
                        $id = substr($key, 1);

                        $sql = "SELECT * FROM tblmenu WHERE idmenu = $id";

                        $row = $db->getAll($sql);

                        foreach ($row as $r) {
                          echo '<div class="row bg-white border rounded py-3 my-2">';

                            echo '<div class="col-md-6">';
                            echo '<img src="./images/' . $r['gambar'] . '" class="img-fluid" alt="'. $r['gambar'] .'" width: 100%;>';
                            echo '</div>';

                            echo '<div class="col-md-6">';
                              echo '<h5 class="pt-2">' . $r['menu'] . '</h5>';
                              echo '<h5 class="pt-2">' . number_format($r['harga'], 2) . '</h5>';
                             
                              
                              echo '<div class="cart-loop mt-2 mb-1">';
                                echo '<a href="?f=home&m=keranjang&kurang=' . $r['idmenu'] . '">';
                                echo '<span style="font-size: 20px;"';
                                echo '<i class="fas fa-minus"></i>';
                                echo '</span>';
                                echo '</a>';
                                echo '<div class="">';
                                echo '<input type="number" value="' . $value . '" min="1" class="form-control-sm" readonly>';
                                echo '</div>';
                                echo '<a href="?f=home&m=keranjang&tambah=' . $r['idmenu'] . '">';
                                echo '<span style="font-size: 20px;"';
                                echo '<i class="fas fa-plus"></i>';
                                echo '</span>';
                                echo '</a>';
                              echo '</div>';
                              
                              echo '<div class="mt-2">';
                                echo '<h5 class="">' .  number_format($r['harga'] * $value, 2) . '</h5>';
                              echo '</div>';

                               echo '<a href="?f=home&m=keranjang&hapus=' . $r['idmenu'] . '" class="btn btn-outline-danger">';
                              echo '<i class="fas fa-trash-alt"></i>';
                              echo '</a>';
                            echo '</div>';


                          echo '</div>';




                          $total = $total + ($value * $r['harga']);
                        }
                      }
                    }
                    echo '<a href="?f=home&m=product" class="btn my-3 px-3 btn-block btn-warning">Kembali Belanja</a>';

                    echo '
                    </form>
                  </div>
                  <div class="col-md-4 offside-md-1 border rounded my-5 bg-white h-25  mb-4">
                    <div class="pt-4">
                      <h6>Detail pembayaran</h6>
                      <hr>
                      <div class="row detail-pembayaran">
                        <div class="col-md-6"><h6>Subtotal</h6>
                          <h6>Pajak PPH 10%</h6>
                          <hr>
                          <h6>Total Pembayaran</h6>
                        </div>
                        <div class="col-md-6">
                          <h6>' . number_format($total, 2) . '</h6>
                          <h6 class="text-danger">' . number_format($total / $pph, 2) . '</h6>
                          <hr>
                          <h6>' .  number_format($total / $pph + $total, 2) . '</h6>
                        </div>
                      </div>';
                      if (!empty($total)) {
                        $opo = $total / $pph;
                        $opo += $total;
                        echo '
                        <a href="?f=home&m=info&total=' . $opo . '" class="btn btn-primary my-3 px-3 btn-block">Checkout</a> ';
                      }
                      echo '
                      </div>
                      
                  </div>
                </div>
              </div>
            </div>
          </main>
  ';
}
