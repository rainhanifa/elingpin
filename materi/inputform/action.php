<?php
    $nama   = $_GET['nama'];
    $kelas  = $_GET['kelas'];
        
    echo "Nama saya ".$nama."<br>";
    echo "Saya kelas ".$kelas."<br>";

    $walikelas = "";

    if ($kelas == 'X RPL A'){
        $walikelas = "Pak Dhanang";
    } else if ($kelas == 'X RPL B'){
        $walikelas = "Bu Dian";
    } else if ($kelas == 'X RPL C'){
        $walikelas = "Pak Mahmudi";
    }
    
    echo $walikelas;
?>