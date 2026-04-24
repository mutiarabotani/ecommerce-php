<?php

class TransaksiController {

    public function index() {

    $db = new PDO("mysql:host=localhost;dbname=db_ecommerce", "root", "");

    $cart = $_SESSION['cart'] ?? [];

    $data = [];

    if(!empty($cart)){

        // hitung jumlah tiap produk
        $qty = array_count_values($cart);

        $ids = implode(',', array_keys($qty));

        $produk = $db->query("SELECT * FROM produk WHERE id_produk IN ($ids)")->fetchAll();

        foreach($produk as $p){
            $p['qty'] = $qty[$p['id_produk']];
            $p['subtotal'] = $p['harga'] * $p['qty'];
            $data[] = $p;
        }
    }

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
public function updateQty() {
    $id = $_POST['id'];
    $action = $_POST['action']; // plus / minus

    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $key => $value){
            if($value == $id){
                if($action == 'minus'){
                    unset($_SESSION['cart'][$key]);
                    break;
                } else {
                    $_SESSION['cart'][] = $id;
                    break;
                }
            }
        }
    }
    header("Location: /cart");
}

public function removeItem() {
    $id = $_POST['id'];
    $_SESSION['cart'] = array_filter($_SESSION['cart'], fn($v) => $v != $id);
    header("Location: /cart");
}
public function checkoutCartView() {

    $db = new PDO("mysql:host=localhost;dbname=db_ecommerce", "root", "");

    $cart = $_SESSION['cart'] ?? [];

    $data = [];

    if(!empty($cart)){

        $qty = array_count_values($cart);
        $ids = implode(',', array_keys($qty));

        $produk = $db->query("SELECT * FROM produk WHERE id_produk IN ($ids)")->fetchAll();

        foreach($produk as $p){
            $p['qty'] = $qty[$p['id_produk']];
            $p['subtotal'] = $p['harga'] * $p['qty'];
            $data[] = $p;
        }
    }

    require __DIR__ . '/../views/dashboard/checkout_cart.php';
}
public function checkoutCartProcess() {

    $db = new PDO("mysql:host=localhost;dbname=db_ecommerce", "root", "");

    $alamat = $_POST['alamat'];
    $metode = $_POST['metode'];

    $cart = $_SESSION['cart'] ?? [];

    if(empty($cart)){
        header("Location: /cart");
        exit;
    }

    $qty = array_count_values($cart);

    foreach($qty as $id => $jumlah){

        $stmt = $db->prepare("SELECT * FROM produk WHERE id_produk=?");
        $stmt->execute([$id]);
        $p = $stmt->fetch();

        $total = $p['harga'] * $jumlah;

        $stmt = $db->prepare("
            INSERT INTO transaksi (id_produk, jumlah, total, alamat, metode_pembayaran, status)
            VALUES (?, ?, ?, ?, ?, 'Menunggu')
        ");

        $stmt->execute([$id, $jumlah, $total, $alamat, $metode]);
    }

    // kosongkan cart
    unset($_SESSION['cart']);
    $_SESSION['cart_count'] = 0;

    echo "<script>alert('Checkout berhasil!');window.location='/transaksi';</script>";
}
public function updateStatus() {

    $id = $_POST['id'];
    $status = $_POST['status'];

    $db = new PDO("mysql:host=localhost;dbname=db_ecommerce", "root", "");

    $stmt = $db->prepare("UPDATE transaksi SET status=? WHERE id_transaksi=?");
    $stmt->execute([$status, $id]);

    header("Location: /transaksi");
}
public function cancelOrder() {

    $id = $_POST['id'];

    $db = new PDO("mysql:host=localhost;dbname=db_ecommerce", "root", "");

    // hanya bisa cancel jika masih Menunggu
    $stmt = $db->prepare("UPDATE transaksi 
                          SET status='Dibatalkan' 
                          WHERE id_transaksi=? AND status='Menunggu'");
    $stmt->execute([$id]);

    header("Location: /transaksi");
}
}