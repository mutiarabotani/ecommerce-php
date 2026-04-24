<?php
require_once __DIR__ . '/../../config/database.php';

class User {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // REGISTER
    public function register($username, $email, $password) {

        // cek email sudah ada
        $check = $this->conn->prepare("SELECT * FROM user WHERE email = ?");
        $check->execute([$email]);

        if($check->rowCount() > 0){
            return "Email sudah digunakan";
        }

        $stmt = $this->conn->prepare("
            INSERT INTO user (username, email, password)
            VALUES (?, ?, ?)
        ");

        $stmt->execute([
            $username,
            $email,
            password_hash($password, PASSWORD_DEFAULT)
        ]);

        return true;
    }

    // LOGIN
    public function login($email, $password) {

        $stmt = $this->conn->prepare("
            SELECT * FROM user WHERE email = ?
        ");

        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])){
            return $user;
        }

        return false;
    }
}