<section>
    <div class="container">
        <div class="row reg-heading">
            <h1 class="text-center">
                Catatan Aktifitas 
                <?php if(isset($_GET['i'])){ echo '',($_GET['i'] == 'guru'? 'Guru' : 'Siswa'); }else{echo 'Semua User ';} ?>
                Kelas
                <?php 
                        $kelas = backgurucode::kelas($_SESSION['user']); 
                        if($kelas<>''){
                            if($kelas == 'xirpla'){ echo 'XI RPL A';}
                            else if($kelas == 'xirplb'){ echo 'XI RPL B';}
                            else if($kelas == 'xirplc'){ echo 'XI RPL C';}
                        } 
                ?>
            </h1>
        </div>
    </div>
    <div class="container">
        <div class="row form-cari">
            <form name="cari_catat" id="cari_catat" method="post" action="index.php?p=caricatatan" role="form" class="form-group">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <select name="type" form="cari_catat" class="form-control">
                        <option value="">--- Pilih Data ---</option>
                        <option value="guru">Guru</option>
                        <option value="siswa">Siswa</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                    <input type="submit" value="OK" class="btn btn-default action">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                    <a href="index.php?p=noc" class="btn btn-default action">Tampilkan Semua</a>
                </div>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table border="1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <?php
                                    if(isset($_GET['i'])){
                                        if($_GET['i']=='siswa'){
                                ?>
                                            <th>Nama</th>
                                <?php
                                        }
                                    }
                                ?>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Aktifitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if($showlogs<>''){
                                    $no = 1;
                                    foreach($showlogs as $data){
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <?php
                                    if(isset($_GET['i'])){
                                        if($_GET['i']=='siswa'){
                                ?>
                                            <th><?php echo $data['nama_siswa']; ?></th>
                                <?php
                                        }
                                    }
                                ?>
                                <td><?php echo $data['tanggal']; ?></td>
                                <td><?php echo $data['jam']; ?></td>
                                <td><?php echo $data['aktifitas']; ?></td>
                            </tr>
                            <?php
                                        $no++;
                                    }
                                }else{
                            ?>
                            <tr>
                                <td colspan="4">Data Kosong</td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</section>