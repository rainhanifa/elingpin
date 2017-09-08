<!DOCTYPE html>
<html>
    <head>
        <title>Teknik penambahan data</title>
        <link rel="stylesheet" type="text/css" href="assets/bootstrap.css">
    </head>
    <body>
        <div class="container">
            <h1>Form Cari Data Siswa</h1>
            <hr>
            <form name="tambah" action="kodecari.php" method="post" role="form" class="form-group">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label class="control-label" for="userid">Pilih kategori dan masukkan data yang akan dicari :</label>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <select name="category" class="form-control">
                            <option value="userid">User ID</option>
                            <option value="nama">Nama</option>
                            <option value="alamat">Alamat</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="keyword" id="keyword" value="" class="form-control">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <input type="submit" name="btntambah" id="btntambah" value="Cari" class="btn btn-default">
                    </div>
                </div>
            </form>
            <hr>
        </div>
        
        <script src="assets/jquery-1.11.2.js"></script>
        <script src="assets/bootstrap.js"></script>
        <script src="assets/npm.js"></script>
    </body>
</html>