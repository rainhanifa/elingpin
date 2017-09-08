<section class="student-home">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12 left-content">
                <h3>Petunjuk</h3>
                <ol>
                    <li>Berdo’alah sebelum mengerjakan perintah kerja pada materi.</li>
                    <li>Bacalah perintah kerja yang ada pada materi dengan seksama.</li>
                    <li>Kerjakan latihan pada materi secara individu.</li>
                    <li>Tanyakan kepada guru jika ada hal yang tidak dimengerti melalui kolom komentar yang tersedia pada masing-masing materi.</li>
                    <li>Sebelum menyelesaikan suatu materi/submateri, siswa <strong>tidak dapat belajar</strong> materi/submateri selanjutnya.</li>
                    <li>Setiap selesai mengerjakan tugas pada materi lab activity, <strong>upload</strong> program &amp; laporan dalam bentuk file .rar </li>
                    <li>Khusus untuk tugas lab activity bisa menggunakan live compiler yang tersedia pada materi.</li>
                    <li>Suatu submateri dianggap selesai jika siswa <strong>telah mendapatkan nilai</strong> class dan lab activity memenuhi Kriteria Ketuntasan Minimal (75).</li>
                    <li>Progress akan bertambah apabila submateri yang telah dikerjakan (class dan lab) memenuhi KKM.</li>
                </ol>
                <hr>
                <?php
                    $getmateri  = "";
                    $user       = "";
                    $jumsub     = 0;
                    $linknext1  = "";
                    $linknext2  = "";
                    $category   = "";
                    if($showhasil<>''){
                        foreach($showhasil as $data){
                            $getmateri = $data['materi'];
                            $user   = $data['nama'];
                            $nilai  = backsiswacode::statusmateri($data['idhasil']);
                            $kclass = "";
                            if($nilai['nclass']>=75){
                                $kclass = "L";
                            } else {
                                $kclass = "B";
                            }
                            
                            $klab = "";
                            if($nilai['nlab']>=75){
                                $klab = "L";
                            } else {
                                $klab = "B";
                            }
                            
                            if($kclass == 'L' and $klab == 'L'){
                                $jumsub++;
                                $category = "class";
                            } else {
                                if($data['classdir']<>''){
                                    if($nilai['nclass']>=75){
                                        $linknext1 = "";
                                        $category = "lab";
                                    } else {
                                        $category = "class";
                                    }
                                } else {
                                    $category = "class";
                                }
                                $linknext1  = $data['submateri'];
                            }
                        }
                        
                        if($getmateri<>'' and $user<>''){
                            $materi_blm = backsiswacode::materibelum($getmateri, $user);
                            if($materi_blm<>''){
                                foreach($materi_blm as $data2){
                                    $linknext2 = $data2['submateri'];
                                }
                            } else {
                                $materi_next = backsiswacode::materilanjut($user);
                                if($materi_next<>''){
                                    $linknext2 = $materi_next;
                                }else{
                                    echo "Pembelajaran telah usai, terimakasih atas partisipasi anda";
                                }
                            }
                        } else {
                            echo "materi / nama kosong";
                        }
                    } else {
                        $linknext2 = backsiswacode::getfirstmateri();
                        $category = "class";
                        echo "Data materi selesai kosong";
                    }
                    
                    //Progress
                    $hasilprogress = backsiswacode::setprogress($jumsub);
                ?>
                <h6>Progress</h6>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $hasilprogress; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $hasilprogress; ?>%;">
                        <?php echo $hasilprogress; ?>&#37;
                    </div>
                </div>
                <?php
                    $nextmateri = "";
                    if($linknext1<>''){
                        $nextmateri = $linknext1;
                    } else {
                        $nextmateri = $linknext2;
                    }
                    
                    $linkfornav = "index.php?p=me&sm=" . $nextmateri . "&cm=" . $category;
                    $_SESSION['nowmateri'] = "index.php?p=me&sm=" . $nextmateri . "&cm=" . $category;
                ?>
                <div class="form-reg">
                    <a href="index.php?p=me&sm=<?php echo $nextmateri; ?>&cm=<?php echo $category; ?>" class="btn btn-default">Lanjutkan</a>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 right-content">
                <div class="header-listmateri text-center">
                    <h6>Daftar Materi</h6>
                </div>
                <div class="body-listmateri">
                   
                       <?php
                            $daftarmateri = backsiswacode::listmateri();
                            if($daftarmateri<>''){
                                foreach($daftarmateri as $dmateri){
                                    $materistat = backsiswacode::jumlahmateri($dmateri['materi'], $user);
                                    if($materistat<>0){
                                        $submateristat = backsiswacode::jumsubmateri($dmateri['materi']);
                                        if($materistat == $submateristat){
                       ?>
                       <ul class="detail-listmateri">
                           <!-- Mengecek materi apakah materi tersebut sedang dalam pengerjaan atau tidak -->
                           <li>
                               <p><?php echo $dmateri['materi']; ?></p>
                               <ul>
                                <?php
                                        $submdmateri   = backsiswacode::listsubmateri($dmateri['materi']);
                                            if($submdmateri<>''){
                                                foreach($submdmateri as $dtadmateri){
                                ?>
                                    <li><?php echo $dtadmateri['submateri']; ?></li>
                                <?php
                                                }
                                            }
                                    ?>
                               </ul>
                           </li>
                       </ul>
                       <?php
                                        } else {
                       ?>
                        <ul class="detail-listmateri">
                            <!-- Materi selanjutnya -->
                            <li>
                                <p><a href="index.php?p=me&sm=<?php echo $nextmateri; ?>&cm=<?php echo $category; ?>"><?php echo $dmateri['materi']; ?></a></p>
                            </li>
                            <?php
                                            $gethasil   = backsiswacode::setmateri($_SESSION['user']);
                                            $dptmateri  = "";
                                            $userhasil  = "";
                                            if($gethasil<>''){
                                                foreach($gethasil as $datahasil){
                                                    $dptmateri  = $datahasil['materi'];
                                                    $userhasil  = $datahasil['nama'];
                                                    $getnilai  = backsiswacode::statusmateri($datahasil['idhasil']);
                            ?>
                            <?php
                                                    if($getnilai['nclass']>=75 and $getnilai['nlab']>=75){
                           ?>
                            <!-- Materi yang sudah selesai -->
                                <ul>
                                    <li class="finish">
                                        <p>
                                            <a href="index.php?p=me&sm=<?php echo $datahasil['submateri']; ?>&cm=class">
                                                <?php echo $datahasil['submateri']; ?>
                                            </a>
                                        </p>
                                        <span class="check"></span> 
                                    </li>
                                </ul>
                        <?php
                                                    } else {
                                                        $mk = "";
                                                        if($datahasil['classdir']<>''){
                                                            if($getnilai['nclass']>=75){
                                                                $mk = "lab";
                                                            } else {
                                                                $mk = "class";
                                                            }
                                                        } else {
                                                            $mk = "class";
                                                        }
                        ?>
                            <!-- Materi yang sedang dalam proses pengerjaan dimana salah satu sudah selesai dikerjakan -->    
                                    <li class="active">
                                        <p>
                                            <a href="index.php?p=me&sm=<?php echo $datahasil['submateri']; ?>&cm=<?php echo $mk; ?>">
                                                <?php echo $datahasil['submateri']; ?>
                                            </a>
                                        </p>
                                        <span class="time"></span>
                                    </li>
                        <?php
                                                    }
                                                }
                                            }
                                            
                                            if($dptmateri<>'' and $userhasil<>''){
                                                $bmateri = backsiswacode::materibelum($dptmateri, $userhasil);
                                                if($materi_blm<>''){
                                                    foreach($bmateri as $databmateri){
                        ?>
                            <!-- Materi yang belum sama sekali dikerjakan -->
                                <ul>
                                    <li class="notfinish"><p><?php echo $databmateri['submateri'];?></p></li>
                                </ul>
                        <?php
                                                    }
                                                } else {
                                                    echo "Data materi belum selesai kosong";
                                                }
                                            } else {
                                                echo "materi / nama kosong";
                                            }                     
                       ?>
                        </ul>
                       <?php
                                        }
                                    } else {
                       ?>
                        <ul class="detail-listmateri">
                            
                            <li>
                                <p><?php echo $dmateri['materi']; ?></p>
                                <ul>
                            <?php
                                $subdmateri   = backsiswacode::listsubmateri($dmateri['materi']);
                                if($subdmateri<>''){
                                    foreach($subdmateri as $datadmateri){
                                        $smselesai   = backsiswacode::materiselesai($dmateri['materi'], $user);
                                        if($smselesai == 'finish'){
                        ?>
                            <!-- Semua submateri selesai -->
                            <li>
                                <p>
                                    <a href="index.php?p=me&sm=<?php echo $datadmateri['submateri']; ?>&cm=class">
                                        <?php echo $datadmateri['submateri']; ?>
                                    </a>
                                </p>
                                <span class="check"></span>
                            </li>
                        <?php
                                        }else{
                        ?>
                            <!-- Semua submateri selesai -->
                            <li><?php echo $datadmateri['submateri']; ?></li>
                        <?php
                                        }
                                    }
                                }
                            ?>
                                </ul>
                            </li>
                        </ul>
                       <?php                
                                    }
                                }
                            } else {
                       ?>
                        <ul class="detail-listmateri">
                            <!-- Materi belum dibuat -->
                            <li>
                                <p><label class="label label-danger">Data materi belum ada/tidak ditemukan</label></p>
                            </li>
                        </ul>
                       <?php
                            }
                       ?> 
                </div>
            </div>
        </div>
    </div>
</section>