<?php
include '../koneksi.php';

$id_transaksi = isset($_POST['id_transaksi']) ? $_POST['id_transaksi'] : '';
$id_pelanggan = isset($_POST['id_pelanggan']) ? $_POST['id_pelanggan'] : '';
$id_obat = isset($_POST['id_obat']) ? $_POST['id_obat'] : '';
$jumlah_obat = isset($_POST['jumlah_obat']) ? $_POST['jumlah_obat'] : '';
$tgl_transaksi = isset($_POST['tgl_transaksi']) ? $_POST['tgl_transaksi'] : '';
$harga_obat = isset($_POST['harga_obat']) ? $_POST['harga_obat'] : '';
$total_harga = isset($_POST['total_harga']) ? $_POST['total_harga'] : '';

/***@var $connection PDO */

try {
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE transaksi SET id_pelanggan = '$id_pelanggan', id_obat = '$id_obat',jumlah_obat = '$jumlah_obat', tgl_transaksi = '$tgl_transaksi', harga_obat = '$harga_obat', total_harga = '$total_harga' WHERE `id_transaksi`= '$id_transaksi'";

    $connection->exec($sql);
    echo "Data berhasil di update";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$connection = null;