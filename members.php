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
    <title>Members</title>
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
    if (isset($_POST['add_contributor'])) {
        $surname = $_POST['surname'];
        $othernames = $_POST['othernames'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $tribe = $_POST['tribe'];
        $clan = $_POST['clan'];
        $sql = "INSERT INTO `members`(`surname`, `contact`, `tribe`, `clan`, `other_names`, `address`) VALUES ('$surname', '$contact', '$tribe', '$clan', '$othernames', '$address')";
        $results = $conn->query($sql);
        if ($results) {
            $username =  $_SESSION['user']['username'];
            $transaction_id = "#" . date('Ym') . time();
            $sql = "INSERT INTO `logs`(`transaction_id`, `transaction_type`, `user`) VALUES ('$transaction_id', 'A new member was added', '$username')";
            $conn->query($sql);

              //insert into users
              $username = $contact;
              $role = "2";
              $password = time();
              $userId = mysqli_insert_id($conn);
              $sql = "INSERT INTO `users`(`username`, `password`, `role`, `user_id`)
                           VALUES ('$username', '$password', '$role', '$userId')";
              $conn->query($sql);
  
        }
    }


    ?>

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include "header.php" ?>

        <!-- ========== Left Sidebar Start ========== -->
        <?php include "sidebar.php" ?>
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
                                <h4 class="mb-sm-0 font-size-18">Registered system Contributors</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="d-flex justify-content-between">
                                            <h3>Members</h3>
                                            <span>
                                                <button type="button" class="js-swal-confirm btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addmember">
                                                    <i class="fa fa-plus text-white me-1"></i> Add member
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <table id="datatable" class="table table-bordered dt-responsive">
                                        <thead>

                                            <tr>
                                                <th>surname</th>
                                                <th>other names</th>
                                                <th>Contact</th>
                                                <th>tribe</th>
                                                <th>clan</th>
                                                <th>address</th>
                                                <th>Registered</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            function time_ago($datetime)
                                            {
                                                $timestamp = strtotime($datetime);
                                                $difference = time() - $timestamp;

                                                if ($difference < 60) {
                                                    return $difference . " secs ago";
                                                } elseif ($difference < 3600) {
                                                    return round($difference / 60) . " mins ago";
                                                } elseif ($difference < 86400) {
                                                    return round($difference / 3600) . " hours ago";
                                                } elseif ($difference < 31536000) {
                                                    return round($difference / 86400) . " days ago";
                                                } else {
                                                    return round($difference / 31536000) . " years ago";
                                                }
                                            }
                                            $sql = "SELECT * FROM `members` JOIN tribes ON tribes.tribe_id = members.tribe JOIN clans ON clans.clan_id = tribes.tribe_id WHERE members.status='1' ORDER BY members.id DESC";
                                            $results = $conn->query($sql);
                                            while ($members = $results->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $members['surname']; ?></td>
                                                    <td> <?php echo $members['other_names']; ?></td>
                                                    <td><?php echo $members['contact']; ?></td>
                                                    <td><?php echo $members['name']; ?></td>
                                                    <td><?php echo $members['clan_name']; ?></td>
                                                    <td><?php echo $members['address']; ?></td>
                                                    <td><?php echo time_ago($members['created_at']) ?></td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <button class="btn">
                                                                <i class="bx bx-pencil text-success " style="font-size: 20px;"></i>
                                                            </button>
                                                            <button class="btn">
                                                                <i class="bx bx-trash-alt text-danger" style="font-size: 20px;"></i>
                                                            </button>

                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

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
                            Cultural portal

                        </div>

                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title d-flex align-items-center px-3 py-4">
                Your Article here
                <h5 class="m-0 me-2">Settings</h5>

                <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
            </div>

            <!-- Settings -->
            <hr class="mt-0" />
            <h6 class="text-center mb-0">Choose Layouts</h6>

            <div class="p-4">
                <div class="mb-2">
                    <img src="assets/images/layouts/layout-1.jpg" class="img-thumbnail" alt="layout images">
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                    <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                </div>

                <div class="mb-2">
                    <img src="assets/images/layouts/layout-2.jpg" class="img-thumbnail" alt="layout images">
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch">
                    <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                </div>

                <div class="mb-2">
                    <img src="assets/images/layouts/layout-3.jpg" class="img-thumbnail" alt="layout images">
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch">
                    <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                </div>

                <div class="mb-2">
                    <img src="assets/images/layouts/layout-4.jpg" class="img-thumbnail" alt="layout images">
                </div>
                <div class="form-check form-switch mb-5">
                    <input class="form-check-input theme-choice" type="checkbox" id="dark-rtl-mode-switch">
                    <label class="form-check-label" for="dark-rtl-mode-switch">Dark RTL Mode</label>
                </div>


            </div>

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <!--Add  Modal -->
    <div class="modal fade" id="addmember" tabindex="-1" aria-labelledby="addContributor" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Member</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="js-validation-signin" action="" method="POST">
                        <div class="mb-4">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="surname" placeholder="Surname">
                                <span class="input-group-text">
                                    <i class="bx bx-user-check"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="othernames" placeholder="Othernames">
                                <span class="input-group-text">
                                    <i class="bx bx-user-check"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <select class="form-select" aria-label="Tribe" name="tribe">
                                <option selected>Add Tribe</option>
                                <?php
                                $sql = "SELECT * FROM `tribes`";
                                $results = $conn->query($sql);
                                while ($tribe = $results->fetch_assoc()) {
                                ?>

                                    <option value="<?php echo $tribe['tribe_id'] ?>"><?php echo $tribe['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-4">
                            <select class="form-select" aria-label="Clan" name="clan">
                                <option selected>Add Clan</option>
                                <?php
                                $sql = "SELECT * FROM `clans`";
                                $results = $conn->query($sql);
                                while ($clan = $results->fetch_assoc()) {
                                ?>

                                    <option value="<?php echo $clan['clan_id'] ?>"><?php echo $clan['clan_name'] ?></option>
                                <?php } ?>
                            </select>

                            </select>
                        </div>
                        <div class="mb-4">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="contact" placeholder="contact">
                                <span class="input-group-text">
                                    <i class="bx bxs-phone-call"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="address" placeholder="Address">
                                <span class="input-group-text">
                                    <i class="bx bxs-map"></i>
                                </span>
                            </div>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" name="add_contributor">Add member</button>
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

</body>

<!-- Mirrored from themesbrand.com/skote/layouts/tables-datatable.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Mar 2023 19:08:49 GMT -->

</html>