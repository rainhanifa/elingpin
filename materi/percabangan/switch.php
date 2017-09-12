<!DOCTYPE html>
<html>
   <head>
       <title>Struktur Kontrol Switch</title>
   </head>	
   <body>
        <?php
            $english = date("l");
            switch($english) {	
            case "Monday":
               $indonesian = "Senin";
               break;
            case "Tuesday":
               $indonesian = "Selasa";
               break;
            case "Wednesday":
               $indonesian = "Rabu";
               break;
            case "Thursday":
               $indonesian = "Kamis";
               break;
            case "Friday":
               $indonesian = "Jumat";
               break;
            case "Saturday":
               $indonesian = "Sabtu";
               break;
            default:
               $indonesian = "Minggu";
            }

            echo"<h2>Hari ini adalah hari $indonesian</h2>";
        ?>
   </body>
</html>
