<?php
require_once '../koneksi.php';

/***
 * @var $connection PDO
 */

$id_obat = $_POST['id_obat'];
try {
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "Delete FROM obat WHERE `id_obat`= '$id_obat'";

    $connection->exec($sql);
    echo "Data berhasil di hapus";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$connection = null;