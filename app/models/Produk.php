<?php
class Produk {

    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getAll(){
        $stmt = $this->db->query("SELECT * FROM produk");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}