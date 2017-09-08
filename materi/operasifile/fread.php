<!DOCTYPE html>
<html>
    <head>
        <title>Operasi File dengan fread</title>
    </head>
    <body>
        <?php
            $namafile   = "data.txt";
            $handle     = fopen($namafile, "r");
            if(!$handle){
                echo "<b>File tidak dapat dibuka atau belum ada</b>";
            } else {
                $isi    = fread($handle, 20);
                $isi2   = fread($handle, 50);
                
                echo "Isi 1 : $isi<br>";
                echo "Isi 2 : $isi2<br>";
            }
            fclose($handle);
        ?>
    </body>
</html>