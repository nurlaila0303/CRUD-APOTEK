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
$id_pelanggan = $_POST['id_pelanggan'] ?? '';
$nama_pelanggan = $_POST['nama_pelanggan'] ?? '';
$jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
$telepon = $_POST['telepon'] ?? '';
$umur = $_POST['umur'] ?? 0;
$tanggal_lahir = $_POST['tanggal_lahir'] ?? date('Y-m-d');
$alamat = $_POST['alamat'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
/**
 * Validation int value
 */
$jumlahFilter = filter_var($umur, FILTER_VALIDATE_INT);

/**
 * Validation empty fields
 */
$isValidated = true;
if(empty($id_pelanggan)){
    $reply['error'] = 'id_pelanggan harus diisi';
    $isValidated = false;
}
if(empty($nama_pelanggan)){
    $reply['error'] = 'nama_pelanggan harus diisi';
    $isValidated = false;
}
if(empty($jenis_kelamin)){
    $reply['error'] = 'jenis_kelamin harus diisi';
    $isValidated = false;
}
if(empty($telepon)){
    $reply['error'] = 'telepon harus diisi';
    $isValidated = false;
}
if(empty($umur)){
    $reply['error'] = 'umur harus diisi';
    
}
if(empty($alamat)){
    $reply['error'] = 'alamat harus diisi';
    $isValidated = false;
}
if(empty($username)){
    $reply['error'] = 'username harus diisi';
    $isValidated = false;
}
if(empty($password)){
    $reply['error'] = 'password harus diisi';
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
    $query = "INSERT INTO pelanggan (id_pelanggan, nama_pelanggan, jenis_kelamin,  telepon, umur, tanggal_lahir, alamat, username, password) 
VALUES (:id_pelanggan, :nama_pelanggan, :jenis_kelamin, :telepon, :umur,  :tanggal_lahir, :alamat, :username, :password)";
    $statement = $connection->prepare($query);
    /**
     * Bind params
     */
    $statement->bindValue(":id_pelanggan", $id_pelanggan);
    $statement->bindValue(":nama_pelanggan", $nama_pelanggan);
    $statement->bindValue(":jenis_kelamin", $jenis_kelamin);
    $statement->bindValue(":telepon", $telepon);
    $statement->bindValue(":umur", $umur, PDO::PARAM_INT);
    $statement->bindValue(":tanggal_lahir", $tanggal_lahir);
    $statement->bindValue(":alamat", $alamat);
    $statement->bindValue(":username", $username);
    $statement->bindValue(":password", $password);
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
/**
 * If not OK, add error info
 * HTTP Status code 400: Bad request
 * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Status#client_error_responses
 */
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