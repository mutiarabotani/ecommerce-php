<!DOCTYPE html>
<html>
<head>
    <title>Keranjang</title>
</head>
<body>

<h2>Keranjang Belanja</h2>

<?php if(empty($cart)): ?>
    <p>Keranjang kosong</p>
<?php else: ?>
    <ul>
        <?php foreach($cart as $item): ?>
            <li>Produk ID: <?= $item ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<a href="/dashboard">Kembali</a>

</body>
</html>