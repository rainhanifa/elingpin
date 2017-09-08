<div class="container">
    <div class="row">
        <h1 class="reg-heading">Form Ubah Profil Guru</h1>
    </div>
</div>

<section>
    <div class="container">
        <div class="row reg-heading head2">
            <h3>Petunjuk</h3>
            <ol>
                <li>Isi sesuai dengan data anda.</li>
                <li>Abaikan data yang tersedia pada field jika tidak ingin mengganti.</li>
                <li>Abaikan tombol upload foto jika tidak ingin mengganti foto profil.</li>
                <li>Abaikan field kata kunci dan ulangi kata kunci jika tidak ingin mengganti kata kunci.</li>
                <li>Jika mengganti kata kunci, data antara field kata kunci dengan ulangi kata kunci harus sama.</li>
            </ol>
            
        </div>
    </div>
</section>

<?php
    if($profilguru<>''){
        if(is_array($profilguru)){
            foreach($profilguru as $data){
                
?>
<section class="form-reg">
    <div class="container">
        <form name="formedprofil" class="form-group" id="formedprofil" role="form" action="index.php?p=updprofil" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $data['id_guru'];?>">
            <div class="row item-reg">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <label for="nama" class="control-label">Nama Lengkap</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                    <input type="text" name="nama" class="form-control" id="nama" value="<?php echo $data['nama']; ?>">
                    <label class="clues">Contoh: Ibnu Shodiqin</label>
                </div>
            </div>
            <div class="row item-reg">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <label for="kelas" class="control-label">Guru Kelas</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                    <?php
                        $select_a   = "";
                        $select_b   = "";
                        $select_c   = "";
                
                        if($data['guru_kelas']=='xirpla'){
                            $select_a = "selected";
                        } else if($data['guru_kelas']=='xirplb'){
                            $select_b = "selected";
                        } else if($data['guru_kelas']=='xirplc'){
                            $select_c = "selected";
                        } else {
                            $select_a   = "";
                            $select_b   = "";
                            $select_c   = "";
                        }
                    ?>
                    <select name="kelas" class="form-control">
                        <option value="xirpla" <?php echo $select_a; ?>>XI RPL A</option>
                        <option value="xirplb" <?php echo $select_b; ?>>XI RPL B</option>
                        <option value="xirplc" <?php echo $select_c; ?>>XI RPL C</option>
                    </select>
                    <label class="clues">Pilih sesuai dengan kelas tempat anda mengajar</label>
                </div>
            </div>
            <div class="row item-reg">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <label for="nip" class="control-label">NIP</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                    <input type="text" name="nip" class="form-control" id="nip" value="<?php echo $data['nip'];?>">
                    <label class="clues">Contoh : 19650508 199701 1 0038</label>
                </div>
            </div>
            <div class="row item-reg">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <label for="mail" class="control-label">Email</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                    <input type="email" name="mail" class="form-control" id="mail" value="<?php echo $data['email']; ?>">
                    <label class="clues">Contoh : ibnuspeedster@gmail.com</label>
                </div>
            </div>
            <div class="row item-reg">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <label for="profil" class="control-label">Foto Profil</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12 foto-profil">
                    <div class="pp-edit img-circle">
                        <img src="<?php echo $data['url_foto']; ?>" alt="Foto Profil Guru" class="img-responsive">
                    </div>
                    <input name="profil" type="file" class="custom-file-input">
                    <label class="clues">Foto setengah badan dan wajib menggunakan pakaian rapi</label>
                </div>
            </div>
            <div class="row item-reg">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <label for="kunci" class="control-label">Kata Kunci</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                    <input type="password" name="kunci" class="form-control" id="kunci" value="">
                    <label class="clues">Silahkan masukkan password yang mudah diingat</label>
                </div>
            </div>
            <div class="row item-reg">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <label for="ulangi_kunci" class="control-label">Ulangi Kata Kunci</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                    <input type="password" name="ulangi_kunci" class="form-control" id="ulangi_kunci" value="">
                    <label class="clues">Ulangi pengisian password</label>
                </div>
            </div>
            <div class="col-md-offset-3">
                <input type="submit" name="updateprofil" value="Selesai" class="btn btn-default">
            </div>
        </form>
    </div>
</section>
<?php
            }
        }
    } else {
?>
<div class="container">
    <div class="row materi-msg">
        <div class="item-reg text-center">
                <label class="label label-danger" style="color:white;">Data tidak ditemukan</label>
        </div>
    </div>
</div>
<?php
    }
?>