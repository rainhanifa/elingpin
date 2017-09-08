<?php
    include 'epsettings/backcontroller/back.php';
    include 'controller/front.php';
    
    if(isset($_REQUEST['p'])){
        $halaman = $_GET['p'];
        switch($halaman){
            case 'guru':
                back::indexguru('beranda');
            break;
            case 'siswa':
                back::indexsiswa('beranda');
            break;
            case 'login':
                front::utama();
            break;
            default:
                front::utama();
            break;
        }
    } else {
        front::utama();
    }
?>