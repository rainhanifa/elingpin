<!DOCTYPE HTML>
<html lang="en">
<head>
   <title>Loop for</title>
</head>
<body>
    <?php
        // Daftar nama siswa
        $siswa[0]   = "Alfian";
        $siswa[1]   = "Bastian";
        $siswa[2]   = "Cantika";

        foreach($siswa as $data){
            echo "Nama siswa : $data";
            echo "<br>";
        }
    ?>
</body>
</html>
