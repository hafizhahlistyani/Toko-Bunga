
<?php
require 'config/koneksi.php';

$page_title = 'Rekap Bulanan';
$base = '';

$data = $koneksi->query("
    SELECT
        DATE_FORMAT(tanggal_pesanan, '%Y-%m') AS bulan,
        COUNT(*) AS total_pesanan,
        SUM(jumlah) AS bunga_terjual,
        SUM(total_harga) AS pendapatan
    FROM pesanan
    GROUP BY DATE_FORMAT(tanggal_pesanan, '%Y-%m')
    ORDER BY bulan DESC
");

include 'partials/header.php';
?>

<div class="panel">

    <div class="panel-head">
        <h2>✿ Rekap Penjualan Bulanan</h2>
    </div>

    <p style="color:#8d777b;">
        Laporan penjualan bunga Bloomé setiap bulan.
    </p>

    <div class="table-wrap">
        <table>
            <tr>
                <th>No</th>
                <th>Bulan</th>
                <th>Total Pesanan</th>
                <th>Bunga Terjual</th>
                <th>Pendapatan</th>
            </tr>

            <?php $no = 1; ?>

            <?php while ($r = $data->fetch_assoc()): ?>
            <tr>
                <td><?= $no++ ?></td>

                <td>
                    <?= date('F Y', strtotime($r['bulan'] . '-01')) ?>
                </td>

                <td><?= $r['total_pesanan'] ?></td>

                <td><?= $r['bunga_terjual'] ?></td>

                <td>
                    Rp <?= number_format($r['pendapatan'], 0, ',', '.') ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

</div>

<?php include 'partials/footer.php'; ?>
