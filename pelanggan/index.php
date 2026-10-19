<?php
require '../config/koneksi.php';

$page_title = 'Data Pelanggan';
$base = '../';

include '../partials/header.php';

$data = $koneksi->query(
    "SELECT * FROM pelanggan ORDER BY id_pelanggan DESC"
);
?>

<div class="panel">

    <div class="panel-head">
        <h2>Data Pelanggan</h2>

        <a class="btn" href="tambah.php">
            + Tambah Pelanggan
        </a>
    </div>

    <div class="table-wrap">

        <table>

            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>No. HP</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>

            <?php $no = 1; ?>

            <?php while ($r = $data->fetch_assoc()): ?>

            <tr>

                <td><?= $no++ ?></td>

                <td>
                    <?= htmlspecialchars($r['nama_pelanggan']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($r['no_hp']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($r['alamat']) ?>
                </td>

                <td class="actions">

                    <a href="edit.php?id=<?= $r['id_pelanggan'] ?>">
                        Edit
                    </a>

                    <a class="delete"
                       href="hapus.php?id=<?= $r['id_pelanggan'] ?>"
                       onclick="return confirm('Hapus pelanggan ini?')">
                        Hapus
                    </a>

                </td>

            </tr>

            <?php endwhile; ?>

        </table>

    </div>
</div>

<?php include '../partials/footer.php'; ?>