<?php
    session_start();

    include "viewsiswa/backview.php";
    include "viewsiswa/fullview.php";
    $halaman = $_GET['p'];

    if(isset($_SESSION['user'])){
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Beranda Siswa </title>
        
        <!-- Meta Tags -->
        <meta charset="UTF-8">
        <meta name="description" content="E-Learning Pemrograman Web Dinamis">
        <meta name="keywords" content="PHP, MySQL, JSP">
        <meta name="author" content="SMKN 4 Malang">
        <meta name="viewport" content="width=device-width">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <base href="http://<?php echo $_SERVER['HTTP_HOST'];?>/elprowinmvc.com/epsettings/siswa/">
        
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="public/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <link rel="stylesheet" type="text/css" href="public/css/siswa.css">
        
        <!-- Icons -->
        <link rel="icon" href="public/images/logo.png">
        
        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        
    </head>
    <body>
        <header>
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
                                        $classbn        = "";
                                        $spanclassbn    = "";
                                        $classprof      = "";
                                        $spancasspr     = "";
                                        $classrapor     = "";
                                        $spanclassrp    = "";
                                        $classmateri    = "";
                                        $spanclassmt    = "";
                                        $classnote      = "";
                                        $spannote       = "";

                                        if($halaman == 'home'){
                                            $classbn     = "active";
                                            $spanclassbn = "home";
                                        } else if($halaman == 'profil' || $halaman == 'formp'){
                                            $classprof   = "active";
                                            $spanclasspr = "profile";
                                        } else if($halaman == 'nilai'){
                                            $classrapor  = "active";
                                            $spanclassrp = "clue";
                                        } else if($halaman == 'materi'){
                                            $classmateri = "active";
                                            $spanclassmt = "materi";
                                        } else if($halaman == 'catatan'){
                                            $classnote = "active";
                                            $spannote = "note";
                                        }
        
                                    ?>
                                    <ul class="nav navbar-nav">
                                        <li class="<?php echo $classbn; ?>">
                                            <a href="index.php?p=beranda">Beranda</a>
                                            <span class="<?php echo $spanclassbn; ?>"></span>
                                        </li>
                                        <li class="<?php echo $classprof; ?>">
                                            <a href="index.php?p=ps">Profil</a>
                                            <span class="<?php echo $spanclasspr; ?>"></span>
                                        </li>
                                        <li class="<?php echo $classmateri; ?>">
                                            <a href="<?php if(isset($_SESSION['nowmateri'])){echo $_SESSION['nowmateri'];}else{echo "";} ?>">Materi</a>
                                            <span class="<?php echo $spanclassmt; ?>"></span>
                                        </li>
                                        <li class="<?php echo $classrapor; ?>">
                                            <a href="index.php?p=ns">Rapor</a>
                                            <span class="<?php echo $spanclassrp; ?>"></span>
                                        </li>
                                        <li class="<?php echo $classnote; ?>">
                                            <a href="index.php?p=nos">Catatan</a>
                                            <span class="<?php echo $spannote; ?>"></span>
                                        </li>
                                        <li>
                                            <a href="index.php?p=logout">Keluar</a>
                                        </li>
                                    </ul>
                                    <ul class="nav navbar-nav navbar-right">
                                        <li><a href="#">Selamat datang, <label class="label label-warning"><?php echo $_SESSION['user']; ?></label></a></li>
                                    </ul>
                                </div><!-- /.navbar-collapse -->
                            </div><!-- /.container-fluid -->
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        
        <?php
            if(isset($_SESSION['user'])){
                if($halaman == 'home'){
                    fullview::home($_SESSION['user']);
                } else if($halaman == 'profil'){
                    fullview::profil($_SESSION['user']);
                } else if($halaman == 'formp'){
                    fullview::formedprofil($_SESSION['user']);
                } else if($halaman == 'nilai'){
                    fullview::rapor($_SESSION['user']);
                } else if($halaman == 'materi'){
                    if(isset($_GET['i']) and $_GET['c']){
                        if($_GET['i']<>'' and $_GET['c']<>''){
                            fullview::materi($_GET['i'], $_GET['c']);
                        } else {
                        ?>
                        <div class="container">
                            <div class="row materi-msg">
                                <div class="item-reg text-center">
                                    <label class="label label-danger" style="color:white;">Halaman tidak ditemukan</label>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                    } else {
                    ?>
                    <div class="container">
                        <div class="row materi-msg">
                            <div class="item-reg text-center">
                                <label class="label label-danger" style="color:white;">Halaman tidak ditemukan</label>
                            </div>
                        </div>
                    </div>
                    <?php    
                    }
                }else if($halaman == 'log'){
                    fullview::logs($_SESSION['user']);
                } else {
                    ?>
                    <div class="container">
                        <div class="row materi-msg">
                            <div class="item-reg text-center">
                                <label class="label label-danger" style="color:white;">Halaman tidak ditemukan</label>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                header("location:http://localhost/elprowinmvc.com/frontpage.php?p=masuk");
                exit;
            }

        ?>
        
        <footer>
            <div class="container">
                <div class="row">
                    <p class="copyright">&copy; Copyright 2014 by <img src="public/images/logo.png" width="36" height="43" alt="Logo SMKN 4 Malang"> SMKN 4 Malang</p> <span class="hidden-xs">|</span>
                    <div class="partner">
                        <p>Bekerja Sama dengan</p>
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
            include "viewsiswa/jscode.php";
            if(isset($_SESSION['user'])){
                if($halaman == 'home'){
                    jscode::general();
                } else if($halaman == 'profil'){
                    jscode::general();
                } else if($halaman == 'formp'){
                    jscode::general();
                    jscode::generalval();
                    jscode::edprofilval();
                } else if($halaman == 'nilai'){
                    jscode::general();
                } else if($halaman == 'materi'){
                    jscode::general();
                    jscode::modal();
                    jscode::tinymce();
                    jscode::generalval();
                    jscode::jspdf();
                    jscode::comment();
                    jscode::iframerespon();
                    jscode::imagerespon();
                } else if($halaman == 'log'){
                    jscode::general();
                } else {
                    echo '';
                }
            } else {
                header("location:http://localhost/elprowinmvc.com/frontpage.php?p=masuk");
                exit;
            }
        ?>
        
    </body>
</html>
<?php
    } else {
        header("location:http://localhost/elprowinmvc.com/frontpage.php?p=masuk");
        exit;
    }
?>