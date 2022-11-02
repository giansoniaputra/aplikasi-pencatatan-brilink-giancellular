<?php 

require 'function.php';
$id = $_GET['id'];
//query data mahasiswa berdasar ID
$trx = query("SELECT * FROM transaksi WHERE id = $id")[0];

$saldo = query("SELECT * FROM saldo WHERE id = '1'")[0];

$jenis = query("SELECT * FROM jenis_transaksi");

if (isset($_POST["submit"])) {
	if (editkredit($_POST) > 0) {
		echo "
		<script>
			alert('Data Berhasil Diubah')
			document.location.href= 'laporan/laporan-piutang-month.php'
		</script>
		";
	}else {
		echo "
		<script>
			alert('Data Gagal Diubah')
			document.location.href= 'laporan/laporan-piutang-month.php'
		</script>
		";
	}
}

?>
<?php include 'tamplate/header.php' ?>

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

                                        <form action="" method="post" class="parsley-examples">
                                            <div class="mb-3">
                                                <input type="hidden" name="id" parsley-trigger="change" class="form-control" id="userName" value="<?= $trx["id"]; ?>" />
                                            </div>
                                            <div class="mb-3">     
                                                <input type="hidden" name="nama" parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="userName" value="<?= $trx["nama"]; ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" name="jenis" parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="userName" value="<?= $trx["jenis"]; ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" name="bri" parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="userName" value="<?= $trx["jenis2"]; ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" name="tanggal" parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="userName" value="<?= $trx["tanggal"]; ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" name="status" parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="userName" value="<?= $trx["status"]; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" name="debit" parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="userName" value="<?= $trx["debit"]; ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" name="kredit" parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="userName" value="<?= $trx["kredit"]; ?>" />
                                            </div>
                                            <div class="mb-3">
                                            <label for="passWord2" class="form-label">Maukan Kredit<span class="text-danger">*</span></label>
                                                <input type="number" name="kreditbaru" parsley-trigger="change"  class="form-control" id="userName" value="<?= $trx["kredit"]; ?>"/>
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" name="laba" parsley-trigger="change"  class="form-control" id="userName" value="<?= $trx["laba"]; ?>"/>
                                            </div>
                                            <input type="hidden" name="saldo_d" value="<?= $saldo["saldo_d"] ?>" required/>
                                            <input type="hidden" name="saldo_k" value="<?= $saldo["saldo_k"] ?>" required/>
                                        
                                            <div class="text-end">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit" name="submit">Submit</button>
                                                <button type="reset" class="btn btn-secondary waves-effect"><a href="transaksi.php">Cencel</a></button>
                                            </div>
                                        </form>
                                    </div>
                                </div> <!-- end card -->
                            </div>
                            <!-- end col -->       
                        
                    </div> <!-- container-fluid -->

                </div> <!-- content -->

<?php include 'tamplate/footer.php'; ?>

<?php include 'tamplate/left-sidebar.php'; ?>