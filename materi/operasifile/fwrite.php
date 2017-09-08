<!DOCTYPE html>
<html>
    <head>
        <title>Operasi File dengan fputs</title>
    </head>
    <body>
        <?php
            $namafile   = "tulis.txt";
            $handle     = fopen($namafile, "w");
            if(!$handle){
                echo "<b>File tidak dapat dibuka atau belum ada</b>";
            } else {
                fwrite($handle, "Nama saya adalah Ibnu", 10);
                echo "<b>File berhasil dituliskan data</b>";
            }
            fclose($handle);
        ?>
    </body>
</html>