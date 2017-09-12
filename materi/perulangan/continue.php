<!DOCTYPE HTML>
<html lang="en">
<head>
   <title>Pernyataan Continue</title>
</head>
<body>
    <?php
        for ($i=1; $i<=20; $i++) {
            if ($i >= 10 and $i <= 15){
                continue;
            }
            echo "$i <br>";
            $i++;
        }
    ?>
</body>
</html>
