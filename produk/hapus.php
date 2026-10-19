<?php
require '../config/koneksi.php';

$id = (int) $_GET['id'];

$koneksi->query(
    "DELETE FROM produk WHERE id_produk = $id"
);

header("Location: index.php");
exit;