<?php
    $teks   = '';
    $action = '';
    $materi = '';
    if(isset($_GET['i'])){
        $teks   = 'Ubah';
        $action = 'index.php?p=em';
    } else {
        $teks   = 'Tambah';
        $action = 'index.php?p=tm';
    }
?>

<div class="container">
    <div class="row">
        <h1 class="reg-heading">Form <?php echo $teks; ?> Materi</h1>
    </div>
</div>

<section class="form-reg">
    <div class="container">
        <form name="fdatamateri" id="fdatamateri" method="post" action="<?php echo $action; ?>" class="form-group" role="form">
            <input type="hidden" name="userid" value="<?php echo $_SESSION['user']; ?>">
            <div class="row item-reg">
                <div class="col-lg-1 col-md-2 col-sm-3 col-xs-12">
                    <label for="materi" class="control-label">Materi</label>
                </div>
                <div class="col-lg-11 col-md-10 col-sm-9 col-xs-12">
                    <?php
                        if(isset($_GET['i'])){
                            if($edmateri<>''){
                                if(is_array($edmateri)){
                                    foreach($edmateri as $data){
                    ?>
                    <p><?php echo $data['materi']; ?></p>
                    <input type="hidden" name="materi" value="<?php echo $data['materi']; ?>">
                    <?php
                                    }
                                }
                            }
                        } else {
                    ?>
                    <input type="text" name="materi" class="form-control" id="materi" value="">
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="row item-reg">
                <div class="col-lg-1 col-md-2 col-sm-3 col-xs-12">
                    <label for="submateri" class="control-label">Sub Materi</label>
                </div>
                <div class="col-lg-11 col-md-10 col-sm-9 col-xs-12">
                    <?php
                        if(isset($_GET['i'])){
                            if($edmateri<>''){
                                if(is_array($edmateri)){
                                    foreach($edmateri as $data){
                                        $materi = $data['materi'];
                                        $getsub = backgurucode::listmateri($materi);          
                                        
                                        foreach($getsub as $hasil){
                                        ?>
                    <input type="hidden" name="noid" value="<?php echo $hasil['idmateri']; ?>">
                    <input type="text" name="submateri<?php echo $hasil['idmateri']; ?>" class="form-control" id="submateri" value="<?php echo $hasil['submateri']; ?>">
                    <label class="clues"> Ganti submateri ini jika ingin mengganti </label>
                    <?php
                                        }
                                    }
                                }
                            }
                        } else {
                            ?>
                    <input type="text" name="submateri" class="form-control" id="submateri" value="">
                    <label class="clues">Contoh: Cara Kerja Aplikasi Web Berbasis Server</label>
                            <?php
                        }
                    ?>
                </div>
            </div>
            <div class="col-lg-offset-1 col-md-offset-2">
                <input type="submit" name="finish_reg" value="Selesai" class="btn btn-default">
            </div>
        </form>
    </div>
</section>