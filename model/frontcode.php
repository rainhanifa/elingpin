<?php
    class frontcode{
        //koneksi
        public static function connecttodb() {
            $dbHost = "localhost"; 
            $dbUser = "root";
            $dbPass = "12345";
            $dbName = "dbelprowin";
            $conn   = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
            if(mysqli_connect_errno()){
                die ("Koneksi gagal : ". mysqli_connect_errno());
            }
            return $conn;	
        }
        
        //Proses Login
        public static function proseslogin($username, $password){
            $con = frontcode::connecttodb();
            $random     = "x0e7q5t1k3g8s2n4lr9f";
            $randompass = sha1(md5($random.md5($password).$random));
            
            //mengecek data login
            $query  = "SELECT * FROM login WHERE username='$username'";
            $sql    = mysqli_query($con, $query);
            $cek    = mysqli_num_rows($sql);
            if($cek<>0){
                while($data   = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
                    if($randompass==$data['password']){
                        $_SESSION['user']   = $data['username'];
                        $namedir            = $data['username'];
                        $userdata           = $data['id'];
                        $id                 = substr($data['id'],0,1);
                        $direktori          = "";
                        $kelas              = "";
                        
                        //Mengecek direktori sudah ada atau belum
                        $cekdir             = "F:/xampp/htdocs/elprowinmvc.com/epsettings/siswa/public/js/codiad/workspace/".$namedir;
                        $cekdirtugas        = "F:/xampp/htdocs/elprowinmvc.com/epsettings/siswa/tugas/".$namedir;
                        
                        if(!file_exists($cekdir) && !file_exists($cekdirtugas)){
                            $loginid = substr($data['id'],0,1);
                            
                            if($loginid == '2'){
                                
                                //membuat folder workspace untuk menyimpan tugas
                                $wp       = "SELECT siswa_kelas FROM data_siswa WHERE id_siswa = '$data[id]'";
                                $sqlwp    = mysqli_query($con, $wp);
                                $kelaswp  = mysqli_fetch_array($sqlwp, MYSQLI_ASSOC);
                                $setkelas = $kelaswp['siswa_kelas'];                                
                                $kelas    = $setkelas;                
                                mkdir("F:/xampp/htdocs/elprowinmvc.com/epsettings/siswa/public/js/codiad/workspace/".$namedir,0777);
                                mkdir("F:/xampp/htdocs/elprowinmvc.com/epsettings/siswa/tugas/".$setkelas."/".$namedir,0777);
                                
                                $direktori  = $namedir;
                                
                            }else if($loginid == '1'){
                                //guru hanya dapat mengakses folder tugas sesuai dengan kelasnya
                                $wp         = "SELECT guru_kelas FROM data_guru WHERE id_guru = '$data[id]'";
                                $sqlwp      = mysqli_query($con, $wp);
                                $kelaswp    = mysqli_fetch_array($sqlwp, MYSQLI_ASSOC);
                                $setkelas   = $kelaswp['guru_kelas'];
                                $direktori  = "";
                                $kelas      = $setkelas;
                            }
                            
                            $_SESSION['folder'] = $namedir;
                            $updlogin   = "UPDATE login SET project = '$direktori' WHERE id = '$data[id]'";
                            $prouplog   = mysqli_query($con, $updlogin) or die (mysqli_error($con));
                        }
                        
                        if($id == '2'){
                            //membuat folder workspace untuk menyimpan tugas
                            $wp       = "SELECT siswa_kelas FROM data_siswa WHERE id_siswa = '$userdata'";
                            $sqlwp    = mysqli_query($con, $wp);
                            $kelaswp  = mysqli_fetch_array($sqlwp, MYSQLI_ASSOC);
                            $setkelas = $kelaswp['siswa_kelas'];                                
                            $kelas    = $setkelas;
                        }
                        
                        //Mencatat aktifitas login baik siswa maupun guru.
                        date_default_timezone_set("Asia/Jakarta");
                        $tanggal    = date("Y-m-d");
                        $jam        = date("H:i:s");
                        
                        echo "kelas ".$kelas;
                        
                        $sql_log    = "INSERT INTO catatan VALUES('','$userdata','$kelas','$tanggal','$jam','Log in')";
                        $exe_log    = mysqli_query($con, $sql_log);
                        
                        $id = substr($data['id'],0,1);
                        if($id == '1'){
                            front::loginpage('guru');
                        } else if ($id == '2'){
                            front::loginpage('siswa');
                        } else {
                            front::errorpage('masuk','idnf');
                        }
                    } else {
                        front::errorpage('masuk','passmm');
                    }
                }
            } else {
                front::errorpage('masuk','datanf');
            }
        }
        
        //Tambah data login
        public static function insert_login($id, $username, $password, $project){
            $con    = frontcode::connecttodb();
            $data   = "";
            $datalogin  = "INSERT INTO login VALUES('$id','$username','$password', '$project')";
            $prologin   = mysqli_query($con, $datalogin) or die (mysqli_error($con));
            if($prologin){
                $data   = "benar";
            }else{
                $data   = "salah";
            }
            return $data;
        }
        
        //Proses Registrasi Guru
        public static function insert_guru($pengguna, $namalengkap, $guru_kelas, $nip, $email, $nama_foto, $temp_foto, $password){
            $con    = frontcode::connecttodb();
            $con2   = frontcode::connecttodb();
            
            //Mengecek username
            $querycek_user  = "SELECT username FROM login WHERE username = '$pengguna'";
            $sqlcek_user    = mysqli_query($con, $querycek_user);
            $numcek_user    = mysqli_num_rows($sqlcek_user);
            $cek_user       = "";
            if($numcek_user<>0){
                $cek_user = "y";
            } else {
                $cek_user = "n";
            }
            
            if($cek_user == 'n'){   
                
                //Memasukkan data pengguna
                $query      = "SELECT id_guru FROM data_guru ORDER BY id_guru DESC LIMIT 0,1";
                $execute    = mysqli_query($con, $query);
                $cek        = mysqli_num_rows($execute);
                $get_data   = mysqli_fetch_array($execute, MYSQLI_ASSOC);

                //Untuk Id otomatis
                if ($cek<>0){
                    if($get_data['id_guru']<=28){
                            $id = $get_data['id_guru']+1;
                        }else if($get_data['id_guru']<=98){
                            $pid    = substr($get_data['id_guru'],1,1)+1;
                            $id     = "1".$pid;
                        }else if($get_data['id_guru']<=198){
                            $pid    = substr($get_data['id_guru'],1,2)+1;
                            $id     = "1".$pid;
                        }
                }else{
                    $id = 11;
                }

                //Untuk random password
                $random     = "x0e7q5t1k3g8s2n4lr9f";
                $randompass = sha1(md5($random.md5($password).$random));
                
                //Memanggil fungsi untuk menambah data login
                $inslogin = frontcode::insert_login($id, $pengguna, $randompass, '');
                if($inslogin == 'benar'){
                    
                    //Untuk upload foto
                    $nama_foto2     = '';
                    $lokasi2        = '';
                    if($temp_foto<>''){
                        $nama_foto2 = $id.".".$nama_foto;
                        $lokasi     = 'epsettings/guru/public/images/foto-profil/'.basename($id. ".$nama_foto");
                        $lokasi2    = 'public/images/foto-profil/'.basename($id. ".$nama_foto");
                        move_uploaded_file($temp_foto, $lokasi);        
                    }else if($temp_foto==''){
                        $nama_foto2 = 'user-default.png';
                        //$getserver  = $_SERVER['HTTP_HOST'];
                        $lokasi2    = 'public/images/foto-profil/'.basename($nama_foto2);
                    }
                    
                    $insert_dataguru    = "INSERT INTO data_guru VALUES('$id','$namalengkap','$guru_kelas','$nip','$email','$nama_foto2','$lokasi2')";
                    $dataguru_sql       = mysqli_query($con2, $insert_dataguru);
                    if($dataguru_sql){
                        front::masuk('regscs');
                    } else {
                        front::errorpage('regguru','errd');
                    }
                }else{
                    front::errorpage('regguru','errd');
                }
            } else {
                front::errorpage('regguru','double');
            }
        }
        
        //Proses Registrasi Siswa
        public static function insert_siswa($pengguna, $namalengkap, $siswa_kelas, $absen, $email, $nama_foto, $temp_foto, $password){
            $con    = frontcode::connecttodb();
            $con2   = frontcode::connecttodb();
            
            //Mengecek username
            $querycek_user  = "SELECT username FROM login WHERE username = '$pengguna'";
            $sqlcek_user    = mysqli_query($con, $querycek_user);
            $numcek_user    = mysqli_num_rows($sqlcek_user);
            $cek_user       = "";
            if($numcek_user<>0){
                $cek_user = "y";
            } else {
                $cek_user = "n";
            }
            
            if($cek_user == 'n'){
                //Mengecek no_absen
                $q_absen    = "SELECT no_absen FROM data_siswa WHERE no_absen = '$absen'";
                $s_absen    = mysqli_query($con, $q_absen);
                $cs_absen    = mysqli_num_rows($s_absen);
                $c_absen    = "y";
                
                if($cs_absen<>0){
                    $c_absen = "y";
                } else {
                    $c_absen = "n";
                }
                
                if($c_absen <> 'y'){
                    //Memasukkan data pengguna
                    $query      = "SELECT id_siswa FROM data_siswa ORDER BY id_siswa DESC LIMIT 0,1";
                    $execute    = mysqli_query($con, $query);
                    $cek        = mysqli_num_rows($execute);
                    $get_data   = mysqli_fetch_array($execute, MYSQLI_ASSOC);

                    //Untuk Id otomatis
                    if ($cek<>0){
                        if($get_data['id_siswa']<=28){
                            $id = $get_data['id_siswa']+1;
                        }else if($get_data['id_siswa']<=298){
                            $pid    = substr($get_data['id_siswa'],1,2)+1;
                            $id     = "2".$pid;
                        }else if($get_data['id_siswa']<=2199){
                            $pid    = substr($get_data['id_siswa'],1,3)+1;
                            $id     = "2".$pid;
                        }
                    }else{
                        $id = 21;
                    }

                    //Untuk random password
                    $random     = "x0e7q5t1k3g8s2n4lr9f";
                    $randompass = sha1(md5($random.md5($password).$random));

                    //Memanggil fungsi untuk menambah data login
                    $inslogin = frontcode::insert_login($id, $pengguna, $randompass, '');
                    
                    if($inslogin == "benar"){                  
                        //Untuk upload foto
                        $nama_foto2     = '';
                        $lokasi2        = '';
                        if($temp_foto<>''){
                            $nama_foto2 = $id.".".$nama_foto;
                            $lokasi     = 'epsettings/siswa/public/images/foto-profil/'.basename($id. ".$nama_foto");
                            $lokasi2    = 'public/images/foto-profil/'.basename($id. ".$nama_foto");
                            move_uploaded_file($temp_foto, $lokasi);    
                        }else if($temp_foto==''){
                            $nama_foto2 = 'user-default.png';
                            //$getserver  = $_SERVER['HTTP_HOST'];
                            $lokasi2    = 'public/images/foto-profil/'.basename($nama_foto2);
                        }
                                                
                        $insert_dataguru    = "INSERT INTO data_siswa VALUES('$id','$namalengkap','$siswa_kelas','$absen','$email','$nama_foto2','$lokasi2')";
                        $dataguru_sql       = mysqli_query($con2, $insert_dataguru);

                        if($dataguru_sql){
                            front::masuk('regscs');
                        } else {
                            echo "not success";
                        }
                    }else{
                        front::errorpage('regsiswa','errd');
                    }
                } else {
                    front::errorpage('regsiswa','dabsen');
                }
            } else {
                front::errorpage('regsiswa','double');
            }
        }
        public static function cekuser($pengguna){
            $con = frontcode::connecttodb();
            $data       = "";
            
            //Mengecek username
            $querycek_user  = "SELECT username FROM login WHERE username='$pengguna'";
            $sqlcek_user    = mysqli_query($con, $querycek_user);
            $datacek_user   = mysqli_num_rows($sqlcek_user);
            if($datacek_user == 1){
                $data = "true";
            } else {
                $data = "false";
            }
            return $data;
        }
        public static function forgetpass($email, $username, $token){
            $con = frontcode::connecttodb();
            $data       = ""; 
            $to         = $email;
            $name       = "Elprowin Administrator";
            $subject    = "Forget Password App From Elprowin";
            $message    = "From:$name <br />".$token;
            $headers    = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

            // More headers
            $headers .= 'From: administrator@elprowin.16mb.com' . "\r\n";
            $headers .= 'Cc: administrator@elprowin.16mb.com' . "\r\n";
            @mail($to, $subject, $message, $headers);
            if(@mail){
                $qry_fp = "SELECT id_lp FROM lupa_pass ORDER BY id_lp DESC";
                $sql_fp = mysqli_query($con, $qry_fp);
                $arr_fp = mysqli_fetch_array($sql_fp, MYSQLI_ASSOC);
                $num_fp = mysqli_num_rows($sql_fp);
                $nomor  = 0;
                if($num_fp <> 0){
                    $nomor = $arr_fp['id_lp']+1;
                } else {
                    $nomor = 1;
                }
                
                //menyimpan username dalam bentuk id
                $qry_dtaus  = "SELECT id FROM login WHERE username = '$username'";
                $sql_dtaus  = mysqli_query($con, $qry_dtaus);
                $arr_dtaus  = mysqli_fetch_array($sql_dtaus, MYSQLI_ASSOC);
                $iduser     = $arr_dtaus['id'];
                
                $qry_insfp  = "INSERT INTO lupa_pass VALUES ('$nomor', '$iduser', '$token')";
                $sql_insfp  = mysqli_query($con, $qry_insfp);
                if($sql_insfp){
                    $data   = "true";
                } else {
                    $data   = "false";
                }
            }else{
                $data   = "false";
            }
            return $data;
        }
        public static function sendforpass($user, $token, $password){
            $con = frontcode::connecttodb();
            $data   = "";
            
            // Mencocokkan username
            $qry_username   = " SELECT login.id, login.username, lupa_pass.* 
                                FROM login 
                                INNER JOIN lupa_pass
                                ON login.id = lupa_pass.akun
                                WHERE login.username='$user'";
            $sql_username   = mysqli_query($con, $qry_username);
            $num_username   = mysqli_num_rows($sql_username);
            $dpass          = mysqli_fetch_array($sql_username, MYSQLI_ASSOC);
            if($num_username <> 0){
                if($token == $dpass['token']){
                    
                    // Mengacak data password
                    $randomkey  = "x0e7q5t1k3g8s2n4lr9f";
                    $setrandom  = sha1(md5($randomkey.md5($password).$randomkey));
                    
                    // Mengubah password
                    $upd_pass   = "UPDATE login SET password = '$setrandom' WHERE id = '$dpass[id]'";
                    $sql_pass   = mysqli_query($con, $upd_pass);
                        
                    if($sql_pass){
                        $del_pass   = "DELETE FROM lupa_pass WHERE token='$token'";
                        $sql_dpass  = mysqli_query($con, $del_pass);
                        if($sql_dpass){
                            $data   = "true";
                        } else {
                            $data   = "false";
                        }
                    } else {
                        $data   = "false";
                    }
                } else {
                    $data = "false";
                }
            } else {
                $data = "false";
            }
            return $data;
        }
    }
?>