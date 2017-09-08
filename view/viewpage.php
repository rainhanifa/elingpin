<?php
    class viewpage{
        public static function get_page($get_page){
            header("location:frontpage.php?p=$get_page");
        }
        public static function front_message($get_page,$message){
            header("location:frontpage.php?p=$get_page&msg=$message");
        }
        public static function front_error($get_page,$message){
            header("location:frontpage.php?p=$get_page&error=$message");
        }
        public static function get_admin($get_page){
            header("location:backpage.php?p=$get_page");
        }
    }
?>