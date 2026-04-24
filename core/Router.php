<?php

class Router {
    private $routes = [];

    public function get($url, $action) {
        $this->routes['GET'][$url] = $action;
    }

    public function post($url, $action) {
        $this->routes['POST'][$url] = $action;
    }

public function run() {
    $method = $_SERVER['REQUEST_METHOD'];
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // hapus slash di akhir
    $url = rtrim($url, '/');

    // kalau kosong jadi '/'
    if ($url == '') {
        $url = '/';
    }

    if (isset($this->routes[$method][$url])) {
        list($controller, $methodAction) = explode('@', $this->routes[$method][$url]);
        $controller = new $controller();
        call_user_func([$controller, $methodAction]);
    } else {
        echo "404 Not Found";
    }
}
}