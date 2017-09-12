<!DOCTYPE html>
<html>
   <head>
       <title>Struktur Kontrol IF</title>
   </head>	
   <body>
        <?php
            date_default_timezone_set("Asia/Jakarta");
            $waktu = date('H');
            if ($waktu <= 10)
            {
               echo "Selamat Pagi";
            }
            elseif ($waktu <= 15)
            {
               echo "Selamat Siang";
            }
            elseif ($waktu <= 18)
            {
               echo "Selamat Sore";
            }
            else
            {
               echo "Selamat Malam";
            }
        ?>
   </body>
</html>
