
<?php
require '../config/koneksi.php';

$page_title = 'Rekap Bulanan';
$base = '../';

$tahun = isset($_GET['tahun'])
    ? (int)$_GET['tahun']
    : (int)date('Y');

$sql = "SELECT
            MONTH(tanggal_pesanan) AS bulan,
            COUNT(*) AS total_pesanan,
            SUM(jumlah) AS total_terjual,
            SUM(total_harga) AS pendapatan
        FROM pesanan
        WHERE YEAR(tanggal_pesanan) = ?
          AND status = 'Selesai'
        GROUP BY MONTH(tanggal_pesanan)
        ORDER BY bulan ASC";

$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $tahun);
$stmt->execute();

$result = $stmt->get_result();

$rekap = [];
$total_pesanan = 0;
$total_terjual = 0;
$total_pendapatan = 0;

while ($row = $result->fetch_assoc()) {
    $rekap[(int)$row['bulan']] = $row;

    $total_pesanan += $row['total_pesanan'];
    $total_terjual += $row['total_terjual'];
    $total_pendapatan += $row['pendapatan'];
}

$bulan = [
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember'
];

include '../partials/header.php';
?>

<section class="welcome">
    <h2>Rekap Penjualan Bulanan 🌸</h2>
    <p>Laporan penjualan Bloomé Flower Shop</p>
</section>

<section class="panel">
    <form method="GET">
        <label>Pilih Tahun:</label>

        <input type="number"
               name="tahun"
               value="<?= $tahun ?>"
               min="2000"
               max="2100">

        <button type="submit" class="btn">
            Tampilkan
        </button>
    </form>
</section>

<section class="cards">

    <div class="card">
        <div class="icon">🛍️</div>
        <h3><?= $total_pesanan ?></h3>
        <p>Total Pesanan</p>
    </div>

    <div class="card">
        <div class="icon">🌷</div>
        <h3><?= $total_terjual ?></h3>
        <p>Produk Terjual</p>
    </div>

    <div class="card">
        <div class="icon">💗</div>
        <h3>
            Rp <?= number_format(
                $total_pendapatan, 0, ',', '.'
            ) ?>
        </h3>
        <p>Total Pendapatan</p>
    </div>

</section>

<section class="panel">

    <div class="panel-head">
        <h2>Rekap Tahun <?= $tahun ?></h2>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Total Pesanan</th>
                    <th>Produk Terjual</th>
                    <th>Pendapatan</th>
                </tr>
            </thead>

            <tbody>
                <?php for ($i = 1; $i <= 12; $i++): ?>

                <?php
                $data = $rekap[$i] ?? null;
                ?>

                <tr>
                    <td><?= $i ?></td>
                    <td><?= $bulan[$i] ?></td>

                    <td>
                        <?= $data['total_pesanan'] ?? 0 ?>
                    </td>

                    <td>
                        <?= $data['total_terjual'] ?? 0 ?>
                    </td>

                    <td>
                        Rp <?= number_format(
                            $data['pendapatan'] ?? 0,
                            0, ',', '.'
                        ) ?>
                    </td>
                </tr>

                <?php endfor; ?>
            </tbody>
        </table>
    </div>

</section>

<?php include '../partials/footer.php'; ?>
