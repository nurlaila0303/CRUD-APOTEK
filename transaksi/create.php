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
$id_transaksi = $_POST['id_transaksi'] ?? '';
$id_pelanggan = $_POST['id_pelanggan'] ?? '';
$id_obat = $_POST['id_obat'] ?? '';
$jumlah_obat = $_POST['jumlah_obat'] ?? 0;
$tgl_transaksi = $_POST['tgl_transaksi'] ?? date('Y-m-d');
$harga_obat = $_POST['harga_obat'] ?? '';
$total_harga = $_POST['total_harga'] ?? '';
/**
 * Validation int value
 */
$jumlahFilter = filter_var($jumlah_obat, FILTER_VALIDATE_INT);

/**
 * Validation empty fields
 */
$isValidated = true;
if(empty($id_transaksi)){
    $reply['error'] = 'id_transaksi harus diisi';
    $isValidated = false;
}
if(empty($id_pelanggan)){
    $reply['error'] = 'id_pelanggan harus diisi';
    $isValidated = false;
}
if(empty($id_obat)){
    $reply['error'] = 'id_obat harus diisi';
    $isValidated = false;   
    
}
if(empty($harga_obat)){
    $reply['error'] = 'harga_obat harus diisi';
    $isValidated = false;
}
if(empty($total_harga)){
    $reply['error'] = 'total_harga harus diisi';
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
    $query = "INSERT INTO transaksi (id_transaksi, id_pelanggan, id_obat, jumlah_obat, tgl_transaksi, harga_obat, total_harga) 
VALUES (:id_transaksi, :id_pelanggan, :id_obat, :jumlah_obat,  :tgl_transaksi, :harga_obat, :total_harga)";
    $statement = $connection->prepare($query);
    /**
     * Bind params
     */
    $statement->bindValue(":id_transaksi", $id_transaksi);
    $statement->bindValue(":id_pelanggan", $id_pelanggan);
    $statement->bindValue(":id_obat", $id_obat);
    $statement->bindValue(":jumlah_obat", $jumlah_obat, PDO::PARAM_INT);
    $statement->bindValue(":tgl_transaksi", $tgl_transaksi);
    $statement->bindValue(":harga_obat", $harga_obat);
    $statement->bindValue(":total_harga", $total_harga);
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

/**
 * Show output to client
 * Set status info true
 */
$reply['status'] = $isOk;
echo json_encode($reply);