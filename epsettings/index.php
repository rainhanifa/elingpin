<?php
    session_start();
    
    include "../model/frontcode.php";

    $con = frontcode::connecttodb();
    if(isset($_SESSION['user'])){
        $username   = $_SESSION['user'];
        $query_log  = "SELECT * FROM login WHERE username='$username'";
        $sql_log    = mysqli_query($con, $query_log);
        $cek_log    = mysqli_num_rows($sql_log);

        if($cek_log<>0){
            while($data   = mysqli_fetch_array($sql_log, MYSQLI_ASSOC)){
                $_SESSION['user']=$data['username'];
                $id = substr($data['id'],0,1);
                
                if($id == '1'){
                   header("location:http://localhost:8080/elprowinmvc.com/epsettings/guru/index.php?p=beranda");
                } else if ($id == '2'){
                   header("location:http://localhost:8080/elprowinmvc.com/epsettings/siswa/index.php?p=beranda");
                } else {
                    header("location:http://localhost:8080/elprowinmvc.com/");
                }
            }
        } else {
            header("location:http://localhost:8080/elprowinmvc.com/");
        }
    } else {
        header("location:http://localhost:8080/elprowinmvc.com/");
    }
?>