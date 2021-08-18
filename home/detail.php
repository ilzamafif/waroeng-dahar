<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
}


$row = $db->getAll("SELECT * FROM tblmenu WHERE idmenu = $id"); 
?>


<main id="main">
  <div class="section-product mt-5">
    <div class="container justify-content-center card o-hidden w-75 border-0 shadow-lg py-3" style="min-height:60vh; margin-top:90px; margin-bottom:90px; ">
      <div class="row align-content-center">
          <div class="col-md-5">
            <?php if (!empty($row)) : ?>
              <?php $i = 1;
              foreach ($row as $data) : ?>
                <img src="./images/<?= $data['gambar'] ?>" class="img-fluid card-img-top" style="height:100%" alt="<?= $data['menu'] ?>"> 
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
          <div class="col-md-4 mt-3">
            <h5 class="title"><?= $data['menu'] ?></h5>
            <span style="font-size: 20px; color: gold;">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </span>
            <h5>
              <small><s class="text-secondary">10%</s></small>
              <span class="price"><?php echo number_format($data['harga'], 2); ?></span>
            </h5>
            <a href="?f=home&m=keranjang&id=<?= $data['idmenu'] ?>" type="submit" name="add" class="btn btn-outline-success btn-sm my-3"><i class="fas fa-shopping-cart"></i> add cart
              <span class="iconify" data-icon="ei-cart" data-inline="false"></span>
            </a>
          </div>
      </div>
    </div>
  </div>
</main>


<footer>
  <p>Copyright © 2021 | Waroeng Dahar</p>
</footer>