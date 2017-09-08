<?php
    class backview {
        public static function goto_page($page){
            header("location:belajar.php?p=$page");
        }
        public static function goto_pageid($page, $id, $cat){
            header("location:belajar.php?p=$page&i=$id&c=$cat");
        }
        public static function goto_pageact($page, $id, $cat, $message){
            header("location:belajar.php?p=$page&i=$id&c=$cat&m=$message");
        }
    }
?>