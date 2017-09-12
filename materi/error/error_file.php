<!DOCTYPE html>
<html>
    <head>
        <title>Penanganan Error dengan Custom error</title>
    </head>
    <body>
        <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 'Off');
            ini_set('log_errors', 'On');
            ini_set('error_log', 'error.log');
            
            $connection = mysql_connect("localhost", "user", "password");
            mysql_select_db("test");
            $result = mysql_query("select * from nama_table");
            
            while($row = mysql_fetch_array($result)){
                echo $row['nama_field'];
            }
        ?>
    </body>
</html>