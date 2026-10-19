<?php
require '../config/koneksi.php';

$id = (int) $_GET['id'];

$r = $koneksi->query(
    "SELECT * FROM pelanggan WHERE id_pelanggan = $id"
)->fetch_assoc();

if (!$r) {
    die("Data tidak ditemukan");
}

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    $q = $koneksi->prepare(
        "UPDATE pelanggan SET
        nama_pelanggan = ?,
        no_hp = ?,
        alamat = ?
        WHERE id_pelanggan = ?"
    );

    $q->bind_param(
        "sssi",
        $nama,
        $no_hp,
        $alamat,
        $id
    );

    $q->execute();

    header("Location: index.php");
    exit;
}

$page_title = 'Edit Pelanggan';
$base = '../';

include '../partials/header.php';
?>

<div class="panel">

    <h2>Edit Pelanggan</h2>

    <form method="post">

        <div class="form-grid">

            <div class="form-group">
                <label>Nama Pelanggan</label>

                <input type="text"
                       name="nama"
                       value="<?= htmlspecialchars($r['nama_pelanggan']) ?>"
                       required>
            </div>

            <div class="form-group">
                <label>Nomor HP</label>

                <input type="text"
                       name="no_hp"
                       value="<?= htmlspecialchars($r['no_hp']) ?>"
                       required>
            </div>

            <div class="form-group full">
                <label>Alamat</label>

                <textarea name="alamat" required><?= htmlspecialchars($r['alamat']) ?></textarea>
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