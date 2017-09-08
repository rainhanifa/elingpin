<?php
    include "modelsiswa/backsiswacode.php";
    class fullview{
        public static function home($userlogin){
            $cekuser    = backsiswacode::check($userlogin);
            if($cekuser<>0){
                $showhasil  = backsiswacode::setmateri($userlogin);
                include "home.php";
            } else {
                header("location:http://localhost:8080/elprowinmvc.com/epsettings/");
            }
        }
        public static function profil($user){
            $showprofile = backsiswacode::studentprofile($user);
            include "profil.php";
        }
        public static function formedprofil($user){
            $editprofil = backsiswacode::studentprofile($user);
            include "fprofil.php";
        }
        public static function rapor($user){
            $showrapor  = backsiswacode::materisiswa($user);
            include "rapor.php";
        }
        public static function materi($nomateri, $category){
            $tampilmateri = backsiswacode::datamateri($nomateri, $category);
            include "materi.php";
        }
        public static function logs($user){
            $showlogs   = backsiswacode::catatansiswa($user);
            include "catatan.php";
        }
    }
?>