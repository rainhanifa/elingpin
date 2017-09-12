<section class="materi-siswa">
    <div class="container">
        <div class="row">
            <?php
                if($dataclass<>''){
                    if(is_array($dataclass)){
                        foreach($dataclass as $data){
                            $materi     = $data['materi'];
                            $title      = backgurucode::showmateri($materi);
            ?>
            <div id="printpdf">
                <h2 class="text-center" id="activity">Class Activity</h1>
                <h3 class="text-center"><?php echo $title['materi']; ?></h3>
                <h4 class="text-center" id="submateri"><?php echo $title['submateri']; ?></h4>
                <div class="form-reg">

                    <?php
                        $konten = substr($data['konten'],0,4);
                        $filename = "http://localhost/elingpin/materi".$data['konten'];
                        if($konten == "/pdf"){       
                            ?>
                            <iframe src="http://localhost/elingpin/public/js/pdfjs/web/viewer.html?file=<?php echo $filename?>#zoom=page-auto"></iframe>
                            <?php
                        }
                        else if($konten == "/vid"){
                            //$filename =  realpath(dirname(__DIR__)."/../../materi".$data['konten']);
                            ?>
                             <video width="320" height="240" controls src="<?php echo $filename?>">
                                Browser Anda tidak mendukung Video Player HTML5.
                                </video> 
                            <?php
                        }
                        else {
                            echo $data['konten'];
                        }?>
                    
                </div>
            </div>
            <div class="form-reg modul-siswa">
                <a href="index.php?p=fkm&i=<?php echo $data['idkonten']; ?>" class="btn btn-default action">Ubah Materi</a>
<!--                <button id="print" class="btn btn-default">Download Materi</button>-->
<!--                <a href="viewguru/pdfmateri.php" class="btn btn-default">Download Materi</a>-->
                <a href="<?php echo($konten == "/pdf" || $konten == "/vid") ? $filename : 'viewguru/downpdf.php?nm='.$_GET['i']; ?>"  class="btn btn-default">Download Materi</a>
                <input type="hidden" id="materitype" value="<?php echo $title['submateri'].'-class'; ?>">
            </div>
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Pedoman Penilaian</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Download Jawaban Latihan</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <h3 class="text-center">Instrumen Penilaian</h1>
                        <h4 class="text-center">Pemrograman Web Dinamis</h1>
                        <p>Petunjuk :</p>
                        <ol>
                            <li>Buatlah format penilaian ini pada Document Editor.</li>
                            <li>Isikan sesuai dengan data yang ada.</li>
                            <li>Hitunglah nilai total yang dihasilkan dari tiap item aspek penilaian sesuai dengan prosedur penilaian.</li>
                            <li>Masukkan identitas siswa, tabel penilaian, dan total nilai pada saat pengisian data <strong>Rapor</strong> sebagai bahan evaluasi siswa.</li>
                        </ol>
                        <p>Nama : Alfian</p>
                        <p>Kelas : X RPL A</p>
                        <p>Nomor Absen : 1</p>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Soal</th>
                                        <th>Nilai</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1.</td>
                                        <td>Deskripsi soal</td>
                                        <td class="text-center">...</td>
                                        <td class="text-center">...</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2.</td>
                                        <td>Deskripsi soal</td>
                                        <td class="text-center">...</td>
                                        <td class="text-center">...</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Total Nilai</td>
                                        <td colspan="2">0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p>Prosedur Penilaian :</p>
                        <ol>
                            <li>Kolom soal berisi deskripsi soal yang ada pada masing-masing materi.</li>
                            <li>Kolom nilai berisi bobot nilai pada masing-masing item soal.</li>
                            <li>Rentang Bobot nilai yang dimasukkan adalah 0 - 100 (kelipatan 5).</li>
                            <li>Bobot nilai bisa berbeda-beda bergantung pada item soal.</li>
                            <li>Kolom keterangan berisi hal-hal yang perlu diperhatikan oleh siswa pada item soal tersebut.</li>
                            <li>Total nilai didapatkan dari jumlah keseluruhan nilai pada item soal.</li>
                            <li>Kriteria Ketuntasan Minimum (KKM) adalah 75.</li>
                        </ol>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <div class="siswa-selesai" id="downsiswa">
                            <span class="judul-materi">Daftar Nama Siswa yang Sudah Menyelesaikan Modul Ini:</span>
                            <label class="clues">(Klik pada nama untuk download)</label>
                            <?php
                                $kelas      = backgurucode::kelas($_SESSION['user']);
                                $finish     = backgurucode::dtraporsiswa($title['idmateri'], $kelas);
                                $nofin      = 1;
                                if($finish<>''){
                                    foreach($finish as $siswa){
                                        if($siswa['classdir']<>''){
                            ?>
                            <p>
                                <label class="label label-info"><?php echo $nofin; ?></label> 
                                <a href="http://localhost:8080/elprowinmvc.com/epsettings/siswa/<?php echo $siswa['classdir']; ?>" id="<?php echo $nofin; ?>" onclick="getname(<?php echo $nofin; ?>)"><?php $download_nama  = $siswa['nama_siswa']; echo $download_nama; ?></a>
                            </p>
                            <?php
                                        } else {
                                            echo 'Komentar Kosong';
                                        }
                                        $nofin++;
                                    }
                                } else {
                                    ?>
                                    <p>
                                        <label class="label label-danger">Belum ada siswa</label>
                                    </p>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-reg modul-siswa">
                <a href="#" type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-default">Komentar Disini</a>
            </div>
            
            <!-- Modal Dialog -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title" id="exampleModalLabel">Komentar</h4>
                        </div>
                        <form name="formkomentar" id="formkomentar" method="post" action="index.php?p=comm" role="form" class="form-group form-comment">
                            <p class="judul-materi">Berikan tanggapan untuk komentar siswa pada materi ini!</p>
                            <input type="hidden" name="kategori" id="kategori" value="cm">
                            <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['user']; ?>">
                            <input type="hidden" name="materi" id="materi" value="<?php echo $data['idkonten']; ?>">
                            <label for="subjek" class="control-label">Subjek</label>
                            <input type="text" name="subjek" id="subjek" value="" class="form-control">
                            <label for="komentar" class="control-label">Komentar</label>
                            <textarea id="komentar" name="komentar" class="form-control"></textarea>
                            <label class="control-label" id="captchaOperation"></label>
                            <input type="text" class="form-control" name="captcha"/>
                            <input type="submit" name="kirim" value="Kirim" class="btn btn-default action send">
                        </form>
                        <?php
                                        $selectclass    = backgurucode::commkelas($kelas);
                                        $userguru       = "";
                                        $usersiswa      = "";
                                        $index          = "";
                                        $index2         = "";
                                        $namasiswa      = "";
                                        $namaguru       = "";
                                        $user           = "";
                                        $selectcomm     = backgurucode::commguru($data['idkonten']);
                                        if($selectclass <> ''){
                                            if($selectcomm <> ''){
                                                foreach($selectclass as $datasc){
                                                    
                                                    //seleksi data guru
                                                    if($datasc['id_guru'] == $index){
                                                        $userguru   = '';
                                                    }else{
                                                        $userguru   = $datasc['id_guru'];
                                                    }
                                                    
                                                    //seleksi data siswa
                                                    if($datasc['id_siswa'] == $index2){
                                                        $usersiswa  = '';
                                                    }else{
                                                        $usersiswa  = $datasc['id_siswa'];
                                                    }
                                                    
                                                    foreach($selectcomm as $dataso){
                                                        if($dataso['user'] == $userguru or $dataso['user'] == $usersiswa){
                                                            $namaguru   = backgurucode::datacommguru($userguru);
                                                            $namasiswa  = backgurucode::datacommsiswa($usersiswa);
                                                            if($namaguru<>''){
                                                                $user   = $namaguru;
                                                            }else if($namasiswa<>''){
                                                                $user   = $namasiswa;
                                                            }else{
                                                                $user   = "user tidak ditemukan";
                                                            }
                        ?>
                        <div class="comment-list">
                            <p><?php echo $dataso['tanggal']; ?> <?php echo $dataso['jam']; ?></p>
                            <p>Subject : <?php echo $dataso['subyek']; ?></p>
                            <p><?php echo $user; ?> <i>mengatakan</i> :</p>
                            <p><?php echo $dataso['deskkomen']; ?></p>
                        </div>
                        <?php
                                                        }else{
                                                            $namauser   = "nama kosong";
                                                        }
                                                    }
                                                
                                                    $index  = $datasc['id_guru'];
                                                    $index2 = $datasc['id_siswa'];
                                                }
                                            }else{
                                                echo "Komentar kosong";
                                            }
                                        }else{
                                            echo "User kosong";
                                        }
                                    }
                                }
                            } else {
                                ?>
                                <label class="label label-danger">Data tidak ditemukan</label>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>