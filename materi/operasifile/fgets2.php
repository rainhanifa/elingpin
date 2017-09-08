<!DOCTYPE html>
<html>
    <head>
        <title>Operasi File dengan fgets</title>
    </head>
    <body>
        <?php
            $namafile   = "data.txt";
            $handle     = @fopen($namafile, "r");
            if(!$handle){
                echo "<b>File tidak dapat dibuka atau belum ada</b>";
            } else {
                echo "<b>Isi file : </b>";
                while(!feof($handle)){
                     $buffer = fgets($handle, 4096);
                    echo $buffer;
                }
            }
            fclose($handle);
        ?>
    </body>
</html>