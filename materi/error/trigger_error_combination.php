<!DOCTYPE html>
<html>
    <head>
        <title>Penanganan Error dengan trigger error dan custom error handler</title>
    </head>
    <body>
        <?php
            function customError($errorLevel,$errorMsg){
                @session_start();
                $_SESSION['error_msg'] = $errorMsg;
                header("Location: error.php");
                exit;
            }
            
            set_error_handler("customError", E_USER_WARNING);
            $input = "<strong>hurup tebal</strong>";
            
            if(preg_match('/<(.+)>/', $input)){
                trigger_error("anda tidak boleh memasukkan html tag", E_USER_WARNING);
            }
        ?>
    </body>
</html>