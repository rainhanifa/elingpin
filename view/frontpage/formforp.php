    <section class="form-log">
        <div class="container">
            <div class="row">
                <form name="forgetpass" id="forgetpass" class="form-group form-login" role="form" action="index.php?p=fpdata" method="post">
                    <?php
                        if(isset($_GET['msg'])){
                            $msg = $_GET['msg'];
                            if($msg == 'sscsend'){
                                echo "<p class='label label-warning text-center'>Mohon periksa email anda, kemudian masukkan kode yang dikirim pada form berikut.</p>";
                            }
                        } 

                        if(isset($_GET['error'])){
                            $error  = $_GET['error'];
                            if($error == 'errdr'){
                                echo "<p class='label label-danger text-center'>Username/kode tidak sama, mohon lakukan pengisian data ulang.</p>";
                            }
                        }
                    ?>
                    <label for="userfp" class="control-label"> Username </label>
                    <input type="text" name="userfp" class="form-control" id="userfp" value="">
                    <label for="tokenfp" class="control-label"> Kode </label>
                    <input type="text" name="tokenfp" class="form-control" id="tokenfp" value="">
                    <label for="tokenfp" class="control-label">Kata kunci baru</label>
                    <input type="password" name="passfp" class="form-control" id="passfp" value="">
                    <label for="tokenfp" class="control-label"> Ulangi kata kunci </label>
                    <input type="password" name="repassfp" class="form-control" id="repassfp" value="">
                    <input type="submit" name="finish_reg" value="Selesai" class="btn btn-default action">
                </form>
            </div>
        </div>
    </section>