<!DOCTYPE html>
<html>
    <head>
        <title>Operasi File dengan fgets</title>
    </head>
    <body>
        <?php
            $namafile   = "data.txt";
            $handle     = fopen($namafile, "r");
            if(!$handle){
                echo "<b>File tidak dapat dibuka atau belum ada</b>";
            } else {
                echo "<b>Isi file : </b>";
                while($isi = fgets($handle, 2048)){
                    echo "$isi <br>";
                }
            }
            fclose($handle);
        ?>
    </body>
</html>