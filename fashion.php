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
} else {
    $query = "SELECT * FROM `contributors` WHERE id='$userId'";
    $tribe = $conn->query($query)->fetch_assoc()['tribe'];
}

?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Fashion and Design</title>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

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

                    <form action="" method="post">
                        <div class="col-3">
                            <div class="mb-2">
                                <label for="floatingSelect">View fashions from other tribes</label>
                                <select class="form-control" id="floatingSelect" aria-label="Floating label select example" name="tribe">
                                    <option selected> Select Tribe</option>
                                    <?php
                                    $query = "SELECT * FROM `tribes`";
                                    $tribes = $conn->query($query);
                                    while ($rows = $tribes->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $rows['tribe_id'] ?>"><?php echo $rows['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                        <div class="col-3 mb-4">
                            <input type="submit" class="btn btn-outline-info" name="filter" value="Filter"></input>
                        </div>
                    </form>

                    <div class="row">
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
                        if (isset($_POST['filter'])) {
                            $id = $_POST['tribe'];
                            $query = "SELECT * FROM `fashion` WHERE fashion.tribe = '$id' ORDER by fashion.id DESC";
                        } else {
                            $query = "SELECT * FROM `fashion` WHERE fashion.tribe = '$tribe' ORDER by fashion.id DESC";
                        }

                        $results = $conn->query($query);

                        if ($results->num_rows > 0) {

                            while ($fashion = $results->fetch_assoc()) {
                        ?>
                                <div class="col-12">
                                    <div class="card" style="width: 18rem;">
                                        <img src="<?php echo $fashion['image']?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                           
                                            <p class="card-text"><?php echo $fashion['description']?></p>
                                            uploaded <a href="#" class=""><small><?php echo time_ago($fashion['uploaded_at']);?></small></a>
                                        </div>
                                    </div>
                                </div>
                    </div>
                <?php }
                        } else { ?>
                <h1 class="text-danger">
                    No Fashion found
                </h1>
            <?php } ?>
                </div>

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

    < <!--end Modal -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script>
            let editor;
            ClassicEditor
                .create(document.querySelector('#editor'))
                .then(newEditor => {
                    editor = newEditor;

                })
                .catch(error => {
                    console.error(error);
                });
        </script>

        <script>
            let editor2;
            ClassicEditor
                .create(document.querySelector('#editor2'))
                .then(newEditor => {
                    editor2 = newEditor;
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
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