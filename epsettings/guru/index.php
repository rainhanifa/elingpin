<?php
    include "viewguru/backview.php";
    include "modelguru/backgurucode.php";
    
    if(isset($_REQUEST['p'])){
        $halaman = $_GET['p'];
        switch($halaman){
            case 'beranda':
                backview::goto_page('home');
            break;
            case 'carisiswa':
                $category   = $_POST['type'];
                $keyword    = $_POST['searchid'];
                backview::search_action('home',$category,$keyword);
            break;
            case 'profil':
                backview::goto_page('profil');
            break;
            case 'edprofil':
                backview::goto_page('edprofil');
            break;
            case 'updprofil':
                $idguru     = $_POST['id'];
                $nama       = $_POST['nama'];
                $kelas      = $_POST['kelas'];
                $nip        = $_POST['nip'];
                $email      = $_POST['mail'];
                $ppname     = $_FILES['profil']['name'];
                $pptemp     = $_FILES['profil']['tmp_name'];
                $pass       = $_POST['kunci'];
                $hasil = backgurucode::updprofil($idguru, $nama, $kelas, $nip, $email, $ppname, $pptemp, $pass);
                if($hasil == 'true'){
                    backview::goto_page('profil');
                } else {
                    backview::goto_page('edprofil');
                }
            break;
            case 'materi':
                backview::goto_page('materi');
            break;
            case 'fm':
                backview::goto_page('fm');
            break;
            case 'tm':
                $materi     = $_POST['materi'];
                $submateri  = $_POST['submateri'];
                $user       = $_POST['userid'];
                $hasil      = backgurucode::tambahmateri($materi, $submateri, $user);
                if($hasil == 'true'){
                    backview::goto_page('materi');
                } else {
                    backview::goto_page('fm');
                }
            break;
            case 'fkm':
                if(!isset($_GET['i'])){
                    $id = null;
                    backview::gopageid('fkm',$id);
                } else {
                    $id = $_GET['i'];
                    backview::gopageid('fkm',$id);
                }
            break;
            case 'fedmateri':
                if(isset($_GET['m'])){
                    $materi = $_GET['m'];
                    backview::gopageid('formem', $materi);
                } else {
                    backview::goto_page('materi');
                }
            break;
            case 'em':
                $konek = backgurucode::connecttodb();
                $hasil = "";
                if($konek){
                    $id         = $_POST['userid'];
                    $materi     = $_POST['materi'];
                    $qry_getsub = "SELECT * FROM detail_materi WHERE materi='$materi'";
                    $sql_getsub = mysqli_query($konek, $qry_getsub) or die (mysqli_error($konek));
                    
                    if($sql_getsub){
                        while($arr = mysqli_fetch_array($sql_getsub, MYSQLI_ASSOC)){
                            $postmateri = 'submateri'.$arr['idmateri'];
                            $submateri  = $_POST[$postmateri];
                            $hasil      = backgurucode::editmateriact($arr['idmateri'], $materi, $submateri);
                        }
                        
                        if($hasil   == 'true'){
                            //Mencatat aktifitas
                            date_default_timezone_set("Asia/Jakarta");

                            $qry_idlog  = "SELECT id FROM login WHERE username = '$id'";
                            $sql_idlog  = mysqli_query($konek, $qry_idlog) or die (mysqli_error($konek));
                            $arr_idlog  = mysqli_fetch_array($sql_idlog, MYSQLI_ASSOC);
                            $idguru     = $arr_idlog['id'];
                            $materi_log = "Mengubah submateri pada materi ".$materi;

                            $kelas      = backgurucode::kelas($id);
                            $tanggal    = date("Y-m-d");
                            $jam        = date("H:i:s");
                            $catat      = backgurucode::inslog($idguru, $kelas, $tanggal, $jam, $materi_log);
                            
                            backview::goto_page('materi');
                        } else {
                            backview::gopageid('fem', $materi);
                        }
                    }else{
                        echo "Wrong Data Selection";
                    }
                }else{
                    echo "Connection to database was lost";
                }
            break;
            case 'delm':
                $materi = $_GET['m'];
                $user   = $_GET['u'];
                $hasil  = backgurucode::hapusmateri($materi, $user);
                if($hasil == 'true'){
                    backview::goto_page('materi');
                } else {
                    backview::goto_page('materi');
                }
            break;
            case 'carimateri':
                $category   = $_POST['category'];
                $keyword    = $_POST['searchid'];
                backview::search_action('materi',$category,$keyword);
            break;
            case 'tmkonten':
                $materi     = $_POST['materi'];
                $submateri  = $_POST['submateri'];
                $kategori   = $_POST['kategori'];
                $isi        = $_POST['isimateri'];

                if($_FILES['filemateri']){
                    $uploadOk = 1;

                    $target_dir   = realpath(realpath(__DIR__)."/../../materi");
                    $temp_file      =   $_FILES["filemateri"]["tmp_name"];
                    $file_name      =   $_FILES["filemateri"]["name"];
                    
                    //get FileType
                    $imageFileType = pathinfo($file_name,PATHINFO_EXTENSION);
                    echo $imageFileType;
                    if($imageFileType == "pdf") {
                        $subfolder  = "/pdf/";
                    }else if ($imageFileType == "webm" || $imageFileType == "ogg" || $imageFileType == "mp4"){
                        $subfolder  = "/video/";
                    }else{
                        echo "gagal";exit;
                    }
                    
                    $target_dir = realpath($target_dir.$subfolder);
                    $target_file = $target_dir . "/" .basename($file_name);
                    if(move_uploaded_file($temp_file, $target_file)){
                        chmod($target_file, 0777);
                    }

                    $isi = $subfolder.basename($file_name);
                }

                $nama       = $_POST['uploader'];
                $hasil      = backgurucode::addkm($materi, $submateri, $kategori, $isi, $nama);
                if($hasil == 'true'){
                    backview::goto_page('materi');
                } else {
                    backview::goto_page('fkm');
                }
            break;
            case 'classact':
                $id = $_GET['cl'];
                backview::gopageid('cm',$id);
            break;
            case 'edkonten':
                $idk        = $_POST['idk'];
                $materi     = $_POST['materi'];
                $submateri  = $_POST['submateri'];
                $kategori   = $_POST['kategori'];
                $isi        = $_POST['isimateri'];


                if($_FILES['filemateri']){
                    $uploadOk = 1;

                    $target_dir   = realpath(realpath(__DIR__)."/../../materi");
                    $temp_file      =   $_FILES["filemateri"]["tmp_name"];
                    $file_name      =   $_FILES["filemateri"]["name"];
                    
                    //get FileType
                    $imageFileType = pathinfo($file_name,PATHINFO_EXTENSION);
                    echo $imageFileType;
                    if($imageFileType == "pdf") {
                        $subfolder  = "/pdf/";
                    }else if ($imageFileType == "webm" || $imageFileType == "ogg" || $imageFileType == "mp4"){
                        $subfolder  = "/video/";
                    }else{
                        echo "gagal";exit;
                    }
                    
                    $target_dir = realpath($target_dir.$subfolder);
                    $target_file = $target_dir . "/" .basename($file_name);
                    if(move_uploaded_file($temp_file, $target_file)){
                        chmod($target_file, 0777);
                    }

                    $isi = $subfolder.basename($file_name);
                }
                
                $nama       = $_POST['uploader'];
                $hasil      = backgurucode::edkm($idk, $materi, $submateri, $kategori, $isi, $nama);
                if($hasil == 'true'){
                    backview::gopageid('cm',$idk);
                } else {
                    backview::gopageid('fkm',$idk);
                }
            break;
            case 'labact':
                $id = $_GET['nl'];
                backview::gopageid('lm',$id);
            break;
            case 'lap':
                backview::goto_page('rapor');
            break;
            case 'searap':
                $kategori       = $_POST['catrapor'];
                $searchvalue    = $_POST['sidrapor'];
                backview::search_action('rapor', $kategori, $searchvalue);
            break;
            case 'fhasil':
                if(isset($_GET['i'])){
                    $siswa  = $_GET['i'];
                    backview::gopageid('fr', $siswa);
                } else {
                    backview::goto_page('rapor');
                }
            break;
            case 'insrap':
                $siswa      = $_POST['namasiswa'];
                $nohasil    = $_POST['nohas'];
                $detailn    = $_POST['detnilai'];
                $class      = $_POST['nilaiclass'];
                $lab        = $_POST['nilailab'];
                $guru       = $_POST['guru'];
                $hasil      = backgurucode::insrapor($nohasil, $detailn, $class, $lab, $guru);
                if($hasil == 'true'){
                    backview::goto_page('rapor');
                } else {
                    backview::gopageid('fr', $siswa);
                }
            break;
            case 'updrap':
                $idrapor    = $_POST['idr'];
                $siswa      = $_POST['namasiswa'];
                $detailn    = $_POST['detnilai'];
                $class      = $_POST['nilaiclass'];
                $lab        = $_POST['nilailab'];
                $idhasil    = $_POST['nohas'];
                $guru       = $_POST['guru'];
                $hasil      = backgurucode::updrapor($idrapor, $detailn, $class, $lab, $idhasil, $guru);
                if($hasil == 'true'){
                    backview::goto_page('rapor');
                } else {
                    backview::gopageid('fr', $siswa);
                }
            break;
            case 'comm':
                $catmateri  = $_POST['kategori'];
                $user       = $_POST['user'];
                $materi     = $_POST['materi'];
                $subject    = $_POST['subjek'];
                $komentar   = $_POST['komentar'];
                
                date_default_timezone_set("Asia/Jakarta");
                $tanggal    = date("Y-m-d");
                $jam        = date("H:i:s");
                $getiduser  = backgurucode::profil($user);
                $iduser     = "";
                
                foreach($getiduser as $data){
                    $iduser     = $data['id_guru'];
                }
            
                $hasil      = backgurucode::inscomm($iduser, $materi, $subject, $komentar, $tanggal, $jam);
                if($hasil == 'true'){
                    backview::gopageid($catmateri, $materi);
                } else {
                    backview::gopageid($catmateri, $materi);
                }
            break;
            case 'noc':
                backview::goto_page('log');
            break;
            case 'caricatatan':
                $category   = $_POST['type'];
                backview::gopageid('log', $category);
            break;
            case 'logout':
                session_start();
                
                //Mencatat aktifitas
                date_default_timezone_set("Asia/Jakarta");
                $conn   = backgurucode::connecttodb();
                $sid    = "SELECT id FROM login WHERE username = '$_SESSION[user]'";
                $sql_sid = mysqli_query($conn, $sid) or die (mysqli_error($conn));
                $arr_sid = mysqli_fetch_array($sql_sid, MYSQLI_ASSOC);
                $idguru = $arr_sid['id'];
                
                $materi_log = "Log Out";

                $kelas      = backgurucode::kelas($_SESSION['user']);
                $tanggal    = date("Y-m-d");
                $jam        = date("H:i:s");
                $catat      = backgurucode::inslog($idguru, $kelas, $tanggal, $jam, $materi_log);
                                
                session_destroy();
                header("location:http://localhost/elingpin/frontpage.php?p=masuk");
            break;
            default:
                backview::goto_page('home');
            break;
        }
    } else {
        backview::goto_page('home');
    }
?>