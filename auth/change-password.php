<?php include 'session.php';
include '../function.php';
$id = $_GET['id'];
$CP = query("SELECT * FROM user WHERE id = $id")[0];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Register & Signup | Adminto - Responsive Admin Dashboard Template</title>
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

    </head>

    <body class="loading authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="text-center">
                            <a href="index.html">
                                <img src="assets/images/logo-dark.png" alt="" height="100" class="mx-auto">
                            </a>
                            <br><br>
                        </div>
                        <div class="card">

                            <div class="card-body p-4">
                                
                                <div class="text-center mb-4">
                                    <h4 class="text-uppercase mt-0">Change Password</h4>
                                </div>

                                <form action="auth-change-pass.php" method="post" enctype="multipart/form-data">
                                <input class="form-control" type="hidden" name="id" value="<?= $CP["id"] ?>" >
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Current Password</label>
                                        <input class="form-control" type="password" id="password" placeholder="Enter your Current Password" name="password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_baru" class="form-label">New Password</label>
                                        <input class="form-control" type="password" id="password_baru" placeholder="Enter your New Password" name="password_baru" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_baru2" class="form-label">Confirm New Password</label>
                                        <input class="form-control" type="password" id="password_baru2" placeholder="Enter your New Password" name="password_baru2" required>
                                    </div>
                                    
                                    <div class="mb-3 text-center d-grid">
                                        <button class="btn btn-primary" type="submit" name="change_pass"> Change Password </button>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- Vendor -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>