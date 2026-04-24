<?php
require_once __DIR__ . '/../models/Produk.php';

class DashboardController {

    private $db;
    private $produkModel;

    // 🔥 KONEKSI DATABASE
    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=db_ecommerce", "root", "");
        $this->produkModel = new Produk($this->db);
    }

    // 🔐 CEK LOGIN
    private function checkLogin() {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
    }

    // ================= DASHBOARD (SHOWCASE PRODUK) =================
    public function index() {
        $this->checkLogin();

        $data = $this->produkModel->getAll();

        include __DIR__ . '/../views/dashboard/dashboard.php';
    }

    // ================= LOGOUT =================
    public function logout() {
        session_destroy();
        header("Location: /login");
        exit;
    }
}