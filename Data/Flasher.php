<?php

class Flasher
{
  public static function setFlash($pesan, $aksi, $tabel, $tipe)
  {
    $_SESSION['flash'] = [
      'pesan' => $pesan,
      'aksi'  => $aksi,
      'tabel'  => $tabel,
      'tipe'  => $tipe
    ];
  }

  public static function flash()
  {
    if (isset($_SESSION['flash'])) {
      echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible fade show" role="alert">
              <strong>' . $_SESSION['flash']['tabel'] . ' ' . $_SESSION['flash']['pesan'] . '</strong> ' . $_SESSION['flash']['aksi'] . '
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>';
      unset($_SESSION['flash']);
    }
  }

  public static function flash5()
  {
    if (isset($_SESSION['flash'])) {
      echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible fade show" role="alert">
              <strong>' . $_SESSION['flash']['tabel'] . ' ' . $_SESSION['flash']['pesan'] . '</strong> ' . $_SESSION['flash']['aksi'] . '
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
      unset($_SESSION['flash']);
    }
  }
}
