<?php
class Database {
    public function connect() {
        return new PDO("mysql:host=localhost;dbname=ecommerce_db", "root", "");
    }
}