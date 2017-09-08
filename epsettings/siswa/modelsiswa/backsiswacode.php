<?php
    class backsiswacode{
        public static function koneksi(){
            $dbhost     = "localhost";
            $dbuser     = "root";
            $dbpass     = "";
            $dbname     = "dbelprowin";
            $conn   = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
            if(mysqli_connect_errno()){
                die ("Koneksi gagal : ". mysqli_connect_errno());
            }
            return $conn;
        }
        public static function isnama($user){
            $conn   = backsiswacode::koneksi();
            $data   = "";
            $getid  = "SELECT id FROM login WHERE username = '$user'";
            $sqlid  = mysqli_query($conn, $getid);
            $arrid  = mysqli_fetch_array($sqlid, MYSQLI_ASSOC);
            $data   = $arrid['id'];
            return $data;
        }
        public static function check($user){
            $conn   = backsiswacode::koneksi();
            $data   = "";
            $qcuser = " SELECT login.*, data_siswa.* 
                        FROM login
                        INNER JOIN data_siswa
                        ON login.id = data_siswa.id_siswa
                        WHERE login.username = '$user'";
            $scuser = mysqli_query($conn, $qcuser);
            $ncuser = mysqli_num_rows($scuser);
            $data   = $ncuser;
            return $data;
        }
        public static function setmateri($user){
            $conn = backsiswacode::koneksi();
            $data = "";
            $id   = backsiswacode::isnama($user);
            $qry_gethasil   = " SELECT hasil_belajar.*, detail_materi.* 
                                FROM hasil_belajar 
                                INNER JOIN detail_materi
                                ON hasil_belajar.materi = detail_materi.idmateri
                                WHERE hasil_belajar.nama = '$id'";
            $sql_gethasil   = mysqli_query($conn, $qry_gethasil);
            while($dta_gethasil   = mysqli_fetch_array($sql_gethasil, MYSQLI_ASSOC)){
                $data[]=$dta_gethasil;
            }
            return $data;
        }
        public static function statusmateri($hasil){
            $conn = backsiswacode::koneksi();
            $qry_getnilai   = "SELECT * FROM rapor WHERE hasil = '$hasil'";
            $sql_getnilai   = mysqli_query($conn, $qry_getnilai);
            $dta_getnilai   = mysqli_fetch_array($sql_getnilai, MYSQLI_ASSOC);
            return $dta_getnilai;
        }
        public static function materibelum($materi, $user){
            $conn = backsiswacode::koneksi();
            $data       = "";
            $qry_blm    = " SELECT * FROM detail_materi 
                            WHERE materi='$materi' AND idmateri 
                            NOT IN (SELECT materi FROM hasil_belajar WHERE nama='$user')";
            $sql_blm    = mysqli_query($conn, $qry_blm);
            while($arr_blm = mysqli_fetch_array($sql_blm, MYSQLI_ASSOC)){
                $data[]=$arr_blm;
            }
            return $data;
        }
        public static function materisiswa($user){
            $conn = backsiswacode::koneksi();
            $data       = "";
            $getid      = "SELECT id FROM login WHERE username = '$user'";
            $sqlid      = mysqli_query($conn, $getid);
            
            if($sqlid){
                $arrid      = mysqli_fetch_array($sqlid, MYSQLI_ASSOC);
                $setid      = $arrid['id'];
                $qrygdata   = " SELECT  hasil_belajar.idhasil as idhasil, hasil_belajar.nama as nama, hasil_belajar.materi as nomateri,
                                        hasil_belajar.classdir as classdir, hasil_belajar.labdir as labdir,
                                        detail_materi.*
                                FROM hasil_belajar
                                INNER JOIN detail_materi
                                ON hasil_belajar.materi  = detail_materi.idmateri
                                WHERE hasil_belajar.nama = '$setid'";
                $sqlgetdata = mysqli_query($conn, $qrygdata);
                if($sqlgetdata){
                    while($arrgetdata = mysqli_fetch_array($sqlgetdata, MYSQLI_ASSOC)){
                        $data[]=$arrgetdata;
                    }
                } else {
                    $data   = "";
                }
            } else {
                $data  = "";
            }
            return $data;
        }
        public static function setprogress($jsubmateri){
            $conn = backsiswacode::koneksi();
            $progress        = 0;
            $qry_totalmateri = "SELECT * FROM detail_materi";
            $sql_totalmateri = mysqli_query($conn, $qry_totalmateri);
            $totalmateri     = mysqli_num_rows($sql_totalmateri);
            if($totalmateri<>0){
                $progress   = ceil(($jsubmateri/$totalmateri)*100);
            } else {
                $progress   = 0;
            }
            return $progress;
        }
        public static function listmateri(){
            $conn = backsiswacode::koneksi();
            $data   = "";
            $qry_ambilmateri = "SELECT DISTINCT(materi) FROM detail_materi";
            $sql_ambilmateri = mysqli_query($conn, $qry_ambilmateri);
            while($arr_ambilmateri = mysqli_fetch_array($sql_ambilmateri, MYSQLI_ASSOC)){
                $data[]=$arr_ambilmateri;
            }
            return $data;
        }
        public static function getfirstmateri(){
            $conn   = backsiswacode::koneksi();
            $data   = "";
            $q_gfm  = "SELECT * FROM detail_materi ORDER BY idmateri ASC";
            $s_gfm  = mysqli_query($conn, $q_gfm);
            $a_gfm  = mysqli_fetch_array($s_gfm, MYSQLI_ASSOC);
            $data   = $a_gfm['submateri'];
            return  $data;
        }
        public static function listsubmateri($materi){
            $conn = backsiswacode::koneksi();
            $data   = "";
            $qry_ambilmateri = "SELECT submateri FROM detail_materi WHERE materi='$materi'";
            $sql_ambilmateri = mysqli_query($conn, $qry_ambilmateri);
            while($arr_ambilmateri = mysqli_fetch_array($sql_ambilmateri, MYSQLI_ASSOC)){
                $data[]=$arr_ambilmateri;
            }
            return $data;
        }
        public static function materilanjut($user){
            $conn = backsiswacode::koneksi();
            $data = "";
            $q_list = " SELECT * FROM detail_materi 
                        WHERE idmateri 
                        NOT IN (SELECT materi FROM hasil_belajar WHERE nama='$user')
                        ORDER BY idmateri ASC";
            $s_list = mysqli_query($conn, $q_list);
            $arr_list = mysqli_fetch_array($s_list, MYSQLI_ASSOC);
            $data = $arr_list['submateri'];
            
            return $data;
        }
        public static function jumlahmateri($materi, $user){
            $conn = backsiswacode::koneksi();
            $data       = "";
            $qry_blm    = " SELECT * FROM detail_materi 
                            WHERE materi='$materi' AND idmateri 
                            NOT IN (SELECT materi FROM hasil_belajar WHERE nama='$user')";
            $sql_blm    = mysqli_query($conn, $qry_blm);
            $data       = mysqli_num_rows($sql_blm);
            return $data;
        }
        public static function materiselesai($materi, $user){
            $conn = backsiswacode::koneksi();
            $data       = "";
            $qry_mat    = "SELECT COUNT(submateri) FROM detail_materi WHERE materi='$materi'";
            $sql_mat    = mysqli_query($conn, $qry_mat);
            $data_mat   = mysqli_num_rows($sql_mat);
            
            $qry_fin    = " SELECT COUNT(submateri) FROM detail_materi 
                            WHERE materi='$materi' AND idmateri 
                            IN (SELECT materi FROM hasil_belajar WHERE nama='$user')";
            $sql_fin    = mysqli_query($conn, $qry_fin);
            $data_fin   = mysqli_num_rows($sql_fin);
            
            if($data_mat == $data_fin){
                $data = "finish";
            }else{
                $data = "not";
            }
            
            return $data;
        }
        public static function jumsubmateri($materi){
            $conn = backsiswacode::koneksi();
            $data   = "";
            $qry_detailsub  = "SELECT submateri FROM detail_materi WHERE materi='$materi'";
            $sql_detailsub  = mysqli_query($conn, $qry_detailsub);
            $data  = mysqli_num_rows($sql_detailsub);
            return $data;
        }
        public static function studentclass($name){
            $conn = backsiswacode::koneksi();
            $data       = "";
            $qryprofile = " SELECT data_siswa.id_siswa, data_siswa.siswa_kelas, login.*
                            FROM data_siswa
                            INNER JOIN login
                            ON data_siswa.id_siswa = login.id
                            WHERE login.username = '$name'";
            $sqlprofile = mysqli_query($conn, $qryprofile);
            $arrprofile = mysqli_fetch_array($sqlprofile, MYSQLI_ASSOC);
            $data       = $arrprofile['siswa_kelas'];
            return $data;
        }
        public static function studentprofile($name){
            $conn = backsiswacode::koneksi();
            $data       = "";
            $qryprofile = " SELECT data_siswa.*, login.*
                            FROM data_siswa
                            INNER JOIN login
                            ON data_siswa.id_siswa = login.id
                            WHERE login.username = '$name'";
            $sqlprofile = mysqli_query($conn, $qryprofile);
            while($arrprofile = mysqli_fetch_array($sqlprofile, MYSQLI_ASSOC)){
                $data[]       = $arrprofile;
            }
            return $data;
        }
        public static function editlogin($id, $password){
            $conn = backsiswacode::koneksi();
            $data = "";
            if($password<>''){
                $random         = "x0e7q5t1k3g8s2n4lr9f";
                $randompass     = sha1(md5($random.md5($password).$random));
                $qry_edlogin    = "UPDATE login SET password='$randompass' WHERE id='$id'";
                $sql_edlogin    = mysqli_query($conn, $qry_edlogin);
                $data           = "true";
            } else if($password == ''){
                $data           = "true";
            } else {
                $data           = "false";
            }
            return $data;
        }
        public static function editprofile($username, $id, $nama, $kelas, $no, $email, $pp, $pptemp, $pass, $repass){
            $conn = backsiswacode::koneksi();
            $data = "";
            if($username<>'' and $id<>'' and $nama<>'' and $kelas<>'' and $no<>'' and $email<>''){
                
                $a_absen    = " SELECT data_siswa.id_siswa, data_siswa.no_absen, login.id, login.username
                                FROM data_siswa
                                INNER JOIN login
                                ON data_siswa.id_siswa = login.id
                                WHERE login.username = '$username'";
                $s_aabsen   = mysqli_query($conn, $a_absen);
                //$d_aabsen   = mysqli_fetch_assoc($s_aabsen, MYSQLI_ASSOC);
                $ce_absen   = mysqli_num_rows($s_aabsen);
                $c_absen    = "";
                
                if($ce_absen <> 0){
                    $c_absen    = "n";
                }else if($ce_absen == 0){
                    $q_absen    = "SELECT no_absen FROM data_siswa WHERE no_absen = '$no'";
                    $s_absen    = mysqli_query($conn, $q_absen);
                    $cs_absen   = mysqli_num_rows($s_absen);
                    $c_absen    = "y";

                    if($cs_absen<>0){
                        $c_absen = "y";
                    } else {
                        $c_absen = "n";
                    }
                }
                
                //Mengecek no_absen
                
                if($c_absen <> 'y'){
                    if($pp<>'' and $pptemp<>''){
                        
                        //Memasukkan data dengan pengubahan foto
                        $ppname = $id.".".$pp;
                        $lokasi = 'public/images/foto-profil/'.basename($id. ".$pp");
                        move_uploaded_file($pptemp, $lokasi);
                        $qry_edprofil = " UPDATE data_siswa SET 
                                          nama_siswa = '$nama', 
                                          siswa_kelas = '$kelas', 
                                          no_absen='$no', 
                                          email='$email', 
                                          foto='$ppname', 
                                          url_foto='$lokasi' 
                                          WHERE id_siswa='$id'";
                        $sql_edprofil = mysqli_query($conn, $qry_edprofil);
                        if($sql_edprofil){
                            $updlogin = backsiswacode::editlogin($id, $pass);
                            if($updlogin == 'true'){
                                $data = "true";
                                
                                //Mencatat aktifitas
                                date_default_timezone_set("Asia/Jakarta");
                                
                                $idsiswa    = $id;
                                $kelas      = backsiswacode::kelas($username);
                                $tanggal    = date("Y-m-d");
                                $jam        = date("H:i:s");
                                $materi_log = "Mengubah data pada profil";
                                $catat      = backsiswacode::inslog($idsiswa, $kelas, $tanggal, $jam, $materi_log);
                                
                            } else {
                                $data = "false";
                            }
                        } else {
                            $data = "false";
                        }
                    } else if($pp=='' and $pptemp=='') {
                        
                        //Memasukkan data dengan pengubahan foto
                        $qry_edprofil = " UPDATE data_siswa SET 
                                          nama_siswa = '$nama', 
                                          siswa_kelas = '$kelas', 
                                          no_absen='$no', 
                                          email='$email'
                                          WHERE id_siswa='$id'";
                        $sql_edprofil = mysqli_query($conn, $qry_edprofil);
                        if($sql_edprofil){
                            $updlogin = backsiswacode::editlogin($id, $pass);
                            if($updlogin == 'true'){
                                $data = "true";
                                
                                //Mencatat aktifitas
                                date_default_timezone_set("Asia/Jakarta");
                                
                                $idsiswa    = $id;
                                $kelas      = backsiswacode::kelas($username);
                                $tanggal    = date("Y-m-d");
                                $jam        = date("H:i:s");
                                $materi_log = "Mengubah data pada profil";
                                $catat      = backsiswacode::inslog($idsiswa, $kelas, $tanggal, $jam, $materi_log);
                                
                            } else {
                                $data = "false";
                            }
                        } else {
                            $data = "false";
                        }
                    } else {
                        $data = "false";
                    }
                }else{
                    $data = "false";
                }
            } else {
                $data = "false";
            }
            
            return $data;
        }
        public static function setidmbysub($submateri){
            $conn = backsiswacode::koneksi();
            $data = "";
            $qry_dsub   = "SELECT idmateri FROM detail_materi WHERE submateri='$submateri'";
            $sql_dsub   = mysqli_query($conn, $qry_dsub);
            $dta_dsub   = mysqli_fetch_array($sql_dsub, MYSQLI_ASSOC);
            return $dta_dsub['idmateri'];
        }
        public static function cekmaterisiswa($user, $materi, $jenismateri){
            $conn = backsiswacode::koneksi();
            $data = "";
            $userid     = backsiswacode::isnama($user);
            $qry_dsub   = " SELECT hasil_belajar.idhasil as idhasil, hasil_belajar.materi as idmateri, rapor.kclass, rapor.klab
                            FROM hasil_belajar
                            INNER JOIN rapor
                            ON hasil_belajar.idhasil = rapor.norapor
                            WHERE hasil_belajar.nama = '$userid' AND hasil_belajar.materi = '$materi'";
            $sql_dsub = mysqli_query($conn, $qry_dsub);
            $cek_dsub = mysqli_num_rows($sql_dsub);

            if($cek_dsub<>0){
                while($dta_dsub = mysqli_fetch_array($sql_dsub, MYSQLI_ASSOC)){
                    if($jenismateri == 'class'){
                        if($dta_dsub['kclass']=='L'){
                            $data   = 'false';
                        }else if($dta_dsub['kclass']=='R'){
                            $data   = 'true';
                        }
                    }else if($jenismateri == 'lab'){
                        if($dta_dsub['klab']=='L'){
                            $data   = 'false';
                        }else if($dta_dsub['klab']=='R'){
                            $data   = 'true';
                        }
                    }
                }
            }else if($cek_dsub == 0){
                $data = 'true';
            }
            return $data;
        }
        public static function datamateri($id, $cat){
            $conn = backsiswacode::koneksi();
            $data   = "";
            $qry_materi = " SELECT detail_materi.idmateri as idmateri, detail_materi.materi as themateri, detail_materi.submateri as submateri, konten_materi.* 
                            FROM detail_materi 
                            INNER JOIN konten_materi
                            ON detail_materi.idmateri = konten_materi.materi
                            WHERE detail_materi.idmateri = '$id' AND konten_materi.kategori='$cat'";
            $sql_materi = mysqli_query($conn, $qry_materi);
            while($dta_materi = mysqli_fetch_array($sql_materi, MYSQLI_ASSOC)){
                $data[]=$dta_materi;
            }
            return $data;
        }
        public static function uploadtugas($fname, $ftemp, $cat, $username, $idmateri, $submateri){
            $conn = backsiswacode::koneksi();
            $data   = "";
            if($fname<>'' and $ftemp<>'' and $cat<>''){
                $materi     = backsiswacode::materisiswa($username);
                $id         = backsiswacode::isnama($username);
                $qryprofile = " SELECT data_siswa.*, login.*
                                FROM data_siswa
                                INNER JOIN login
                                ON data_siswa.id_siswa = login.id
                                WHERE login.username = '$username'";
                $sqlprofile = mysqli_query($conn, $qryprofile);
                $arrprofile = mysqli_fetch_array($sqlprofile, MYSQLI_ASSOC);
                $locate     = "";   
                
                if($materi<>''){
                    $dm         = "";
                    foreach($materi as $m){
                        if($m['nomateri'] == $idmateri){
                            $dm="true";
                            $cekdir = "F:/xampp/htdocs/elprowinmvc.com/epsettings/siswa/".$locate;
                            if(file_exists($cekdir)){
                                chmod($direktori, 0644);
                                unlink($cekdir);
                            }
                            
                            if($cat=='lab'){
                                $locate     = 'tugas/'.$arrprofile['siswa_kelas'].'/'.$username.'/'.basename($fname);
                                move_uploaded_file($ftemp, $locate);
                                
                                $qry_upd    = "UPDATE hasil_belajar SET labdir='$locate' WHERE materi='$idmateri' AND nama='$id'";
                                $sql_upd    = mysqli_query($conn, $qry_upd);
                                if($sql_upd){
                                    $data   = "true"; 
                                } else {
                                    $data   = "false";
                                }
                            } else if($cat=='class'){
                                $locate     = 'tugas/'.$arrprofile['siswa_kelas'].'/'.$username.'/'.basename($fname);
                                move_uploaded_file($ftemp, $locate);

                                $qry_upd    = "UPDATE hasil_belajar SET classdir='$locate' WHERE materi='$idmateri' AND nama='$id'";
                                $sql_upd    = mysqli_query($conn, $qry_upd);
                                if($sql_upd){
                                    $data   = "true"; 
                                } else {
                                    $data   = "SQL Execution Error";
                                }
                            } else{
                                $data = "Category not Found";
                            }
                        }else{
                            $dm="Materi is Empty";
                        }
                    }
                    
                    if($dm == 'false'){
                        $qry_get    = "SELECT idhasil FROM hasil_belajar ORDER BY idhasil DESC";
                        $sql_get    = mysqli_query($conn, $qry_get);
                        $dta_get    = mysqli_fetch_array($sql_get, MYSQLI_ASSOC);
                        if($cat=='class'){
                            $no         = 0;
                            if($dta_get['idhasil'] == ''){
                                $no     = 1;
                            } else {
                                $no     = $dta_get['idhasil'] + 1;
                            }

                            $locate     = 'tugas/'.$arrprofile['siswa_kelas'].'/'.$username.'/'.basename($fname);

                            move_uploaded_file($ftemp, $locate);

                            $qry_hasil  = "INSERT INTO hasil_belajar VALUES ('$no', '$id', '$idmateri', '$locate', '')";

                            $sql_hasil  = mysqli_query($conn, $qry_hasil) or die (mysqli_error());
                            if($sql_hasil){
                                $data   = "true"; 
                            } else {
                                $data   = "false iku";
                            }
                        } else if($cat=='lab'){
                            $no         = 0;
                            if($dta_get['idhasil'] == ''){
                                $no     = 1;
                            } else {
                                $no     = $dta_get['idhasil'] + 1;
                            }

                            $locate     = 'tugas/'.$arrprofile['siswa_kelas'].'/'.$username.'/'.basename($fname);

                            move_uploaded_file($ftemp, $locate);

                            $qry_upd  = "INSERT INTO hasil_belajar VALUES ('$no', '$id', '$idmateri', '', '$locate')";

                            $sql_upd    = mysqli_query($conn, $qry_upd) or die (mysqli_error());
                            if($sql_upd){
                                $data   = "true"; 
                            } else {
                                $data   = "SQL Execetion Error";
                            }
                        }else{
                            $data = "Category not Found";
                        }
                    }
                    
                } else if($materi=='') {
                    $qry_get    = "SELECT idhasil FROM hasil_belajar ORDER BY idhasil DESC";
                    $sql_get    = mysqli_query($conn, $qry_get);
                    $dta_get    = mysqli_fetch_array($sql_get, MYSQLI_ASSOC);
                    $no         = 0;
                    if($cat=='class'){
                        if($dta_get['idhasil'] == ''){
                            $no     = 1;
                        } else {
                            $no     = $dta_get['idhasil'] + 1;
                        }

                        $locate     = 'tugas/'.$arrprofile['siswa_kelas'].'/'.$username.'/'.basename($fname);

                        move_uploaded_file($ftemp, $locate);

                        $qry_hasil  = "INSERT INTO hasil_belajar VALUES ('$no', '$id', '$idmateri', '$locate', '')";

                        $sql_hasil  = mysqli_query($conn, $qry_hasil) or die (mysqli_error());
                        if($sql_hasil){
                            $data   = "true"; 
                        } else {
                            $data   = "false iku";
                        }
                    } else if($cat=='lab'){
                        $no         = 0;
                        if($dta_get['idhasil'] == ''){
                            $no     = 1;
                        } else {
                            $no     = $dta_get['idhasil'] + 1;
                        }

                        $locate     = 'tugas/'.$arrprofile['siswa_kelas'].'/'.$username.'/'.basename($fname);

                        move_uploaded_file($ftemp, $locate);

                        $qry_upd  = "INSERT INTO hasil_belajar VALUES ('$no', '$id', '$idmateri', '', '$locate')";

                        $sql_upd    = mysqli_query($conn, $qry_upd) or die (mysqli_error());
                        if($sql_upd){
                            $data   = "true"; 
                        } else {
                            $data   = "Error in Execute SQL Code";
                        }
                    }else{
                        $data = "Category not found";
                    }
                }
            } else {
                $data = "Materi is empty";
            }
            
            if($data == 'true'){
                //Mencatat aktifitas
                date_default_timezone_set("Asia/Jakarta");

                $idsiswa    = backsiswacode::isnama($username);
                $kelas      = backsiswacode::kelas($username);
                $tanggal    = date("Y-m-d");
                $jam        = date("H:i:s");
                $materi_log = "Mengunggah tugas pada materi ".$submateri." kategori ".$cat;
                
                $catat      = backsiswacode::inslog($idsiswa, $kelas, $tanggal, $jam, $materi_log);
            }
            
            return $data;
        }
        public static function classcomm($kelas){
            $conn = backsiswacode::koneksi();
            $data   = "";
            $qry_kelas      = " SELECT data_guru.id_guru, data_guru.nama, data_guru.guru_kelas, 
                                       data_siswa.id_siswa, data_siswa.nama_siswa, data_siswa.siswa_kelas
                                FROM data_guru
                                INNER JOIN data_siswa
                                ON data_guru.guru_kelas = data_siswa.siswa_kelas
                                WHERE data_guru.guru_kelas = '$kelas'";
            $sql_kelas      = mysqli_query($conn, $qry_kelas);
            while($arr_kelas = mysqli_fetch_array($sql_kelas, MYSQLI_ASSOC)){
                $data[]=$arr_kelas;
            }
            return $data;
        }
        public static function comment($materi){
            $conn = backsiswacode::koneksi();
            $data   = "";
            $qry_komentar   = "SELECT * FROM komentar WHERE kommateri='$materi' ORDER BY tanggal, jam, id_komen DESC";
            $sql_komentar   = mysqli_query($conn, $qry_komentar);
            while($arr_komentar   = mysqli_fetch_array($sql_komentar, MYSQLI_ASSOC)){
                $data[]=$arr_komentar;
            }
            return $data;
        }
        public static function commguru($user){
            $conn = backsiswacode::koneksi();
            $data   = "";
            $sql_usguru = " SELECT nama FROM data_guru WHERE data_guru.id_guru = '$user'";
            $qry_usguru = mysqli_query($conn, $sql_usguru);
            $dta_usguru = mysqli_fetch_array($qry_usguru, MYSQLI_ASSOC);
            $data   = $dta_usguru['nama'];
            return $data;
        }
        public static function commsiswa($user){
            $conn = backsiswacode::koneksi();
            $data   = "";
            $sql_usguru = " SELECT nama_siswa FROM data_siswa WHERE data_siswa.id_siswa = '$user'";
            $qry_usguru = mysqli_query($conn, $sql_usguru);
            $dta_usguru = mysqli_fetch_array($qry_usguru, MYSQLI_ASSOC);
            $data   = $dta_usguru['nama_siswa'];
            return $data;
        }
        public static function insertcomment($user, $materi, $subject, $komentar, $tanggal, $jam, $username, $submateri, $kategori){
            $conn = backsiswacode::koneksi();
            $data   = "";
            $qry_komentar   = "SELECT id_komen FROM komentar ORDER BY id_komen DESC";
            $sql_komentar   = mysqli_query($conn, $qry_komentar);
            $num_komentar   = mysqli_num_rows($sql_komentar);
            $arr_komentar   = mysqli_fetch_array($sql_komentar, MYSQLI_ASSOC);
            $number         = 0;
            
            if($num_komentar == 0){
                $number     = 1;
            } else {
                $number     = $arr_komentar['id_komen'] + 1;
            }
            
            $qry_inskom     = "INSERT INTO komentar VALUES ('$number', '$user', '$materi', '$subject', '$komentar', '$tanggal', '$jam')";
            $sql_inskom     = mysqli_query($conn, $qry_inskom);
            if($sql_inskom){
                $data       = "true";
                
                //Mencatat aktifitas
                date_default_timezone_set("Asia/Jakarta");

                $idsiswa    = $user;
                $kelas      = backsiswacode::kelas($username);
                $tanggal    = date("Y-m-d");
                $jam        = date("H:i:s");
                $materi_log = "Mengomentari materi ".$submateri." kategori ".$kategori;
                $catat      = backsiswacode::inslog($idsiswa, $kelas, $tanggal, $jam, $materi_log);
            } else {
                $data       = "false";
            }
            return $data;
        }
        public static function kelas($user){
            $conn = backsiswacode::koneksi();
            $qry_id     = "SELECT id, username FROM login WHERE username='$user'";
            $sql_id     = mysqli_query($conn, $qry_id);
            $get_id     = mysqli_fetch_array($sql_id, MYSQLI_ASSOC);
            $is_id      = $get_id['id'];

            $qry_kelas  = "SELECT id_siswa, siswa_kelas FROM data_siswa WHERE id_siswa = '$is_id'";
            $sql_kelas  = mysqli_query($conn, $qry_kelas);
            $data_kelas = mysqli_fetch_array($sql_kelas, MYSQLI_ASSOC);
            $guru_kelas = '';
            $guru_kelas = $data_kelas['siswa_kelas'];
            return $guru_kelas;
        }
        public static function inslog($user, $kelas, $tanggal, $jam, $aktifitas){
            $conn = backsiswacode::koneksi();
            $data   = "";
            $qry_log    = "INSERT INTO catatan VALUES ('', '$user', '$kelas', '$tanggal', '$jam', '$aktifitas')";
            $sql_log    = mysqli_query($conn, $qry_log);
            if($sql_log){
                $data   = "true";
            }else{
                $data   = "false";
            }
            return $data;
        }
        public static function catatansiswa($user){
            $conn   = backsiswacode::koneksi();
            $data   = "";
            $userid = backsiswacode::isnama($user);
            
            $qry_cs = "SELECT * FROM catatan WHERE user_id = '$userid'";
            $sql_cs = mysqli_query($conn, $qry_cs) or die (mysqli_error($conn));
            
            while($arr_cs = mysqli_fetch_array($sql_cs, MYSQLI_ASSOC)){
                $data[]=$arr_cs;
            }
            return $data;
        }
    }
?>