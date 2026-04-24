<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Transaksi</title>

    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
            margin: 0;
        }

        .header {
            background: #ee4d2d;
            color: white;
            padding: 15px;
            font-size: 20px;
        }

        .container {
            padding: 20px;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .card img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .info {
            flex: 1;
        }

        .info h4 {
            margin: 0;
        }

        .price {
            color: #ee4d2d;
            font-weight: bold;
        }

        .total {
            text-align: right;
        }

        .btn {
            margin-top: 10px;
            padding: 6px 12px;
            border: none;
            background: #ee4d2d;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .empty {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>

<div class="header">🛒 Riwayat Transaksi</div>

<div class="container">

<?php if(empty($data)): ?>

    <div class="empty">
        <h3>Belum ada transaksi 😢</h3>
        <a href="/dashboard">Belanja sekarang</a>
    </div>

<?php else: ?>

    <?php foreach($data as $t): ?>

    <?php
    $img = "/public/img/" . ($t['gambar'] ?? 'default.png');
    ?>

    <div class="card">

        <img src="<?= $img ?>">

        <div class="info">
            <h4><?= $t['nama_produk'] ?></h4>
            <div>Jumlah: <?= $t['jumlah'] ?></div>
            <div class="price">Rp <?= number_format($t['total']) ?></div>
            <small><?= $t['tanggal'] ?></small>
        </div>

        <div class="total">
            <strong>Total</strong><br>
            Rp <?= number_format($t['total']) ?>
        </div>

    </div>

    <?php endforeach; ?>

<?php endif; ?>

</div>

</body>
</html>