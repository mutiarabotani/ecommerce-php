<!DOCTYPE html>
<html>
<head>
    <title>Keranjang</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f5f5;
        }

        .container {
            padding: 20px;
            max-width: 700px;
            margin: auto;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            display: flex;
            gap: 15px;
            align-items: center;
        }

        img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .info {
            flex: 1;
        }

        .price {
            color: #ee4d2d;
            font-weight: bold;
        }

        .qty {
            font-size: 13px;
            color: gray;
        }

        .total {
            font-weight: bold;
        }

        .footer {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            text-align: right;
        }

        .btn {
            padding: 10px 15px;
            background: #ee4d2d;
            color: white;
            border: none;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container">

<h2>🛒 Keranjang Belanja</h2>

<?php if(empty($data)): ?>

    <p>Keranjang kosong</p>

<?php else: ?>

    <?php $grandTotal = 0; ?>

    <?php foreach($data as $p): ?>

    <?php
    $img = "/public/img/" . ($p['gambar'] ?? 'default.png');
    $grandTotal += $p['subtotal'];
    ?>

    <div class="card">

        <img src="<?= $img ?>">

        <div class="info">
            <h4><?= $p['nama_produk'] ?></h4>
            <div class="price">Rp <?= number_format($p['harga']) ?></div>
            <div class="qty">Jumlah: <?= $p['qty'] ?></div>
        </div>

        <div class="total">
            Rp <?= number_format($p['subtotal']) ?>
        </div>

    </div>

    <?php endforeach; ?>

    <div class="footer">
        <h3>Total: Rp <?= number_format($grandTotal) ?></h3>
        <button class="btn">Checkout</button>
    </div>

<?php endif; ?>

<br>
<a href="/dashboard">⬅ Kembali</a>

</div>

</body>
</html>