<!DOCTYPE HTML>
<html lang="en">
<head>
   <title>Pernyataan Break</title>
</head>
<body>
    <?php
        for ($i=1; $i<=20; $i++) {
            echo "$i<br>";
            if ($i == 10){
                break;
            }
        }
        echo "Selesai<br>";
    ?>
</body>
</html>
