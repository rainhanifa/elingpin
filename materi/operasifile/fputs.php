<!DOCTYPE html>
<html>
    <head>
        <title>Operasi File dengan fputs</title>
    </head>
    <body>
        <?php
            $namafile   = "tulis.txt";
            $mydata     = "Kelas, X RPL B";
            $fp         = fopen($namafile, "w");
            fputs($fp, $mydata);
            fclose($fp);
        ?>
    </body>
</html>