<?php
require '../config/koneksi.php';

$id = (int) $_GET['id'];

$koneksi->query(
    "DELETE FROM pelanggan WHERE id_pelanggan = $id"
);

header("Location: index.php");
exit;