<!DOCTYPE html>
<html>
    <head>
        <title>Penanganan Error dengan email</title>
    </head>
    <body>
        <?php
        //Fungsi dengan exception
        function checkNum($number) {
          if($number>1) {
            throw new Exception("Nilai harus dibawah 1");
          }
          return true;
        }

        //penerapan try...catch
        try {
          checkNum(2);
          //Jika exception terjadi teks ini tidak muncul
          echo 'Kondisi benar';
        }

        //menangkap exception yang terjadi
        catch(Exception $e) {
          echo 'Message: ' .$e->getMessage();
        }
?>
    </body>
</html>