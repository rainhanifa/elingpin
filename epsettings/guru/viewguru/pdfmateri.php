<html>
    <head>
        <title> Halaman Guru </title>
        
        <base href="http://<?php echo $_SERVER['HTTP_HOST'];?>/elprowinmvc.com/epsettings/guru/">
        
        <!-- CSS -->
<!--
        <link rel="stylesheet" type="text/css" href="epsettings/guru/public/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="epsettings/guru/public/css/style.css">
        <link rel="stylesheet" type="text/css" href="epsettings/guru/public/css/guru.css">
-->
        
        <!-- Icons -->
<!--        <link rel="icon" href="public/images/logo.png">-->
        
        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        
        <script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/elprowinmvc.com/public/js/jquery-1.11.2.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("img").addClass("img-responsive");
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".img-responsive").each(function(){
                    var imgsrc  = $(this).attr("src");
                    var newsrc  = "../" + imgsrc;
//                    var newsrc  = "" + imgsrc.substring(6,100);
                    $(this).attr("src", newsrc);
                });
            });
        </script>
    </head>
    <body>
<?php
    require_once("../modelguru/backgurucode.php");

    $noclass    = $_GET['nm'];
    $dataclass  = backgurucode::classcode($noclass);
    $html       = "";
    $title      = "";
    if($dataclass<>''){
        if(is_array($dataclass)){
            foreach($dataclass as $data){
                $materi     = $data['materi'];
                $title      = backgurucode::showmateri($materi);
                $html = '<h2>Class Activity</h1>
                         <h3>'.$title['materi'].'</h3>
                         <h4>'.$title['submateri'].'</h4>
                         <p>'.$data['konten'].'</p>';
            }
        }
    }
    echo $html;
?>
    </body>
</html>