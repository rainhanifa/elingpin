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
            
            var_dump($teman);
            var_dump("<br>");
            
            $kawan[] = "Lala";
            $kawan[] = "Lili";
            $kawan[] = "Lulu";

            var_dump($kawan);
            var_dump("<br>");

            $isidompet = array("sim", "ktp", "50000");

            var_dump($isidompet);
        ?>
    </body>
</html>