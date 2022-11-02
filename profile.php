<?php 

include 'function.php';


?>


<?php include 'tamplate/header.php'; 

$gambar = query("SELECT * FROM user WHERE username = '$_SESSION[username]'");
?>


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
                                    <div class="bg-picture card-body">

                                        <div class="d-flex align-items-top">
                                            <a href="gambar/<?php foreach($gambar as $row) : ?><?= $row["gambar"] ?>" target="_blank"><img src="gambar/<?= $row["gambar"] ?>" class="flex-shrink-0 rounded-circle avatar-xl img-thumbnail float-start me-3" alt="profile-image"></a>

                                            <div class="flex-grow-1 overflow-hidden">
                                                <h4 class="m-0"><?= $row["nama_user"] ?></h4>
                                                <p class="text-muted"><i>Owner</i></p>
                                                <div class="text-start">
                                                    <p class="text-muted font-15"><strong>Nama Lengkap :</strong> <span class="ms-2"><?= $row["nama_user"] ?></span></p>

                                                    <p class="text-muted font-15"><strong>Mobile :</strong><span class="ms-2"><?= $row["no_hp"] ?></span></p>

                                                    <p class="text-muted font-15"><strong>Email :</strong> <span class="ms-2"><?= $row["email"] ?></span></p>

                                                    <p class="text-muted font-15"><strong>Location :</strong> <span class="ms-2"><?= $row["alamat"] ?></span></p>
                                                </div>
                                                <div class="mt-3 mt-md-0">
                                                    <a href="auth/change-picture.php?id=<?= $row["id"] ?>"><button type="button" class="btn btn-success  width-md waves-effect waves-light">Change Picture</button></a>
                                                    <a href="auth/change-password.php?id=<?= $row["id"] ?>"><button type="button" class="btn btn-success width-md waves-effect waves-light">Change Password</button></a>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-lg-12">

                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Edit User</h4>
                                        <br>
                                        <form action="auth/auth-edit.php" method="post" class="parsley-examples">
                                            <input type="hidden" name="id" value="<?= $row["id"]; ?>">
                                            <input type="hidden" name="password" value="<?= $row["password"]; ?>">
                                            <input type="hidden" name="gambar" value="<?= $row["gambar"]; ?>">
                                            <input type="hidden" name="username" value="<?= $row["username"]; ?>">
                                            <div class="mb-3">
                                                <label for="nama_user" class="form-label">Full Name</label>
                                                <input type="text" name="nama_user" parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="nama_user" value="<?= $row["nama_user"]; ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="no_hp" class="form-label">Mobile</label>
                                                <input type="text" name="no_hp" parsley-trigger="change" required placeholder="Enter user Phone Number" class="form-control" id="no_hp" value="<?= $row["no_hp"]; ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">E-Mail</label>
                                                <input type="email" name="email" parsley-trigger="change" required placeholder="Enter user Email" class="form-control" id="email" value="<?= $row["email"]; ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Address</label>
                                                <textarea type="text" name="alamat" required placeholder="Enter user Address" class="form-control" id="alamat"><?= $row["alamat"]; ?><?php endforeach; ?></textarea>
                                            </div>
                                            <div class="text-end">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit" name="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div> <!-- end card -->
                            </div>
                            <!-- end col --> 

                        

<?php include 'tamplate/footer.php'; ?>

<?php include 'tamplate/left-sidebar.php'; ?>