<!DOCTYPE html>
<html>
    <head>
        <title>Prinsip Fungsi</title>
    </head>
    <body>
        <?php
            function contohfungsi($bilangan){
                $pangkatdua = $bilangan * $bilangan;
                return $pangkatdua;
            }

            function contohprosedur(){
                ?>
                <h1>Judul Program</h1>
                <?php
            }
            
            echo contohprosedur();
            $hasil = contohfungsi(5);
            echo $hasil;
        ?>
    </body>
</html>