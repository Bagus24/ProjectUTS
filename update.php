<!DOCTYPE HTML>
<html>
<head>
    <title>Aplikasi Data Mahasiswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>

    <div class="container"> 
        <div class="page-header">
            <h1>Aplikasi Data Mahasiswa</h1>
        </div>

<?php
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Baris tidak ada');
include 'koneksi.php';
 
try {
    $query = "SELECT id, nim, nama, jurusan FROM data_mhs WHERE id = ? LIMIT 0,1";
    $stmt = $con->prepare( $query );
    $stmt->bindParam(1, $id);
    $stmt->execute();
     
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $nim = $row['nim'];
    $nama = $row['nama'];
    $jurusan = $row['jurusan'];

}catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>


<?php
 if($_POST){  
     try{
         $query = "UPDATE data_mhs 
                     SET nim=:nim, nama=:nama, jurusan=:jurusan 
                     WHERE id = :id";

         $stmt = $con->prepare($query);

         $nim=htmlspecialchars(strip_tags($_POST['nim']));
         $nama=htmlspecialchars(strip_tags($_POST['nama']));
         $jurusan=htmlspecialchars(strip_tags($_POST['jurusan']));

         $stmt->bindParam(':nim', $nim);
         $stmt->bindParam(':nama', $nama);
         $stmt->bindParam(':jurusan', $jurusan);
         $stmt->bindParam(':id', $id);

         if($stmt->execute()){
             echo "<div class='alert alert-success'>Data telah diubah</div>";
         }else{
             echo "<div class='alert alert-danger'>Gagal mengubah data. Silahkan coba lagi!.</div>";
         }
          
     }catch(PDOException $exception){
         die('ERROR: ' . $exception->getMessage());
     }
 }

 ?>
 

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>NIM</td>
            <td><input type='text' name='nim' value="<?php echo htmlspecialchars($nim, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><input type='text' name='nama' value="<?php echo htmlspecialchars($nama, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Jurusan</td>
            <td><input type='text' name='jurusan' value="<?php echo htmlspecialchars($jurusan, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Simpan' class='btn btn-primary' />
                <a href='index.php' class='btn btn-danger'>Kembali</a>
            </td>
        </tr>
    </table>
</form>
         
    </div> 
     

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>