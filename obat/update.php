<?php
include '../koneksi.php';

$id_obat = isset($_POST['id_obat']) ? $_POST['id_obat'] : '';
$nama_obat = isset($_POST['nama_obat']) ? $_POST['nama_obat'] : '';
$dosis = isset($_POST['dosis']) ? $_POST['dosis'] : '';
$stok = isset($_POST['stok']) ? $_POST['stok'] : '';
$komposisi = isset($_POST['komposisi']) ? $_POST['komposisi'] : '';
$tgl_kadaluwarsa = isset($_POST['tgl_kadaluwarsa']) ? $_POST['tgl_kadaluwarsa'] : '';
$kegunaan = isset($_POST['kegunaan']) ? $_POST['kegunaan'] : '';
$harga_obat = isset($_POST['harga_obat']) ? $_POST['harga_obat'] : '';


/***@var $connection PDO */

try {
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE obat SET nama_obat = '$nama_obat', dosis = '$dosis',stok = '$stok', komposisi = '$komposisi', tgl_kadaluwarsa = '$tgl_kadaluwarsa', kegunaan = '$kegunaan', harga_obat = '$harga_obat' WHERE `id_obat`= '$id_obat'";

    $connection->exec($sql);
    echo "Data berhasil di update";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$connection = null;