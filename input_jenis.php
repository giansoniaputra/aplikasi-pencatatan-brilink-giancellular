<?php 
include 'auth/session.php';
//query data

require 'function.php';

$jenis = query("SELECT * FROM jenis_transaksi ORDER BY jenis_transaksi ASC");

if (isset($_POST["submit"])) {
	if (tambahJenis($_POST) > 0) {
		echo "
		<script>
			alert('Data Berhasil Ditambahkan')
			document.location.href= 'input_jenis.php'
		</script>
		";
	}else {
		echo "
		<script>
			alert('Data Gagal Ditambahkan')
			document.location.href= 'input_jenis.php'
		</script>
		";
	}
}



?>

<?php include 'tamplate/header-tbl.php'; ?>
            
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Jenis Transaksi</h4>
                                        
                                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                                            <thead>
                                            <tr>
                                                <th>NO.</th>
                                                <th>Jenis Transaksi</th>
                                                <th>Laba</th>
                                                <th>OPSI</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach( $jenis as $row ) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row["jenis_transaksi"]; ?></td>
                                                <td><?= $row["laba"]; ?></td>
                                                <td><a href="edit-jenis.php?id=<?= $row["id"] ?>"><button type="button" class="btn btn-warning waves-effect waves-light"><i class="fe-edit"></i></button></a>
                                                    <a href="hapus-jenis.php?id=<?= $row["id"] ?>"><button type="button" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i></i></button></a>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <div class="mt-3 mt-md-0">
                                            <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#custom-modal"><i class="mdi mdi-plus-circle me-1"></i> Tambah Transaksi </button>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div> <!-- end row -->


                

<?php include 'tamplate/footer.php'; ?>

        <!-- Modal -->
        <div class="modal fade" id="custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title" id="myCenterModalLabel">Add Contact</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Jenis Transaksi</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="jenis_transaksi" required>
                            </div>
                            <div class="mb-3">
                                <label for="example-date" class="form-label">Laba</label>
                                <input class="form-control" id="example-date" type="text" name="laba" required> 
                            </div>
                                <button type="submit" class="btn btn-light waves-effect waves-light" name="submit">Save</button>
                                <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

<?php include 'tamplate/left-sidebar-tbl.php'; ?>