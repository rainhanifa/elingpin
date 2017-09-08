<?php
    class backgurucode{
        public static function connecttodb(){
            $dbhost     = "localhost";
            $dbuser     = "root";
            $dbpass     = "";
            $dbname     = "dbelprowin";
            $conn       = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
            if(mysqli_connect_errno()){
                die ("Koneksi gagal : ". mysqli_connect_errno());
            }
            return $conn;
        }
        public static function check($user){
            $conn = backgurucode::connecttodb();
            $data   = "";
            $qcuser = " SELECT login.*, data_guru.* 
                        FROM login
                        INNER JOIN data_guru
                        ON login.id = data_guru.id_guru
                        WHERE login.username = '$user'";
            $scuser = mysqli_query($conn, $qcuser);
            $ncuser = mysqli_num_rows($scuser);
            $data   = $ncuser;
            return $data;
        }
        public static function kelas($user){
            $conn = backgurucode::connecttodb();
            $qry_id     = "SELECT id, username FROM login WHERE username='$user'";
            $sql_id     = mysqli_query($conn, $qry_id);
            $get_id     = mysqli_fetch_array($sql_id, MYSQLI_ASSOC);
            $is_id      = $get_id['id'];

            $qry_kelas  = "SELECT id_guru, guru_kelas FROM data_guru WHERE id_guru = '$is_id'";
            $sql_kelas  = mysqli_query($conn, $qry_kelas);
            $data_kelas = mysqli_fetch_array($sql_kelas, MYSQLI_ASSOC);
            $guru_kelas = '';
            $guru_kelas = $data_kelas['guru_kelas'];
            return $guru_kelas;
        }
        public static function datasiswa($user){
            $conn = backgurucode::connecttodb();
            $kelas  = backgurucode::kelas($user);
            $data   = '';
            if($kelas<>''){
                $query  = "SELECT * FROM data_siswa WHERE siswa_kelas='$kelas' ORDER BY no_absen ASC";
                $sql    = mysqli_query($conn, $query);
                while ($hasil = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
                    $data[]=$hasil;
                }
            } else {
                $data = '';
            }
            return $data;
        }
        public static function showsiswa($id){
            $conn = backgurucode::connecttodb();
            $arr_rssiswa    = "";
            $qry_rssiswa    = "SELECT * FROM data_siswa WHERE id_siswa = '$id'";
            $sql_rssiswa    = mysqli_query($conn, $qry_rssiswa);
            $arr_rssiswa    = mysqli_fetch_array($sql_rssiswa, MYSQLI_ASSOC);
            return $arr_rssiswa;
        }
        public static function carisiswa($user,$category,$keyword){
            $conn = backgurucode::connecttodb();
            $kelas  = backgurucode::kelas($user);
            $data   = '';
            if($kelas<>''){
                $query  = "";
                if($category == 'materi'){
                    $q_gm   = " SELECT detail_materi.idmateri as idmateri, detail_materi.materi as themateri, detail_materi.submateri, hasil_belajar.*
                                FROM detail_materi 
                                INNER JOIN hasil_belajar
                                ON detail_materi.idmateri = hasil_belajar.materi
                                WHERE detail_materi.submateri LIKE '%$keyword%'";
                    $s_gm   = mysqli_query($conn, $q_gm);
                    while($d_gm = mysqli_fetch_array($s_gm, MYSQLI_ASSOC)){
                        $query  = "SELECT * FROM data_siswa WHERE siswa_kelas='$kelas' AND id_siswa = $d_gm[nama] ORDER BY no_absen ASC";
                        $sql    = mysqli_query($conn, $query);
                        $data   = '';
                        while ($hasil = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
                            $data[] = $hasil;
                        }
                    }
                } else if($category == 'nama_siswa' or $category == 'no_absen') {
                    $query  = "SELECT * FROM data_siswa WHERE siswa_kelas='$kelas' AND $category LIKE '%$keyword%' ORDER BY no_absen ASC";
                    $sql    = mysqli_query($conn, $query);
                    $data   = '';
                    while ($hasil = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
                        $data[]=$hasil;
                    }
                } else {
                  $data = '';  
                }
            } else {
                $data = '';
            }
            return $data;
        }
        public static function profil($user){ 
            $conn = backgurucode::connecttodb();
            $data   = '';
            $query  = "SELECT id, username FROM login WHERE username='$user'";
            $sql    = mysqli_query($conn, $query);
            $id     = mysqli_fetch_array($sql, MYSQLI_ASSOC);
            
            $qry_guru   = "SELECT * FROM data_guru WHERE id_guru='$id[id]'";
            $sql_guru   = mysqli_query($conn, $qry_guru);
            while($hasil  = mysqli_fetch_array($sql_guru, MYSQLI_ASSOC)){
                $data[] = $hasil;
            }
            return $data; 
        }
        public static function updlogin($id, $password){
            $conn = backgurucode::connecttodb();
            $data = '';
            
            if($password<>''){
                $random         = "x0e7q5t1k3g8s2n4lr9f";
                $randompass     = sha1(md5($random.md5($password).$random));
                $qry_dtlogin    = "UPDATE login SET password='$randompass' WHERE id='$id'";
                $sql_dtlogin    = mysqli_query($conn, $qry_dtlogin);
                $data = 'true';
            } else if($password==''){
                $data = 'true';
            } else {
                $data = 'false';
            }
            return $data;
        }
        public static function updprofil($idguru, $nama, $kelas, $nip, $email, $ppname, $pptemp, $pass){
            $conn = backgurucode::connecttodb();
            $data = '';
            if($idguru<>'' and $nama<>'' and $kelas<>'' and $email<>''){
                if($ppname<>'' and $pptemp<>''){
                    $ppname2        = $idguru.".".$ppname;
                    $lokasi         = 'public/images/foto-profil/'.basename($idguru. ".$ppname");
                    move_uploaded_file($pptemp, $lokasi);
                    $qry_dtguru     = "UPDATE data_guru SET nama='$nama', guru_kelas='$kelas', nip='$nip', email='$email', foto='$ppname2', url_foto='$lokasi' WHERE id_guru = '$idguru'";
                    $sql_dtguru     = mysqli_query($conn, $qry_dtguru);
                    $upd_login = backgurucode::updlogin($idguru, $pass);
                    if($upd_login == 'true'){
                        $data = 'true';
                    } else {
                        $data = 'false';
                    }
                } else if($ppname=='' and $pptemp==''){
                    $qry_dtguru     = "UPDATE data_guru SET nama='$nama', guru_kelas='$kelas', nip='$nip', email='$email' WHERE id_guru = '$idguru'";
                    $sql_dtguru     = mysqli_query($conn, $qry_dtguru);
                    $upd_login = backgurucode::updlogin($idguru, $pass);
                    if($upd_login == 'true'){
                        $data = 'true';
                    } else {
                        $data = 'false';
                    }
                } else {
                    $data = 'false';
                }
            } else {
                $data = 'false';
            }
            
            if($data == true){
                date_default_timezone_set("Asia/Jakarta");
                $tanggal    = date("Y-m-d");
                $jam        = date("H:i:s");
                $catat      = backgurucode::inslog($idguru, $kelas, $tanggal, $jam, 'Mengubah Profil');
            }
            
            return $data;
        }
        public static function materi(){
            $conn = backgurucode::connecttodb();
            $data   = '';
            $sql    = "SELECT DISTINCT(materi) FROM detail_materi";
            $query  = mysqli_query($conn, $sql);
            while($hasil = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                $data[]=$hasil;
            }
            return $data;
        }
        public static function carimateri($category, $keyword){
            $conn = backgurucode::connecttodb();
            $data   = '';
            if($category<>'' and $keyword<>''){
                $query  = "SELECT DISTINCT(materi) FROM detail_materi WHERE $category LIKE '%$keyword%' ORDER BY idmateri ASC";
                $sql    = mysqli_query($conn, $query);
                $data   = '';
                while ($hasil = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
                    $data[]=$hasil;
                }
            } else {
                $data = '';
            }
            return $data;
        }
        public static function listmateri($materi){
            $conn = backgurucode::connecttodb();
            $data               = '';
            $qrymateri          = "SELECT * FROM detail_materi WHERE materi='$materi'";
            $sqlmateri          = mysqli_query($conn, $qrymateri);
            while($datamateri   = mysqli_fetch_array($sqlmateri, MYSQLI_ASSOC)){
                $data[] = $datamateri;
            }
            return $data;
        }
        public static function showmateri($materi){
            $conn = backgurucode::connecttodb();
            $qry_materi = "SELECT * FROM detail_materi WHERE idmateri='$materi'";
            $sql_materi = mysqli_query($conn, $qry_materi);
            $jdl_materi = mysqli_fetch_array($sql_materi, MYSQLI_ASSOC);
            return $jdl_materi;
        }
        public static function smateri($materi, $category, $keyword){
            $conn = backgurucode::connecttodb();
            $data               = '';
            $qrymateri          = "SELECT * FROM detail_materi WHERE materi='$materi' AND $category LIKE '%$keyword%' ORDER BY idmateri ASC";
            $sqlmateri          = mysqli_query($conn, $qrymateri);
            while($datamateri   = mysqli_fetch_array($sqlmateri, MYSQLI_ASSOC)){
                $data[] = $datamateri;
            }
            return $data;
        }
        public static function siswaselesai($nama){
            $conn = backgurucode::connecttodb();
            $data               = "";
            $qry_siswaselesai   = " SELECT hasil_belajar.*, hasil_belajar.materi, detail_materi.* 
                                    FROM hasil_belajar 
                                    INNER JOIN detail_materi
                                    ON hasil_belajar.materi = detail_materi.idmateri
                                    WHERE hasil_belajar.nama='$nama'";
            $sql_siswaselesai   = mysqli_query($conn, $qry_siswaselesai);
            while($hasil        = mysqli_fetch_array($sql_siswaselesai, MYSQLI_ASSOC)){
                $data[]=$hasil;
            }
            return $data;
        }
        public static function buttonclasslab($nomateri){
            $conn = backgurucode::connecttodb();
            $data           = '';
            $qry_btnmateri  = "SELECT * FROM konten_materi WHERE materi='$nomateri'";
            $sql_btnmateri  = mysqli_query($conn, $qry_btnmateri);
            while($ket_btnmateri  = mysqli_fetch_array($sql_btnmateri, MYSQLI_ASSOC)){
                $data[] = $ket_btnmateri;
            }
            return $data;
        }
        public static function showclass($noclass){
            $conn = backgurucode::connecttodb();
            $hasil          = '';
            $qry_tampil     = "SELECT * FROM konten_materi WHERE idkonten='$noclass'";
            $sql_tampil     = mysqli_query($conn, $qry_tampil);
            $hasil          = mysqli_fetch_array($sql_tampil, MYSQLI_ASSOC);
            return $hasil;
        }
        public static function tambahmateri($materi, $submateri, $user){
            $conn = backgurucode::connecttodb();
            $qry_ambilid    = "SELECT idmateri FROM detail_materi ORDER BY idmateri DESC";
            $sql_ambilid    = mysqli_query($conn, $qry_ambilid) or die (mysqli_error($conn));
            $cek_ambilid    = mysqli_num_rows($sql_ambilid);
            $dta_ambilid    = mysqli_fetch_array($sql_ambilid, MYSQLI_ASSOC);
            $idmateri       = 0;
            
            if($cek_ambilid<>0){
                $idmateri   = $dta_ambilid['idmateri']+1;
            } else {
                $idmateri = 1;
            }
            
            $data   = '';
            if($materi<>'' and $submateri<>''){
                $qry_materi = "INSERT INTO detail_materi VALUES ('$idmateri', '$materi', '$submateri')";
                $sql_materi = mysqli_query($conn, $qry_materi);
                if($sql_materi){
                    $data = 'true';
                    
                    //Mencatat aktifitas
                    date_default_timezone_set("Asia/Jakarta");
                    
                    $qry_idlog  = "SELECT id FROM login WHERE username = '$user'";
                    $sql_idlog  = mysqli_query($conn, $qry_idlog) or die (mysqli_error($conn));
                    $arr_idlog  = mysqli_fetch_array($sql_idlog, MYSQLI_ASSOC);
                    $idguru     = $arr_idlog['id'];
                    $materi_log = "Menambah materi ".$materi;
                        
                    $kelas      = backgurucode::kelas($user);
                    $tanggal    = date("Y-m-d");
                    $jam        = date("H:i:s");
                    $catat      = backgurucode::inslog($idguru, $kelas, $tanggal, $jam, $materi_log);
                    
                } else {
                    $data = 'false';
                }
            } else {
                $data = 'false';
            }
            return $data;
        }
        public static function editmateri($materi){
            $conn = backgurucode::connecttodb();
            $data   = '';
            if($materi<>''){
                $qry_getmateri  = "SELECT DISTINCT(materi) FROM detail_materi where materi='$materi'";
                $sql_getmateri  = mysqli_query($conn, $qry_getmateri);
                while($arr_getmateri = mysqli_fetch_array($sql_getmateri, MYSQLI_ASSOC)){
                    $data[]=$arr_getmateri;
                }
            } else {
                $data = 'false';
            }
            return $data;
        }
        public static function editmateriact($id, $materi, $submateri){
            $conn = backgurucode::connecttodb();
            $data   = '';
            if($id<>'' and $materi<>'' and $submateri<>''){
                $qry_updmateri  = "UPDATE detail_materi SET materi='$materi', submateri='$submateri' WHERE idmateri='$id'";
                $sql_updmateri  = mysqli_query($conn, $qry_updmateri) or die (mysqli_error($konek));
                if($sql_updmateri){
                    $data = 'true';
                } else {
                    $data = 'false';
                }
            } else {
                $data = 'false';
            }
            return $data;
        }
        public static function hapusmateri($materi, $user){
            $conn = backgurucode::connecttodb();
            $con2 = backgurucode::connecttodb();
            $con3 = backgurucode::connecttodb();
            $data = '';
            if($materi<>''){
                $qry_hpsmateri  = "DELETE FROM detail_materi WHERE materi='$materi'";
                $sql_hpsmateri  = mysqli_query($conn, $qry_hpsmateri);
                if($sql_hpsmateri){
                    $qry_hpskonten  = "DELETE FROM konten_materi WHERE materi='$materi'";
                    $sql_hpskonten  = mysqli_query($con2, $qry_hpskonten);
                    if($sql_hpskonten){
                        //Mencatat aktifitas
                        date_default_timezone_set("Asia/Jakarta");

                        $qry_idlog  = "SELECT id FROM login WHERE username = '$user'";
                        $sql_idlog  = mysqli_query($con3, $qry_idlog) or die (mysqli_error($conn));
                        $arr_idlog  = mysqli_fetch_array($sql_idlog, MYSQLI_ASSOC);
                        $idguru     = $arr_idlog['id'];
                        $materi_log = "Menghapus materi ".$materi;

                        $kelas      = backgurucode::kelas($user);
                        $tanggal    = date("Y-m-d");
                        $jam        = date("H:i:s");
                        $catat      = backgurucode::inslog($idguru, $kelas, $tanggal, $jam, $materi_log);
                        
                        $data = 'true';
                    } else {
                        $data = 'false';
                    }
                } else {
                    $data = 'false';
                }
            } else {
                $data = 'false';
            }
            return $data;
        }
        public static function addkm($materi, $submateri, $kategori, $isi, $nama){
            $conn = backgurucode::connecttodb();
            $qry_ambilid    = "SELECT idkonten FROM konten_materi ORDER BY idkonten DESC";
            $sql_ambilid    = mysqli_query($conn, $qry_ambilid);
            $cek_ambilid    = mysqli_num_rows($sql_ambilid);
            $dta_ambilid    = mysqli_fetch_array($sql_ambilid, MYSQLI_ASSOC);
            $idkonten       = 0;
            
            if($cek_ambilid<>0){
                $idkonten   = $dta_ambilid['idkonten']+1;
            } else {
                $idkonten = 1;
            }
            
            $qry_ambilmtr   = "SELECT * FROM detail_materi where materi='$materi' AND submateri='$submateri'";
            $sql_ambilmtr   = mysqli_query($conn, $qry_ambilmtr);
            $dta_ambilmtr   = mysqli_fetch_array($sql_ambilmtr, MYSQLI_ASSOC);
            $nomateri       = $dta_ambilmtr['idmateri'];
            
            $data   = '';
            
            if ($materi<>'' and $submateri<>'' and $kategori<>'' and $isi<>''){
                $qry_km = "INSERT INTO konten_materi VALUES('$idkonten', '$nomateri', '$kategori', '$isi', '$nama')";
                $sql_km = mysqli_query($conn, $qry_km);
                if($sql_km){
                    
                    $data = 'true';
                    
                    //Mencatat aktifitas
                    date_default_timezone_set("Asia/Jakarta");
                    
                    $qry_idlog  = "SELECT id FROM login WHERE username = '$nama'";
                    $sql_idlog  = mysqli_query($conn, $qry_idlog) or die (mysqli_error($conn));
                    $arr_idlog  = mysqli_fetch_array($sql_idlog, MYSQLI_ASSOC);
                    $idguru     = $arr_idlog['id'];
                    $materi_log = "Menambah konten submateri ".$submateri." kategori ".$kategori." activity";
                        
                    $kelas      = backgurucode::kelas($nama);
                    $tanggal    = date("Y-m-d");
                    $jam        = date("H:i:s");
                    $catat      = backgurucode::inslog($idguru, $kelas, $tanggal, $jam, $materi_log);
                    
                } else {
                    $data = 'false';
                }
            } else {
                $data = 'false';
            }
            return $data;
        }
        public static function classcode($noclass){
            $conn = backgurucode::connecttodb();
            $qry_tampil     = "SELECT * FROM konten_materi WHERE idkonten='$noclass'";
            $sql_tampil     = mysqli_query($conn, $qry_tampil);
            while($hasil = mysqli_fetch_array($sql_tampil, MYSQLI_ASSOC)){
                $data[]=$hasil;
            }
            return $data;
        }
        public static function setmateri($noktn){
            $conn = backgurucode::connecttodb();
            $data           = '';
            $qry_getdata    = "SELECT idkonten, materi FROM konten_materi WHERE idkonten = '$noktn'";
            $sql_getdata    = mysqli_query($conn, $qry_getdata);
            $arr_getdata    = mysqli_fetch_array($sql_getdata, MYSQLI_ASSOC);

            $qry_getmateri  = "SELECT idmateri, materi FROM detail_materi WHERE idmateri = '$arr_getdata[materi]'";
            $sql_getmateri  = mysqli_query($conn, $qry_getmateri);
            
            while($arr_getmateri  = mysqli_fetch_array($sql_getmateri, MYSQLI_ASSOC)){
                $data   = $arr_getmateri['materi'];
            }
            return $data;
        }
        public static function setsubmateri($noktn){
            $conn = backgurucode::connecttodb();
            $data           = '';
            $qry_getdata    = "SELECT idkonten, materi FROM konten_materi WHERE idkonten = '$noktn'";
            $sql_getdata    = mysqli_query($conn, $qry_getdata);
            $arr_getdata    = mysqli_fetch_array($sql_getdata, MYSQLI_ASSOC);

            $qry_getmateri  = "SELECT idmateri, submateri FROM detail_materi WHERE idmateri = '$arr_getdata[materi]'";
            $sql_getmateri  = mysqli_query($conn, $qry_getmateri);
            
            while($arr_getmateri  = mysqli_fetch_array($sql_getmateri, MYSQLI_ASSOC)){
                $data   = $arr_getmateri['submateri'];
            }
            return $data;
        }
        public static function edkm($idk, $materi, $submateri, $kategori, $isi, $nama){
            $conn = backgurucode::connecttodb();
            $qry_ambilmtr   = "SELECT * FROM detail_materi where materi='$materi' AND submateri='$submateri'";
            $sql_ambilmtr   = mysqli_query($conn, $qry_ambilmtr);
            $dta_ambilmtr   = mysqli_fetch_array($sql_ambilmtr, MYSQLI_ASSOC);
            $nomateri       = $dta_ambilmtr['idmateri'];
            
            $qry_edkonten   = "UPDATE konten_materi SET materi='$nomateri', kategori='$kategori', konten='$isi', uploader='$nama' WHERE idkonten='$idk'";
            $sql_edkonten   = mysqli_query($conn, $qry_edkonten) or die(mysql_error());
            if(!$sql_edkonten){
                $data = 'false';
            } else {
                $data = 'true';
                
                //Mencatat aktifitas
                date_default_timezone_set("Asia/Jakarta");

                $qry_idlog  = "SELECT id FROM login WHERE username = '$nama'";
                $sql_idlog  = mysqli_query($conn, $qry_idlog) or die (mysqli_error($conn));
                $arr_idlog  = mysqli_fetch_array($sql_idlog, MYSQLI_ASSOC);
                $idguru     = $arr_idlog['id'];
                $materi_log = "Mengubah konten submateri ".$submateri." kategori ".$kategori." activity";

                $kelas      = backgurucode::kelas($nama);
                $tanggal    = date("Y-m-d");
                $jam        = date("H:i:s");
                $catat      = backgurucode::inslog($idguru, $kelas, $tanggal, $jam, $materi_log);
                
            }
            return $data;
        }
        public static function datarapor(){
            $conn = backgurucode::connecttodb();
            $data               = '';
            $qry_dtrapor        = " SELECT hasil_belajar.materi, detail_materi.* 
                                    FROM hasil_belajar 
                                    INNER JOIN detail_materi
                                    ON hasil_belajar.materi = detail_materi.idmateri
                                    GROUP BY hasil_belajar.materi";
            $sql_dtrapor        = mysqli_query($conn, $qry_dtrapor);
            if($sql_dtrapor){    
                while($arr_dtrapor  = mysqli_fetch_array($sql_dtrapor, MYSQLI_ASSOC)){
                    $data[] = $arr_dtrapor;
                }
            } else {
                $data = '';
            }
            return $data;
        }
        public static function dtraporsiswa($materi, $kelas){
            $conn = backgurucode::connecttodb();
            $data = '';
            $qry_dtsiswa        = " SELECT hasil_belajar.*, data_siswa.nama_siswa, data_siswa.siswa_kelas 
                                    FROM hasil_belajar
                                    INNER JOIN data_siswa
                                    ON hasil_belajar.nama = data_siswa.id_siswa
                                    WHERE hasil_belajar.materi='$materi' AND data_siswa.siswa_kelas='$kelas'";
            $sql_dtsiswa        = mysqli_query($conn, $qry_dtsiswa);
            if($sql_dtsiswa){
                while($arr_dtsiswa  = mysqli_fetch_array($sql_dtsiswa, MYSQLI_ASSOC)){
                    $data[] = $arr_dtsiswa;
                }
            } else {
                $data = '';
            }
            return $data;
        }
        public static function dtnilaisiswa($hasilsiswa){
            $conn = backgurucode::connecttodb();
            $data = '';
            $qry_dtnilai    = " SELECT rapor.*, hasil_belajar.idhasil, hasil_belajar.classdir, hasil_belajar.labdir
                                FROM rapor
                                INNER JOIN hasil_belajar
                                ON rapor.hasil = hasil_belajar.idhasil
                                WHERE rapor.hasil = '$hasilsiswa'";
            $sql_dtnilai    = mysqli_query($conn, $qry_dtnilai);
            if($sql_dtnilai){
                $arr_dtnilai    = mysqli_fetch_array($sql_dtnilai, MYSQLI_ASSOC);
                $data           = $arr_dtnilai;
            } else {
                $data   = '';
            }
            return $data;
        }
        public static function searchdtrapor($cat, $value, $kriteria1, $kriteria2){
            $conn = backgurucode::connecttodb();
            $datacari   = '';
            if($cat<>'' and $value<>''){
                if($cat == 'nmr'){
                    $qry_dtsiswa        = " SELECT hasil_belajar.*, data_siswa.nama_siswa, data_siswa.siswa_kelas 
                                            FROM hasil_belajar
                                            INNER JOIN data_siswa
                                            ON hasil_belajar.nama = data_siswa.id_siswa
                                            WHERE hasil_belajar.materi='$kriteria1' AND data_siswa.siswa_kelas='$kriteria2' AND data_siswa.nama_siswa LIKE '%$value%'";
                    $sql_dtsiswa        = mysqli_query($conn, $qry_dtsiswa);
                    if($sql_dtsiswa){
                        while($arr_dtsiswa  = mysqli_fetch_array($sql_dtsiswa, MYSQLI_ASSOC)){
                            $datacari[] = $arr_dtsiswa;
                        }
                    } else {
                        $datacari = '';
                    }
                } else if($cat == 'mtr'){
                    $qry_dtrapor        = " SELECT hasil_belajar.materi, detail_materi.* 
                                            FROM hasil_belajar 
                                            INNER JOIN detail_materi
                                            ON hasil_belajar.materi = detail_materi.idmateri
                                            WHERE detail_materi.materi LIKE '%$value%'
                                            GROUP BY hasil_belajar.materi";
                    $sql_dtrapor        = mysqli_query($conn, $qry_dtrapor);
                    if($sql_dtrapor){    
                        while($arr_dtrapor  = mysqli_fetch_array($sql_dtrapor, MYSQLI_ASSOC)){
                            $datacari[] = $arr_dtrapor;
                        }
                    } else {
                        $datacari = '';
                    }
                } else if($cat == 'sbr'){
                    $qry_dtrapor        = " SELECT hasil_belajar.materi, detail_materi.* 
                                            FROM hasil_belajar 
                                            INNER JOIN detail_materi
                                            ON hasil_belajar.materi = detail_materi.idmateri
                                            WHERE detail_materi.submateri LIKE '%$value%'
                                            GROUP BY hasil_belajar.materi";
                    $sql_dtrapor        = mysqli_query($conn, $qry_dtrapor);
                    if($sql_dtrapor){    
                        while($arr_dtrapor  = mysqli_fetch_array($sql_dtrapor, MYSQLI_ASSOC)){
                            $datacari[] = $arr_dtrapor;
                        }
                    } else {
                        $datacari = '';
                    }
                } else if($cat == 'nlr'){
                    $qry_dtsiswa        = " SELECT hasil_belajar.*, data_siswa.nama_siswa, data_siswa.siswa_kelas 
                                            FROM hasil_belajar
                                            INNER JOIN data_siswa
                                            ON hasil_belajar.nama = data_siswa.id_siswa
                                            WHERE hasil_belajar.materi='$kriteria1' AND data_siswa.siswa_kelas='$kriteria2' AND idhasil = ( SELECT hasil 
                                                                                                                                            FROM rapor 
                                                                                                                                            WHERE nclass = '$value')";
                    $sql_dtsiswa        = mysqli_query($conn, $qry_dtsiswa);
                    if($sql_dtsiswa){
                        while($arr_dtsiswa  = mysqli_fetch_array($sql_dtsiswa, MYSQLI_ASSOC)){
                            $datacari[] = $arr_dtsiswa;
                        }
                    } else {
                        $datacari = '';
                    }
                } else if($cat == 'nlp'){
                    $qry_dtsiswa        = " SELECT hasil_belajar.*, data_siswa.nama_siswa, data_siswa.siswa_kelas 
                                            FROM hasil_belajar
                                            INNER JOIN data_siswa
                                            ON hasil_belajar.nama = data_siswa.id_siswa
                                            WHERE hasil_belajar.materi='$kriteria1' AND data_siswa.siswa_kelas='$kriteria2' AND idhasil = ( SELECT hasil 
                                                                                                                                            FROM rapor 
                                                                                                                                            WHERE nlab = '$value')";
                    $sql_dtsiswa        = mysqli_query($conn, $qry_dtsiswa);
                    if($sql_dtsiswa){
                        while($arr_dtsiswa  = mysqli_fetch_array($sql_dtsiswa, MYSQLI_ASSOC)){
                            $datacari[] = $arr_dtsiswa;
                        }
                    } else {
                        $datacari = '';
                    }
                } else {
                    $datacari = 'false';
                }
            } else {
                $datacari = 'false';
            }
            return $datacari;
        }
        public static function ceknilai($id){
            $conn = backgurucode::connecttodb();
            $data   = '';
            $qry_ceknilai   = "SELECT * FROM rapor WHERE hasil='$id'";
            $sql_ceknilai   = mysqli_query($conn, $qry_ceknilai);
            $is_ceknilai    = mysqli_num_rows($sql_ceknilai);
            if($is_ceknilai<>0){
                $data   = 'true';
            } else {
                $data   = 'false';
            }
            return $data;
        }
        public static function cekrapor($id){
            $conn = backgurucode::connecttodb();
            $is_cekrapor   = '';
            $qry_cekrapor   = "SELECT * FROM rapor WHERE hasil='$id'";
            $sql_cekrapor   = mysqli_query($conn, $qry_cekrapor);
            $is_cekrapor    = mysqli_fetch_array($sql_cekrapor, MYSQLI_ASSOC);
            return $is_cekrapor;
        }
        public static function datanilai($id){
            $conn = backgurucode::connecttodb();
            $data           = '';
            $qry_dtnilai    = "SELECT * FROM hasil_belajar WHERE idhasil='$id'";
            $sql_dtnilai    = mysqli_query($conn, $qry_dtnilai);
            if($sql_dtnilai){
                while($arr_dtrapor = mysqli_fetch_array($sql_dtnilai, MYSQLI_ASSOC)){
                    $data[] = $arr_dtrapor; 
                }
            } else {
                $data       = '';
            }
            return $data;
        }
        public static function gethasil($id){
            $conn = backgurucode::connecttodb();
            $arr_dtrapor    = '';
            $qry_dtnilai    = "SELECT * FROM hasil_belajar WHERE idhasil='$id'";
            $sql_dtnilai    = mysqli_query($conn, $qry_dtnilai);
            if($sql_dtnilai){
                $arr_dtrapor = mysqli_fetch_array($sql_dtnilai, MYSQLI_ASSOC);
            } else {
                $arr_dtrapor       = '';
            }
            return $arr_dtrapor;
        }
        public static function insrapor($idhasil, $detailnilai, $nilaiclass, $nilailab, $guru){
            $conn = backgurucode::connecttodb();
            $data   = '';
            
            $qry_norapor    = "SELECT norapor FROM rapor ORDER BY norapor DESC";
            $sql_norapor    = mysqli_query($conn, $qry_norapor);
            $dta_norapor    = mysqli_fetch_array($sql_norapor, MYSQLI_ASSOC);
            $cek_norapor    = mysqli_num_rows($sql_norapor);
            
            $norapor        = 0;
            
            if($cek_norapor<>0){
                $norapor    = $dta_norapor['norapor']+1;
            } else {
                $norapor    = 1;
            }
            
            // Penentuan siswa lulus berdasarkan Kriteria Ketuntasan Minimum
            $ketclass       = '';
            $ketlab         = '';
            
            if($nilaiclass<>''){
                if($nilaiclass >= 75){
                    $ketclass = 'L';    
                }else{
                    $ketclass = 'R';
                }        
            }
            
            if($nilailab<>''){
                if($nilailab >= 75){
                    $ketlab = 'L';    
                }else{
                    $ketlab = 'R';
                }        
            }
            
            $qry_insrapor   = "INSERT INTO rapor VALUES ('$norapor', '$idhasil', '$detailnilai', '$nilaiclass', '$nilailab', '$ketclass', '$ketlab')";
            $sql_insrapor   = mysqli_query($conn, $qry_insrapor);
            if($sql_insrapor){
                $data = 'true';
                
                $sh     = " SELECT hasil_belajar.materi, detail_materi.idmateri, detail_materi.submateri
                            FROM hasil_belajar
                            INNER JOIN detail_materi
                            ON hasil_belajar.materi = detail_materi.idmateri
                            WHERE hasil_belajar.idhasil = '$idhasil'";
                $sql_sh = mysqli_query($conn, $sh) or die (mysqli_error($conn));     
                $arr_sh = mysqli_fetch_array($sql_sh, MYSQLI_ASSOC);
                $sh_mat  = $arr_sh['submateri'];
                
                $sn     = " SELECT hasil_belajar.nama, data_siswa.id_siswa, data_siswa.nama_siswa
                            FROM hasil_belajar
                            INNER JOIN data_siswa
                            ON hasil_belajar.nama = data_siswa.id_siswa
                            WHERE hasil_belajar.idhasil = '$idhasil'";
                $sql_sn = mysqli_query($conn, $sn) or die (mysqli_error($conn));     
                $arr_sn = mysqli_fetch_array($sql_sn, MYSQLI_ASSOC);
                $sn_nama  = $arr_sn['nama_siswa'];
                
                $sid    = "SELECT id FROM login WHERE username = '$guru'";
                $sql_sid = mysqli_query($conn, $sid) or die (mysqli_error($conn));
                $arr_sid = mysqli_fetch_array($sql_sid, MYSQLI_ASSOC);
                $idguru = $arr_sid['id'];
                
                //Mencatat aktifitas
                date_default_timezone_set("Asia/Jakarta");
                $materi_log = "Memasukkan nilai ".$sn_nama." pada submateri ".$sh_mat;

                $kelas      = backgurucode::kelas($guru);
                $tanggal    = date("Y-m-d");
                $jam        = date("H:i:s");
                $catat      = backgurucode::inslog($idguru, $kelas, $tanggal, $jam, $materi_log);
                                
            } else {
                $data = 'false';
            }
            
            return $data;
        }
        public static function updrapor($norapor, $detailnilai, $nilaiclass, $nilailab, $idhasil, $guru){
            $conn = backgurucode::connecttodb();
            $data   = '';
            
            // Penentuan siswa lulus berdasarkan Kriteria Ketuntasan Minimum
            $ketclass       = '';
            $ketlab         = '';
            if($nilaiclass<>''){
                if($nilaiclass >= 75){
                    $ketclass = 'L'; //Lulus
                } else {
                    $ketclass = 'R'; //Remidial
                }    
            } else {
                $ketclass   = '';
                $nilaiclass = 0;
            }
            
            if($nilailab<>''){
                if($nilailab >= 75){
                    $ketlab = 'L'; //Lulus
                } else {
                    $ketlab = 'R'; //Remidial
                }    
            } else {
                $ketlab     = '';
                $nilailab   = 0;
            }
            
            $qry_updrapor   = "UPDATE rapor SET detail_nilai='$detailnilai', nclass='$nilaiclass', nlab='$nilailab', kclass='$ketclass', klab='$ketlab' WHERE norapor='$norapor'";
            $sql_updrapor   = mysqli_query($conn, $qry_updrapor);
            if($sql_updrapor){
                $data = 'true';
                
                $sh     = " SELECT hasil_belajar.materi, detail_materi.idmateri, detail_materi.submateri
                            FROM hasil_belajar
                            INNER JOIN detail_materi
                            ON hasil_belajar.materi = detail_materi.idmateri
                            WHERE hasil_belajar.idhasil = '$idhasil'";
                $sql_sh = mysqli_query($conn, $sh) or die (mysqli_error($conn));     
                $arr_sh = mysqli_fetch_array($sql_sh, MYSQLI_ASSOC);
                $sh_mat  = $arr_sh['submateri'];
                
                $sn     = " SELECT hasil_belajar.nama, data_siswa.id_siswa, data_siswa.nama_siswa
                            FROM hasil_belajar
                            INNER JOIN data_siswa
                            ON hasil_belajar.nama = data_siswa.id_siswa
                            WHERE hasil_belajar.idhasil = '$idhasil'";
                $sql_sn = mysqli_query($conn, $sn) or die (mysqli_error($conn));     
                $arr_sn = mysqli_fetch_array($sql_sn, MYSQLI_ASSOC);
                $sn_nama  = $arr_sn['nama_siswa'];
                
                $sid    = "SELECT id FROM login WHERE username = '$guru'";
                $sql_sid = mysqli_query($conn, $sid) or die (mysqli_error($conn));
                $arr_sid = mysqli_fetch_array($sql_sid, MYSQLI_ASSOC);
                $idguru = $arr_sid['id'];
                
                //Mencatat aktifitas
                date_default_timezone_set("Asia/Jakarta");
                $materi_log = "Mengubah nilai ".$sn_nama." pada submateri ".$sh_mat;

                $kelas      = backgurucode::kelas($guru);
                $tanggal    = date("Y-m-d");
                $jam        = date("H:i:s");
                $catat      = backgurucode::inslog($idguru, $kelas, $tanggal, $jam, $materi_log);
                
            } else {
                $data = 'false';
            }
            
            return $data;
        }
        public static function commkelas($kelas){
            $conn = backgurucode::connecttodb();
            $data           = "";
            $qry_kelas      = " SELECT data_guru.id_guru, data_guru.nama, data_guru.guru_kelas, data_siswa.id_siswa, data_siswa.nama_siswa, data_siswa.siswa_kelas
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
        public static function commguru($materi){
            $conn = backgurucode::connecttodb();
            $data           = "";
            $qry_komentar   = "SELECT * FROM komentar WHERE kommateri='$materi' ORDER BY id_komen DESC";
            $sql_komentar   = mysqli_query($conn, $qry_komentar);
            while($arr_komentar   = mysqli_fetch_array($sql_komentar, MYSQLI_ASSOC)){
                $data[]=$arr_komentar;
            }
            return $data;
        }
        public static function datacommguru($iduser){
            $conn = backgurucode::connecttodb();
            $data       = "";
            $sql_usguru = "SELECT nama FROM data_guru WHERE data_guru.id_guru = '$iduser'";
            $qry_usguru = mysqli_query($conn, $sql_usguru);
            $dta_usguru = mysqli_fetch_array($qry_usguru, MYSQLI_ASSOC);
            $data       = $dta_usguru['nama'];
            return $data;
        }
        public static function datacommsiswa($iduser){
            $conn = backgurucode::connecttodb();
            $data   = "";
            $sql_usiswa = "SELECT nama_siswa FROM data_siswa WHERE data_siswa.id_siswa = '$iduser'";
            $qry_usiswa = mysqli_query($conn, $sql_usiswa);
            $dta_usiswa = mysqli_fetch_array($qry_usiswa, MYSQLI_ASSOC);
            $data       = $dta_usiswa['nama_siswa'];
            return $data;
        }
        public static function inscomm($user, $materi, $subject, $komentar, $tanggal, $jam){
            $conn = backgurucode::connecttodb();
            $data   = "";
            $user2          = $user;
            $materi2        = $materi;
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
                $qry_idlog  = "SELECT username FROM login WHERE id = '$user2'";
                $sql_idlog  = mysqli_query($conn, $qry_idlog) or die (mysqli_error($conn));
                $arr_idlog  = mysqli_fetch_array($sql_idlog, MYSQLI_ASSOC);
                $idguru     = $arr_idlog['username'];
                                                
                $qry_submat = "SELECT materi,kategori FROM konten_materi INNER JOIN komentar ON konten_materi.idkonten = komentar.kommateri WHERE idkonten = '$materi2'";
                $sql_submat = mysqli_query($conn, $qry_submat) or die (mysqli_error($conn));
                $arr_submat = mysqli_fetch_array($sql_submat, MYSQLI_ASSOC);
                $submat     = $arr_submat['materi'];
                $jenis      = $arr_submat['kategori'];
            
                $qry_mat    = "SELECT submateri FROM detail_materi WHERE idmateri='$submat'";
                $sql_mat    = mysqli_query($conn, $qry_mat) or die (mysqli_error($conn));
                $arr_mat    = mysqli_fetch_array($sql_mat, MYSQLI_ASSOC);
                $log_mat    = $arr_mat['submateri'];
                            
                $materi_log = "Memberikan komentar pada materi ".$log_mat." kategori ".$jenis." subjek ".$subject;

                $kelas      = backgurucode::kelas($idguru); 
                $catat      = backgurucode::inslog($user, $kelas, $tanggal, $jam, $materi_log);
                
            } else {
                $data       = "false";
            }
            return $data;
        }
        public static function inslog($user, $kelas, $tanggal, $jam, $aktifitas){
            $conn   = backgurucode::connecttodb();
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
        
        public static function catatanguru($user, $category){
            $conn   = backgurucode::connecttodb();
            $data   = "";
            $kelas = backgurucode::kelas($user);
            
            $qry_idlog  = "SELECT id FROM login WHERE username = '$user'";
            $sql_idlog  = mysqli_query($conn, $qry_idlog) or die (mysqli_error($conn));
            $arr_idlog  = mysqli_fetch_array($sql_idlog, MYSQLI_ASSOC);
            $idguru     = $arr_idlog['id'];
            
            if($category == ''){
                $qry_cs = "SELECT * FROM catatan WHERE kelas = '$kelas'";
            }else{
                if($category == 'guru'){
                    $qry_cs = "SELECT * FROM catatan WHERE kelas = '$kelas' AND user_id = '$idguru'";
                }else if($category == 'siswa'){
                    $qry_cs = " SELECT catatan.*, data_siswa.id_siswa, data_siswa.nama_siswa 
                                FROM catatan
                                INNER JOIN data_siswa
                                ON catatan.user_id = data_siswa.id_siswa 
                                WHERE kelas = '$kelas' AND user_id <> '$idguru'";
                }
            }
            $sql_cs = mysqli_query($conn, $qry_cs) or die (mysqli_error($conn));
            
            while($arr_cs = mysqli_fetch_array($sql_cs, MYSQLI_ASSOC)){
                $data[]=$arr_cs;
            }
            return $data;
        }
    }
?>