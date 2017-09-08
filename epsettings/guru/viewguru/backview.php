<?php
    class backview {
        public static function goto_page($page){
            header("location:pembelajaran.php?p=$page");
        }
        public static function search_action($page, $category, $keyword){
            header("location:pembelajaran.php?p=$page&c=$category&k=$keyword");
        }
        public static function gopageid($page, $id){
            header("location:pembelajaran.php?p=$page&i=$id");
        }
    }
?>