<!DOCTYPE html>
<html>
    <head>
        <title>Penanganan Error dengan trigger error</title>
    </head>
    <body>
        <?php
            $input = "<strong>hurup tebal</strong>";
            if(preg_match('/<(.+)>/', $input)){
                trigger_error("anda tidak boleh memasukkan html tag");
            }
        ?>
    </body>
</html>