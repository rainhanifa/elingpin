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

    $userid = $_POST['userid'];
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];

    if($userid<>'' and $nama<>'' and $alamat<>''){
        //memasukkan data ke tabel siswa
        $query     = "INSERT INTO siswa VALUES ('','$userid', '$nama', '$alamat')";
        $execute   = mysqli_query($conn, $query);
        if($execute){
            echo "<label>Pengisian data sukses!</label>";
            echo "<p>Data yang dimasukkan antara lain:</p>";
            echo "<p>User ID : ".$userid."</p>";
            echo "<p>Nama    : ".$nama."</p>";
            echo "<p>Alamat  : ".$alamat."</p>";
        } else {
            echo "<label>Pengisian data gagal! Periksa ulang data anda</label>";
        }
    } else {
        echo "<label>Pengisian data gagal! Data tidak boleh ada yang kosong!</label>";
    }

?>