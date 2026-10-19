
<?php
require '../config/koneksi.php';

$page_title = 'Best Seller Bunga';
$base = '../';

// Mengambil data produk paling laris
$sql = "
    SELECT
        produk.id_produk,
        produk.nama_produk,
        produk.jenis_bunga,
        SUM(pesanan.jumlah) AS total_terjual,
        SUM(pesanan.total_harga) AS total_penjualan
    FROM pesanan
    JOIN produk
        ON pesanan.id_produk = produk.id_produk
    GROUP BY
        produk.id_produk,
        produk.nama_produk,
        produk.jenis_bunga
    ORDER BY total_terjual DESC
";

$data = $koneksi->query($sql);

// Memanggil header
include '../partials/header.php';
?>

<div class="panel">

    <div class="panel-head">
        <h2>❀ Best Seller Bunga</h2>
    </div>

    <p style="color: #8d777b; margin-bottom: 20px;">
        Daftar bunga paling laris di Bloomé Flower Shop.
    </p>

    <div class="table-wrap">

        <table>
            <thead>
                <tr>
                    <th>Peringkat</th>
                    <th>Nama Bunga</th>
                    <th>Jenis Bunga</th>
                    <th>Total Terjual</th>
                    <th>Total Penjualan</th>
                </tr>
            </thead>

            <tbody>

                <?php
                $no = 1;

                if ($data && $data->num_rows > 0):
                    while ($r = $data->fetch_assoc()):
                ?>

                <tr>
                    <td>
                        <?php
                        if ($no == 1) {
                            echo '🏆 1';
                        } elseif ($no == 2) {
                            echo '🥈 2';
                        } elseif ($no == 3) {
                            echo '🥉 3';
                        } else {
                            echo $no;
                        }

                        $no++;
                        ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($r['nama_produk']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($r['jenis_bunga']) ?>
                    </td>

                    <td>
                        <?= number_format(
                            $r['total_terjual'],
                            0, ',', '.'
                        ) ?>
                    </td>

                    <td>
                        Rp <?= number_format(
                            $r['total_penjualan'],
                            0, ',', '.'
                        ) ?>
                    </td>
                </tr>

                <?php
                    endwhile;
                else:
                ?>

                <tr>
                    <td colspan="5"
                        style="text-align:center; padding:20px;">
                        Belum ada data penjualan bunga.
                    </td>
                </tr>

                <?php endif; ?>

            </tbody>
        </table>

    </div>

</div>

<?php
// Memanggil footer
include '../partials/footer.php';
?>
