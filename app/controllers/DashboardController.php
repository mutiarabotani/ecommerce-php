<?php
require_once __DIR__ . '/../models/Produk.php';

class DashboardController {

    private $db;
    private $produkModel;

    // KONEKSI DATABASE
    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=shop_db", "root", "");
        $this->produkModel = new Produk($this->db);
    }

    // 🔐 CEK LOGIN
    private function checkLogin() {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
    }

    public function index() {
        $this->checkLogin();

        $data = $this->produkModel->getAll();

        include __DIR__ . '/../views/dashboard/dashboard.php';
    }

    public function logout() {
        session_destroy();
        header("Location: /login");
        exit;
    }
    public function detail() {

    $id = $_GET['id'];

    $db = new PDO("mysql:host=localhost;dbname=db_ecommerce", "root", "");

    $stmt = $db->prepare("SELECT * FROM produk WHERE id_produk=?");
    $stmt->execute([$id]);

    $produk = $stmt->fetch();

    require __DIR__ . '/../views/dashboard/detail.php';
}
}