<?php
require '../config/koneksi.php';

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    $q = $koneksi->prepare(
        "INSERT INTO pelanggan
        (nama_pelanggan, no_hp, alamat)
        VALUES (?, ?, ?)"
    );

    $q->bind_param(
        "sss",
        $nama,
        $no_hp,
        $alamat
    );

    $q->execute();

    header("Location: index.php");
    exit;
}

$page_title = 'Tambah Pelanggan';
$base = '../';

include '../partials/header.php';
?>

<div class="panel">

    <h2>Tambah Pelanggan</h2>

    <form method="post">

        <div class="form-grid">

            <div class="form-group">
                <label>Nama Pelanggan</label>
                <input type="text" name="nama" required>
            </div>

            <div class="form-group">
                <label>Nomor HP</label>
                <input type="text" name="no_hp" required>
            </div>

            <div class="form-group full">
                <label>Alamat</label>
                <textarea name="alamat" required></textarea>
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