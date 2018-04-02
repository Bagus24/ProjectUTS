<?php
include 'koneksi.php'; 
try {
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Baris tidak ada');
 
    $query = "DELETE FROM data_mhs WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $id);
     
    if($stmt->execute()){
        header('Location: index.php?action=deleted');
    }else{
        die('Gagal menghapus');
    }
}catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>