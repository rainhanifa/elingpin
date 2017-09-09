<section>
    <div class="container">
        <div class="row reg-heading">
            <h1 class="text-center">Daftar Materi Pemrograman Web Dinamis</h1>
        </div>
        <div class="row form-cari materi">
            <form name="carimateri" id="carimateri" method="post" action="index.php?p=carimateri" role="form" class="form-group">
                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
                    <select name="category" form="carimateri" class="form-control">
                        <option value="">--- Kategori Pencarian ---</option> 
                        <option value="materi">Materi</option>
                        <option value="submateri">Submateri</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
                    <input type="text" name="searchid" value="" placeholder="Kata Kunci Pencarian" class="form-control">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                    <input type="submit" value="Cari" class="btn btn-default action">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                    <a href="index.php?p=materi" class="btn btn-default action">Lihat Semua</a>
                </div>
            </form>
        </div> 
    </div>
</section>

<section class="all-materi">
    <div class="container">
        <div class="row">
            <a href="index.php?p=fm" class="btn btn-default add">Tambah Materi</a>
            <a href="index.php?p=fkm" class="btn btn-default add">Tambah Konten Materi</a>
            <hr>
        </div>
        <?php
            if($daftarmateri<>''){
                if(is_array($daftarmateri)){
                    foreach($daftarmateri as $data){
        ?>
                    <div class="deskripsi-materi">
                        <h5>Materi : <?php echo $data['materi']; ?></h5>
                        
                        <?php
//                                backgurucode::connecttodb();
                                if(!isset($_GET['c']) and !isset($_GET['k'])){
                                    $arrmateri      = backgurucode::listmateri($data['materi']); 
                                } else {
                                    $arrmateri      = backgurucode::smateri($data['materi'], $category, $keyword);
                                }
                                
                                $no               = 1;
                                foreach($arrmateri as $datamateri){
                            ?>
                            <div class="row">
                                <div class="col-lg-7 col-md-7 col-sm-4 col-xs-12">
                                    <p>
                                        <label class="label label-danger"><?php echo $no; ?></label>
                                        <?php echo $datamateri['submateri']; ?>
                                    </p>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-8 col-xs-12 form-reg">
                                    <?php
                                        $nomateri   = $datamateri['idmateri']; 
                                        $classact   = 'Class Activity Kosong';
                                        $labact     = 'Lab Activity Kosong';
                                        $classid    = 'p=materi';
                                        $labid      = 'p=materi';
                                        
                                        $setbtn     = backgurucode::buttonclasslab($nomateri);
                                        
                                        if($setbtn<>''){
                                            foreach($setbtn as $ket_btnmateri){
                                                if($ket_btnmateri['kategori']=='class'){
                                                    $classact       = 'Class Activity';
                                                    $classid        = 'p=classact&cl='.$ket_btnmateri['idkonten'];
                                                } else if($ket_btnmateri['kategori']=='lab'){
                                                    $labact         = 'Lab Activity';
                                                    $labid          = 'p=labact&nl='.$ket_btnmateri['idkonten'];
                                                }
                                            }
                                        } else {
                                            $classact   = 'Class Activity Kosong';
                                            $labact     = 'Lab Activity Kosong';
                                            $classid    = 'p=materi';
                                            $labid      = 'p=materi';
                                        }
                                    ?>
                                    <a href="index.php?<?php echo $classid; ?>" class="btn activity action"><?php echo $classact; ?></a>
                                    <a href="index.php?<?php echo $labid; ?>" class="btn lab action"><?php echo $labact; ?></a>
                                </div>
                            </div>
                            <?php
                                    $no++;
                                }
                            ?>
                        <div class="form-reg">
                            <a href="index.php?p=fedmateri&m=<?php echo $data['materi']; ?>" class="btn btn-default delete">Edit Materi</a>
                            <a href="index.php?p=delm&m=<?php echo $data['materi']; ?>&u=<?php echo $_SESSION['user']; ?>" class="btn btn-default delete">Hapus Materi</a>
                        </div>
                    </div>
                <?php
                    }
                }
            } else {
        ?>
            <div class="row materi-msg">
                <div class="item-reg">
                        <label class="label label-danger" style="color:white;">Data tidak ditemukan</label>
                </div>
            </div>
        <?php
            }
        ?>
    </div>
</section>