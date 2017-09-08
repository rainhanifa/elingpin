<?php
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
    
    $id     = $_GET['id'];
    
    if($id<>''){
        $query  = "DELETE FROM siswa WHERE user_id = '$id'";
        $sql    = mysqli_query($conn, $query);
        if($sql){
            echo "Data $id berhasil dihapus! <a href=tampil.php>Kembali</a>";
        } else {
            echo "Terjadi kesalahan pada kode SQL, periksa kembali id anda!";
        }
    } else {
        echo "ID Kosong";
    }
    
?>