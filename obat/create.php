<?php
include '../koneksi.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    http_response_code(400);
    $reply['error'] = 'POST method required';
    echo json_encode($reply);
    exit();
}
/**
 * Get input data POST
 */
$id_obat = $_POST['id_obat'] ?? '';
$nama_obat = $_POST['nama_obat'] ?? '';
$dosis = $_POST['dosis'] ?? '';
$komposisi = $_POST['komposisi'] ?? '';
$stok = $_POST['stok'] ?? 0;
$tgl_kadaluwarsa = $_POST['tgl_kadaluwarsa'] ?? date('Y-m-d');
$kegunaan = $_POST['kegunaan'] ?? '';
$harga_obat = $_POST['harga_obat'] ?? '';
/**
 * Validation int value
 */
$jumlahFilter = filter_var($stok, FILTER_VALIDATE_INT);

/**
 * Validation empty fields
 */
$isValidated = true;
if(empty($id_obat)){
    $reply['error'] = 'id_obat harus diisi';
    $isValidated = false;
}
if(empty($nama_obat)){
    $reply['error'] = 'nama_obat harus diisi';
    $isValidated = false;
}
if(empty($dosis)){
    $reply['error'] = 'dosis harus diisi';
    $isValidated = false;
}
if(empty($komposisi)){
    $reply['error'] = 'komposisi harus diisi';
    $isValidated = false;    
    
}
if(empty($kegunaan)){
    $reply['error'] = 'kegunaan harus diisi';
    $isValidated = false;
}
if(empty($harga_obat)){
    $reply['error'] = 'harga_obat harus diisi';
    $isValidated = false;
}
/*
 * Jika filter gagal
 */
if(!$isValidated){
    echo json_encode($reply);
    http_response_code(400);
    exit(0);
}
/**
 * Method OK
 * Validation OK
 * Prepare query
 */
try{
    $query = "INSERT INTO obat (id_obat, nama_obat, dosis, komposisi, stok, tgl_kadaluwarsa, kegunaan, harga_obat) 
VALUES (:id_obat, :nama_obat, :dosis, :komposisi, :stok,  :tgl_kadaluwarsa, :kegunaan, :harga_obat)";
    $statement = $connection->prepare($query);
    /**
     * Bind params
     */
    $statement->bindValue(":id_obat", $id_obat);
    $statement->bindValue(":nama_obat", $nama_obat);
    $statement->bindValue(":dosis", $dosis);
    $statement->bindValue(":komposisi", $komposisi);
    $statement->bindValue(":stok", $stok, PDO::PARAM_INT);
    $statement->bindValue(":tgl_kadaluwarsa", $tgl_kadaluwarsa);
    $statement->bindValue(":kegunaan", $kegunaan);
    $statement->bindValue(":harga_obat", $harga_obat);
    /**
     * Execute query
     */
    $isOk = $statement->execute();
}catch (Exception $exception){
    $reply['error'] = $exception->getMessage();
    echo json_encode($reply);
    http_response_code(400);
    exit(0);
}

if(!$isOk){
    $reply['error'] = $statement->errorInfo();
    http_response_code(400);
}


$reply['status'] = $isOk;
echo json_encode($reply);