<!DOCTYPE html>
<html>
    <head>
        <title>Konversi Tipe Data</title>
    </head>
    <body>
        <?php 
           // Konversi menjadi Integer
              var_dump((int) 1.23); // 3
              echo "<br />";
              var_dump((int) "1.23");  // 3 (string 1.23)
              echo "<br />";
              var_dump((int) "99 Cahaya di Langit Eropa");  //99
              echo "<br />";
              var_dump((int) "Lalala"); // 0
              echo "<br />";
              var_dump((int) "Number 11"); //0
              echo "<br />";
              var_dump((int) TRUE); // 0
              echo "<br />";
              var_dump((int) "1TRUE"); //1
              echo "<br />";
              var_dump((int) array()); // 0
              echo "<br />";
              var_dump((int) array("ini")); //1
              echo "<br />";
        ?>
    </body>
</html>