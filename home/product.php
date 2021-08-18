<?php
$row = $db->getAll("SELECT * FROM tblmenu");
?>

<header>
  <div class="hero">
    <h1 class="tagline">Welcome To Waroeng Dahar</h1>
    <p class="tagline-2">Menyediakan makanan dan minuman dengan berbagai macam rasa</p>
    <a href="#main" class="btn btn-outline-primary mx-auto btn-order ">Order Now</a>
  </div>
</header>

<main id="main">
  <div class="section-product">
    <div class="mx-4 mt-2">
      <div class="row py-5 text-center">
        <?php if (!empty($row)) : ?>
          <?php $i = 1;
          foreach ($row as $data) : ?>
            <div class="col-md-4 col-sm-6 my-3 col-lg-3">
              <div class="card shadow mb-3 pt-3">
                <div>
                  <img src="./frontend/images/data/<?= $data['gambar'] ?>" class="img-fluid card-img-top" style="height:250px" alt="<?= $data['menu'] ?>">
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
                    <!-- <small><s class="text-secondary">10%</s></small> -->
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

<footer>
  <p>Copyright © 2021 | Waroeng Dahar</p>
</footer>

<!-- <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Menu <?= $data['menu'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span class="fa fa-arrow-righ t"></span>
        </button>
      </div>
      <div class="modal-body">

              <?php
                $id = $data['idmenu'];
                var_dump($id);
                $s = $db->getAll("SELECT * FROM tblmenu WHERE idmenu = $id"); 
              ?>                          


        <div class="row justify-content-center">
          <div class="col-md-5 mr-3">
            <img src="./images/<?= $s[0]['gambar'] ?>" class="img-fluid card-img-top" style="height:100%">
          </div>
          <div class="col-md-5">
            <h5 class="card-title"><?= $s[0]['menu'] ?></h5>
              <span style="font-size: 20px; color: gold;">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
              </span>
              <h5>
                <small><s class="text-secondary">10%</s></small>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sapiente non debitis quia culpa dolor, expedita reprehenderit impedit alias nobis, dolorem suscipit magnam neque? Ea, ab. Ex doloribus suscipit tenetur placeat repellat, pariatur voluptatem omnis molestiae modi quisquam, labore sapiente velit?</p>
                <span class="price"><?php echo number_format($s[0]['harga'], 2); ?></span>
              </h5>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="?f=home&m=keranjang&id=<?= $data['idmenu'] ?>" type="submit" name="add" class="btn btn-outline-success mr-3"><i class="fas fa-shopping-cart"></i> add cart
          <span class="iconify" data-icon="ei-cart" data-inline="false"></span>
        </a>
      </div>
    </div>
  </div>
</div> -->