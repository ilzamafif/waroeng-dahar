<?php

class DB
{
  private $host = "127.0.0.1";
  private $user = "root";
  private $pass = "";
  private $database = "wd";
  private $koneksi;

  public function __construct()
  {
    $this->koneksi = $this->koneksiDB();
  }

  public function koneksiDB()
  {
    $koneksi = mysqli_connect($this->host, $this->user, $this->pass, $this->database);
    return $koneksi;
  }

  public function getAll($sql)
  {
    $result = mysqli_query($this->koneksi, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }

    if (!empty($data)) {
      return $data;
    }
  }

  public function getItem($sql)
  {
    $result = mysqli_query($this->koneksi, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row;
  }

  public function rowCount($sql)
  {
    $result = mysqli_query($this->koneksi, $sql);
    $count = mysqli_num_rows($result);
    return $count;
  }

  public function runSql($sql)
  {
    $result = mysqli_query($this->koneksi, $sql);
  }

   public function getDate($tgl1, $tgl2)
  {
    $result = mysqli_query($this->koneksi, "SELECT * FROM tblorder WHERE tglorder BETWEEN $tgl1 AND $tgl2");
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }

    if (!empty($data)) {
      return $data;
    }
  }
}
