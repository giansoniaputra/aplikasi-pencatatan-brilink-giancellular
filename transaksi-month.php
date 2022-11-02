<?php 
include 'auth/session.php';


//query data

include 'function.php';

$transaksi = query("SELECT * FROM transaksi WHERE month(tanggal)=month(curdate()) and id != 1037 ORDER BY id DESC");

//akhir query data

if (isset($_POST["submit"])) {
	if (tambahTransaksi($_POST) > 0) {
		echo "
		<script>
			alert('Data Berhasil Ditambahkan')
			document.location.href= 'transaksi-month.php'
		</script>
		";
    }else {
		echo "
		<script>
			alert('Data Gagal Ditambahkan')
			document.location.href= 'transaksi-month.php'
		</script>
		";
	}
}

//ambil data
//query data mahasiswa berdasar ID
$saldo = query("SELECT * FROM saldo WHERE id = '1'")[0];

$jenis = query("SELECT * FROM jenis_transaksi ORDER BY jenis_transaksi ASC");


?>

<?php include 'tamplate/header-tbl.php'; ?>
            
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <br>
                        <div class="row">
                            <div class="mt-3 mt-md-0">
                                <a href="transaksi.php"><button type="button" class="btn btn-outline-success width-md waves-effect waves-light">Hari Ini</button></a>
                                <a href="transaksi-month.php"><button type="button" class="btn btn-success width-md waves-effect waves-light">Bulan Ini</button></a>
                                <a href="transaksi-all.php"><button type="button" class="btn btn-outline-success width-md waves-effect waves-light">Semua</button></a>
                                <a href="transaksi-search.php"><button type="button" class="btn btn-outline-success width-md waves-effect waves-light">Cari</button></a>
                            </div>
                        </div>
                        <br>
                        <div class="mt-3 mt-md-0">
                                            <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#custom-modal"><i class="mdi mdi-plus-circle me-1"></i> Tambah Transaksi </button>
                                        </div>
                                        <br>
                    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title"> Transaksi</h4>
                                        
                                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                                            <thead>
                                            <tr>
                                                <th>NO.</th>
                                                <th>Nama</th>
                                                <th>Jenis Transaksi</th>
                                                <th>Tanggal Transaksi</th>
                                                <th>Status</th>
                                                <th>Debit</th>
                                                <th>Kredit</th>
                                                <th style="width:12%">Opsi</th>
                                            </tr>
                                            </thead>
    
    
                                            <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach( $transaksi as $row ) : ?>
                                                
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row["nama"]; ?></td>
                                                <td><?= $row["jenis"]; ?></td>
                                                <td><?= tanggal($row["tanggal"]); ?></td>
                                                <td><?= $row["status"]; ?></td>
                                                <td><?= rupiah($row["debit"]); ?></td>
                                                <td><?= rupiah($row["kredit"]); ?></td>
                                                <td>
                                                <div class="button-list">
                                                    <a href="edit.php?id=<?= $row["id"] ?>"><button type="button" class="btn btn-warning waves-effect waves-light"><i class="fe-edit"></i></button></a>
                                                    <a href="delete.php?id=<?= $row["id"] ?>"><button type="button" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i></button></a>
                                                </div>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        
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
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" placeholder="Enter name" name="nama" required>
                            </div>
                            <div class="mb-3">
                            <label for="position" class="form-label">Jenis Transaksi</label>
                                <select class="form-control" data-toggle="select2" data-width="100%" name="jenis_transaksi" id="jenis_transaksi" onchange="autofill()" required> 
                                    <option value="">Pilih Jenis Transaksi</option>
                                        <?php foreach( $jenis as $row ) : ?>
                                            <option value="<?= $row["jenis_transaksi"]; ?>">
                                                <?= $row["jenis_transaksi"]; ?>
                                            </option>
                                        <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                            <label for="bri" class="form-label">BRI/NON-BRI</label>
                                <select class="form-control" data-toggle="select2" data-width="100%" name="bri" id="bri" required> 
                                        <option value="">...</option>
                                        <option value="bri">BRILINK</option>
                                        <option value="non">NON-BRILINK</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="example-date" class="form-label">Tanggal Transaksi</label>
                                <input class="form-control" id="example-date" type="date" name="tanggal" required>
                            </div>
                            <div class="mb-3">
                            <label for="position" class="form-label">Status</label>
                                <select class="form-control" data-toggle="select2" data-width="100%" name="status" id="men" onchange="autofill()">
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
                                <label for="example-date" class="form-label">Debit</label>
                                <input class="form-control" id="example-date" type="number" name="debit" value="0" required>
                            </div>
                            <div class="mb-3">
                                <label for="example-date" class="form-label">Kredit</label>
                                <input class="form-control" id="laba example-date" type="number" name="kredit" value="0" required>
                            </div>
                            <div class="mb-3">
                                <label for="example-date" class="form-label">Laba</label>
                                <input class="form-control" id="laba" type="number" name="laba">
                            </div>
                            <input type="hidden" name="saldo_d" value="<?= $saldo["saldo_d"] ?>" required/>
                            <input type="hidden" name="saldo_k" value="<?= $saldo["saldo_k"] ?>" required/>
        
                                <button type="submit" class="btn btn-light waves-effect waves-light" name="submit">Save</button>
                                <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Right Sidebar -->
        <div class="right-bar">

            <div data-simplebar class="h-100">

                <div class="rightbar-title">
                    <a href="javascript:void(0);" class="right-bar-toggle float-end">
                        <i class="mdi mdi-close"></i>
                    </a>
                    <h4 class="font-16 m-0 text-white">Theme Customizer</h4>
                </div>
        
                <!-- Tab panes -->
                <div class="tab-content pt-0">  

                    <div class="tab-pane active" id="settings-tab" role="tabpanel">

                        <div class="p-3">
                            <div class="alert alert-warning" role="alert">
                                <strong>Customize </strong> the overall color scheme, Layout, etc.
                            </div>

                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Color Scheme</h6>
                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="layout-color" value="light"
                                    id="light-mode-check" checked />
                                <label class="form-check-label" for="light-mode-check">Light Mode</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="layout-color" value="dark"
                                    id="dark-mode-check" />
                                <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
                            </div>

                            <!-- Width -->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Width</h6>
                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="layout-size" value="fluid" id="fluid" checked />
                                <label class="form-check-label" for="fluid-check">Fluid</label>
                            </div>
                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="layout-size" value="boxed" id="boxed" />
                                <label class="form-check-label" for="boxed-check">Boxed</label>
                            </div>

                            <!-- Menu positions -->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Menus (Leftsidebar and Topbar) Positon</h6>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="leftbar-position" value="fixed" id="fixed-check"
                                    checked />
                                <label class="form-check-label" for="fixed-check">Fixed</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="leftbar-position" value="scrollable"
                                    id="scrollable-check" />
                                <label class="form-check-label" for="scrollable-check">Scrollable</label>
                            </div>

                            <!-- Left Sidebar-->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Color</h6>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="leftbar-color" value="light" id="light" />
                                <label class="form-check-label" for="light-check">Light</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="leftbar-color" value="dark" id="dark" checked/>
                                <label class="form-check-label" for="dark-check">Dark</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="leftbar-color" value="brand" id="brand" />
                                <label class="form-check-label" for="brand-check">Brand</label>
                            </div>

                            <div class="form-check form-switch mb-3">
                                <input type="checkbox" class="form-check-input" name="leftbar-color" value="gradient" id="gradient" />
                                <label class="form-check-label" for="gradient-check">Gradient</label>
                            </div>

                            <!-- size -->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Size</h6>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="leftbar-size" value="default"
                                    id="default-size-check" checked />
                                <label class="form-check-label" for="default-size-check">Default</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="leftbar-size" value="condensed"
                                    id="condensed-check" />
                                <label class="form-check-label" for="condensed-check">Condensed <small>(Extra Small size)</small></label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="leftbar-size" value="compact"
                                    id="compact-check" />
                                <label class="form-check-label" for="compact-check">Compact <small>(Small size)</small></label>
                            </div>

                            <!-- User info -->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Sidebar User Info</h6>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="sidebar-user" value="true" id="sidebaruser-check" />
                                <label class="form-check-label" for="sidebaruser-check">Enable</label>
                            </div>


                            <!-- Topbar -->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Topbar</h6>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="topbar-color" value="dark" id="darktopbar-check"
                                    checked />
                                <label class="form-check-label" for="darktopbar-check">Dark</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="topbar-color" value="light" id="lighttopbar-check" />
                                <label class="form-check-label" for="lighttopbar-check">Light</label>
                            </div>

                            <div class="d-grid mt-4">
                                <button class="btn btn-primary" id="resetBtn">Reset to Default</button>
                                <a href="https://1.envato.market/admintoadmin" class="btn btn-danger mt-3" target="_blank"><i class="mdi mdi-basket me-1"></i> Purchase Now</a>
                            </div>

                        </div>

                    </div>
                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>
        <!--  Autofill  -->
        <script type="text/javascript">
            $(document).ready(function() {
                $( "#nama" ).autocomplete({
                serviceUrl: "suggestion.php",   // Kode php untuk prosesing data
                dataType: "JSON",           // Tipe data JSON
                onSelect: function (suggestion) {
                    $( "#nama" ).val(suggestion.nama);
                }
                });
            })
        </script>
        <script src="assets/libs/jquery/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
        <script type="text/javascript">
            function autofill(){
                var jenis_transaksi = $("#jenis_transaksi").val();
                var status = $("#men").val();
                if (status == 'LUNAS(DEBIT)'){
                $.ajax({
                    url : 'autofill-ajax.php',
                    data : 'jenis_transaksi='+jenis_transaksi,
                }).success(function(data){
                    var json = data,
                    obj =JSON.parse(json);
                    $("#laba").val(obj.laba);
                });
                }else if (status == 'BELUM LUNAS'){
                $.ajax({
                    url : 'autofill-ajax.php',
                    data : 'jenis_transaksi='+jenis_transaksi,
                }).success(function(data){
                    var json = data,
                    obj =JSON.parse(json);
                    $("#laba").val(obj.laba);
                });
                }else{
                    $.ajax({
                    url : 'autofill2-ajax.php',
                    data : 'jenis_transaksi='+jenis_transaksi,
                }).success(function(data){
                    var json = data,
                    obj =JSON.parse(json);
                    $("#laba").val(obj.laba);
                });
                }
            }
        </script>

        
        

        <!-- third party js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <!-- third party js ends -->

        <!-- Datatables init -->
        <script src="assets/js/pages/datatables.init.js"></script>
        
        <!-- App js -->
        
        <script src="assets/js/app.min.js"></script>

        <!--  autofocus  -->
        <script type="text/javascript">document.formID.inputID.focus();</script>  

        
        
    </body>
</html>