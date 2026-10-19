
<?php
require 'config/koneksi.php';

$page_title = 'Best Seller Bunga';
$base = '';

$sql = "
    SELECT
        produk.nama_produk,
        produk.jenis_bunga,
        SUM(pesanan.jumlah) AS total_terjual,
        SUM(pesanan.total_harga) AS total_penjualan
    FROM pesanan
    INNER JOIN produk
        ON pesanan.id_produk = produk.id_produk
    GROUP BY
        produk.id_produk,
        produk.nama_produk,
        produk.jenis_bunga
    ORDER BY total_terjual DESC
";

$data = $koneksi->query($sql);

include 'partials/header.php';
?>

<div class="panel">

    <div class="panel-head">
        <h2>❀ Best Seller Bunga</h2>
    </div>

    <p style="color:#a77c86;">
        Daftar bunga paling laris
        di Bloomé Flower Shop 🌸
    </p>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Peringkat</th>
                    <th>Nama Bunga</th>
                    <th>Jenis Bunga</th>
                    <th>Jumlah Terjual</th>
                    <th>Total Penjualan</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $no = 1;

                if ($data && $data->num_rows > 0):
                    while ($row = $data->fetch_assoc()):
                ?>

                <tr>
                    <td>
                        <?php
                        if ($no == 1) {
                            echo "🏆 1";
                        } elseif ($no == 2) {
                            echo "🥈 2";
                        } elseif ($no == 3) {
                            echo "🥉 3";
                        } else {
                            echo $no;
                        }
                        $no++;
                        ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row['nama_produk']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row['jenis_bunga']) ?>
                    </td>

                    <td>
                        <?= $row['total_terjual'] ?>
                    </td>

                    <td>
                        Rp <?= number_format($row['total_penjualan'], 0, ',', '.') ?>
                    </td>
                </tr>

                <?php
                    endwhile;
                else:
                ?>

                <tr>
                    <td colspan="5" style="text-align:center;">
                        Belum ada data penjualan bunga.
                    </td>
                </tr>

                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<?php include 'partials/footer.php'; ?>
