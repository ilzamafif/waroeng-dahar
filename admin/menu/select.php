<?php

if (isset($_POST['opsi'])) {
  $opsi = $_POST['opsi'];
  $where = "WHERE idkategori= $opsi";
} else {
  $opsi = 0;
  $where = "";
}

$jumlahDataPerHalaman = 5;
$jumlahData = $db->rowCount("SELECT idmenu FROM tblmenu $where");
$JumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$row = $db->getAll("SELECT * FROM tblmenu $where ORDER BY idmenu ASC LIMIT $awalData , $jumlahDataPerHalaman");
$rows = $db->getAll("SELECT * FROM tblkategori ORDER BY kategori ASC");

?>

<div class="container-fluid">

  <h1 class="h3 mb-2 text-gray-800">Data Menu</h1>
  <a href="?f=menu&m=insert" class="btn btn-sm btn-primary shadow-sm">
    <i class="fas fa-plus a-sm text-white-sm"></i> Tambah menu
  </a>

  <div class="row mt-3">
    <div class="col-lg-6">
      <?php Flasher::flash(); ?>
    </div>
  </div>

  <div class="card shadow my-3">
    <div class="card-header py-3 ">
      <h6 class="font-weight-bold text-primary ">Data Menu</h6>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <select name="opsi" class="custom-select mb-3" style="width: auto;" data-sortOrder onchange="this.form.submit()">
          <?php foreach ($rows as $r) : ?>
            <option <?php if ($r['idkategori'] == $opsi) echo "selected"; ?> value="<?= $r['idkategori']; ?>"><?= $r['kategori']; ?></option>
          <?php endforeach; ?>
        </select>
      </form>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Menu</th>
              <th>Harga</th>
              <th>Gambar</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($row)) : ?>
              <?php $i = 1;
              foreach ($row as $data) : ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td>
                    <strong><?= $data['menu'] ?></strong>
                  </td>
                  <td>
                    <?= $data['harga'] ?>
                  </td>
                  <td>
                    <img src="../images/<?= $data['gambar'] ?>" width="150px">
                  </td>
                  <td>
                    <form action="" method="post">
                      <a href="?f=menu&m=update&id=<?= $data['idmenu']; ?>" class="btn btn-sm btn-primary shadow-sm my-2"><i class="fas fa-pencil-alt"></i> Ubah</a>
                      <a href="?f=menu&m=delete&id=<?= $data['idmenu']; ?>" class="btn btn-danger btn-sm"><i class=" fas fa-trash"></i> Hapus</a>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="5" class="text-center">Data Kosong</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>

        <nav>
          <ul class="pagination justify-content-end">

            <?php if ($halamanAktif > 1) : ?>
              <li class="page-item">
                <a href="?f=menu&m=select&halaman=<?= $halamanAktif - 1; ?>" class="page-link">Previous</a>
              </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $JumlahHalaman; $i++) : ?>
              <?php if ($i == $halamanAktif) : ?>
                <li class="page-item text-bold"><a href="?f=menu&m=select&halaman=<?= $i ?>" class="page-link"><?= $i ?></a></li>
              <?php else : ?>
                <li class="page-item"><a href="?f=menu&m=select&halaman=<?= $i ?>" class="page-link"><?= $i ?></a></li>
              <?php endif; ?>
            <?php endfor; ?>



            <?php if ($halamanAktif < $JumlahHalaman) : ?>
              <li class=" page-item">
                <a href="?f=menu&m=select&halaman=<?= $halamanAktif + 1; ?>" class="page-link">Next</a>
              </li>
            <?php endif; ?>
          </ul>
        </nav>

      </div>
    </div>
  </div>

</div>