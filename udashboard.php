<?php
session_start();
if(!isset($_SESSION['user'])){
    header("location:login.php");
  }
include "dbconnect.php";

?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Contributors</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-sidebar="dark" data-layout-mode="light">

    <?php
    if (isset($_POST['change_user'])) {

        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "UPDATE `users` SET `username`='$username',`password`='$password' WHERE id='$id'";
        $results = $conn->query($sql);
        if ($results) {
            $username =  $_SESSION['user']['username'];
            $transaction_id = "#" . date('Ym') . time();
            $sql = "INSERT INTO `logs`(`transaction_id`, `transaction_type`, `user`) VALUES ('$transaction_id', 'Changed users details', '$username')";
            $conn->query($sql);
        }
    }
    ?>

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include "header.php" ?>

        <!-- ========== Left Sidebar Start ========== -->
        <?php include "/var/www/html/portal/usersidebar.php" ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">System Users</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-primary text-center">
                  <div class="card-title text-center">
                    <h4 class="text-center mt-2">Quiz Center</h4>
                  </div>
                  <div class="card-body text-center bx-lg">
                  <div class="text-center">
                  <i class='bx bx-book-content bx-lg text-success'></i>

                  </div>
                  <div class="text-center ">
                  <a href = "viewquiz.php" class = "btn btn-primary">Attempt</a>
                  </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-secondary">
                  <div class="card-title">
                  
                    <h4  class="text-center mt-2">Music</h4>
                  </div>
                  <div class="card-body text-center bx-lg">
                  <div class="text-center text-warning">
                    <i class='bx bx-music' ></i>
                    </div>
                  <a href = "music.php" class = "btn btn-primary">Listen</a>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-warning">
                  <div class="card-title">
                  
                    <h4  class="text-center mt-2">Fashion</h4>
                  </div>
                  <div class="card-body text-center bx-lg">
                  <div class="text-center text-danger">
                  <i class='bx bxs-t-shirt'></i>
                    </div>
                  <a href = "cultural_music.php" class = "btn btn-primary">Check out</a>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-danger">
                  <div class="card-title">
                  
                    <h4  class="text-center mt-2">Food and Cousines</h4>
                  </div>
                  <div class="card-body text-center bx-lg">
                  <div class="text-center text-warning">
                  <i class='bx bx-dish' ></i>
                    </div>
                  <a href = "cultural_music.php" class = "btn btn-primary">Learn</a>
                  </div>
                </div>
              </div>
            
            </div>

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> ©
                            Cultural Portal
                        </div>

                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <!--Add  Modal -->
    <div class="modal fade" id="user" tabindex="-1" aria-labelledby="addContributor" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change User Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="js-validation-signin" action="" method="POST">
                        <input type="hidden" class="form-control" name="id" id="id">
                        <p>Username</p>

                        <div class="input-group input-group-lg mb-4">
                            <input type="text" class="form-control" name="username" placeholder="username" id="name">
                            <span class="input-group-text">
                                <i class="bx bx-user"></i>
                            </span>
                        </div>
                        <div class="mb-4">
                            <p>Password</p>
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="password" placeholder="password" id="pass">
                                <span class="input-group-text">
                                    <i class="bx bxs-lock"></i>
                                </span>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" name="change_user">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--end  Modal -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/libs/jszip/jszip.min.js"></script>
    <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>

    <script src="assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            $('.change_btn').click(function() {
                var id = $(this).closest("tr").find('td:nth-child(1)').text().trim();
                $('#id').val(id);
                var name = $(this).closest("tr").find('td:nth-child(2)').text().trim();
                $('#name').val(name);
                var password = $(this).closest("tr").find('td:nth-child(3)').text().trim();
                $('#pass').val(password);
            });

        });
    </script>

</body>

</html>