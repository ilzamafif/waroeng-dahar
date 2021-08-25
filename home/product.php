<?php
$row = $db->getAll("SELECT * FROM tblkategori INNER JOIN tblmenu ON (tblmenu.idkategori = tblkategori.idkategori)");

?>

<header>
  <div class="hero">
    <h1 class="title">Welcome To Waroeng Dahar</h1>
    <p class="tagline">Menyediakan makanan dan minuman dengan berbagai macam rasa</p>
  </div>
</header>

<main id="main">
  <div class="section-product">
    <div class="row py-5 text-left mx-2">
      <?php if (!empty($row)) : ?>
        <?php $i = 1;
        foreach ($row as $data) : ?>
          <div class="my-3 col-6 col-sm-4 col-md-3 col-lg-2">
            <div class="card shadow">
              <div>
                <img src="./frontend/images/data/<?= $data['gambar'] ?>" class="img-fluid card-img-top" alt="<?= $data['menu'] ?>" style="width: 188px; height: 188px;">
              </div>
              <div class="card-body">
                <h5 class="card__title"><?= $data['menu'] ?></h5>
                <p class="card__category badge bg-success badge-sm">
                  <?= $data['kategori'] ?>
                </p>
                <h5 class="card__price">RP. <?php echo number_format($data['harga'], 2); ?></h5>
                <a href="?f=home&m=keranjang&id=<?= $data['idmenu'] ?>" class="btn btn-outline-primary btn-sm btn-block">add to cart</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>

  <section class="section-method">
    <h3 class="text-center mb-4">Tutorial mesen makanan</h3>
    <div class="container">
      <div class="row mt-4">
        <div class="col-12 col-md-4 col-lg-3">
          <h4>Pilih Menu</h4>
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. In possimus odit dolor nostrum nihil excepturi corporis fugit nobis, error quia labore qui nesciunt doloremque ducimus libero distinctio minima inventore voluptatum.</p>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
          <h4>masukkan keranjang & checkout</h4>
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. In possimus odit dolor nostrum nihil excepturi corporis fugit nobis, error quia labore qui nesciunt doloremque ducimus libero distinctio minima inventore voluptatum.</p>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
          <h4>cek alamat</h4>
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. In possimus odit dolor nostrum nihil excepturi corporis fugit nobis, error quia labore qui nesciunt doloremque ducimus libero distinctio minima inventore voluptatum.</p>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
          <h4>sukses</h4>
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. In possimus odit dolor nostrum nihil excepturi corporis fugit nobis, error quia labore qui nesciunt doloremque ducimus libero distinctio minima inventore voluptatum.</p>
        </div>
      </div>
    </div>
  </section>
</main>

<footer class="section-footer mt-5 mb-4 border-top bg-dark text-light">
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