<?php

class TransaksiController {

    public function index() {

        $cart = $_SESSION['cart'] ?? [];

        require __DIR__ . '/../views/dashboard/cart.php';
    }

    public function addToCart() {

        $id = $_POST['id_produk'];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $_SESSION['cart'][] = $id;

        $_SESSION['cart_count'] = count($_SESSION['cart']);

        header("Location: /dashboard"); // ⬅️ penting
        exit;
    }
 public function beli() {

    $id = $_POST['id_produk'];
    $alamat = $_POST['alamat'];
    $metode = $_POST['metode'];

    $db = new PDO("mysql:host=localhost;dbname=db_ecommerce", "root", "");

    $stmt = $db->prepare("SELECT * FROM produk WHERE id_produk=?");
    $stmt->execute([$id]);
    $produk = $stmt->fetch();

    $jumlah = 1;
    $total = $produk['harga'] * $jumlah;

    $stmt = $db->prepare("
        INSERT INTO transaksi (id_produk, jumlah, total, alamat, metode_pembayaran)
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->execute([$id, $jumlah, $total, $alamat, $metode]);

    echo "<script>
        alert('Transaksi berhasil!');
        window.location='/transaksi';
    </script>";
}
public function transaksi() {

    $db = new PDO("mysql:host=localhost;dbname=db_ecommerce", "root", "");

    $data = $db->query("
        SELECT t.*, p.nama_produk, p.gambar
        FROM transaksi t
        JOIN produk p ON t.id_produk = p.id_produk
        ORDER BY t.id_transaksi DESC
    ")->fetchAll();

    require __DIR__ . '/../views/dashboard/transaksi.php';
}
public function checkout() {

    $id = $_GET['id_produk'];

    $db = new PDO("mysql:host=localhost;dbname=db_ecommerce", "root", "");

    $stmt = $db->prepare("SELECT * FROM produk WHERE id_produk=?");
    $stmt->execute([$id]);
    $produk = $stmt->fetch();

    require __DIR__ . '/../views/dashboard/chekout.php';
}
}