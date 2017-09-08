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
                <h2 class="text-center" id="activity">Lab Activity</h1>
                <h3 class="text-center"><?php echo $title['materi']; ?></h3>
                <h4 class="text-center" id="submateri"><?php echo $title['submateri']; ?></h4>
                <div class="form-reg"><?php echo $data['konten']; ?></div>
            </div>
            <div class="form-reg modul-siswa">
                <a href="index.php?p=fkm&i=<?php echo $data['idkonten']; ?>" class="btn btn-default action">Ubah Materi</a>
<!--                <button id="print" class="btn btn-default">Download Materi</button>-->
<!--                <a href="viewguru/downpdf.php" class="btn btn-default">Download Materi</a>-->
                <a href="viewguru/downpdf.php?nm=<?php echo $_GET['i']; ?>" class="btn btn-default">Download Materi</a>
                <input type="hidden" id="materitype" value="<?php echo $title['submateri'].'-lab'; ?>">
            </div>
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Pedoman Penilaian</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Download Jawaban Latihan XI RPL A</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <h3 class="text-center">Instrumen Penilaian Praktikum</h1>
                        <h4 class="text-center">Pemrograman Web Dinamis</h1>
                        <p>Petunjuk :</p>
                        <ol>
                            <li>Buatlah format penilaian ini pada Document Editor.</li>
                            <li>Isikan sesuai dengan data yang ada.</li>
                            <li>Berikan tanda centang (√) pada kolom keterangan sesuai dengan aspek yang dinilai.</li>
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
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Aspek Yang Dinilai</th>
                                        <th rowspan="2">Catatan</th>
                                        <th colspan="2">Keterangan</th>
                                    </tr>
                                    <tr>
                                        <th>Ya</td>
                                        <th>Tidak</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1.</td>
                                        <td>Program berjalan dengan baik (tanpa terjadi error)</td>
                                        <td class="text-center">...</td>
                                        <td class="text-center">...</td>
                                        <td class="text-center">...</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2.</td>
                                        <td>Konsep program sesuai dengan perintah penugasan.</td>
                                        <td class="text-center">...</td>
                                        <td class="text-center">...</td>
                                        <td class="text-center">...</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">3.</td>
                                        <td>Keluaran yang dihasilkan program sesuai dengan perintah penugasan.</td>
                                        <td class="text-center">...</td>
                                        <td class="text-center">...</td>
                                        <td class="text-center">...</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">4.</td>
                                        <td>Terdapat kreativitas dalam format tampilan program.</td>
                                        <td class="text-center">...</td>
                                        <td class="text-center">...</td>
                                        <td class="text-center">...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p>Total Nilai : 0</p>
                        <p>Prosedur Penilaian :</p>
                        <ol>
                            <li>Aspek penilaian 1 memiliki total nilai 20, jika program berjalan tanpa kesalahan.</li>
                            <li>Aspek penilaian 2 memiliki total nilai 30, jika konsep program sesuai dengan perintah penugasan.</li>
                            <li>Aspek penilaian 3 memiliki total nilai 30, jika keluaran yang dihasilkan program sesuai dengan perintah penugasan.</li>
                            <li>Aspek penilaian 4 memiliki total nilai 20, jika terdapat kreativitas dalam bentuk format tampilan, validasi inputan, atau hal-hal lain yang berada diluar perintah penugasan namun menjadi fasilitas yang seharusnya ada dalam program.</li>
                            <li>Kriteria Ketuntasan Minimum adalah 75.</li>
                        </ol>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <div class="siswa-selesai">
                            <span class="judul-materi">Daftar Nama Siswa yang Sudah Menyelesaikan Modul Ini</span>
                            <label class="clues">(Klik pada nama untuk download)</label>
                            <?php
                                $kelas      = backgurucode::kelas($_SESSION['user']);
                                $finish     = backgurucode::dtraporsiswa($title['idmateri'], $kelas);
                                $nofin      = 1;
                                if($finish<>''){
                                    foreach($finish as $siswa){
                                        if($siswa['labdir']<>''){
                            ?>
                            <p>
                                <label class="label label-info"><?php echo $nofin; ?></label> 
                                <a href="http://localhost/elprowinmvc.com/epsettings/siswa/<?php echo $siswa['labdir']; ?>" id="<?php echo $nofin; ?>" onclick="getname(<?php echo $nofin; ?>)"><?php echo $siswa['nama_siswa']; ?></a>
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
                                        <label class="label label-danger">Belum ada siswa yang selesai</label>
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
                                        $user       = "";
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