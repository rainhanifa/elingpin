<!DOCTYPE html>
<html>
    <head>
        <title>Prinsip Fungsi</title>
    </head>
    <body>
        <?php
            function hyperlink($url){
                ?>
                <a href="<?php echo $url;?>">Click me!</a>
                <?php
            }


            $website = hyperlink("http://www.facebook.com");
            echo $website;
        ?>
    </body>
</html>