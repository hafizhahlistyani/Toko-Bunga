<?php
require '../config/koneksi.php';

$id = (int) $_GET['id'];

$r = $koneksi->query(
    "SELECT * FROM produk WHERE id_produk = $id"
)->fetch_assoc();

if (!$r) {
    die("Data tidak ditemukan");
}

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $harga = (float) $_POST['harga'];
    $stok = (int) $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    $q = $koneksi->prepare(
        "UPDATE produk SET
        nama_produk = ?,
        jenis_bunga = ?,
        harga = ?,
        stok = ?,
        deskripsi = ?
        WHERE id_produk = ?"
    );

    $q->bind_param(
        "ssdisi",
        $nama,
        $jenis,
        $harga,
        $stok,
        $deskripsi,
        $id
    );

    $q->execute();

    header("Location: index.php");
    exit;
}

$page_title = 'Edit Produk';
$base = '../';

include '../partials/header.php';
?>

<div class="panel">

    <h2>Edit Produk Bunga</h2>

    <form method="post">

        <div class="form-grid">

            <div class="form-group">
                <label>Nama Produk</label>

                <input type="text"
                       name="nama"
                       value="<?= htmlspecialchars($r['nama_produk']) ?>"
                       required>
            </div>

            <div class="form-group">
                <label>Jenis Bunga</label>

                <input type="text"
                       name="jenis"
                       value="<?= htmlspecialchars($r['jenis_bunga']) ?>"
                       required>
            </div>

            <div class="form-group">
                <label>Harga</label>

                <input type="number"
                       name="harga"
                       value="<?= $r['harga'] ?>"
                       required>
            </div>

            <div class="form-group">
                <label>Stok</label>

                <input type="number"
                       name="stok"
                       value="<?= $r['stok'] ?>"
                       required>
            </div>

            <div class="form-group full">
                <label>Deskripsi</label>

                <textarea name="deskripsi"><?= htmlspecialchars($r['deskripsi']) ?></textarea>
            </div>

        </div>

        <div class="form-actions">

            <button class="btn" name="simpan">
                Update
            </button>

            <a class="btn secondary" href="index.php">
                Batal
            </a>

        </div>

    </form>

</div>

<?php include '../partials/footer.php'; ?>