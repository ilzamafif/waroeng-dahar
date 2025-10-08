-- Database: waroeng_dahar
-- This database will be used for the Waroeng Dahar restaurant ordering system

-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS wd CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE wd;

-- Table structure for tblkategori
CREATE TABLE tblkategori (
  idkategori INT(11) NOT NULL AUTO_INCREMENT,
  kategori VARCHAR(100) NOT NULL,
  PRIMARY KEY (idkategori)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for tblmenu
CREATE TABLE tblmenu (
  idmenu INT(11) NOT NULL AUTO_INCREMENT,
  idkategori INT(11) NOT NULL,
  menu VARCHAR(255) NOT NULL,
  harga DECIMAL(10,2) NOT NULL,
  gambar VARCHAR(255) DEFAULT NULL,
  aktif ENUM('Y', 'N') DEFAULT 'Y',
  PRIMARY KEY (idmenu),
  FOREIGN KEY (idkategori) REFERENCES tblkategori(idkategori) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for tblpelanggan
CREATE TABLE tblpelanggan (
  idpelanggan INT(11) NOT NULL AUTO_INCREMENT,
  pelanggan VARCHAR(100) NOT NULL,
  alamat TEXT NOT NULL,
  telp VARCHAR(15) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  aktif ENUM('Y', 'N') DEFAULT 'Y',
  PRIMARY KEY (idpelanggan),
  UNIQUE KEY unique_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for tbluser
CREATE TABLE tbluser (
  iduser INT(11) NOT NULL AUTO_INCREMENT,
  user VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  level ENUM('admin', 'owner', 'employee') NOT NULL DEFAULT 'employee',
  aktif ENUM('Y', 'N') DEFAULT 'Y',
  PRIMARY KEY (iduser),
  UNIQUE KEY unique_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for tblorder
CREATE TABLE tblorder (
  idorder INT(11) NOT NULL AUTO_INCREMENT,
  idpelanggan INT(11) NOT NULL,
  tglorder DATETIME NOT NULL,
  total DECIMAL(10,2) NOT NULL,
  bayar DECIMAL(10,2) NOT NULL DEFAULT 0,
  kembali DECIMAL(10,2) NOT NULL DEFAULT 0,
  status TINYINT(1) NOT NULL DEFAULT 0, -- 0 = pending, 1 = confirmed
  PRIMARY KEY (idorder),
  FOREIGN KEY (idpelanggan) REFERENCES tblpelanggan(idpelanggan) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for tblorderdetail
CREATE TABLE tblorderdetail (
  idorderdetail INT(11) NOT NULL AUTO_INCREMENT,
  idorder INT(11) NOT NULL,
  idmenu INT(11) NOT NULL,
  jumlah INT(11) NOT NULL,
  harga DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (idorderdetail),
  FOREIGN KEY (idorder) REFERENCES tblorder(idorder) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (idmenu) REFERENCES tblmenu(idmenu) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert initial data for tblkategori
INSERT INTO tblkategori (kategori) VALUES 
('Makanan'),
('Minuman'),
('Dessert'),
('Snack');

-- Insert initial data for tbluser (default admin user)
INSERT INTO tbluser (user, email, password, level, aktif) VALUES
('Admin', 'admin@waroengdahar.com', 'admin123', 'admin', 'Y'),
('Owner', 'owner@waroengdahar.com', 'owner123', 'owner', 'Y');

-- Insert sample data for tblpelanggan
INSERT INTO tblpelanggan (pelanggan, alamat, telp, email, password, aktif) VALUES
('John Doe', 'Jl. Merdeka No. 123, Jakarta', '081234567890', 'johndoe@example.com', 'password123', 'Y'),
('Jane Smith', 'Jl. Sudirman No. 456, Surabaya', '082345678901', 'janesmith@example.com', 'password123', 'Y');

-- Insert sample data for tblmenu
INSERT INTO tblmenu (idkategori, menu, harga, gambar, aktif) VALUES
(1, 'Nasi Goreng', 25000.00, 'nasgor.jpg', 'Y'),
(1, 'Mie Ayam', 20000.00, 'mieayam.jpg', 'Y'),
(2, 'Es Teh', 5000.00, 'esteh.jpg', 'Y'),
(2, 'Jus Alpukat', 15000.00, 'jusalpukat.jpg', 'Y'),
(3, 'Es Krim', 10000.00, 'es_krim.jpg', 'Y'),
(4, 'Keripik Singkong', 8000.00, 'keripik.jpg', 'Y');