<?php 
require 'function.php';

//ambil data
$id = $_GET['id'];
//query data mahasiswa berdasar ID
$trx = query("SELECT * FROM jenis_transaksi WHERE id = $id")[0];

if (isset($_POST["submit"])) {
	if (editjenis($_POST) > 0) {
		echo "
		<script>
			alert('Data Berhasil Diubah')
			document.location.href= 'input_jenis.php'
		</script>
		";
	}else {
		echo "
		<script>
			alert('Data Gagal Diubah')
			document.location.href= 'input_jenis.php'
		</script>
		";
	}
}


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
                            <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Edit Transaksi</h4>

                                        <form action="" method="post">
                                            <div class="mb-3">
                                                <input type="hidden" name="id" parsley-trigger="change" class="form-control" id="userName" value="<?= $trx["id"]; ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Jenis Transaksi</label>
                                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="jenis_transaksi" value="<?= $trx["jenis_transaksi"]; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-date" class="form-label">Laba</label>
                                                <input class="form-control" id="example-date" type="number" name="laba" value="<?= $trx["laba"]; ?>">
                                            </div>
                                                <button type="submit" class="btn btn-light waves-effect waves-light" name="submit">Save</button>
                                                <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-dismiss="modal">Cancel</button>
                                        </form>
                                    </div>
                                </div> <!-- end card -->
                            </div>
                            <!-- end col -->       
                        
                    </div> <!-- container-fluid -->

                </div> <!-- content -->

 <?php include 'tamplate/footer.php'; ?>


 <?php include 'tamplate/left-sidebar.php'; ?>