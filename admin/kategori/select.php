<?php
$jumlahDataPerHalaman = 4;
$jumlahData = $db->rowCount("SELECT idkategori FROM tblkategori");
$JumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$row = $db->getAll("SELECT * FROM tblkategori ORDER BY kategori ASC LIMIT $awalData , $jumlahDataPerHalaman");

?>

<div class="container-fluid">

  <h1 class="h3 mb-2 text-gray-800">Data kategori</h1>
  <a href="?f=kategori&m=insert" class="btn btn-sm btn-primary shadow-sm">
    <i class="fas fa-plus a-sm text-white-sm"></i> Tambah produk
  </a>

  <div class="row mt-3">
    <div class="col-lg-6">
      <?php Flasher::flash(); ?>
    </div>
  </div>

  <div class="card shadow my-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data kategori</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>kategori</th>
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
                    <strong><?= $data['kategori'] ?></strong><br>
                  </td>
                  <td>
                    <form action="" method="post">
                      <a href="?f=kategori&m=update&id=<?= $data['idkategori']; ?>" class="btn btn-sm btn-primary shadow-sm my-2">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Ubah</a>
                      <a href="?f=kategori&m=delete&id=<?= $data['idkategori']; ?>" class="btn btn-danger btn-sm"><i class=" fas fa-trash">
                        </i> Hapus</a>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="3" class="text-center">Data Kosong</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>

        <nav>
          <ul class="pagination justify-content-end">

            <?php if ($halamanAktif > 1) : ?>
              <li class="page-item">
                <a href="?f=kategori&m=select&halaman=<?= $i - 1; ?>" class="page-link">Previous</a>
              </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $JumlahHalaman; $i++) : ?>
              <?php if ($i == $halamanAktif) : ?>
                <li class="page-item text-bold"><a href="?f=kategori&m=select&halaman=<?= $i ?>" class="page-link"><?= $i ?></a></li>
              <?php else : ?>
                <li class="page-item"><a href="?f=kategori&m=select&halaman=<?= $i ?>" class="page-link"><?= $i ?></a></li>
              <?php endif; ?>
            <?php endfor; ?>



            <?php if ($halamanAktif < $JumlahHalaman) : ?>
              <li class=" page-item">
                <a href="?f=kategori&m=select&halaman=<?= $halamanAktif + 1; ?>" class="page-link">Next</a>
              </li>
            <?php endif; ?>
          </ul>
        </nav>

      </div>
    </div>
  </div>

</div>