<?php 
include 'session.php';
include '../function.php';

//query debit
$sql = query("SELECT sum(debit) as debday FROM transaksi WHERE tanggal=curdate() AND status = 'LUNAS(DEBIT)'");
    //Jumlah Debit Masuk
    $debit = mysqli_query($conn,"SELECT * FROM transaksi  WHERE tanggal=curdate() AND status = 'LUNAS(DEBIT)'");
    $jum_debit = mysqli_num_rows($debit);

//query kredit
$sql2 = query("SELECT sum(kredit) as kreday FROM transaksi WHERE tanggal=curdate()");
    //Jumlah Kredit Masuk
    $kredit = mysqli_query($conn,"SELECT * FROM transaksi  WHERE tanggal=curdate() AND status = 'LUNAS(KREDIT)'");
    $jum_kredit = mysqli_num_rows($kredit);

//query laba debit
$sql3 = query("SELECT sum(laba) as laday FROM transaksi WHERE tanggal=curdate() AND status = 'LUNAS(DEBIT)'");
foreach($sql3 as $row){
    if($row["laday"] == NULL){
        $raw = '1';
    } else {
        $raw = $row["laday"];
    }
}

    //Jumlah Laba Masuk
    $laba = mysqli_query($conn,"SELECT laba FROM transaksi  WHERE tanggal=curdate() AND status = 'LUNAS(DEBIT)' AND laba !='0'");
    $jum_laba = mysqli_num_rows($laba);

//laba kredit
$sql5 = query("SELECT sum(debit) as debday FROM transaksi WHERE tanggal=curdate() AND status = 'LUNAS(KREDIT)'");
$sql6 = query("SELECT sum(kredit) as kreday FROM transaksi WHERE tanggal=curdate() AND status = 'LUNAS(KREDIT)'");
foreach( $sql5 as $row ) {
    foreach($sql6 as $row2){
    $laba_k = $row2["kreday"]-$row["debday"];
    }
}

//query piutang
$sql4 = query("SELECT sum(hutang) as piutang FROM transaksi WHERE tanggal=curdate()");
    //Jumlah Piutang Masuk
    $hutang = mysqli_query($conn,"SELECT hutang FROM transaksi  WHERE tanggal=curdate() AND hutang !='0'");
    $jum_hutang = mysqli_num_rows($hutang);

?>


<?php include 'tamplate/header.php'; ?>

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <br>
                        <div class="row">
                            <div class="mt-3 mt-md-0">
                                <a href="laporan-day.php"><button type="button" class="btn btn-success  width-md waves-effect waves-light">Hari Ini</button></a>
                                <a href="laporan-month.php"><button type="button" class="btn btn-outline-success width-md waves-effect waves-light">Bulan Ini</button></a>
                                <a href="laporan-all.php"><button type="button" class="btn btn-outline-success width-md waves-effect waves-light">Semua</button></a>
                            </div>
                        </div>
                        <br>
                        <!--  Debit Harian  -->  
                        <div class="row">
                        <h3 class="page-title-main">INFORMASI SALDO & PIUTANG (HARIAN INI)</h3>
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
    
                                        <h4 class="header-title mt-0 mb-4">Debit</h4>
    
                                        <div class="widget-chart-1">
                                            <div class="widget-chart-box-1 float-start" dir="ltr">
                                                <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#05c46b "
                                                       data-bgColor="#dff9fb" value="<?= $jum_debit ?>"
                                                       data-skin="tron" data-angleOffset="180" data-readOnly=true
                                                       data-thickness=".15"/>
                                            </div>
    
                                            <div class="widget-detail-1 text-end">
                                                <h2 class="fw-normal pt-2 mb-1"><?php foreach( $sql as $row ) : ?><?= rupiah('0'+$row["debday"]); ?><?php endforeach; ?></h2>
                                                <p class="text-muted mb-1">Debit</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                        
                            <!--  Kredit Harian  -->  
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
    
                                        <h4 class="header-title mt-0 mb-4">Kredit</h4>
    
                                        <div class="widget-chart-1">
                                            <div class="widget-chart-box-1 float-start" dir="ltr">
                                                <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#be2edd"
                                                       data-bgColor="#FDA7DF" value="<?= $jum_kredit ?>"
                                                       data-skin="tron" data-angleOffset="180" data-readOnly=true
                                                       data-thickness=".15"/>
                                            </div>
    
                                            <div class="widget-detail-1 text-end">
                                                <h2 class="fw-normal pt-2 mb-1"><?php foreach( $sql2 as $row ) : ?><?= rupiah('0'+$row["kreday"]); ?><?php endforeach; ?></h2>
                                                <p class="text-muted mb-1">Kredit</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <!--  Laba Debit Harian  -->  
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
    
                                        <h4 class="header-title mt-0 mb-4">Laba Debit</h4>
                                        <div class="widget-box-2">
                                            <div class="widget-detail-2 text-end">
                                                <span class="badge bg-info rounded-pill float-start mt-3"><?php foreach( $sql3 as $row ) : ?><?= round('0'+$raw/($raw+$laba_k)*'100',2); ?><?php endforeach; ?>% <i class="mdi mdi-trending-up"></i> </span>
                                                <h2 class="fw-normal mb-1"> <?php foreach( $sql3 as $row ) : ?><?= rupiah('0'+$raw); ?><?php endforeach; ?></h2> </h2>
                                                <p class="text-muted mb-3">Laba Debit</p>
                                            </div>
                                            <div class="progress progress-bar-alt-info progress-sm">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                        aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: <?php foreach( $sql3 as $row ) : ?><?= round('0'+$raw/($raw+$laba_k)*'100',2); ?><?php endforeach; ?>%;">
                                                    <span class="visually-hidden">77% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->  

                            <!--  Laba Kredit Harian  -->  
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
                                                <span class="badge bg-warning rounded-pill float-start mt-3"><?php foreach( $sql3 as $row ) : ?><?= round('0'+$laba_k/($raw+$laba_k)*'100',2); ?><?php endforeach; ?>% <i class="mdi mdi-trending-up"></i> </span>
                                                <h2 class="fw-normal mb-1"> <?= rupiah($laba_k); ?></h2> </h2>
                                                <p class="text-muted mb-3">Laba Kredit</p>
                                            </div>
                                            <div class="progress progress-bar-alt-warning progress-sm">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                        aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: <?php foreach( $sql3 as $row ) : ?><?= round('0'+$laba_k/($raw+$laba_k)*'100',2); ?><?php endforeach; ?>%;">
                                                    <span class="visually-hidden">77% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col --> 

                            <!--  Jumlah Laba Harian  -->  
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
    
                                        <h4 class="header-title mt-0 mb-4">Jumlan Laba</h4>
    
                                        <div class="widget-chart-1">
                                            <div class="widget-chart-box-1 float-start" dir="ltr">
                                                <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#4b6584 "
                                                       data-bgColor="#d1d8e0" value="<?= $jum_laba ?>"
                                                       data-skin="tron" data-angleOffset="180" data-readOnly=true
                                                       data-thickness=".15"/>
                                            </div>
    
                                            <div class="widget-detail-1 text-end">
                                                <h2 class="fw-normal pt-2 mb-1"><?= rupiah($raw+$laba_k); ?></h2>
                                                <p class="text-muted mb-1">Jumlan Laba</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <!--  Jumlah Laba Harian  -->  
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
    
                                        <h4 class="header-title mt-0 mb-4">Jumlan Piutang</h4>
    
                                        <div class="widget-chart-1">
                                            <div class="widget-chart-box-1 float-start" dir="ltr">
                                                <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#f05050 "
                                                       data-bgColor="#F9B9B9" value="<?= $jum_hutang ?>"
                                                       data-skin="tron" data-angleOffset="180" data-readOnly=true
                                                       data-thickness=".15"/>
                                            </div>
    
                                            <div class="widget-detail-1 text-end">
                                                <h2 class="fw-normal pt-2 mb-1"><?php foreach( $sql4 as $row ) : ?><?= rupiah('0'+$row["piutang"]); ?><?php endforeach; ?></h2>
                                                <p class="text-muted mb-1">Jumlan Piutang</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->



                        </div><!--  end row  -->



                        </div><!--  end row  -->




<?php include 'tamplate/footer.php'; ?>
<?php include 'tamplate/left-sidebar.php'; ?>