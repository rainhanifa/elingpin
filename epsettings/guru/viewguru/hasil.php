<div id="printpdf">
    <section>
        <div class="container">
            <div class="row reg-heading">
                <?php
                    $setkelas   = '';
                    $kelas      = backgurucode::kelas($_SESSION['user']);
                    if($kelas == 'xirpla'){
                        $setkelas   = 'XI RPL A';
                    } else if ($kelas == 'xirplb'){
                        $setkelas   = 'XI RPL B';
                    } else if ($kelas == 'xirplc'){
                        $setkelas   = 'XI RPL C';
                    } else {
                        $setkelas = '';
                    }
                ?>
                <h1 class="text-center">Laporan Hasil Belajar Siswa Kelas <?php echo $setkelas; ?></h1>
            </div>
            <div class="row form-cari">
                <form name="carirapor" id="carirapor" method="post" action="index.php?p=searap" role="form" class="form-group">
                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
                        <select name="catrapor" form="carirapor" class="form-control">
                            <option value="">--- Kategori Pencarian ---</option>
                            <option value="nmr">Nama</option>
                            <option value="mtr">Materi</option>
                            <option value="sbr">Submateri</option>
                            <option value="nlr">Nilai Teori</option>
                            <option value="nlp">Nilai Praktik</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
                        <input type="text" name="sidrapor" value="" placeholder="Kata Kunci Pencarian" class="form-control">
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                        <input type="submit" value="Cari" class="btn btn-default action">
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                        <a href="index.php?p=lap" class="btn btn-default action">Lihat Semua</a>
                    </div>
                </form>
            </div> 
        </div>
    </section>

    <section class="form-reg">
        <div class="container">
            <div class="row rapor">
                <?php    
                    if($showrapor<>''){
                        if(is_array($showrapor)){
                            foreach($showrapor as $data){
                ?>
                <p class="bold">Materi : <?php echo $data['materi']; ?></p>
                <p>Submateri : <?php echo $data['submateri']; ?></p>
                <div class="table-responsive">
                    <table border="1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Nilai Teori</th>
                                <th>Keterangan</th>
                                <th>Nilai Praktikum</th>
                                <th>Keterangan</th>
                                <th class="cellact">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php
                                // Query Data Siswa
                                $dtsiswa    = '';
                                if(isset($_GET['c']) and isset($_GET['k'])){
                                    if($_GET['c'] == 'nlr' || $_GET['c'] == 'nlp' || $_GET['c'] == 'nmr'){
                                        $dtsiswa = backgurucode::searchdtrapor($_GET['c'], $_GET['k'], $data['idmateri'], $kelas);
                                    } else {
                                        $dtsiswa = backgurucode::dtraporsiswa($data['idmateri'], $kelas);
                                    }
                                } else {
                                    $dtsiswa = backgurucode::dtraporsiswa($data['idmateri'], $kelas);
                                }
                                $no = 1;

                                if($dtsiswa<>''){
                                    if(is_array($dtsiswa)){
                                        foreach($dtsiswa as $datasis){
                                            $nsiswa = backgurucode::dtnilaisiswa($datasis['idhasil']);
                ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $datasis['nama_siswa']; ?></td>
                                <td>
                                    <?php
                                        if($datasis['classdir']<>''){
                                            if($nsiswa['nclass']<>''){
                                                echo $nsiswa['nclass'];
                                            } else {
                                                echo '-';
                                            }
                                        } else {
                                            echo '-';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $ket        = '';
                                        if($datasis['classdir']<>''){
                                            if($nsiswa['kclass'] == 'L'){
                                                $ket    = '<label style=color:green>Lulus</label>';
                                            } else if($nsiswa['kclass'] == 'R') {
                                                $ket    = '<label style=color:darkred>Remedial</label>';
                                            } else {
                                                $ket    = '<label style=color:orange>Belum Ada Nilai</label>';
                                            }
                                        } else {
                                            $ket    = 'Belum Selesai';
                                        }

                                        echo $ket;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if($datasis['labdir']<>''){
                                            if($nsiswa['nlab']<>''){
                                                echo $nsiswa['nlab'];
                                            } else {
                                                echo '-';
                                            }
                                        } else {
                                            echo '-';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $ket        = '';
                                        if($datasis['labdir']<>''){
                                            if($nsiswa['klab'] == 'L'){
                                                $ket    = '<label style=color:green>Lulus</label>';
                                            } else if($nsiswa['klab'] == 'R') {
                                                $ket    = '<label style=color:darkred>Remedial</label>';
                                            } else {
                                                $ket    = '<label style=color:orange>Belum Ada Nilai</label>';
                                            }
                                        } else {
                                            $ket    = 'Belum Selesai';
                                        }

                                        echo $ket;
                                    ?>
                                </td>
                                <td class="cellact"><a href="index.php?p=fhasil&i=<?php echo $datasis['idhasil']; ?>">Ubah</a></td>
                            </tr>
                <?php
                                    $no++;
                                        }
                                    }
                                } else {
                ?>
                <div class="row materi-msg">
                    <div class="item-reg text-center">
                            <label class="label label-danger" style="color:white;">Data tidak ditemukan</label>
                    </div>
                </div>
                <?php
                                }

                ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <?php
                            }
                        }
                    } else {
                ?>
                <div class="row materi-msg">
                    <div class="item-reg text-center">
                            <label class="label label-danger" style="color:white;">Data tidak ditemukan</label>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="profil-siswa">
                    <div class="form-reg">
                        <button id="print" class="btn btn-default">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>