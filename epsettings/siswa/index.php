<?php
    include "viewsiswa/backview.php";
    include "modelsiswa/backsiswacode.php";
    if(isset($_REQUEST['p'])){
        $halaman = $_GET['p'];
        switch($halaman){
            case 'beranda':
                backview::goto_page('home');
            break;
            case 'ps':
                backview::goto_page('profil');
            break;
            case 'ns':
                backview::goto_page('nilai');
            break;
            case 'edp':
                backview::goto_page('formp');
            break;
            case 'fedp':
                $username = $_POST['username'];
                $id     = $_POST['id'];
                $nama   = $_POST['nama'];
                $kelas  = $_POST['kelas'];
                $no     = $_POST['absen'];
                $email  = $_POST['mail'];
                $pp     = $_FILES['profil']['name'];
                $pptemp = $_FILES['profil']['tmp_name'];
                $pass   = $_POST['kunci'];
                $repass = $_POST['ulangi_kunci'];
                $send   = backsiswacode::editprofile($username, $id, $nama, $kelas, $no, $email, $pp, $pptemp, $pass, $repass);
                if($send == 'true'){
                    backview::goto_page('profil');
                } else {
                    backview::goto_page('formp');
                }
            break;
            case 'me':
                if(isset($_GET['sm']) && isset($_GET['cm'])){
                    $id = backsiswacode::setidmbysub($_GET['sm']);
                    if($id<>''){
                        backview::goto_pageid('materi', $id, $_GET['cm']);
                    }else{
                        backview::goto_page('home');
                    }
                } else {
                    backview::goto_page('home');
                }
            break;
            case 'fupmateri':
                $index      = $_POST['index'];
                $submateri  = $_POST['submateri'];
                $category   = $_POST['category'];
                $user       = $_POST['user'];
                $tipe       = $_POST['tipe'];
                if($index<>'' and $category<>''){
                    $filename   = $_FILES['uptugas']['name'];
                    $filetemp   = $_FILES['uptugas']['tmp_name'];
                    $fileext    = pathinfo($filename, PATHINFO_EXTENSION);
                    
                    $id         = backsiswacode::setidmbysub($submateri);
                    
                    if($fileext == 'zip'){
                        
                        $hasil  = backsiswacode::uploadtugas($filename, $filetemp, $tipe, $user, $index, $submateri);
                        if($hasil == 'true'){
                            backview::goto_pageact('materi', $id, $category, 'upscs');
                        }else{
                            backview::goto_pageact('materi', $id, $category, 'errscs');
                        }
                    } else {
                        backview::goto_pageact('materi', $id, $category, 'errtype');
                    }
                    
                } else {
                    backview::goto_page('home');
                }
            break;
            case 'comment':
                $submateri  = $_POST['smateri'];
                $kategori   = $_POST['kmateri'];
                $user       = $_POST['umateri'];
                $usercomm   = backsiswacode::studentprofile($user);
                $ucomm      = "";
                foreach($usercomm as $datauser){
                    $ucomm  = $datauser['id_siswa'];
                }
            
                $materi     = $_POST['imateri'];
                $subyek     = $_POST['subjek'];
                $komentar   = $_POST['komentar'];
            
                date_default_timezone_set("Asia/Jakarta");
                $tanggal    = date("Y-m-d");
                $jam        = date("H:i:s");
                $hasil      = backsiswacode::insertcomment($ucomm, $materi, $subyek, $komentar, $tanggal, $jam, $user, $submateri, $kategori);
                $id         = backsiswacode::setidmbysub($submateri);

                if($hasil == 'true'){
                    backview::goto_pageid('materi', $id, $kategori);
                } else {
                    backview::goto_pageid('materi', $id, $kategori);
                }
            break;
            case 'nos':
                backview::goto_page('log');
            break;
            case 'logout':
                session_start();
                //Mencatat aktifitas
                date_default_timezone_set("Asia/Jakarta");
                $conn   = backsiswacode::koneksi();
                $sid    = "SELECT id FROM login WHERE username = '$_SESSION[user]'";
                $sql_sid = mysqli_query($conn, $sid) or die (mysqli_error($conn));
                $arr_sid = mysqli_fetch_array($sql_sid, MYSQLI_ASSOC);
                $idsiswa = $arr_sid['id'];
                
                $materi_log = "Log Out";

                $kelas      = backsiswacode::kelas($_SESSION['user']);
                $tanggal    = date("Y-m-d");
                $jam        = date("H:i:s");
                $catat      = backsiswacode::inslog($idsiswa, $kelas, $tanggal, $jam, $materi_log);
                                
                session_destroy();
                header("location:http://localhost:8080/elprowinmvc.com/frontpage.php?p=masuk");
            break;
            default:
                 backview::goto_page('home');
            break;
        }
    } else {
         backview::goto_page('home');
    }
?>