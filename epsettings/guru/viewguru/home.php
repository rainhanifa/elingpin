<div class="container">
    <div class="row reg-heading">
        <h1 class="text-center">Petunjuk</h1>
    </div>
</div>

<section class="form-cari">
    <div class="container">
        <div class="row">
            <ol>
                <li>Lakukan pengecekan setiap satu minggu sekali pada progress belajar siswa.</li>
                <li>Segera tanggapi pertanyaan atau pernyataan siswa yang ada pada kolom komentar pada masing-masing modul.</li>
                <li>Download hasil pengerjaan tugas siswa pada masing-masing modul.</li>
                <li>Perhatikan pedoman penilaian dalam melakukan proses penilaian.</li>
                <li>Pedoman penilaian tersedia pada masing-masing modul.</li>
            </ol>
        </div>
        <hr>
    </div>
</section>

<section>
    <div class="container">
        <div class="row reg-heading">
            <?php 
                $kelas  = backgurucode::kelas($user);
                if($kelas == 'xirpla'){
                    $guru_kelas = 'XI RPL A';
                } else if($kelas == 'xirplb'){
                    $guru_kelas = 'XI RPL B';
                } else if($kelas == 'xirplc'){
                    $guru_kelas = 'XI RPL C';
                } else {
                    $guru_kelas = '';
                }
            ?>
            <h1 class="text-center">Data Progress Belajar <!-- Siswa Kelas <?php echo $guru_kelas;?> --></h1>
        </div>
        <div class="row form-cari">
            <form name="cari_siswa" id="cari_siswa" method="post" action="index.php?p=carisiswa" role="form" class="form-group">
                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
                    <select name="type" form="cari_siswa" class="form-control">
                        <option value="">--- Kategori Pencarian ---</option>
                        <option value="nama_siswa">Nama</option>
                        <option value="materi">Materi</option>
                        <option value="no_absen">No. Absen</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
                    <input type="text" name="searchid" value="" placeholder="Kata Kunci Pencarian" class="form-control">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                    <input type="submit" value="Cari" class="btn btn-default action">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                    <a href="index.php?p=beranda" class="btn btn-default action">Tampilkan Semua</a>
                </div>
            </form>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <?php
//            $url_siswa = "http://localhost:8080/elingpin/epsettings/siswa/";
            $url_siswa = "http://".$_SERVER["HTTP_HOST"]."/elingpin/epsettings/siswa/";
            if($daftarsiswa<>''){
                if(is_array($daftarsiswa)){
                    foreach($daftarsiswa as $data){
        ?>        
        <div id="box-6" class="box">
            <div class="progress-box">
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
                        <div class="img-box">
                            <img src="<?php echo $url_siswa.$data['url_foto']; ?>" alt="Foto Profil Siswa" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12">
                        <p>
                            Nama : <?php echo $data['nama_siswa']; ?> <br>
                            Materi yang dipelajari:
                        </p>
                        <?php
                            $listmateri = backgurucode::siswaselesai($data['id_siswa']); 
                            if($listmateri<>''){
                        ?>
                        <ol>
                        <?php
                                foreach($listmateri as $datamateri){
                                    $keterangan = "";
                                    if($datamateri['classdir']<>'' and $datamateri['labdir']<>''){
                                        $keterangan = "Tugas Lengkap";
                                    } else if ($datamateri['classdir']<>'' and $datamateri['labdir']==''){
                                        $keterangan = "Tugas Lab Activity belum selesai";
                                    } else if ($datamateri['classdir']=='' and $datamateri['labdir']<>''){
                                        $keterangan = "Tugas Class Activity belum selesai";
                                    } else {
                                        $keterangan = "Tugas belum lengkap";
                                    }
                        ?>
                            <li><?php echo $datamateri['submateri']." (".$keterangan.")"; ?></li>
                        <?php
                                }
                        ?>
                        </ol>
                        <?php
                            } else {
                        ?>
                        <label class="label label-danger">Siswa belum mengerjakan materi apapun</label>
                        <?php
                            }
                        ?>
                    </div>
                    <span class="scale-caption icon-zoom"><?php echo $data['no_absen']; ?></span>
                    <span class="caption icon-zoom"><?php echo $data['no_absen']; ?></span>
                </div>
            </div>
        </div>
        <?php
                    }
                }
            } else {
                ?>
                    <div class="item-reg">
                        <label class="label label-danger" style="color:white;">Data tidak ditemukan</label>
                    </div>
                <?php
            }
        ?>
    </div>
</section>