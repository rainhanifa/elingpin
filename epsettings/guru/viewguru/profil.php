<div class="container">
    <div class="row">
        <h1 class="reg-heading">Profil Guru</h1>
    </div>
</div>
<?php
    if($profilguru<>''){
        if(is_array($profilguru)){
            foreach($profilguru as $data){
                
?>
<section class="profil-guru">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                <div class="img-profile">
                    <img src="<?php echo $data['url_foto']; ?>" width="198" height="202" alt="Foto Profil Siswa" class="img-responsive">
                </div>
            </div>
            <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                        <label class="profil-head">Nama Pengguna</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                        <span>:</span>
                        <label><?php echo $_SESSION['user'];?></label>
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                        <label class="profil-head">Nama Lengkap</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                        <span>:</span>
                        <label><?php echo $data['nama']; ?></label>
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                        <label class="profil-head">Guru Kelas</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                        <span>:</span>
                        <label>
                            <?php
                                if($data['guru_kelas']=='xirpla'){
                                    echo "XI RPL A";
                                } else if($data['guru_kelas']=='xirplb'){
                                    echo "XI RPL B";
                                } else if($data['guru_kelas']=='xirplc'){
                                    echo "XI RPL C";
                                } else {
                                    echo "";
                                }
                            ?>
                        </label>
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                        <label class="profil-head">NIP</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                        <span>:</span>
                        <label><?php echo $data['nip'];?></label>
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                        <label class="profil-head">Email</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                        <span>:</span>
                        <label><?php echo $data['email']; ?></label>
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <div class="form-reg">
                        <a href="index.php?p=edprofil" class="btn btn-default">Ubah</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
            }
        }
    }
?>