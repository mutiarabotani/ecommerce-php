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

        .qty-box {
            margin-top: 5px;
        }

        .qty-box button {
            padding: 3px 8px;
            border: none;
            background: #ddd;
            cursor: pointer;
        }

        .qty-box strong {
            margin: 0 10px;
        }

        .remove-btn {
            color: red;
            border: none;
            background: none;
            cursor: pointer;
            margin-top: 5px;
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
            cursor: pointer;
        }

        a {
            text-decoration: none;
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

            <!-- QTY -->
            <div class="qty-box">

                <form method="POST" action="/updateQty" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $p['id_produk'] ?>">
                    <button name="action" value="minus">➖</button>
                </form>

                <strong><?= $p['qty'] ?></strong>

                <form method="POST" action="/updateQty" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $p['id_produk'] ?>">
                    <button name="action" value="plus">➕</button>
                </form>

            </div>

            <!-- HAPUS -->
            <form method="POST" action="/removeItem">
                <input type="hidden" name="id" value="<?= $p['id_produk'] ?>">
                <button class="remove-btn">Hapus</button>
            </form>

        </div>

        <div class="total">
            Rp <?= number_format($p['subtotal']) ?>
        </div>

    </div>

    <?php endforeach; ?>

    <?php
    $ongkir = 10000;
    $totalAkhir = $grandTotal + $ongkir;
    ?>

    <div class="footer">
        <p>Subtotal: Rp <?= number_format($grandTotal) ?></p>
        <p>Ongkir: Rp <?= number_format($ongkir) ?></p>
        <h3>Total: Rp <?= number_format($totalAkhir) ?></h3>

        <form action="/checkoutCart" method="GET">
            <button class="btn">Checkout</button>
        </form>
    </div>

<?php endif; ?>

<br>
<a href="/dashboard">⬅ Kembali</a>

</div>

</body>
</html>