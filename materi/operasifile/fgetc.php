<!DOCTYPE html>
<html>
    <head>
        <title>Operasi File dengan fgetc()</title>
    </head>
    <body>
        <?php
            $namafile   = "data.txt";
            $handle     = fopen($namafile, "r");
            $huruf      = 0;
            $baris      = 1;

            if(!$handle){
                echo "<b>File tidak dapat dibuka atau belum ada</b>";
            } else {
                while(!feof($handle)){
                    $ch = fgetc($handle);
                    if(($ch!="") and ($ch!="\n") and ($ch!="\t")){
                        $huruf++;
                    } else if ($ch == "\n"){
                        $baris++;
                    }
                }
                echo "Jumlah huruf : $huruf <br>";
                echo "Jumlah baris : $baris <br>";
            }
            fclose($handle);
        ?>
    </body>
</html>