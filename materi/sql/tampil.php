<!DOCTYPE html>
<html>
    <head>
        <title>Teknik Penghapusan Data</title>
        <link rel="stylesheet" type="text/css" href="assets/bootstrap.css">
    </head>
    <body>
        <div class="container">
            <h1>Data Siswa</h1>
            <hr>
            <?php
                //koneksi
                $server = "localhost";
                $user   = "root";
                $pass   = "";
                $dbase  = "latihan_db";

                // create connection
                $conn = mysqli_connect($server, $user, $pass, $dbase);

                // check connection
                if (!$conn){
                    die("Connection failed: " . mysqli_connect_error());
                }
                
                $query  = "SELECT * FROM siswa ORDER BY user_id ASC";
                $sql    = mysqli_query($conn, $query);
                if($sql){
                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <th>No.</th>
                                <th>User ID</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th colspan="2">Aksi</th>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    while($data = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $data['user_id']; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo $data['alamat']; ?></td>
                                    <td><a href="hapus.php?id=<?php echo $data['user_id'];?>">Hapus</a></td>
                                    <td><a href="ubah.php?id=<?php echo $data['user_id'];?>">Ubah</a></td>
                                </tr>
                                <?php
                                        $no++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                } else {
                    ?>
                    <label class="label label-danger">Terjadi kesalahan pada kode SQL!</label>
                    <?php
                }
            ?>
        </div>
        
        <script src="assets/jquery-1.11.2.js"></script>
        <script src="assets/bootstrap.js"></script>
        <script src="assets/npm.js"></script>
    </body>
</html>