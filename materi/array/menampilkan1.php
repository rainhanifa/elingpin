<!DOCTYPE html>
<html>
    <head>
        <title>Cara menampilkan array 1</title>
    </head>
    <body>
        <?php
            $teman[0] = "Charlie";
            $teman[1] = "Ani";
            $teman[2] = "Budi";
            
            echo $teman[0]."<br>";
            echo $teman[1]."<br>";
            echo $teman[2]."<br>";
            
            $kawan[] = "Lala";
            $kawan[] = "Lili";
            $kawan[] = "Lulu";

            echo $kawan[0]."<br>";
            echo $kawan[1]."<br>";
            echo $kawan[2]."<br>";

            $isidompet = array("sim", "ktp", "50000");

            echo $isidompet[0]."<br>";
            echo $isidompet[1]."<br>";
            echo $isidompet[2]."<br>";
        ?>
    </body>
</html>