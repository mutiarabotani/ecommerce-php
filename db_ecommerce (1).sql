CREATE DATABASE IF NOT EXISTS db_ecommerce;
USE db_ecommerce;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

CREATE TABLE kategori (
  id_kategori INT AUTO_INCREMENT PRIMARY KEY,
  nama_kategori VARCHAR(100),
  keterangan TEXT
);

INSERT INTO kategori VALUES
(1, 'Fashion Pria', 'Produk pria'),
(2, 'Fashion Wanita', 'Produk wanita'),
(3, 'Aksesoris', 'Pelengkap fashion');

CREATE TABLE supplier (
  id_supplier INT AUTO_INCREMENT PRIMARY KEY,
  nama_supplier VARCHAR(100),
  alamat TEXT,
  no_hp VARCHAR(15)
);

INSERT INTO supplier VALUES
(1, 'PT Fashion Indo', 'Jakarta', '08123456789');

CREATE TABLE produk (
  id_produk INT AUTO_INCREMENT PRIMARY KEY,
  nama_produk VARCHAR(100),
  harga INT,
  stok INT,
  id_kategori INT,
  id_supplier INT,
  gambar VARCHAR(255),
  FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori),
  FOREIGN KEY (id_supplier) REFERENCES supplier(id_supplier)
);

INSERT INTO produk VALUES
(1, 'Baju Casual Wanita', 80000, 10, 2, 1, 'baju_wanita.png'),
(2, 'Hoodie Oversize', 150000, 25, 1, 1, 'hodie.png'),
(3, 'Jaket Denim', 350000, 15, 1, 1, 'jaket_denim.png'),
(4, 'Celana Jeans Slim Fit', 200000, 20, 1, 1, 'celana_jeans.png'),
(5, 'Basic Crop', 120000, 20, 2, 1, 'Basic_Crop.png'),
(6, 'Kaos Polos Hitam', 80000, 20, 1, 1, 'kaos_hitam.png'),
(7, 'Kaos Polos Putih', 80000, 20, 1, 1, 'Kaso_putih.png'),
(8, 'Sweater Wanita', 170000, 20, 2, 1, 'sweater.png'),
(9, 'Kemeja Flanel', 190000, 20, 1, 1, 'kemeja_flanel.png'),
(10, 'Rok Mini Wanita', 140000, 20, 2, 1, 'rok.png'),
(11, 'Dress Casual', 220000, 20, 2, 1, 'dress.png'),
(12, 'Cardigan Rajut', 160000, 20, 2, 1, 'cardigan.png'),
(13, 'Celana Cargo', 200000, 20, 1, 1, 'celana_jeans.png'),
(14, 'Sepatu Sneakers', 350000, 20, 3, 1, 'sneaker.png'),
(15, 'Tas Selempang', 130000, 20, 3, 1, 'tas.png'),
(16, 'Topi Fashion', 90000, 20, 3, 1, 'topi.png');

CREATE TABLE user (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50),
  password VARCHAR(100),
  email VARCHAR(100)
);

INSERT INTO user VALUES
(1, 'admin', '123', 'admin@gmail.com'),
(2, 'Silvia', '123', 'sipiada11@gmail.com');

CREATE TABLE transaksi (
  id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
  tanggal DATE,
  total INT,
  id_produk INT,
  jumlah INT,
  alamat TEXT,
  metode_pembayaran VARCHAR(50),
  status VARCHAR(20) DEFAULT 'Menunggu'
);

CREATE TABLE detail_transaksi (
  id_detail INT AUTO_INCREMENT PRIMARY KEY,
  id_transaksi INT,
  id_produk INT,
  jumlah INT,
  subtotal INT,
  FOREIGN KEY (id_transaksi) REFERENCES transaksi(id_transaksi),
  FOREIGN KEY (id_produk) REFERENCES produk(id_produk)
);

COMMIT;