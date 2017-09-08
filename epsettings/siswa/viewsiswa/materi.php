<section class="materi-siswa">
    <div class="container">
        <div class="row">
            <?php
                if($tampilmateri<>''){
                    if(is_array($tampilmateri)){
                        foreach($tampilmateri as $data){
                            $mc     = "";
                            $link   = "";
                            if($data['kategori'] == 'class'){
                                $mc     = "Class";
                                $link   = "class";
                            } else {
                                $mc     = "Lab";
                                $link   = "lab";
                            }
            ?>
            <?php
                        if(isset($_GET['m'])){
                            if($_GET['m']=='upscs'){
            ?>
            <label class="label label-success clues"><?php echo "Upload berhasil, tunggu proses penilaian."; ?></label>
            <?php
                            } else if($_GET['m']=='errtype') {
            ?>
            <label class="label label-danger clues"><?php echo "Upload gagal, cek kembali type file anda."; ?></label>
            <?php
                            } else {
            ?>
            <label class="label label-danger clues"><?php echo "Upload gagal, cek kembali file anda."; ?></label>
            <?php                
                            }
                        } else {
                            echo "";
                        }
            ?>
            <div id="printpdf">
                <h2 class="text-center"><?php echo $mc; ?> Activity</h1>
                <h3 class="text-center"><?php echo $data['themateri']; ?></h2>
                <h3 class="text-center"><?php echo $data['submateri']; ?></h3>
                <div class="form-reg">
                    <?php echo $data['konten'] ?>
                </div>
            </div>
            <?php
                            $cekstatus  = backsiswacode::cekmaterisiswa($_SESSION['user'], $_GET['i'], $link);
                            
                            if($cekstatus == 'true'){
            ?>
            <div class="class">
                <label class="clues">Upload file tugas dalam bentuk <strong>.zip</strong> dengan nama file nama_jenismateri_submateri (contoh: ibnu_class_carakerjaaplikasiwebberbasisserver.zip)</label>
                <label class="clues">Klik tombol <strong>Upload File Jawaban Latihan</strong>, lalu Klik OK</label>
                <form name="formup" id="formup" method="post" action="index.php?p=fupmateri" enctype="multipart/form-data">
                    <input type="hidden" name="index" value="<?php echo $data['idmateri']; ?>">
                    <input type="hidden" name="submateri" value="<?php echo $data['submateri']; ?>">
                    <input type="hidden" name="category" value="<?php echo $_GET['c']; ?>">
                    <input type="hidden" name="user" value="<?php echo $_SESSION['user']; ?>">
                    <input type="hidden" name="tipe" value="<?php echo $link; ?>">
                    <input type="file" name="uptugas" id="uptugas" class="custom-file-input" value="">
                    <div class="form-reg finish">
                        <input type="submit" name="finish_reg" value="OK" class="btn btn-default act">
                    </div>
                    <hr>
                </form>
            </div>
            <?php
                            }
            ?>
            
            <div class="form-reg modul-siswa">
                <?php
                    if($data['kategori'] == 'class'){
                ?>
                <a href="index.php?p=me&sm=<?php echo $data['submateri']; ?>&cm=lab" class="btn btn-default">Lanjut Ke Praktik</a>
                <?php
                    } else if($data['kategori'] == 'lab') {
                ?>
                <a href="index.php?p=me&sm=<?php echo $data['submateri']; ?>&cm=class" class="btn btn-default">Kembali ke Teori</a>
                <a href="public/js/codiad/index.php?user=<?php echo $_SESSION['user'];?>" class="btn btn-default">Live Compiler</a>
                <?php
                    }
                ?>
                <button id="print" class="btn btn-default">Download Materi</button>
                <input type="hidden" id="materitype" value="<?php echo $data['submateri'].'-'.$mc; ?>">
                <a href="#" type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-default">Komentar</a>
            </div>
            
            <!-- Comment Modal Dialog -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title" id="exampleModalLabel">Data Komentar</h4>
                        </div>
                        <form name="formkomentar" id="formkomentar" method="post" action="index.php?p=comment" role="form" class="form-group form-comment">
                            <p class="judul-materi">Merasa kesulitan? Isi form dibawah ini untuk bertanya pada guru.</p>
                            <input type="hidden" name="smateri" value="<?php echo $data['submateri']; ?>">
                            <input type="hidden" name="kmateri" value="<?php echo $data['kategori']; ?>">
                            <input type="hidden" name="umateri" value="<?php echo $_SESSION['user']; ?>">
                            <input type="hidden" name="imateri" value="<?php echo $data['idkonten']; ?>">
                            <label for="subjek" class="control-label">Subjek</label>
                            <input type="text" name="subjek" id="subjek" value="" class="form-control" required>
                            <label for="komentar" class="control-label">Komentar</label>
                            <textarea id="komentar" name="komentar" class="form-control" required></textarea>
                            <label class="control-label" id="captchaOperation"></label>
                            <input type="text" class="form-control" name="captcha" />
                            <label class="clues">Masukkan jawaban pada field diatas untuk membuktikan anda bukan robot.</label>
                            <div class="form-reg modul-siswa">
                                <input type="submit" name="kirim" value="Kirim" class="btn btn-default">
                            </div>
                        </form>
                        <?php
                                        $getclasscomm   = backsiswacode::studentclass($_SESSION['user']);
                                        $viewclasscomm  = backsiswacode::classcomm($getclasscomm);
                                        $index  = "";
                                        $index2 = "";
                                        $guru   = "";
                                        $siswa  = "";
                                        $viewcomm   = backsiswacode::comment($data['idkonten']);
                            
                                        if($viewclasscomm<>''){
                                            if($viewcomm<>''){
                                                foreach($viewclasscomm as $vcc){
                                                        
                                                        //seleksi guru
                                                        if($vcc['id_guru'] == $index){
                                                            $guru = '';
                                                        }else{
                                                            $guru = $vcc['id_guru'];
                                                        }
                                                        
                                                        //seleksi siswa
                                                        if($vcc['id_siswa'] == $index2){
                                                            $siswa = '';
                                                        }else{
                                                            $siswa = $vcc['id_siswa'];
                                                        }
                                                        
                                                    foreach($viewcomm as $vc){
                                                        if($vc['user'] == $guru or $vc['user'] == $siswa){
                                                            $namaguru   = backsiswacode::commguru($vc['user']);
                                                            $namasiswa  = backsiswacode::commsiswa($vc['user']);
                                                            $userkomen  = "";
                                                            if($namaguru<>''){
                                                                $userkomen = $namaguru;
                                                            } else if($namasiswa<>'') {
                                                                $userkomen = $namasiswa;
                                                            } else {
                                                                $userkomen = 'User tidak ditemukan';
                                                            }
                        ?>
                        <div class="comment-list">
                            <p><?php echo $vc['id_komen']; ?></p>
                            <p><?php echo $vc['tanggal']; ?> <?php echo $vc['jam']; ?></p>
                            <p>Subject : <?php echo $vc['subyek']; ?></p>
                            <p><?php echo $userkomen; ?> <i>mengatakan</i> :</p>
                            <p><?php echo $vc['deskkomen']; ?></p>
                        </div>
                        <?php
                                                        }
                                                    }
                                                    $index  = $vcc['id_guru'];
                                                    $index2 = $vcc['id_siswa'];
                                                }
                                            }else{
                                                echo 'Komentar kosong';
                                            }
                                        }else{
                                            echo 'Kelas user tidak ditemukan';
                                        }

                                    }
                                }
                            } else {
                        ?>
                        <div class="row materi-msg">
                            <div class="item-reg text-center">
                                    <label class="label label-danger" style="color:white;">Materi tidak ditemukan</label>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>