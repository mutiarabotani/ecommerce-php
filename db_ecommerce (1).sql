CREATE DATABASE IF NOT EXISTS db_ecommerce;
USE db_ecommerce;

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

CREATE TABLE detail_transaksi (
  id_detail int(11) NOT NULL AUTO_INCREMENT,
  id_transaksi int(11),
  id_produk int(11),
  jumlah int(11),
  subtotal int(11),
  PRIMARY KEY (id_detail)
);

CREATE TABLE kategori (
  id_kategori int(11) NOT NULL AUTO_INCREMENT,
  nama_kategori varchar(100),
  keterangan text,
  PRIMARY KEY (id_kategori)
);

INSERT INTO kategori VALUES
(1, 'Elektronik', 'Barang elektronik'),
(2, 'Aksesoris', 'Perangkat tambahan');

CREATE TABLE supplier (
  id_supplier int(11) NOT NULL AUTO_INCREMENT,
  nama_supplier varchar(100),
  alamat text,
  no_hp varchar(15),
  PRIMARY KEY (id_supplier)
);

INSERT INTO supplier VALUES
(1, 'PT Teknologi', 'Jakarta', '08123456789');

CREATE TABLE produk (
  id_produk int(11) NOT NULL AUTO_INCREMENT,
  nama_produk varchar(100),
  harga int(11),
  stok int(11),
  id_kategori int(11),
  id_supplier int(11),
  gambar varchar(255),
  PRIMARY KEY (id_produk)
);

INSERT INTO produk VALUES
(5, 'Baju Casual Wanita', 8000000, 10, 1, 1, 'baju_wanita.png'),
(6, 'Hoodie Oversize', 150000, 25, 2, 1, 'hodie.png'),
(7, 'Jaket Denim Pria', 350000, 15, 2, 1, 'jaket_denim.png'),
(8, 'Celana Jeans Slim Fit', 200000, 20, 2, 1, 'celana_jeans.png'),
(9, 'Basic Crop', 120000, NULL, NULL, NULL, 'Basic_Crop.png'),
(15, 'Kaos Polos Hitam', 80000, NULL, NULL, NULL, 'kaos_hitam.png'),
(16, 'Kaos Polos Putih', 80000, NULL, NULL, NULL, 'Kaso_putih.png'),
(17, 'Sweater Wanita', 170000, NULL, NULL, NULL, 'sweater.png'),
(18, 'Kemeja Flanel', 190000, NULL, NULL, NULL, 'kemeja_flanel.png'),
(19, 'Rok Mini Wanita', 140000, NULL, NULL, NULL, 'rok.png'),
(20, 'Dress Casual', 220000, NULL, NULL, NULL, 'dress.png'),
(21, 'Cardigan Rajut', 160000, NULL, NULL, NULL, 'cardigan.png'),
(22, 'Celana Cargo', 200000, NULL, NULL, NULL, 'celana_jeans.png'),
(23, 'Sepatu Sneakers', 350000, NULL, NULL, NULL, 'sneaker.png'),
(24, 'Tas Selempang', 130000, NULL, NULL, NULL, 'tas.png'),
(25, 'Topi Fashion', 90000, NULL, NULL, NULL, 'topi.png'),
(26, 'Blouse Wanita', 150000, NULL, NULL, NULL, 'blouse.png'),
(27, 'Jaket Parasut', 250000, NULL, NULL, NULL, 'jaket_denim.png'),
(28, 'Kemeja Putih Formal', 180000, NULL, NULL, NULL, 'kemeja_putih.png'),
(29, 'Celana Kulot', 170000, NULL, NULL, NULL, 'topi.png');

CREATE TABLE transaksi (
  id_transaksi int(11) NOT NULL AUTO_INCREMENT,
  tanggal date,
  total int(11),
  id_produk int(11),
  jumlah int(11),
  alamat text,
  metode_pembayaran varchar(50),
  status varchar(20) DEFAULT 'Menunggu',
  PRIMARY KEY (id_transaksi)
);

INSERT INTO transaksi VALUES
(1, NULL, 150000, 6, 1, NULL, NULL, 'Menunggu'),
(2, NULL, 150000, 6, 1, NULL, NULL, 'Menunggu'),
(3, NULL, 150000, 6, 1, 'Kp Cikoranji', 'COD', 'Menunggu'),
(4, NULL, 120000, 9, 1, 'bandung', 'COD', 'Menunggu'),
(5, NULL, 140000, 19, 1, 'bandung', 'COD', 'Menunggu');

CREATE TABLE user (
  id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(50),
  password varchar(100),
  email varchar(100),
  PRIMARY KEY (id)
);

INSERT INTO user VALUES
(1, 'admin', '123', NULL),
(2, 'Mutiara Botani', '$2y$12$Yf3VzSg6EsEEXZW1fgg.IOh76xdEAokaHCkBrtNaJ1YUaIwG/nY4.', NULL),
(3, 'Silvia', '$2y$12$xams5ruY6dIJTa35q16lW.Ruv0Z8GKrsajd2E2eVX.wdHYx/MtGB2', 'sipiada11@gmail.com'),
(4, 'Mutiara Botani', '$2y$12$d4ll0k.xYMvS2UlrKAdn4.Kxj2vexOX/4py4whrA.l0XJpADzQTFm', 'mutiarabotani2222@gmail.com');

SET FOREIGN_KEY_CHECKS=1;

COMMIT;