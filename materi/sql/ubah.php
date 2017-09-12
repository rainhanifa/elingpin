<!DOCTYPE html>
<?php
    $id = $_GET['id'];
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
    
?>
<html>
    <head>
        <title>Teknik pengubahan data</title>
        <link rel="stylesheet" type="text/css" href="assets/bootstrap.css">
    </head>
    <body>
        <div class="container">
            <h1>Form Tambah Data Siswa</h1>
            <hr>
            <?php
                $query  = "SELECT * FROM siswa WHERE user_id='$id'";
                $sql    = mysqli_query($conn, $query);
                if($sql){
                    $data = mysqli_fetch_array($sql, MYSQLI_ASSOC);
            ?>
            <form name="tambah" action="kodeubah.php" method="post" role="form" class="form-group">
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <label class="control-label" for="userid">User ID</label>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12">
                        <input type="text" name="userid" id="userid" value="<?php echo $data['user_id'];?>" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <label class="control-label" for="userid">Nama Siswa</label>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12">
                        <input type="text" name="nama" id="nama" value="<?php echo $data['nama'];?>" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <label class="control-label" for="userid">Alamat Siswa</label>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12">
                        <textarea name="alamat" class="form-control" rows="5"><?php echo $data['alamat'];?></textarea>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input type="submit" name="btntambah" id="btntambah" class="btn btn-default">
                    </div>
                </div>
            </form>
            <?php
                }
            ?>
        </div>
        
        <script src="assets/jquery-1.11.2.js"></script>
        <script src="assets/bootstrap.js"></script>
        <script src="assets/npm.js"></script>
    </body>
</html>