<!DOCTYPE HTML>
<html>
<head>
    <title>Aplikasi Data Mahasiswa</title>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
    </style>
 
</head>
<body>
 
    
    <div class="container">
        <div class="page-header">
            <h1>Aplikasi Data Mahasiswa</h1>
        </div>
     
<?php

include 'koneksi.php';
$action = isset($_GET['action']) ? $_GET['action'] : "";
if($action=='deleted'){
    echo "<div class='alert alert-success'>Data telah dihapus</div>";
}

$query = "SELECT id, nim, nama, jurusan FROM data_mhs ORDER BY nim ASC";
$stmt = $con->prepare($query);
$stmt->execute();
$num = $stmt->rowCount();

    echo "<a href='create.php' class='btn btn-primary m-b-1em'>Tambah data</a>";
 
if($num>0){
    echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr>";
        echo "<th>NIM</th>";
        echo "<th>Nama</th>";
        echo "<th>Jurusan</th>";
        echo "<th>Action</th>";
    echo "</tr>";
     
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    echo "<tr>";
        echo "<td>{$nim}</td>";
        echo "<td>{$nama}</td>";
        echo "<td>{$jurusan}</td>";
        echo "<td>";
            echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";
            echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Delete</a>";
        echo "</td>";
    echo "</tr>";
}

echo "</table>";
     
}else{
    echo "<div class='alert alert-danger'>Tidak ada data</div>";
}

?>
         
    </div> 
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type='text/javascript'>

function delete_user( id ){
    var answer = confirm('Apa kamu yakin akan menghapus data ini?');
    if (answer){
        window.location = 'delete.php?id=' + id;
    } 
}
</script>
</body>
</html>