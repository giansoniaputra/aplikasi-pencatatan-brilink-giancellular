
<?php 
include 'session.php';
include '../function.php';
$query = query("SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC");

?>

<?php include 'tamplate/header.php'; ?>

     <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                    
                        <div class="row">

                            <div class="col-xl-4 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Cetak Laporan Manual</h3>
                                        <h4>Sesuai Tanggal Transaksi</h4>
                                        <hr>
                                            <form action="laporan-mnl-trx.php" method="post">
                                                <div class="mb-3">
                                                    <label for="position" class="form-label">Jenis Laporan</label>
                                                    <select class="form-control" data-toggle="select2" data-width="100%" name="jenis_transaksi" id="jenis_transaksi" style="width: 50%;"> 
                                                        <option value="TRANSAKSI">TRANSAKSI</option>
                                                        <option value="PIUTANG">PIUTANG</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Tanggal Awal</label>
                                                    <input type="date" class="form-control" name="tanggal_awal" style="width: 50%;" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Tanggal Akhir</label>
                                                    <input type="date" class="form-control" name="tanggal_akhir" style="width: 50%;" required>
                                                </div>

                                                <button type="submit" class="btn btn-success waves-effect waves-light" name="submit">Cetak</button>
                                            </form>    
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Cetak Laporan Manual</h3>
                                        <h4>Sesuai Nama Pelanggan</h4>
                                        <hr>
                                            <form action="laporan-mnl-plg-trx.php" method="post">
                                                <div class="mb-3">
                                                    <label for="position" class="form-label">Jenis Laporan</label>
                                                    <select class="form-control" data-toggle="select2" data-width="100%" name="jenis_transaksi" id="jenis_transaksi" style="width: 50%;"> 
                                                        <option value="TRANSAKSI">TRANSAKSI</option>
                                                        <option value="PIUTANG">PIUTANG</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <select class="form-control" data-toggle="select2" data-width="100%" name="nama" id="jenis_transaksi" style="width:50%" required>
                                                        <option value="">Pilih Nama Pelanggan</option>
                                                        <?php foreach( $query as $row ) : ?>
                                                            <option value="<?= $row["nama_pelanggan"]; ?>">
                                                            <?= $row["nama_pelanggan"]; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-success waves-effect waves-light" name="submit">Cetak</button>
                                            </form>    
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4     col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                    <h3>Cetak Laporan Otomatis</h3>
                                    <h4>Rakapitulasi Bulan Ini</h4>
                                        <hr>
                                        <div class="mt-3 mt-md-0">
                                            <!--  Laporan Transaksi  -->  
                                            <h5>Laporan Transaksi</h5>
                                            <a href="laporan-trx-day.php"><button type="button" class="btn btn-success  width-md waves-effect waves-light">Hari Ini</button></a>
                                            <a href="laporan-trx-month.php"><button type="button" class="btn btn-success width-md waves-effect waves-light">Bulan Ini</button></a>
                                            <br><br>

                                            <!--  Laporan Piutang  -->  
                                            <h5>Laporan Piutang</h5>
                                            <a href="laporan-ptg-day.php"><button type="button" class="btn btn-success  width-md waves-effect waves-light">Hari Ini</button></a>
                                            <a href="laporan-ptg-month.php"><button type="button" class="btn btn-success width-md waves-effect waves-light">Bulan Ini</button></a>
                                            
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div> <!-- end row --> 

<?php include 'tamplate/footer.php' ?>


<?php include 'tamplate/left-sidebar.php'; ?>