<?php
    include "modelguru/backgurucode.php";

    class fullview{
        public static function cek(){
            session_start();
            $hasil = "";
            if(isset($_SESSION['user'])){
                $cek    = backgurucode::check($_SESSION['user']);
                if($cek <> 0){
                    $hasil = "true";
                } else {
                    $hasil = $_SESSION['user'];
                }
            } else { 
                $hasil = "false";
            }
            return $hasil;
        }
        public static function home($user,$category,$keyword){
            backgurucode::connecttodb();
            if($category == '' and $keyword == ''){
                $daftarsiswa    = backgurucode::datasiswa($user);
            } else {
                $daftarsiswa    = backgurucode::carisiswa($user,$category,$keyword);
            }
            include "home.php";
        }
        public static function profil($user){
            $profilguru = backgurucode::profil($user);
            include "profil.php";
        }
        public static function edprofil($user){
            $profilguru = backgurucode::profil($user);
            include "ubahprofil.php";
        }
        public static function materi($category, $keyword){
            backgurucode::connecttodb();
            if($category == '' and $keyword == ''){
                $daftarmateri   = backgurucode::materi();
            } else {
                $daftarmateri   = backgurucode::carimateri($category,$keyword);
            }
            include "materi.php";
        }
        public static function formmateri(){
            include "fmateri.php";
        }
        public static function formedmateri($getmateri){
            $edmateri = backgurucode::editmateri($getmateri);
            include "fmateri.php";
        }
        public static function formkontenmateri(){
            $submit = 'false';
            include "fkontenmateri.php";
        }
        public static function classview($nomateri){
            $noclass    = $nomateri;
            $dataclass  = backgurucode::classcode($noclass);
            include "classmateri.php";
        }
        public static function edkontenmateri($id){
            $submit = 'true';
            $noktn  = $id; 
            include "fkontenmateri.php";
        }
        public static function labview($nomateri){
            $noclass    = $nomateri;
            $dataclass  = backgurucode::classcode($noclass);
            include "labmateri.php";
        }
        public static function viewhasil(){
            $showrapor  = backgurucode::datarapor();
            include "hasil.php";
        }
        public static function carimaterihasil($cat, $value){
            $showrapor  = backgurucode::searchdtrapor($cat, $value, '', '');
            include "hasil.php";
        }
        public static function showfrapor($id){
            $datarapsis  = backgurucode::datanilai($id);
            include "rapsis.php";
        }
        public static function logs($user, $category){
            $showlogs  = backgurucode::catatanguru($user, $category);
            include "catatan.php";
        }
    }
?>