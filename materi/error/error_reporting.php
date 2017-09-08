<!DOCTYPE html>
<html>
    <head>
        <title>Penanganan Error dengan Die</title>
    </head>
    <body>
        <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
            $connection = mysql_connect("localhost", "user", "password");
            mysql_select_db("test");
            $result = mysql_query("select * from nama_table");
            while($row = mysql_fetch_array($result)){
            echo $row['nama_field'];
            }
        ?>
    </body>
</html>