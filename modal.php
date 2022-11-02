<?php


//query data

require 'function.php';

$query = query("SELECT * FROM modal WHERE id = '1'");

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
                        <div class="mt-3 mt-md-0">
                            <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#custom-modal"><i class="mdi mdi-plus-circle me-1"></i> Masukan Modal Awal</button><br><br><br>
                        </div>
                          
                        
                        <!--  Rekapitulasi Keseluruhan  -->
                        <div class="row">

                            
                            <h3 class="page-title-main">INFORMASI MODAL</h3>
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
    
                                        <h4 class="header-title mt-0 mb-4">Modal Awal</h4>
                                        <div class="widget-box-2">
                                            <div class="widget-detail-2 text-end">
                                                <span class="badge bg-warning rounded-pill float-start mt-3">100% <i class="mdi mdi-trending-up"></i> </span>
                                                <h2 class="fw-normal mb-1"> <?php foreach( $query as $row ) : ?><?= rupiah('0'+$row["modal"]); ?><?php endforeach; ?> </h2>
                                                <p class="text-muted mb-3">Revenue today</p>
                                            </div>
                                            <div class="progress progress-bar-alt-warning progress-sm">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                        aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 100%;">
                                                    <span class="visually-hidden">77% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            
                        </div>
                        <!-- end row -->
                        
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
                                <input type="number" class="form-control" id="name" placeholder="Enter" name="modal">
                            </div>
                                <button type="submit" class="btn btn-light waves-effect waves-light" name="submit">Save</button>
                                <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

<?php include 'tamplate/left-sidebar.php'; ?>