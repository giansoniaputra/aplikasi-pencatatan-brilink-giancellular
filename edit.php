<?php 

require 'function.php';

//ambil data
$id = $_GET['id'];
//query data mahasiswa berdasar ID
$trx = query("SELECT * FROM transaksi WHERE id = $id")[0];

if (isset($_POST["submit"])) {
	if (edit($_POST) > 0) {
		echo "
		<script>
			alert('Data Berhasil Diubah')
			document.location.href= 'transaksi.php'
		</script>
		";
	}else {
		echo "
		<script>
			alert('Data Berhasil Diubah')
			document.location.href= 'transaksi.php'
		</script>
		";
	}
}

$saldo = query("SELECT * FROM saldo WHERE id = '1'")[0];

$jenis = query("SELECT * FROM jenis_transaksi");

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

                                        <form action="" method="post" class="parsley-examples">
                                            <div class="mb-3">
                                                <input type="hidden" name="id" parsley-trigger="change" class="form-control" id="userName" value="<?= $trx["id"]; ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="userName" class="form-label">Nama</label>
                                                <input type="text" name="nama" parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="userName" value="<?= $trx["nama"]; ?>" />
                                            </div>
                                            <div class="mb-3">
                                            <label for="position" class="form-label">Jenis Transaksi</label>
                                                <select class="form-control" data-toggle="select2" data-width="100%" name="jenis_transaksi" id="jenis_transaksi" onchange="autofill()"> 
                                                    <option value="<?= $trx["jenis"]; ?>"><?= $trx["jenis"]; ?></option>
                                                        <?php foreach( $jenis as $row ) : ?>
                                                            <option value="<?= $row["jenis_transaksi"]; ?>">
                                                                <?= $row["jenis_transaksi"]; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                            <label for="bri" class="form-label">BRILINK/NON-BRILINK</label>
                                                <select class="form-control" data-toggle="select2" data-width="100%" name="bri" id="bri">
                                                    <option value="<?= $trx["jenis2"]; ?>"><?= $trx["jenis2"]; ?></option>
                                                        <option value="bri">BRILINK</option>
                                                        <option value="non">NON-BRILINK</option>
                                                        
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="pass1" class="form-label">Tanggal Transaksi<span class="text-danger">*</span></label>
                                                <input type="date" name="tanggal" parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="userName" value="<?= $trx["tanggal"]; ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" name="status" parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="userName" value="<?= $trx["status"]; ?>">
                                            </div>
                                            <div class="mb-3">
                                            <label for="position" class="form-label">Status</label>
                                                <select class="form-control" data-toggle="select2" data-width="100%" name="statusbaru" id="men" onchange="autofill()">
                                                    <option value="<?= $trx["status"]; ?>"><?= $trx["status"]; ?></option>
                                                        <option value="LUNAS(DEBIT)">LUNAS(DEBIT)</option>
                                                        <option value="LUNAS(KREDIT)">LUNAS(KREDIT)</option>
                                                        <option value="BELUM LUNAS">BELUM LUNAS</option>
                                                        <option value="PINJAMAN">PINJAMAN</option>
                                                        <option value="LABA">LABA</option>
                                                        <option value="PENAMBAHAN">PENAMBAHAN</option>
                                                        <option value="PENGURANGAN">PENGURANGAN</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" name="debit" parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="userName" value="<?= $trx["debit"]; ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" name="kredit" parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="userName" value="<?= $trx["kredit"]; ?>" />
                                            </div>
                                            <div class="mb-3">
                                            <label for="passWord2" class="form-label">Debit Baru<span class="text-danger">*</span></label>
                                                <input type="number" name="debitbaru" parsley-trigger="change"  class="form-control" id="userName" value="<?= $trx["debit"]; ?>" />
                                            </div>
                                            <div class="mb-3">
                                            <label for="passWord2" class="form-label">Kredit Baru<span class="text-danger">*</span></label>
                                                <input type="number" name="kreditbaru" parsley-trigger="change"  class="form-control" id="userName" value="<?= $trx["kredit"]; ?>"/>
                                            </div>
                                            <div class="mb-3">
                                            <label for="passWord2" class="form-label">Laba<span class="text-danger">*</span></label>
                                                <input type="number" name="laba" parsley-trigger="change"  class="form-control" id="userName" value="<?= $trx["laba"]; ?>"/>
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