<?php
session_start();

require_once 'core/Router.php';

// CONTROLLER YANG DIPAKAI SAJA
require_once 'app/controllers/AuthController.php';
require_once 'app/controllers/DashboardController.php';
require_once 'app/controllers/TransaksiController.php';

$router = new Router();

/* ================= ROUTES ================= */

// AUTH
$router->get('/', 'AuthController@login');
$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@processLogin');

$router->get('/register', 'AuthController@register');
$router->post('/register', 'AuthController@processRegister');

// DASHBOARD
$router->get('/dashboard', 'DashboardController@index');


// TRANSAKSI
$router->post('/cart', 'TransaksiController@addToCart');
$router->get('/cart', 'TransaksiController@index'); 
$router->post('/beli', 'TransaksiController@beli');
$router->get('/transaksi', 'TransaksiController@transaksi');
$router->get('/checkout', 'TransaksiController@checkout');
$router->post('/updateQty', 'TransaksiController@updateQty');
$router->post('/removeItem', 'TransaksiController@removeItem');
$router->get('/checkoutCart', 'TransaksiController@checkoutCartView');
$router->post('/checkoutCart', 'TransaksiController@checkoutCartProcess');
$router->post('/updateStatus', 'TransaksiController@updateStatus');
$router->post('/cancelOrder', 'TransaksiController@cancelOrder');

// LOGOUT
$router->get('/logout', 'AuthController@logout');

// JALANKAN
$router->run();