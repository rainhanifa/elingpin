<!DOCTYPE html>
<html>
    <head>
        <title>Cara menampilkan array 2</title>
    </head>
    <body>
        <?php
            $teman[0] = "Charlie";
            $teman[1] = "Ani";
            $teman[2] = "Budi";
            
            print_r($teman);
            print_r("<br>");
            
            $kawan[] = "Lala";
            $kawan[] = "Lili";
            $kawan[] = "Lulu";

            print_r($kawan);
            print_r("<br>");

            $isidompet = array("sim", "ktp", "50000");

            print_r($isidompet);
        ?>
    </body>
</html>