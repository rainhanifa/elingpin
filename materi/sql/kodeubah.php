<?php
    $id = $_GET['id'];
    //koneksi
    $server = "localhost";
    $user   = "root";
    $pass   = "";
    $dbase  = "latihan_db";

    // create connection
    $conn = mysqli_connect($server, $user, $pass, $dbase);

    // check connection
    if (!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $id     = $_POST['id'];
    $userid = $_POST['userid'];
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];
    
    if($id<>'' and $userid<>'' and $nama<>'' and $alamat<>''){
        $query     = "UPDATE siswa SET user_id = '$userid', nama = '$nama', alamat = '$alamat' WHERE id='$id'";
        $execute   = mysqli_query($conn, $query);
        if($execute){
            header('location: tampil.php');
        } else {
            echo "Terjadi kesalahan pada kode SQL. Periksa kembali data inputan anda!";
        }
    }else{
        echo "Periksa kembali data inputan anda!";
    }
?>