<!DOCTYPE html>
<html>
    <head>
        <title>Penanganan Error dengan Die</title>
    </head>
    <body>
        <?php
            mysql_connect('localhost', 'user', 'password') 
                or die ('tidak dapat melakukan koneksi ke server');
            mysql_select_db('test');
        ?>
    </body>
</html>