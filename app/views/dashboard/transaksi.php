<!DOCTYPE html>
<html>
<head>
    <title>Transaksi</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
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
            gap: 15px;
            align-items: center;
        }

        img {
            width: 70px;
            height: 70px;
            border-radius: 8px;
            object-fit: cover;
        }

        .status {
            font-size: 13px;
            padding: 5px 10px;
            border-radius: 20px;
            display: inline-block;
            margin-top: 5px;
        }

        .menunggu { background: orange; color: white; }
        .diproses { background: blue; color: white; }
        .dikirim { background: purple; color: white; }
        .selesai { background: green; color: white; }
        .dibatalkan { background: gray; color: white; }

        button {
            margin-top: 5px;
            padding: 5px 10px;
            border: none;
            background: #ee4d2d;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .cancel-btn {
            background: red;
        }
    </style>
</head>
<body>

<div class="container">

<h2>📦 Riwayat Transaksi</h2>

<?php foreach($data as $t): ?>

<?php
$img = "/public/img/" . ($t['gambar'] ?? 'default.png');
$statusClass = strtolower($t['status']);
?>

<div class="card">

    <img src="<?= $img ?>">

    <div style="flex:1;">
        <h4><?= $t['nama_produk'] ?></h4>
        <p>Jumlah: <?= $t['jumlah'] ?></p>
        <p>Total: Rp <?= number_format($t['total']) ?></p>

        <span class="status <?= $statusClass ?>">
            <?= $t['status'] ?>
        </span>

        <!-- UPDATE STATUS -->
        <?php if($t['status'] != 'Selesai' && $t['status'] != 'Dibatalkan'): ?>

        <form method="POST" action="/updateStatus">
            <input type="hidden" name="id" value="<?= $t['id_transaksi'] ?>">

            <?php if($t['status'] == 'Menunggu'): ?>
                <button name="status" value="Diproses">Proses</button>
            <?php elseif($t['status'] == 'Diproses'): ?>
                <button name="status" value="Dikirim">Kirim</button>
            <?php elseif($t['status'] == 'Dikirim'): ?>
                <button name="status" value="Selesai">Selesaikan</button>
            <?php endif; ?>

        </form>

        <?php endif; ?>

        <!-- BATALKAN PESANAN -->
        <?php if($t['status'] == 'Menunggu'): ?>
        <form method="POST" action="/cancelOrder">
            <input type="hidden" name="id" value="<?= $t['id_transaksi'] ?>">
            <button class="cancel-btn">Batalkan</button>
        </form>
        <?php endif; ?>

    </div>

</div>

<?php endforeach; ?>

<br>
<a href="/dashboard">⬅ Kembali</a>

</div>

</body>
</html>