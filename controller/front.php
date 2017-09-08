<?php   
    include "view/viewpage.php";
    
    class front{
        public static function utama(){
            viewpage::get_page('home');
        }
        public static function komp(){
            viewpage::get_page('komp');
        }
        public static function materi(){
            viewpage::get_page('materi');
        }
        public static function masuk($msg){
            if($msg == 'regscs'){
                viewpage::front_message('masuk', 'regscs');
            } else {
                viewpage::get_page('masuk');
            }
        }
        public static function regsiswa(){
            viewpage::get_page('regsiswa');
        }
        public static function regguru(){
            viewpage::get_page('regguru');
        }
        public static function loginpage($page){
            viewpage::get_admin($page);
        }
        public static function errorpage($page,$message){
            viewpage::front_error($page,$message);
        }
        public static function msgpage($page,$message){
            viewpage::front_message($page,$message);
        }
    }
?>