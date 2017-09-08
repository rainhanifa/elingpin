<section class="form-reg">
    <div class="container">
        <div class="row reg-heading">
            <h1 class="text-center">Laporan Hasil Belajar Siswa</h1>
            <br>
        </div>
    </div>
    <div class="container">
        <div class="row rapor">
            <div class="table-responsive">
                <table border="1" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Materi</th>
                            <th>Submateri</th>
                            <th>Nilai Teori</th>
                            <th>Keterangan</th>
                            <th>Nilai Praktek</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>

<?php
    if($showrapor<>''){
        if(is_array($showrapor)){
            foreach($showrapor as $data){
?>
                    <tbody>
                        <tr>
                            <td rowspan="<?php echo $num; ?>"><?php echo $data['materi'];?></td>
                            <td><?php echo $data['submateri'];?></td>
<?php

                $nteori     = 0;
                $kteori     = "";
                $nprakt     = 0;
                $kprakt     = "";
                
                $conn       = backsiswacode::koneksi();
                $query      = "SELECT * FROM rapor WHERE hasil = '$data[idhasil]'";
                $sql        = mysqli_query($conn, $query) or die (mysqli_error());
                $data2      = mysqli_fetch_array($sql, MYSQLI_ASSOC);

                if($data['classdir']<>''){
                     if($data2['nclass']<>''){
                         $nteori = $data2['nclass'];
                         if($data2['kclass'] == 'L'){
                            $kteori = "Lulus";
                         } else {
                            $kteori = "Remedial";
                         }
                     } else {
                         $nteori = 0;
                         $kteori = "belum dinilai";
                     }
                } else if($data['classdir'] == ""){
                    $nteori     = 0;
                    $kteori     = "belum selesai";
                } else {
                    $nteori     = 0;
                    $kteori     = "";
                }

                if($data['labdir']<>''){
                     if($data2['nlab']<>''){
                         $nprakt = $data2['nlab'];
                         if($data2['klab'] == 'L'){
                            $kprakt = "Lulus";
                         } else {
                            $kprakt = "Remedial";
                         }
                     } else {
                         $nprakt = 0;
                         $kprakt = "belum dinilai";
                     }
                } else if($data['labdir'] == ""){
                    $nprakt     = 0;
                    $kprakt     = "belum selesai";
                } else {
                    $nprakt     = 0;
                    $kprakt     = "";
                }
?>
                            <td><?php echo $nteori; ?></td>
                            <td><?php echo $kteori; ?></td>
                            <td><?php echo $nprakt; ?></td>
                            <td><?php echo $kprakt; ?></td>
<?php
?>
                        </tr>
                    </tbody>
<?php
            }
        }
    }
?>
                </table>
            </div>
        </div>
    </div>
</div>
</section>