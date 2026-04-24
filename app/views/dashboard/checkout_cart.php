<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>

    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
        }

        .container {
            max-width: 700px;
            margin: auto;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        img {
            width: 60px;
            height: 60px;
            border-radius: 8px;
        }

        .total {
            text-align: right;
            margin-top: 20px;
            background: white;
            padding: 15px;
            border-radius: 10px;
        }

        textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        button {
            margin-top: 10px;
            padding: 10px;
            width: 100%;
            background: #ee4d2d;
            color: white;
            border: none;
        }
    </style>
</head>
<body>

<div class="container">

<h2>🧾 Checkout</h2>

<?php $grandTotal = 0; ?>

<?php foreach($data as $p): ?>

<?php
$img = "/public/img/" . ($p['gambar'] ?? 'default.png');
$grandTotal += $p['subtotal'];
?>

<div class="card">
    <img src="<?= $img ?>">
    <div>
        <b><?= $p['nama_produk'] ?></b><br>
        <?= $p['qty'] ?> x Rp <?= number_format($p['harga']) ?>
    </div>
</div>

<?php endforeach; ?>

<div class="total">
    <h3>Total: Rp <?= number_format($grandTotal) ?></h3>
</div>

<form method="POST" action="/checkoutCart">

    <label>Alamat</label>
    <textarea name="alamat" required></textarea>

    <label>Metode Pembayaran</label>
    <select name="metode" required>
        <option value="COD">COD</option>
        <option value="Transfer">Transfer</option>
        <option value="E-Wallet">E-Wallet</option>
    </select>

    <button>Bayar Sekarang</button>

</form>

</div>

</body>
</html>