<?php
    class back {
        public static function indexguru($get_page){
            header("location:epsettings/guru/index.php?p=$get_page");
        }
        public static function indexsiswa($get_page){
            header("location:epsettings/siswa/index.php?p=$get_page");
        }
    }
?>