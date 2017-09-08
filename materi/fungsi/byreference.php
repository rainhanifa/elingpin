<!DOCTYPE html>
<html>
    <head>
        <title>Prinsip Fungsi</title>
    </head>
    <body>
        <?php
            function datasiswa(&$nama){
                $nama .= 'Alfiandi';
            }

            $nama_siswa = 'Nama anda : ';
            datasiswa($nama_siswa);
            echo $nama_siswa;
        ?>
    </body>
</html>