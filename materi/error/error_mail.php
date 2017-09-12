<!DOCTYPE html>
<html>
    <head>
        <title>Penanganan Error dengan email</title>
    </head>
    <body>
        <?php
            function customError($errorLevel,$errorMsg){
                echo "<b>Error:</b> [$errorLevel] $errstr<br />";
                echo "Telah terjadi kesalahan pada sistem";
                error_log(" Error: [$errorLevel] $errorMsg",1,
                            "admin@example.com","From: error@example.com");
            }

            set_error_handler("customError", E_USER_WARNING);
            $input = "<strong>hurup tebal</strong>";
            
            if(preg_match('/<(.+)>/', $input)){
                trigger_error("Anda tidak boleh memasukkan html tag", E_USER_WARNING);
            }
        ?>
    </body>
</html>