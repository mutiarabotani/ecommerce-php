<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f5f5f5;
        }

        .header {
            background: #ee4d2d;
            color: white;
            padding: 15px 20px;
            font-size: 20px;
        }

        .container {
            padding: 20px;
            max-width: 600px;
            margin: auto;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }

        .product {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .product img {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            object-fit: cover;
        }

        .price {
            color: #ee4d2d;
            font-weight: bold;
        }

        textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #ee4d2d;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #d84325;
        }
    </style>
</head>

<body>

<div class="header">🧾 Checkout</div>

<div class="container">

    <div class="card product">

        <?php
        $img = "/public/img/" . ($produk['gambar'] ?? 'default.png');
        ?>

        <img src="<?= $img ?>">

        <div>
            <h3><?= $produk['nama_produk'] ?></h3>
            <div class="price">Rp <?= number_format($produk['harga']) ?></div>
        </div>

    </div>

    <div class="card">

        <form method="POST" action="/beli">

            <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">

            <label>📍 Alamat Pengiriman</label>
            <textarea name="alamat" placeholder="Masukkan alamat lengkap..." required></textarea>

            <label>💳 Metode Pembayaran</label>
            <select name="metode" required>
                <option value="">-- Pilih Metode Pembayaran --</option>
                <option value="COD">COD (Bayar di Tempat)</option>
                <option value="Transfer">Transfer Bank</option>
                <option value="E-Wallet">E-Wallet</option>
            </select>

            <button type="submit">Bayar Sekarang</button>

        </form>

    </div>

</div>

</body>
</html>