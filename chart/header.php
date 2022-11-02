<?php 

$data = query("SELECT * FROM user WHERE username = '$_SESSION[username]'");

?>
<?php foreach ($data as $profil) : ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Gian Cellular</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

		<!-- App css -->

		<link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

		<!-- icons -->
		<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

        <script src="chart/jquery-1.11.3.min.js"></script>    
        <script src="chart/highcharts.js"></script>
        <script src="chart/exporting.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
 
        var grafik1;

        var grafik2;

        grafik1 = new Highcharts.Chart({
        chart: {
        renderTo: "kotak1", 
        type: "column" 
        },
        <?php $hariIni = new DateTime();
        $tanggal = $hariIni->format('F Y'); ?>
        title: {
        text: "Grafik Jumlah Transaksi Bulan <?= $tanggal ?>" 

        },
        xAxis: {
        categories: ["Jenis Transaksi"] 
        },
        yAxis: {
        title: {
        text: "Jumlah Transaksi" 
        }
        },
        series:
        [
        <?php $tampil=mysqli_query($conn," SELECT*, count(id) as jumlah_transaksi FROM transaksi WHERE month(tanggal)=month(curdate()) AND year(tanggal)=year(curdate()) group by jenis");
        while($data=mysqli_fetch_array($tampil)){

        ?>
        {
        name: "<?=$data['jenis']?>", 
        data: [<?=$data['jumlah_transaksi']?>]
        },
        <?php } ?>
        ]
        });

        grafik2 = new Highcharts.Chart({
        chart: {
        renderTo: "kotak2", 
        type: "column" 
        },
        title: {
        text: "Grafik Jumlah Transaksi Keseluruhan"

        },
        xAxis: {
        categories: ["Jenis Transaksi"] 
        },
        yAxis: {
        title: {
        text: "Jumlah Transaksi" 
        }
        },
        series:
        [
        <?php $tampil=mysqli_query($conn," SELECT*, count(id) as jumlah_transaksi FROM transaksi group by jenis");
        while($data=mysqli_fetch_array($tampil)){

        ?>
        {
        name: "<?=$data['jenis']?>", 
        data: [<?=$data['jumlah_transaksi']?>]
        },
        <?php } ?>
        ]
        });

        });
        </script>
        <script src="https://code.jquery.com/jquery-2.1.4.js" integrity="sha256-siFczlgw4jULnUICcdm9gjQPZkw/YPDqhQ9+nAOScE4="crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
            
                $("#gian").click(function() {
                $("#body").addClass("sidebar-enable");
                })
            
            });
            </script>

    </head>
    <!-- body start -->
    <body class="loading" id="body" data-layout-color="light"  data-layout-mode="default" data-layout-size="fluid" data-topbar-color="light" data-leftbar-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='true'>

        <!-- Begin page -->
        <div id="wrapper">
            
            <!-- Topbar Start -->
            <div class="navbar-custom">
                    <ul class="list-unstyled topnav-menu float-end mb-0">
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="gambar/<?= $profil["gambar"]; ?>" alt="user-image" class="rounded-circle">
                                <span class="pro-user-name ms-1">
                                    <?= $profil["nama_user"]; ?> <i class="mdi mdi-chevron-down"></i> 
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>
    
                                <!-- item-->
                                <a href="profile.php" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>My Account</span>
                                </a>
                                <div class="dropdown-divider"></div>
    
                                <!-- item-->
                                <a href="auth/logout.php" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span>Logout</span>
                                </a>
    
                            </div>
                        </li>
    
                        <li class="dropdown notification-list">
                            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                                <i class="fe-settings noti-icon"></i>
                            </a>
                        </li>
    
                    </ul>
    
                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="index.php" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <img src="assets/images/logo-sm.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/logo-light.png" alt="" height="16">
                            </span>
                        </a>
                        <a href="index.php" class="logo logo-dark text-center">
                            <span class="logo-sm">
                                <img src="assets/images/logo-sm.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/logo1.png" alt="" height="50">
                            </span>
                        </a>
                    </div>

                    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
                        <li>
                            <button class="button-menu-mobile disable-btn waves-effect" id="gian">
                                <i class="fe-menu"></i>
                            </button>
                        </li>
    
                        <li>
                            <h4 class="page-title-main">Gian Cellular</h4>
                        </li>
            
                    </ul>

                    <div class="clearfix"></div> 
               
            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="h-100" data-simplebar>

                     <!-- User box -->
                    <div class="user-box text-center">

                        <img src="gambar/<?= $profil["gambar"] ?>" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
                            <div class="dropdown">
                                <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown"  aria-expanded="false"><?= $profil["nama_user"] ?></a>
                                <div class="dropdown-menu user-pro-dropdown">

                                    <!-- item-->
                                    <a href="profile.php" class="dropdown-item notify-item">
                                        <i class="fe-user me-1"></i>
                                        <span>My Account</span>
                                    </a>
        
                                    <!-- item-->
                                    <a href="auth/logout.php" class="dropdown-item notify-item">
                                        <i class="fe-log-out me-1"></i>
                                        <span>Logout</span>
                                    </a>
        
                                </div>
                            </div>

                        

                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="profile.php" class="text-muted left-user-info">
                                    <i class="fe-user me-1"></i>
                                </a>
                            </li>

                            <li class="list-inline-item">
                                <a href="auth/logout.php">
                                    <i class="mdi mdi-power"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <li class="menu-title">Navigation</li>
                
                            <li>
                                <a href="index.php">
                                    <i class="mdi mdi-view-dashboard-outline"></i>
                                    <span class="badge bg-success rounded-pill float-end">9+</span>
                                    <span> Dashboard </span>
                                </a>
                            </li>

                            <li class="menu-title mt-2">Transaction</li>

                            <li>
                                <a href="transaksi.php">
                                    <i class="fe-dollar-sign"></i>
                                    <span> Transaksi </span>
                                </a>
                            </li>
                            <li>
                                <a href="input_jenis.php">
                                    <i class="fe-grid"></i>
                                    <span> Jenis Transaksi </span>
                                </a>
                            </li>
                            <li>
                                <a href="modal.php">
                                    <i class="fe-credit-card"></i>
                                    <span> Input Modal </span>  
                                </a>
                            </li>

                            <li class="menu-title mt-2">Report</li>

                            <li>
                                <a href="#email" data-bs-toggle="collapse">
                                    <i class="fe-file"></i>
                                    <span> Laporan </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="email">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="laporan/laporan-all.php">Saldo</a>
                                        </li>
                                        <li>
                                            <a href="laporan/laporan-piutang.php">Piutang</a>
                                        </li>
                                        <li>
                                            <a href="laporan/cetak-laporan.php">Cetak Laporan</a>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <?php endforeach; ?>