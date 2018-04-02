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
if($_POST){
    include 'koneksi.php';
    try{
        $query = "INSERT INTO data_mhs SET nim=:nim, nama=:nama, jurusan=:jurusan";
        $stmt = $con->prepare($query);
 
        $nim=htmlspecialchars(strip_tags($_POST['nim']));
        $nama=htmlspecialchars(strip_tags($_POST['nama']));
        $jurusan=htmlspecialchars(strip_tags($_POST['jurusan']));
 
        $stmt->bindParam(':nim', $nim);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':jurusan', $jurusan);
         
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Data telah tersimpan</div>";
        }else{
            echo "<div class='alert alert-danger'>Gagal menyimpan data</div>";
        }
         
    }catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}

?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>NIM</td>
            <td><input type='text' name='nim' class='form-control' /></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><input type='text' name='nama' class='form-control' /></td>
        </tr>
        <tr>
            <td>Jurusan</td>
            <td><input type='text' name='jurusan' class='form-control' /></td>
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