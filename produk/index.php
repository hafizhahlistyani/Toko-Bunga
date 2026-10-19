<?php
require '../config/koneksi.php';

$page_title = 'Data Produk';
$base = '../';

include '../partials/header.php';

$data = $koneksi->query(
    "SELECT * FROM produk ORDER BY id_produk DESC"
);
?>

<div class="panel">

    <div class="panel-head">
        <h2>Katalog Produk Bunga</h2>

        <a class="btn" href="tambah.php">
            + Tambah Produk
        </a>
    </div>

    <div class="table-wrap">

        <table>

            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Jenis</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>

            <?php $no = 1; ?>

            <?php while ($r = $data->fetch_assoc()): ?>

            <tr>

                <td><?= $no++ ?></td>

                <td>
                    <?= htmlspecialchars($r['nama_produk']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($r['jenis_bunga']) ?>
                </td>

                <td>
                    Rp <?= number_format($r['harga'], 0, ',', '.') ?>
                </td>

                <td><?= $r['stok'] ?></td>

                <td class="actions">

                    <a href="edit.php?id=<?= $r['id_produk'] ?>">
                        Edit
                    </a>

                    <a class="delete"
                       href="hapus.php?id=<?= $r['id_produk'] ?>"
                       onclick="return confirm('Hapus produk ini?')">
                        Hapus
                    </a>

                </td>

            </tr>

            <?php endwhile; ?>

        </table>

    </div>
</div>

<?php include '../partials/footer.php'; ?>