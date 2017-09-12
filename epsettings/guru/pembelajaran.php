<?php
    include "viewguru/backview.php";
    include "viewguru/fullview.php";
    include "viewguru/javascript.php";
    
    $tampil = fullview::cek();
    
    if($tampil == 'true'){
        $halaman = $_GET['p'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Halaman Guru </title>
        
        <!-- Meta Tags -->
        <meta charset="UTF-8">
        <meta name="description" content="E-Learning Pemrograman Web Dinamis">
        <meta name="keywords" content="PHP, MySQL, JSP">
        <meta name="author" content="SMKN 4 Malang">
        <meta name="viewport" content="width=device-width">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <base href="http://<?php echo $_SERVER['HTTP_HOST'];?>/elingpin/epsettings/guru/">
        
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="public/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <link rel="stylesheet" type="text/css" href="public/css/guru.css">
        
        <!-- Icons -->
        <link rel="icon" href="public/images/logo1.png">
        
        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        
    </head>
    <body>
        <header>
            <div class="bg-header">
                <div class="navigation">
                    <div class="container">
                        <div class="row">
                            <nav class="navbar navbar-default">
                                <div class="container-fluid">
                                    <!-- Brand and toggle get grouped for better mobile display -->
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                        <a class="navbar-brand visible-xs" href="#">Elprowin</a>
                                    </div>

                                    <!-- Collect the nav links, forms, and other content for toggling -->
                                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                        <?php
                                            $classberanda       = '';
                                            $spanclassberanda   = '';
                                            $classprofil        = '';
                                            $spanclassprofil    = '';
                                            $classmateri        = '';
                                            $spanclassmateri    = '';
                                            $classrapor         = '';
                                            $spanclassrapor     = '';
                                            $classnote          = '';
                                            $spanclassnote      = '';

                                            if($halaman == 'home'){
                                                $classberanda      = 'active';
                                                $spanclassberanda  = 'home';
                                            } else if ($halaman == 'profil' or $halaman == 'edprofil'){
                                                $classprofil      = 'active';
                                                $spanclassprofil  = 'profile';
                                            } else if ($halaman == 'materi' or $halaman == 'fm' or $halaman == 'fkm'){
                                                $classmateri      = 'active';
                                                $spanclassmateri  = 'materi';
                                            } else if ($halaman == 'cm' or $halaman == 'lm' or $halaman == 'formem'){
                                                $classmateri      = 'active';
                                                $spanclassmateri  = 'materi';
                                            } else if ($halaman == 'rapor' or $halaman == 'fr'){
                                                $classrapor      = 'active';
                                                $spanclassrapor  = 'clue';
                                            } else if($halaman == 'log'){
                                                $classnote      = 'active';
                                                $spanclassnote  = 'note';
                                            }
                                        ?>
                                        <ul class="nav navbar-nav">
                                            <li class="<?php echo $classberanda; ?>">
                                                <a href="index.php?p=beranda">Beranda</a>
                                                <span class="<?php echo $spanclassberanda; ?>"></span>
                                            </li>
                                            <li class="<?php echo $classprofil; ?>">
                                                <a href="index.php?p=profil">Profil</a>
                                                <span class="<?php echo $spanclassprofil; ?>"></span>
                                            </li>
                                            <li class="<?php echo $classmateri; ?>">
                                                <a href="index.php?p=materi">Materi</a>
                                                <span class="<?php echo $spanclassmateri; ?>"></span>
                                            </li>
                                            <li class="<?php echo $classrapor; ?>">
                                                <a href="index.php?p=lap">Data Nilai</a>
                                                <span class="<?php echo $spanclassrapor; ?>"></span>
                                            </li>
                                            <li class="<?php echo $classnote; ?>">
                                                <a href="index.php?p=noc">Catatan Aktifitas</a>
                                                <span class="<?php echo $spanclassnote; ?>"></span>
                                            </li>
                                            <li>
                                                <a href="index.php?p=logout">Keluar</a>
                                            </li>
                                        </ul>
                                        <ul class="nav navbar-nav navbar-right">
                                            <li><a href="#">Selamat datang, <label class="label label-warning" id="name"><?php echo $_SESSION['user']; ?></label></a></li>
                                        </ul>
                                    </div><!-- /.navbar-collapse -->
                                </div><!-- /.container-fluid -->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <?php
            if (isset($_SESSION['user'])){
                if($halaman == 'home'){
                    $category   = '';
                    $searchid   = '';
                    if(!isset($_GET['c']) and !isset($_GET['k'])){
                        fullview::home($_SESSION['user'],$category,$searchid);
                    } else {
                        $category   = $_GET['c'];
                        $searchid   = $_GET['k'];
                        fullview::home($_SESSION['user'],$category,$searchid);
                    }
                } else if ($halaman == 'profil'){
                    fullview::profil($_SESSION['user']);
                } else if ($halaman == 'edprofil'){
                    fullview::edprofil($_SESSION['user']);
                } else if ($halaman == 'materi'){
                    $category   = '';
                    $searchid   = '';
                    if(!isset($_GET['c']) and !isset($_GET['k'])){
                        fullview::materi($category,$searchid);
                    } else {
                        $category   = $_GET['c'];
                        $searchid   = $_GET['k'];
                        fullview::materi($category,$searchid);
                    }
                } else if ($halaman == 'fm'){
                    fullview::formmateri();
                } else if ($halaman == 'formem'){
                    if(isset($_GET['i'])){
                        $getmateri  = $_GET['i'];
                        fullview::formedmateri($getmateri);
                    } else {
                        fullview::materi('','');
                    }
                } else if ($halaman == 'fkm'){
                    if($_GET['i'] <> null){
                        $idkonten = $_GET['i'];
                        fullview::edkontenmateri($idkonten);
                    } else {
                        fullview::formkontenmateri();
                    }
                } else if ($halaman == 'cm'){
                    $nomateri = $_GET['i'];
                    fullview::classview($nomateri);
                } else if ($halaman == 'lm'){
                    $nomateri = $_GET['i'];
                    fullview::labview($nomateri);
                } else if ($halaman == 'rapor'){
                    if(isset($_GET['c']) and isset($_GET['k'])){
                        if($_GET['c'] == 'mtr' || $_GET['c'] == 'sbr'){
                            fullview::carimaterihasil($_GET['c'], $_GET['k']);
                        } else {
                            fullview::viewhasil();
                        }
                    } else {
                        fullview::viewhasil();
                    }
                } else if ($halaman == 'fr'){
                    if(isset($_GET['i'])){
                        $siswa  = $_GET['i'];
                        fullview::showfrapor($siswa);
                    } else {
                        fullview::viewhasil();
                    }
                } else if ($halaman == 'log'){
                    if(isset($_GET['i'])){
                        fullview::logs($_SESSION['user'],$_GET['i']);
                    }else{
                        fullview::logs($_SESSION['user'],'');
                    }
                } else {
                    ?>
                    <div class="container">
                        <div class="row materi-msg">
                            <div class="item-reg text-center">
                                    <label class="label label-danger" style="color:white;">Data tidak ditemukan</label>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                header("location:http://localhost/elingpin/frontpage.php?p=masuk");
                exit;
            }

        ?>
        
        <footer>
            <div class="container">
                <div class="row">
                    <p class="copyright">&copy; Copyright 2017 by  Fakultas Ilmu Keolahragaan</p> <span class="hidden-xs">|</span>
                    <div class="partner">
                        <p></p>
                        <a href="http://e-learning.um.ac.id/">
                            <img src="public/images/Logo-UM.png" width="1560" height="240" alt="Logo Universitas Negeri Malang" class="img-responsive">
                        </a>
                    </div>
                    <br>
                    <p class="text-center">Dibuat dan dikembangkan oleh Ibnu Shodiqin Suhaemy</p>
                </div>
            </div>
        </footer>
        
        <?php  
            if (isset($_SESSION['user'])){
                if($halaman == 'home'){
                    javascript::general();
                } else if ($halaman == 'profil'){
                    javascript::general();
                } else if ($halaman == 'edprofil'){
                    javascript::general();
                    javascript::formvalidate();
                    javascript::formprofil();
                } else if ($halaman == 'materi'){
                    javascript::general();
                } else if ($halaman == 'fm'){
                    javascript::general();
                    javascript::formvalidate();
                    javascript::formmateri();
                } else if ($halaman == 'formem'){
                    javascript::general();
                    javascript::formvalidate();
                    javascript::formmateri();
                } else if ($halaman == 'fkm'){
                    javascript::general();
                    javascript::otomateri();
                    javascript::formvalidate();
                    javascript::formkonten();
                    javascript::tinymce();
                } else if ($halaman == 'cm'){
                    javascript::general();
                    javascript::download();
                    javascript::tab();
                    javascript::jspdf();
                    javascript::tinymce();
                    javascript::formvalidate();
                    javascript::comment();
                    javascript::iframerespon();
                    javascript::imagerespon();
                    javascript::tablerespon();
                } else if ($halaman == 'lm'){
                    javascript::general();
                    javascript::download();
                    javascript::tab();
                    javascript::jspdf();
                    javascript::tinymce();
                    javascript::formvalidate();
                    javascript::comment();
                    javascript::iframerespon();
                    javascript::imagerespon();
                    javascript::tablerespon();
                } else if ($halaman == 'rapor'){
                    javascript::general();
                    javascript::printarea();
                } else if ($halaman == 'fr'){
                    javascript::general();
                    javascript::formvalidate();
                    javascript::formnilai();
                    javascript::tinymce();
                }  else if ($halaman == 'log'){
                    javascript::general();
                } else {
                    ?>
                    <div class="container">
                        <div class="row materi-msg">
                            <div class="item-reg text-center">
                                    <label class="label label-danger" style="color:white;">Data tidak ditemukan</label>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                header("location:http://localhost/elingpin/frontpage.php?p=masuk");
                exit;
            }
        ?>
        
    </body>
</html>
<?php
    } else {
//        echo $tampil;
        header("location:http://localhost/elingpin/frontpage.php?p=masuk");
        exit;
    }
?>