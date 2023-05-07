<?php
session_start();
include "dbconnect.php";

//Getting the tribe id
$userId = $_SESSION['user']['user_id'];
$role = $_SESSION['user']['role'];
$username = $_SESSION['user']['username'];

if ($role == 2) {
    $query = "SELECT * FROM `members` WHERE id='$userId'";
    $tribe = $conn->query($query)->fetch_assoc()['tribe'];
    $clan = $conn->query($query)->fetch_assoc()['clan'];
    $surname = $conn->query($query)->fetch_assoc()['tribe'];

    
} else {
    $query = "SELECT * FROM `contributors` WHERE id='$userId'";
    $tribe = $conn->query($query)->fetch_assoc()['tribe'];
    $surname = $conn->query($query)->fetch_assoc()['full_name'];
    $clan = $conn->query($query)->fetch_assoc()['clan'];
}

?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Find Clan</title>
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
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body data-sidebar="dark" data-layout-mode="light">
    <style>
        .ck-editor__editable {
            min-height: 150px !important;
        }
    </style>
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include "header.php" ?>

        <!-- ========== Left Sidebar Start ========== -->
        <?php include "usersidebar.php" ?>
        <!-- Left Sidebar End -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                       <dv class="col-12 text-center">
                            <div class="container">
                                <h1 class="text-center">Lets match you to clans you may relate to, just input your surname!!</h1>
                                <form class="form-inline my-2 my-lg-0" method="post" action="" >
                                     <input class="form-control mr-sm-2 mb-4" type="search" placeholder="Search Clan" aria-label="Search" name="surname" >
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search" >Search</button>
                                 </form>
                            </div>

                       </dv>
                       <?php 
                       if(isset($_POST['search'])){
                       ?>
                            <?php     
                            $surname = $_POST['surname'];                       
                             $query = "SELECT * FROM `members` JOIN clans ON clans.clan_id = members.clan WHERE members.surname = '$surname' GROUP BY clans.clan_id";
                            $results = $conn->query($query);
                            if ($results->num_rows > 0) {?>
                                <h1 class='text-warning'>Hello, <?php echo $surname ?> these are possible clans you are likely to belong to!!!</h1>
                                <?php while ($data = $results->fetch_assoc()) {
                            ?>
                                    <div class="col-4">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $data['clan_name']?></h5>
                                                <p class="card-text"><?php echo $data['location']?></p>
                                                <p class="card-text"><small class="text-primary">Current Leader: <?php echo $data['clan_leader']?></small></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            } else { ?>
                                <h1 class="text-danger">
                                    Sorry, we could not match you to any possible clans in the system.
                                    Please, try again later!!!!!!
                                </h1>
                            <?php } ?>
                        </div>
                        <?php }?>

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-sm-12">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Cultural Portal
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    
    <!--end  Modal -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

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