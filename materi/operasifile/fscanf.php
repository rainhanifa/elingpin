<!DOCTYPE html>
<html>
    <head>
        <title>Operasi File dengan fscanf</title>
    </head>
    <body>
        <?php
            $namafile   = "data.txt";
            $handle     = fopen($namafile, "r");
            if(!$handle){
                echo "<b>File tidak dapat dibuka atau belum ada</b>";
            } else {
                while(list($nama, $data) = fscanf($handle, "%s\t%s\n")){
                    echo $nama." ".$data."<br>";
                }
            }
            fclose($handle);
        ?>
    </body>
</html>