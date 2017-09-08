<?php
    
    session_start();
    
    include 'controller/front.php';
    include 'model/frontcode.php';
    
    if(isset($_REQUEST['p'])){
        $halaman = $_GET['p'];
        
        switch($halaman){
            case 'home':
                front::utama();
            break;
            case 'komp':
                front::komp();
            break;
            case 'materi':
                front::materi();
            break;
            case 'masuk':
                front::masuk('');
            break;
            case 'regsiswa':
                front::regsiswa();
            break;
            case 'regguru':
                front::regguru();
            break;
            case 'login':
                $user   = $_POST['namalogin'];
                $pass   = $_POST['kuncilogin'];
                frontcode::proseslogin($user,$pass);
            break;
            case 'daftarguru':
                $pengguna       = $_POST['pengguna'];
                $namalengkap    = $_POST['nama'];
                $guru_kelas     = $_POST['gurukelas'];
                $nip            = $_POST['nip'];
                $email          = $_POST['mail'];
                $nama_foto      = $_FILES['profil']['name'];
                $temp_foto      = $_FILES['profil']['tmp_name'];
                $password       = $_POST['kunci'];
                $repassword     = $_POST['ulangikunci'];
                
                if($pengguna<>'' and $namalengkap<>'' and $guru_kelas<>'' and $nip<>'' and $email<>'' and $password<>'' and $repassword<>''){
                    if($password == $repassword){
                        frontcode::insert_guru($pengguna, $namalengkap, $guru_kelas, $nip, $email, $nama_foto, $temp_foto, $password);
                    } else {
                        front::regguru();
                    }
                } else {
                    front::regguru();
                }
            break;
            case 'daftarsiswa':
                $pengguna       = $_POST['pengguna'];
                $namalengkap    = $_POST['namasiswa'];
                $siswa_kelas    = $_POST['siswakelas'];
                $absen          = $_POST['absen'];
                $email          = $_POST['mailsiswa'];
                $nama_foto      = $_FILES['profilsiswa']['name'];
                $temp_foto      = $_FILES['profilsiswa']['tmp_name'];
                $password       = $_POST['kunci'];
                $repassword     = $_POST['ulangikunci'];
                
                if($pengguna<>'' and $namalengkap<>'' and $siswa_kelas<>'' and $absen<>'' and $email<>'' and $password<>'' and $repassword<>''){
                    if($password == $repassword){
                        frontcode::insert_siswa($pengguna, $namalengkap, $siswa_kelas, $absen, $email, $nama_foto, $temp_foto, $password);
                    } else {
                        front::regsiswa();
                    }
                } else {
                    front::regsiswa();
                }
            break;
            case 'forpass':
                $email      = $_POST['forgetmail'];
                $username   = $_POST['forgetusername'];
                $cek        = frontcode::cekuser($username);
                if($cek == 'true'){
                    date_default_timezone_set("Asia/Jakarta");
                    $teksrandom = date("H:i:s")."x0e7q5t1k3g8s2n4lr9f";
                    $toknrandom = md5($teksrandom.md5($teksrandom).$teksrandom);
                    $token      = $toknrandom;
                    $sendmail   = frontcode::forgetpass($email, $username, $token);
                    if($sendmail == 'true'){
                        $message = "sscsend";
                        front::msgpage('formfp', $message);
                    } else {
                        $message = "errsend";
                        front::errorpage('masuk', $message);
                    }
                } else {
                    $message = "errusr";
                    front::errorpage('masuk', $message);
                }
            break;
            case 'fpdata':
                $username   = $_POST['userfp'];
                $token      = $_POST['tokenfp'];
                $newpass    = $_POST['passfp'];
                $hasil      = frontcode::sendforpass($username, $token, $newpass);
                if($hasil == 'true'){
                    $message = "scsdp";
                    front::msgpage('masuk', $message);
                } else {
                    $message = "errdr";
                    front::errorpage('formfp', $message);
                }
            break;
            default:
                front::utama();
            break;
        }
        
    } else {
        front::utama();
    }
?>