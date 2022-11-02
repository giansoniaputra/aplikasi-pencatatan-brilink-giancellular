<?php 
include 'session.php';

//query data

require '../function.php';
    //Rekapitulasi Keseluruhan
    $stat = query("SELECT * FROM saldo INNER JOIN modal ON saldo.id = modal.id");
    $laba = query("SELECT * FROM transaksi");
    //Laba Debit Keselueuhan
    $sql6 = mysqli_query($conn, "SELECT sum(laba) as totlabaall FROM transaksi WHERE status='LUNAS(DEBIT)'");
    $data6 = mysqli_fetch_array($sql6);
    
    $sql2 = mysqli_query($conn, "SELECT sum(hutang) as tothutang FROM transaksi ");
    $data2 = mysqli_fetch_array($sql2);
    //Rekapitulasi Harian
        //Laba Debit Perhari
    $sql = mysqli_query($conn, "SELECT sum(laba) as totlaba FROM transaksi WHERE status='LUNAS(DEBIT)' and tanggal=curdate()");
    $data = mysqli_fetch_array($sql);


    
    





//akhir query data

//Input Modal
if (isset($_POST["submit"])) {
	if (tambahModal($_POST) > 0) {
		echo "
		<script>
			alert('Data Berhasil Ditambahkan')
			document.location.href= 'index.php'
		</script>
		";
	}else {
		echo "
		<script>
			alert('Data Gagal Ditambahkan')
			document.location.href= 'index.php'
		</script>
		";
	}
}

//Akhir Input Modal
  

?>

<?php include 'tamplate/header.php'; ?>

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
         
            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <!--  Rekapitulasi Keseluruhan  -->
                        <br>
                        <div class="row">
                            <div class="mt-3 mt-md-0">
                                <a href="laporan-day.php"><button type="button" class="btn btn-outline-success width-md waves-effect waves-light">Hari Ini</button></a>
                                <a href="laporan-month.php"><button type="button" class="btn btn-outline-success width-md waves-effect waves-light">Bulan Ini</button></a>
                                <a href="laporan-all.php"><button type="button" class="btn btn-success width-md waves-effect waves-light">Semua</button></a>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <h3 class="page-title-main">INFORMASI SALDO & PIUTANG</h3>
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                                            </div>
                                        </div>
    
                                        <h4 class="header-title mt-0 mb-4">Saldo Debit</h4>
                                        <div class="widget-box-2">
                                            <div class="widget-detail-2 text-end">
                                                <span class="badge bg-warning rounded-pill float-start mt-3"><?php foreach( $stat as $row ) : ?><?= round('0'+$row["saldo_d"]/$row["modal"]*'100',2); ?><?php endforeach; ?>% <i class="mdi mdi-trending-up"></i> </span>
                                                <h2 class="fw-normal mb-1"> <?php foreach( $stat as $row ) : ?><?= rupiah('0'+$row["saldo_d"]); ?><?php endforeach; ?> </h2>
                                                <p class="text-muted mb-3">Revenue today</p>
                                            </div>
                                            <div class="progress progress-bar-alt-warning progress-sm">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                        aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: <?php foreach( $stat as $row ) : ?><?= round('0'+$row["saldo_d"]/$row["modal"]*'100',2); ?><?php endforeach; ?>%;">
                                                    <span class="visually-hidden">77% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                                            </div>
                                        </div>
    
                                        <h4 class="header-title mt-0 mb-4">Saldo Kredit</h4>
    
                                        <div class="widget-box-2">
                                            <div class="widget-detail-2 text-end">
                                                <span class="badge bg-success rounded-pill float-start mt-3"><?php foreach( $stat as $row ) : ?><?= round('0'+$row["saldo_k"]/$row["modal"]*'100',2); ?><?php endforeach; ?>% <i class="mdi mdi-trending-up"></i> </span>
                                                <h2 class="fw-normal mb-1"> <?php foreach( $stat as $row ) : ?><?= rupiah('0'+$row["saldo_k"]); ?><?php endforeach; ?> </h2>
                                                <p class="text-muted mb-3">Revenue today</p>
                                            </div>
                                            <div class="progress progress-bar-alt-success progress-sm">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                        aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: <?php foreach( $stat as $row ) : ?><?= round('0'+$row["saldo_k"]/$row["modal"]*'100',2); ?><?php endforeach; ?>%;">
                                                    <span class="visually-hidden">77% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            

                            
                            
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                                            </div>
                                        </div>
    
                                        <h4 class="header-title mt-0 mb-4">Jumlah Saldo</h4>
    
                                        <div class="widget-box-2">
                                            <div class="widget-detail-2 text-end">
                                                <span class="badge bg-success rounded-pill float-start mt-3"><?= round('0'+($row["saldo_d"]+$row["saldo_k"]+$data2["tothutang"])/$row["modal"]*'100',2); ?>% <i class="mdi mdi-trending-up"></i> </span>
                                                <h2 class="fw-normal mb-1"> <?= rupiah('0'+$row["saldo_d"]+$row["saldo_k"]+$data2["tothutang"]); ?> </h2>
                                                <p class="text-muted mb-3">Revenue today</p>
                                            </div>
                                            <div class="progress progress-bar-alt-success progress-sm">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                        aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: <?= round('0'+($row["saldo_d"]+$row["saldo_k"]+$data2["tothutang"])/$row["modal"]*'100',2); ?>%;">
                                                    <span class="visually-hidden">77% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->


                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                                            </div>
                                        </div>
    
                                        <h4 class="header-title mt-0 mb-4">Laba Kredit</h4>
    
                                        <div class="widget-box-2">
                                            <div class="widget-detail-2 text-end">
                                                <span class="badge bg-info rounded-pill float-start mt-3"><?= round('0'+($row["saldo_d"]+$row["saldo_k"]+$data2["tothutang"]-$row["modal"])/($data["totlaba"]+$row["saldo_d"]+$row["saldo_k"]+$data2["tothutang"]-$row["modal"])*(($row["saldo_d"]+$row["saldo_k"]+$data2["tothutang"])/$row["modal"]*'100'-'100'),2); ?>% <i class="mdi mdi-trending-up"></i> </span>
                                                <h2 class="fw-normal mb-1"> <?= rupiah('0'+$row["saldo_d"]+$row["saldo_k"]+$data2["tothutang"]-$row["modal"]); ?> </h2>
                                                <p class="text-muted mb-3">Revenue today</p>
                                            </div>
                                            <div class="progress progress-bar-alt-info progress-sm">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                        aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: <?= round('0'+($row["saldo_d"]+$row["saldo_k"]+$data2["tothutang"]-$row["modal"])/($data["totlaba"]+$row["saldo_d"]+$row["saldo_k"]+$data2["tothutang"]-$row["modal"])*(($row["saldo_d"]+$row["saldo_k"]+$data2["tothutang"])/$row["modal"]*'100'-'100'),2); ?>%;">
                                                    <span class="visually-hidden">77% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            

                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                
                                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                
                                                <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                                
                                                <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                                
                                                <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                                            </div>
                                        </div>
    
                                        <h4 class="header-title mt-0 mb-4">Jumlah Piutang</h4>
    
                                        <div class="widget-box-2">
                                            <div class="widget-detail-2 text-end">
                                                <span class="badge bg-danger rounded-pill float-start mt-3"><i class="fa fa-line-chart"></i><?= round('0'+$data2["tothutang"]/$row["modal"]*'100',2); ?>% <i class="mdi mdi-trending-up"></i> </span>
                                                <h2 class="fw-normal mb-1"> <?= rupiah('0'+$data2["tothutang"]); ?> </h2>
                                                <p class="text-muted mb-3">Revenue today</p>
                                            </div>
                                            <div class="progress progress-bar-alt-danger progress-sm">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                        aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: <?= round('0'+$data2["tothutang"]/$row["modal"]*'100',2); ?>%;">
                                                    <span class="visually-hidden">77% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        
<?php include 'tamplate/footer.php'; ?>

        <!-- Modal -->
        <div class="modal fade" id="custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title" id="myCenterModalLabel">Masukan Modal Awal</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Modal Awal</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter" name="modal">
                            </div>
                                <button type="submit" class="btn btn-light waves-effect waves-light" name="submit">Save</button>
                                <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

<?php include 'tamplate/left-sidebar.php'; ?>