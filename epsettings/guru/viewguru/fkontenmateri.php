<div class="container">
    <div class="row">
        <h1 class="reg-heading">
            <?php
                if($_GET['i'] <> null){
                    echo "Form Ubah Konten Materi";
                } else {
                    echo "Form Tambah Konten Materi";
                }
            ?>
        </h1>
    </div>
</div>

<section>
    <div class="container">
        <div class="row reg-heading head2">
            <h3>Petunjuk</h3>
            <ol>
                <li>Isi form dibawah ini sesuai dengan data konten materi.</li>
                <li>Field submateri akan tampil menyesuaikan dengan pilihan pada field materi.</li>
                <li>Jika field submateri belum muncul data setelah memilih materi, harap menunggu sejenak.</li>
            </ol>
        </div>
    </div>
</section>

<?php
    backgurucode::connecttodb();
    $action = "";
    if($_GET['i'] <> null){
        $action = "index.php?p=edkonten";
    } else {
        $action = "index.php?p=tmkonten";
    }
?>

<section class="form-reg">
    <div class="container">
        <form name="formtmkonten" id="formtmkonten" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data" class="form-group" role="form">
            <input type="hidden" name="uploader" value="<?php echo $_SESSION['user']; ?>">
            <div class="row item-reg">
                <div class="col-lg-1 col-md-2 col-sm-3 col-xs-12">
                    <label for="materi" class="control-label">Materi</label>
                </div>
                <div class="col-lg-11 col-md-10 col-sm-9 col-xs-12">
                    <select name="materi" class="form-control" id="materi" onchange="pilih_kota('dom_kota',this.value);">
                        <option value="">-- Pilih Materi --</option>
                        <?php
                            $cekmateri      = backgurucode::materi();
                            $issetmateri    = backgurucode::setmateri($noktn);
                            
                            foreach($cekmateri as $dta_materi){
                                if($submit == 'false'){
                            ?>
                        <option value="<?php echo $dta_materi['materi']; ?>"><?php echo $dta_materi['materi']; ?></option>
                            <?php
                                } else {
                                    if($dta_materi['materi'] == $issetmateri){
                                        $selected1   = "selected=selected";
                                    } else {
                                        $selected1   = '';
                                    }
                            ?>
                        <option value="<?php echo $dta_materi['materi']; ?>" <?php echo $selected1; ?>><?php echo $dta_materi['materi']; ?></option>
                            <?php
                                }
                            }
                        ?>
                    </select>
                    <label class="clues">Pilih salah satu materi</label>
                </div>
            </div>
            <div class="row item-reg">
                <div class="col-lg-1 col-md-2 col-sm-3 col-xs-12">
                    <label for="submateri" class="control-label">Sub Materi</label>
                </div>
                <div class="col-lg-11 col-md-10 col-sm-9 col-xs-12">
                    <select name="submateri" class="form-control" id="dom_kota">
                        <?php
                            if($_GET['i'] <> null){
                                $issetsubmateri     = backgurucode::setmateri($noktn);
                                $selectmateri       = backgurucode::listmateri($issetmateri);
                                foreach($selectmateri as $arr_subm){
                                    $issetsubmateri     = backgurucode::setsubmateri($noktn);
                                    if($arr_subm['submateri'] == $issetsubmateri){
                                        $selected2   = "selected=selected";
                                    } else {
                                        $selected2   = '';
                                    }
                            ?>
                        <option value="<?php echo $arr_subm['submateri']; ?>" <?php echo $selected2; ?>><?php echo $arr_subm['submateri']; ?></option>
                            <?php
                                }
                            } else {
                            ?>
                        <option value="">-- Pilih Submateri --</option>
                            <?php
                            }
                        ?>
                    </select>
                    <label class="clues">Pilih salah satu submateri</label>
                </div>
            </div>
            
            <div class="row item-reg">
                <div class="col-lg-1 col-md-2 col-sm-3 col-xs-12">
                    <label for="kategori" class="control-label">Kategori</label>
                </div>
                <div class="col-lg-11 col-md-10 col-sm-9 col-xs-12">
            <?php
                if($_GET['i'] <> null){
                    $arr_edmateri = backgurucode::showclass($noktn);
            ?>
                    <input type="hidden" name="idk" value="<?php echo $_GET['i']; ?>">
                    <select name="kategori" class="form-control" id="kategori">
            <?php
                    $selected3   = "";
                    $selected4   = "";
                                
                    if($arr_edmateri['kategori'] == 'class'){
                        $selected3   = "selected=selected";
                        $selected4   = "";
                    } else if($arr_edmateri['kategori'] == 'lab'){
                        $selected3   = "";
                        $selected4   = "selected=selected";
                    } 
                } else {
                    $selected3   = "";
                    $selected4   = "";
            ?>
                    <select name="kategori" class="form-control" id="kategori">
                        <option value="">-- Pilih Kategori --</option>
            <?php
                }
            ?>
                        <option value="class" <?php echo $selected3; ?>>Class Activity</option>
                        <option value="lab" <?php echo $selected4; ?>>Lab Activity</option>
                    </select>
                    <label class="clues">Pilih kategori sesuai dengan modul yang dibuat</label>
                </div>
            </div>
            <div class="row item-reg">
                <div class="col-lg-1 col-md-2 col-sm-3 col-xs-12">
                    <label for="isimateri" class="control-label">Isi Materi</label>
                </div>
                <div class="col-lg-11 col-md-10 col-sm-9 col-xs-12">
                    <textarea name="isimateri" id="isimateri" rows="20">
                        <?php
                            if($_GET['i'] <> null){
                                echo $arr_edmateri['konten']; 
                            }
                        ?>
                    </textarea>
                    <label class="clues">Silahkan masukkan materi untuk modul anda</label>
                </div>
            </div>
            <div class="col-lg-offset-1 col-md-offset-2">
                <input type="submit" name="finish_reg" value="Selesai" class="btn btn-default">
            </div>
        </form>
    </div>
</section>