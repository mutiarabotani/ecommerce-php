<!DOCTYPE html>
<html>
<head>
    <title>Fashion Shop</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fdf2f8, #f1f5f9);
        }

        .navbar {
            background: linear-gradient(90deg, #ec4899, #f43f5e);
            color: white;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-weight: 600;
            font-size: 20px;
        }

        .search {
            width: 40%;
            display: flex;
        }

        .search input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px 0 0 8px;
        }

        .search button {
            padding: 10px;
            border: none;
            background: #1e293b;
            color: white;
            border-radius: 0 8px 8px 0;
        }

        .cart {
            text-decoration: none;
            color: white;
            position: relative;
            font-size: 22px;
        }

        .cart span {
            position: absolute;
            top: -8px;
            right: -10px;
            background: red;
            font-size: 12px;
            padding: 3px 7px;
            border-radius: 50%;
        }

        .container {
            padding: 40px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            gap: 25px;
        }

        .card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
        }

        .price {
            color: #e11d48;
            font-weight: bold;
        }

        .btn {
            padding: 8px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            margin-top: 5px;
        }

        .cart-btn {
            background: orange;
            color: white;
        }

        .buy-btn {
            background: #ec4899;
            color: white;
        }
    </style>
</head>

<body>

<div class="navbar">
    <div class="logo">Fashion Shop</div>

    <div class="search">
        <input type="text" placeholder="Cari pakaian...">
        <button>🔍</button>
    </div>

    <!-- ICON CART -->
    <a href="/cart" class="cart">
        🛒
        <span><?= $_SESSION['cart_count'] ?? 0 ?></span>
    </a>
</div>

<div class="container">

    <h3>Koleksi Fashion</h3>

    <div class="grid">

        <?php foreach($data as $p): ?>

        <?php
        // ambil gambar dari database
        $img = "/public/img/" . (!empty($p['gambar']) ? $p['gambar'] : "default.png");
        ?>

        <div class="card">

            <img src="<?= $img ?>" alt="produk">

            <div class="card-body">

                <h4><?= $p['nama_produk'] ?></h4>

                <div class="price">
                    Rp <?= number_format($p['harga']) ?>
                </div>

                <div>⭐⭐⭐⭐⭐</div>

                <form method="POST" action="/cart">
                    <input type="hidden" name="id_produk" value="<?= $p['id_produk'] ?>">
                    <button type="submit" class="btn cart-btn">+ Keranjang</button>
                </form>

            <form method="GET" action="/checkout">
                <input type="hidden" name="id_produk" value="<?= $p['id_produk'] ?>">
                <button type="submit" class="btn buy-btn">Beli</button>
            </form>
                        </div>

        </div>

        <?php endforeach; ?>

    </div>

</div>

</body>
</html>