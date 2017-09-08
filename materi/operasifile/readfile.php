<!DOCTYPE html>
<html>
    <head>
        <title>Operasi File dengan Readfile</title>
    </head>
    <body>
        <?php
            $namafile   = "data.txt";
            $read       = readfile($namafile);
            echo $read;
        ?>
    </body>
</html>