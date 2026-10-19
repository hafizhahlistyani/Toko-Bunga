<?php
require 'config/koneksi.php';

$j_produk = $koneksi->query(
    "SELECT COUNT(*) AS total FROM produk"
)->fetch_assoc()['total'];

$j_pelanggan = $koneksi->query(
    "SELECT COUNT(*) AS total FROM pelanggan"
)->fetch_assoc()['total'];

$j_pesanan = $koneksi->query(
    "SELECT COUNT(*) AS total FROM pesanan"
)->fetch_assoc()['total'];

$page_title = 'Dashboard';
$base = '';

include 'partials/header.php';
?>

<section class="welcome">
    <h2>Selamat datang di Bloomé 🌸</h2>
    <p>
        Kelola produk bunga, pelanggan, dan pesanan toko
        dengan mudah.
    </p>
</section>

<section class="cards">

    <div class="card">
        <div class="icon">🌷</div>
        <h3><?= $j_produk ?></h3>
        <p>Total produk bunga</p>
    </div>

    <div class="card">
        <div class="icon">♡</div>
        <h3><?= $j_pelanggan ?></h3>
        <p>Total pelanggan</p>
    </div>

    <div class="card">
        <div class="icon">🧾</div>
        <h3><?= $j_pesanan ?></h3>
        <p>Total pesanan</p>
    </div>

</section>

<section class="panel">
    <div class="panel-head">
        <h2>Mulai mengelola toko</h2>
    </div>

    <p>
        Gunakan menu di sebelah kiri untuk menambah,
        mengedit, menghapus, dan melihat data sistem
        informasi toko bunga.
    </p>

    <a class="btn" href="produk/index.php">
        Lihat Produk →
    </a>
</section>

<?php include 'partials/footer.php'; ?>