<?php
    include "view/viewpage.php";
    include "view/fullview.php";
    session_start();
    $halaman    = $_GET['p'];
?>
<!DOCTYPE html>
    <html>
        <head>
            <title>ELINGPIN</title>

            <!-- Meta Tags -->
            <meta charset="UTF-8">
            <meta name="description" content="E-Learning Pemrograman Web Dinamis">
            <meta name="keywords" content="PHP, MySQL, JSP">
            <meta name="author" content="Fakultas Ilmu Keolahragaan">
            <meta name="viewport" content="width=device-width">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <!-- CSS -->
            <base href="http://<?php echo $_SERVER['HTTP_HOST'];?>/elingpin/">
            <link rel="stylesheet" href="public/css/bootstrap.css"/>
            <link rel="stylesheet" href="public/css/style.css"/>

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
                                            <ul class="nav navbar-nav">
                                                <?php
                                                    $classhome          = '';
                                                    $spanclasshome      = '';
                                                    $classkomp          = '';
                                                    $spanclasskomp      = '';
                                                    $classmateri        = '';
                                                    $spanclassmateri    = '';
                                                    $classmasuk         = '';
                                                    $spanclassmasuk     = '';
                                                    $classdaftar        = '';
                                                    $spanclassdaftar    = '';

                                                    if(!isset($_SESSION['user'])){
                                                        if($halaman == 'home'){
                                                            $classhome      = 'active';
                                                            $spanclasshome  = 'home';
                                                        } else if ($halaman == 'komp'){
                                                            $classkomp      = 'komp active';
                                                            $spanclasskomp  = 'komp';
                                                        } else if ($halaman == 'materi'){
                                                            $classmateri      = 'active';
                                                            $spanclassmateri  = 'materi';
                                                        } else if ($halaman == 'masuk'){
                                                            $classmasuk      = 'active';
                                                            $spanclassmasuk  = 'masuk';
                                                        } else if ($halaman == 'regguru' or $halaman == 'regsiswa'){
                                                            $classdaftar      = 'active';
                                                            $spanclassdaftar  = 'daftar';
                                                        }
                                                    } else {
                                                        $classmasuk = 'hidden';
                                                        if($halaman == 'home'){
                                                            $classhome      = 'active';
                                                            $spanclasshome  = 'home';
                                                        } else if ($halaman == 'komp'){
                                                            $classkomp      = 'komp active';
                                                            $spanclasskomp  = 'komp';
                                                        } else if ($halaman == 'materi'){
                                                            $classmateri      = 'active';
                                                            $spanclassmateri  = 'materi';
                                                        } else if ($halaman == 'masuk' || $halaman == 'formfp'){
                                                            $classhome      = 'active';
                                                            $spanclasshome  = 'home';
                                                        } else if ($halaman == 'regguru' or $halaman == 'regsiswa'){
                                                            $classdaftar      = 'active';
                                                            $spanclassdaftar  = 'daftar';
                                                        }
                                                    }
                                                ?>
                                                <li class="<?php echo $classhome; ?>">
                                                    <a href="index.php?p=home">Halaman Utama</a>
                                                    <span class="<?php echo $spanclasshome; ?>"></span>
                                                </li>
                                                <li class="<?php echo $classmasuk; ?>">
                                                    <a href="index.php?p=masuk">Masuk</a>
                                                    <span class="<?php echo $spanclassmasuk; ?>"></span>
                                                </li>
                                                <li class="dropdown <?php echo $classdaftar; ?>">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Daftar <span class="caret"></span></a>
                                                    <span class="<?php echo $spanclassdaftar; ?>"></span>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="index.php?p=regguru">Guru</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="index.php?p=regsiswa">Siswa</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <?php
                                                if(isset($_SESSION['user'])){
                                            ?>
                                            <ul class="nav navbar-nav navbar-right">
                                                <li><a href="epsettings"><label class="label label-warning"><?php echo $_SESSION['user']; ?></label></a></li>
                                            </ul>
                                            <?php
                                                }
                                            ?>
                                        </div><!-- /.navbar-collapse -->
                                    </div><!-- /.container-fluid -->
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <?php
                if($halaman == 'home'){
                    fullview::home();
                }else if($halaman == 'komp'){
                    fullview::komp();
                }else if($halaman == 'materi'){
                    fullview::materi();
                }else if($halaman == 'masuk'){
                    if(!isset($_SESSION['user'])){
                        fullview::masuk();
                    } else {
                        fullview::home();
                    }
                }else if($halaman == 'regsiswa'){
                    fullview::regsiswa();
                }else if($halaman == 'regguru'){
                    fullview::regguru();
                }else if($halaman == 'formfp'){
                    fullview::formforpass();
                }
            ?>
            
            <footer>
                <div class="container">
                    <div class="row">
                        <p class="copyright"> Copyright 2017 &copy; Fakultas Ilmu Keolahragaan
                            <a href="http://e-learning.um.ac.id/">
                                <img src="public/images/Logo-UM.png" width="1560" height="240" alt="Logo Universitas Negeri Malang" class="img-responsive">
                            </a>
                        <br>
                        <p class="text-center">Dibuat dan dikembangkan oleh <a href="http://illiyin.co">Illiyin Studio</a></p>
                    </div>
                </div>
            </footer>
            
            <?php 
                include "view/frontpage/javascript.php";
                if($halaman == 'home'){
                    javascript::general();
                }else if($halaman == 'komp'){
                    javascript::general();
                    javascript::accordion();
                }else if($halaman == 'materi'){
                    javascript::general();
                }else if($halaman == 'masuk'){
                    javascript::general();
                    javascript::modal();
//                    javascript::fvalidate();
                    javascript::flogin();
                    javascript::forgetpass();
                }else if($halaman == 'formfp'){
                    javascript::general();
                    javascript::fvalidate();
                    javascript::formfgpass();
                }else if($halaman == 'regsiswa'){
                    javascript::general();
                    javascript::fvalidate();
                    javascript::fregistrasi();
                }else if($halaman == 'regguru'){
                    javascript::general();
                    javascript::fvalidate();
                    javascript::fregistrasi();
                }
            ?>
        </body>
    </html>