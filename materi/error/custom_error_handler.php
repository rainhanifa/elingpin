<!DOCTYPE html>
<html>
    <head>
        <title>Penanganan Error dengan Custom error</title>
    </head>
    <body>
        <?php
            function customError($errorLevel,$errorMsg){
                @session_start();
                $_SESSION['error_msg'] = $errorMsg;
                header("Location: error.php");
                exit;
            }

            set_error_handler("customError");
            error_reporting(E_ALL);
            $connection = mysql_connect("localhost", "user", "password");
            mysql_select_db("test");
            $result = mysql_query("select * from nama_table");

            while($row = mysql_fetch_array($result)){
                echo $row['nama_field'];
            }
        ?>
    </body>
</html>