<!DOCTYPE html>
<html>
    <head>
        <title>Tipe Data Objek</title>
    </head>
    <body>
        <?php 
            class objek{
                function coba(){
                    return 10000;
                }
                
                function tampil(){
                    echo "test print";
                }
            }

            $test = new objek;
            $test->coba();
            echo "<br>";
            $test->tampil();
        ?>
    </body>
</html>