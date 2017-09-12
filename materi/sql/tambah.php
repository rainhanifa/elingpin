<!DOCTYPE html>
<html>
    <head>
        <title>Teknik penambahan data</title>
        <link rel="stylesheet" type="text/css" href="assets/bootstrap.css">
    </head>
    <body>
        <div class="container">
            <h1>Form Tambah Data Siswa</h1>
            <hr>
            <form name="tambah" action="kodetambah.php" method="post" role="form" class="form-group">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <label class="control-label" for="userid">User ID</label>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12">
                        <input type="text" name="userid" id="userid" value="" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <label class="control-label" for="userid">Nama Siswa</label>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12">
                        <input type="text" name="nama" id="nama" value="" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <label class="control-label" for="userid">Alamat Siswa</label>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12">
                        <textarea name="alamat" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input type="submit" name="btntambah" id="btntambah" class="btn btn-default">
                    </div>
                </div>
            </form>
        </div>
        
        <script src="assets/jquery-1.11.2.js"></script>
        <script src="assets/bootstrap.js"></script>
        <script src="assets/npm.js"></script>
    </body>
</html>