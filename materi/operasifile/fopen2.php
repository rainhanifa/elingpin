<!DOCTYPE html>
<html>
    <head>
        <title>Operasi File dengan mode w</title>
    </head>
    <body>
        <?php
            $namafile   = "data.txt";
            $handle     = fopen($namafile, "w");
            if(!$handle){
                echo "<b>File tidak dapat dibuka atau belum ada</b>";
            } else {
                echo "<b>File berhasil dibuka</b>";
            }
            fclose($handle);
        ?>
    </body>
</html>