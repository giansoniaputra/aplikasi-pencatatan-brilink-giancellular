<?php 
include 'session.php';
    include '../function.php';
    $sql = query("SELECT * FROM transaksi WHERE status = 'BELUM LUNAS' AND tanggal=curdate() OR status = 'PINJAMAN' AND tanggal=curdate() ORDER BY id DESC");

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
                                <a href="laporan-piutang.php"><button type="button" class="btn btn-success width-md waves-effect waves-light">Hari Ini</button></a>
                                <a href="laporan-piutang-month.php"><button type="button" class="btn btn-outline-success width-md waves-effect waves-light">Bulan Ini</button></a>
                                <a href="laporan-piutang-all.php"><button type="button" class="btn btn-outline-success width-md waves-effect waves-light">Semua</button></a>
                                <a href="laporan-piutang-search.php"><button type="button" class="btn btn-outline-success width-md waves-effect waves-light">Cari</button></a>
                            </div>
                        </div>
                        <br>
                        
                        <div class="row">
                        <h3 class="page-title-main">LAPORAN PIUTANG (HARIAN INI)</h3>
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
                                            <?php foreach( $sql as $row ) : ?>
                                                
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
                                                    <a href="../lunas_debit.php?id=<?= $row["id"] ?>"><button type="button" class="btn btn-success waves-effect waves-light"><i class="fe-check-circle"></i></button></a>
                                                    <a href="../lunas_kredit.php?id=<?= $row["id"] ?>"><button type="button" class="btn btn-success waves-effect waves-light"><i class="fe-check-square"></i></button></a>
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
<?php include 'tamplate/left-sidebar-tbl.php'; ?>