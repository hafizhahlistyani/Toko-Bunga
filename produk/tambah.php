<?php
require '../config/koneksi.php';

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $harga = (float) $_POST['harga'];
    $stok = (int) $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    $q = $koneksi->prepare(
        "INSERT INTO produk
        (nama_produk, jenis_bunga, harga, stok, deskripsi)
        VALUES (?, ?, ?, ?, ?)"
    );

    $q->bind_param(
        "ssdis",
        $nama,
        $jenis,
        $harga,
        $stok,
        $deskripsi
    );

    $q->execute();

    header("Location: index.php");
    exit;
}

$page_title = 'Tambah Produk';
$base = '../';

include '../partials/header.php';
?>

<div class="panel">

    <h2>Tambah Produk Bunga</h2>

    <form method="post">

        <div class="form-grid">

            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama" required>
            </div>

            <div class="form-group">
                <label>Jenis Bunga</label>
                <input type="text"
                       name="jenis"
                       placeholder="Mawar, Lily, dll."
                       required>
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="number"
                       name="harga"
                       min="0"
                       required>
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number"
                       name="stok"
                       min="0"
                       required>
            </div>

            <div class="form-group full">
                <label>Deskripsi</label>
                <textarea name="deskripsi"></textarea>
            </div>

        </div>

        <div class="form-actions">

            <button class="btn" name="simpan">
                Simpan
            </button>

            <a class="btn secondary" href="index.php">
                Batal
            </a>

        </div>

    </form>

</div>

<?php include '../partials/footer.php'; ?>