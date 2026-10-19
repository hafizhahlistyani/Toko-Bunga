<?php
if (!isset($page_title)) {
    $page_title = 'Bloomé Flower Shop';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= htmlspecialchars($page_title) ?> | Bloomé
    </title>

    <link rel="stylesheet"
          href="<?= $base ?? '' ?>assets/style.css">
</head>

<body>

<div class="layout">

    <aside class="sidebar">

        <div class="brand">
            <span>✿</span>

            <div>
                Bloomé
                <small>flower shop</small>
            </div>
        </div>

        <nav>
            <a href="<?= $base ?? '' ?>index.php">
                ⌂ Dashboard
            </a>

            <a href="<?= $base ?? '' ?>produk/index.php">
                ❀ Data Produk
            </a>

            <a href="<?= $base ?? '' ?>pelanggan/index.php">
                ♡ Data Pelanggan
            </a>

            <a href="<?= $base ?? '' ?>pesanan/index.php">
                ▣ Data Pesanan
            </a>
            
            <a href="<?= $base ?? '' ?>rekap/index.php">
                ▤ Rekap Bulanan
            </a>

            <a href="<?= $base ?? '' ?>best_seller/bestseller.php">
                ❀ Best Seller Bunga
            </a>

        </nav>

        <div class="sidebar-note">
            Fresh flowers,<br>
            beautiful moments 🌷
        </div>

    </aside>

    <main class="content">

        <header class="topbar">
            <div>
                <p class="eyebrow">FLOWER SHOP MANAGEMENT</p>
                <h1><?= htmlspecialchars($page_title) ?></h1>
            </div>

            <div class="avatar">B</div>
        </header>