<section class="form-reg">
    <div class="container">
        <div class="row reg-heading">
            <h1 class="text-center">Catatan Aktifitas Siswa</h1>
            <br>
        </div>
    </div>
    <div class="container">
        <div class="row rapor">
            <div class="table-responsive">
                <table border="1" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
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
</section>