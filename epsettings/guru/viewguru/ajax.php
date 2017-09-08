<?php
    include "../modelguru/backgurucode.php";
    
    if(isset($_POST['get_dataname']) AND isset($_POST['get_user']) AND isset($_POST['get_materi'])){
        $name   = $_POST['get_dataname'];
        $user   = $_POST['get_user'];
        $materi = $_POST['get_materi'];
        $activ  = $_POST['get_act'];
        
        //Mencatat aktifitas
        $conn       = backgurucode::connecttodb();
        date_default_timezone_set("Asia/Jakarta");

        $qry_idlog  = "SELECT id FROM login WHERE username = '$user'";
        $sql_idlog  = mysqli_query($conn, $qry_idlog) or die (mysqli_error($conn));
        $arr_idlog  = mysqli_fetch_array($sql_idlog, MYSQLI_ASSOC);
        $idguru     = $arr_idlog['id'];
        $materi_log = "Download tugas siswa ".$name." submateri ".$materi;

        $kelas      = backgurucode::kelas($user);
        $tanggal    = date("Y-m-d");
        $jam        = date("H:i:s");
        $catat      = backgurucode::inslog($idguru, $kelas, $tanggal, $jam, $materi_log);
    }else{
        echo "Data Not Set";
    }
?>