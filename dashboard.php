<?php
session_start();
include "dbconnect.php";

?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-sidebar="dark" data-layout-mode="light">

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

                    <div class="row">

                        <div class="col-xl-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <p class="text-muted fw-medium">Tribes</p>
                                                    <h4 class="mb-0"> <?php
                                                                        $sql = "SELECT * FROM `tribes`";
                                                                        $results = $conn->query($sql);
                                                                        echo $results->num_rows;

                                                                        ?>
                                                    </h4>
                                                </div>

                                                <div class="flex-shrink-0 align-self-center ">
                                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-success">
                                                        <span class="avatar-title">
                                                            <i class="bx bx-copy-alt font-size-24"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <p class="text-muted fw-medium">clans</p>
                                                    <h4 class="mb-0"> <?php
                                                                        $sql = "SELECT * FROM `clans`";
                                                                        $results = $conn->query($sql);
                                                                        echo $results->num_rows;

                                                                        ?>
                                                    </h4>
                                                </div>

                                                <div class="flex-shrink-0 align-self-center ">
                                                    <div class="avatar-sm rounded-circle bg-danger mini-stat-icon">
                                                        <span class="avatar-title rounded-circle bg-danger">
                                                            <i class="bx bx-archive-in font-size-24"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <p class="text-muted fw-medium">Contributors</p>
                                                    <h4 class="mb-0"> <?php
                                                                        $sql = "SELECT * FROM `contributors`";
                                                                        $results = $conn->query($sql);
                                                                        echo $results->num_rows;

                                                                        ?>
                                                    </h4>
                                                </div>

                                                <div class="flex-shrink-0 align-self-center">
                                                    <div class="avatar-sm rounded-circle bg-success mini-stat-icon">
                                                        <span class="avatar-title rounded-circle bg-success">
                                                            <i class="bx bx-user font-size-24"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <p class="text-muted fw-medium">System Users</p>
                                                    <h4 class="mb-0"> <?php
                                                                        $sql = "SELECT * FROM `users`";
                                                                        $results = $conn->query($sql);
                                                                        echo $results->num_rows;

                                                                        ?>
                                                    </h4>
                                                </div>

                                                <div class="flex-shrink-0 align-self-center">
                                                    <div class="avatar-sm rounded-circle bg-warning mini-stat-icon">
                                                        <span class="avatar-title rounded-circle bg-warning">
                                                            <i class="bx bx-user font-size-24"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->


                        </div>
                    </div>
                    <!-- end row -->


                    <!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Latest Transactions on the System</h4>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                   <th class="align-middle">Transaction Id</th>
                                                    <th class="align-middle">Transaction Type</th>
                                                    <th class="align-middle">Made by User</th>
                                                    <th class="align-middle">Log Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                function time_ago($datetime) {
                                                    $timestamp = strtotime($datetime);
                                                    $difference = time() - $timestamp;
                                                 
                                                    if ($difference < 60) {
                                                       return $difference . " sec ago";
                                                    } elseif ($difference < 3600) {
                                                       return round($difference/60) . " mins ago";
                                                    } elseif ($difference < 86400) {
                                                       return round($difference/3600) . " hours ago";
                                                    } elseif ($difference < 31536000) {
                                                       return round($difference/86400) . " days ago";
                                                    } else {
                                                       return round($difference/31536000) . " years ago";
                                                    }
                                                 }

                                                 $sql = "SELECT * FROM `logs` ORDER BY id DESC";
                                                 $results = $conn->query($sql);
                                                 while($logs = $results->fetch_assoc()){
                                                
                                                ?>
                                                <tr>
                                                    <td><?php echo $logs['transaction_id']?></td>
                                                    <td><?php echo $logs['transaction_type']?></td>
                                                    <td>
                                                    <?php echo $logs['user']?>
                                                    </td>
                                                    <td>
                                                    <?php echo time_ago($logs['log_time'])?>
                                                    </td>
                                                    
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end table-responsive -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Cultural Portal.
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

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- dashboard init -->
    <script src="assets/js/pages/dashboard.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>