<?php
$row = $db->getAll("SELECT * FROM tblmenu");
?>

<header>
  <div class="hero">
    <h1 class="title">Welcome To Waroeng Dahar</h1>
    <p class="tagline">Menyediakan makanan dan minuman dengan berbagai macam rasa</p>
    <!-- <a href="#main" class="btn btn-outline-primary mx-auto btn-order ">Order Now</a> -->
  </div>
</header>

<main id="main">
  <div class="section-product">
    <div class="mx-4 mt-2">
      <div class="row py-5 text-center">
        <?php if (!empty($row)) : ?>
          <?php $i = 1;
          foreach ($row as $data) : ?>
            <div class="my-3 col-sm-6 col-md-3 col-lg-2">
              <div class="card shadow">
                <div>
                  <img src="./frontend/images/data/<?= $data['gambar'] ?>" class="img-fluid card-img-top" alt="<?= $data['menu'] ?>">
                </div>
                <div class="card-body">
                  <h5 class="card-title"><?= $data['menu'] ?></h5>
                  <span style="font-size: 20px; color: gold;">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                  </span>
                  <h5>
                    <span class="price"><?php echo number_format($data['harga'], 2); ?></span>
                  </h5>
                  <a href="?f=home&m=keranjang&id=<?= $data['idmenu'] ?>" type="submit" name="add" class="btn btn-outline-success btn-sm my-2 mr-2"><i class="fas fa-shopping-cart"></i> add cart </a>

                  <a href="?f=home&m=detail&id=<?= $data['idmenu'] ?>" class="btn btn-outline-success btn-sm my-2 mr-2">Lihat Detail</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</main>

<footer class="section-footer mt-5 mb-4 border-top">
  <div class="container pt-5 pb-5">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="row">
          <div class="col-12 col-lg-3">
            <h5>Perusahaan</h5>
            <ul>
              <li><a href="#">Tentang</a></li>
              <li><a href="#">Produk</a></li>
              <li><a href="#">Blog</a></li>
            </ul>
          </div>
          <div class="col-12 col-lg-3">
            <h5>Gabung</h5>
            <ul>
              <li><a href="#">Mitra Driver</a></li>
              <li><a href="#">Mitra Usaha</a></li>
            </ul>
          </div>
          <div class="col-12 col-lg-3">
            <h5>Hubungi Kami</h5>
            <ul>
              <li><a href="#">Bantuan</a></li>
              <li><a href="#">Kontak</a></li>
            </ul>
          </div>
          <div class="col-12 col-lg-3">
            <h5>Carrer</h5>
            <ul>
              <li><a href="#">Pelajar</a></li>
              <li><a href="#">Profesional</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row border-top justify-content-center pt-4">
      <div class="col-auto text-gray-500 font-wight-light">
        2021 Copyright Banyu Bening | All Right Resserved | Made In Indonesia
      </div>
    </div>
  </div>
</footer>