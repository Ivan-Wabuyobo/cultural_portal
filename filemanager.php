<?php
session_start();
include "dbconnect.php";

?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>File manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

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

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">System File manager</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="d-xl-flex">
                        <div class="w-100">
                            <div class="d-md-flex">
                                <!-- filemanager-leftsidebar -->

                                <div class="w-100">
                                    <div class="card">
                                        <div class="card-body">
                                            <div>
                                                <div class="row mb-3">
                                                    <div class="col-xl-3 col-sm-6">
                                                        <div class="mt-2">
                                                            <h5>My Files</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-9 col-sm-6">
                                                        <form
                                                            class="mt-4 mt-sm-0 float-sm-end d-flex align-items-center">
                                                            <div class="search-box mb-2 me-2">
                                                                <div class="position-relative">
                                                                    <input type="text"
                                                                        class="form-control bg-light border-light rounded"
                                                                        placeholder="Search...">
                                                                    <i class="bx bx-search-alt search-icon"></i>
                                                                </div>
                                                            </div>

                                                            <div class="dropdown mb-0">
                                                                <a class="btn btn-link text-muted mt-n2" role="button"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                                    <i class="mdi mdi-dots-vertical font-size-20"></i>
                                                                </a>

                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item" href="#">Share Files</a>
                                                                    <a class="dropdown-item" href="#">Share with me</a>
                                                                    <a class="dropdown-item" href="#">Other Actions</a>
                                                                </div>
                                                            </div>


                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="row">
                                                    <?php
                                                    function convertBytes($bytes, $unit = null) {
                                                        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
                                                        $i = 0;
                                                        while ($bytes >= 1024 && $i < count($units) - 1) {
                                                            $bytes /= 1024;
                                                            $i++;
                                                        }
                                                        return round($bytes, 2) . ($unit ? ' ' . $unit : ' ' . $units[$i]);
                                                    }

                                                    $sql = "SELECT *, (SELECT COUNT(gallery.id) FROM gallery WHERE gallery.tribe=tribes.tribe_id) AS gallery, (SELECT SUM(gallery.size) FROM gallery WHERE gallery.tribe=tribes.tribe_id) AS gallery_size, (SELECT COUNT(video.id) FROM video WHERE video.tribe = tribes.tribe_id) AS videos , (SELECT SUM(video.video_size) FROM video WHERE video.tribe = tribes.tribe_id) AS video_size FROM `tribes`";
                                                    $results = $conn->query($sql);
                                                    while ($item = $results->fetch_assoc()) {
                                                    ?>
                                                    <div class="col-xl-4 col-sm-6">
                                                        <div class="card shadow-none border">
                                                            <div class="card-body p-3">
                                                                <div class="">
                                                                    <div class="float-end ms-2">
                                                                        <div class="dropdown mb-2">
                                                                            <a class="font-size-16 text-muted"
                                                                                role="button" data-bs-toggle="dropdown"
                                                                                aria-haspopup="true">
                                                                                <i class="mdi mdi-dots-horizontal"></i>
                                                                            </a>

                                                                            <div
                                                                                class="dropdown-menu dropdown-menu-end">
                                                                                <a class="dropdown-item"
                                                                                    href="#">Open</a>

                                                                                <a class="dropdown-item"
                                                                                    href="#">Close</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-xs me-3 mb-3">
                                                                        <div
                                                                            class="avatar-title bg-transparent rounded">
                                                                            <i
                                                                                class="bx bxs-folder font-size-24 text-warning"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex">
                                                                        <div class="overflow-hidden me-auto">
                                                                            <h5 class="font-size-14 text-truncate mb-1">
                                                                                <a href="javascript: void(0);"
                                                                                    class="text-body"><?php echo $item['name']; ?></a>
                                                                            </h5>
                                                                            <p class="text-muted text-truncate mb-0">
                                                                                <?php $total = $item['gallery'] + $item['videos'];

                                                                                                                            echo $total; ?>
                                                                                Files</p>
                                                                        </div>
                                                                        <div class="align-self-end ms-2">
                                                                            <p class="text-muted mb-0"><?php
                                                                                $total_size = $item['gallery_size'] + $item['video_size'];

                                                                               echo convertBytes($total_size);
                                                                                ?></p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                <!-- end row -->
                                            </div>

                                            <div class="mt-4">
                                                <div class="d-flex flex-wrap">
                                                    <h5 class="font-size-16 me-3">Recent Files</h5>

                                                    <div class="ms-auto">
                                                        <a href="javascript: void(0);" class="fw-medium text-reset">View
                                                            All</a>
                                                    </div>
                                                </div>
                                                <hr class="mt-2">

                                                <div class="table-responsive">
                                                    <table class="table align-middle table-nowrap table-hover mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Date modified</th>
                                                                <th scope="col" colspan="2">Size</th>
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
                                                                        return round($difference/60) . " min ago";
                                                                    } elseif ($difference < 86400) {
                                                                        return round($difference/3600) . " hour ago";
                                                                    } elseif ($difference < 31536000) {
                                                                        return round($difference/86400) . " day ago";
                                                                    } else {
                                                                        return round($difference/31536000) . " year ago";
                                                                    }
                                                                 }
                                                            $sql = "SELECT * FROM gallery WHERE status='1' ORDER BY gallery.id DESC";
                                                            $results = $conn->query($sql);

                                                            while($item = $results->fetch_assoc()){
                                                            
                                                            ?>
                                                            <tr>
                                                                <td><a href="<?php echo $item['image_name']?>"
                                                                        class="text-dark fw-medium"><i
                                                                            class="mdi mdi-file-document font-size-16 align-middle text-primary me-2"></i>
                                                                        <?php echo $item['image_name'];?></a></td>
                                                                <td><?php echo time_ago( $item['uploaded_at'])?></td>
                                                                <td><?php echo convertBytes( $item['size'])?></td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <a class="font-size-16 text-muted" role="button"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-haspopup="true">
                                                                            <i class="mdi mdi-dots-horizontal"></i>
                                                                        </a>

                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <a class="dropdown-item" href="#">Open</a>
                                                                            <a class="dropdown-item" href="#">Edit</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end w-100 -->
                            </div>
                        </div>

                        <div class="card filemanager-sidebar ms-lg-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <h5 class="font-size-15 mb-4">Storage Manager</h5>
                                    <div class="apex-charts" id="radial-chart" data-colors='["--bs-primary"]'></div>

                                </div>

                                <div class="mt-4">
                                    <div class="card border shadow-none mb-2">
                                        <a href="javascript: void(0);" class="text-body">
                                            <div class="p-2">
                                                <div class="d-flex">
                                                    <div class="avatar-xs align-self-center me-2">
                                                        <div
                                                            class="avatar-title rounded bg-transparent text-success font-size-20">
                                                            <i class="mdi mdi-image"></i>
                                                        </div>
                                                    </div>

                                                    <div class="overflow-hidden me-auto">
                                                        <h5 class="font-size-13 text-truncate mb-1">Images</h5>
                                                        <?php
                                                        
                                                        $sql = "SELECT * FROM `gallery` WHERE status = '1'";
                                                        $results = $conn->query($sql);

                                                        ?>
                                                        <p class="text-muted text-truncate mb-0"><?php echo $results
                                                                                                        ->num_rows ?>
                                                            Files</p>
                                                    </div>

                                                    <div class="ms-2">
                                                        <p class="text-muted"><?php
                                                        $sql = "SELECT SUM(size) AS size FROM `gallery` WHERE status = '1'";
                                                        $results = $conn->query($sql);
                                                        $size = $results->fetch_assoc()['size'];
                                                        echo convertBytes($size)?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="card border shadow-none mb-2">
                                        <a href="javascript: void(0);" class="text-body">
                                            <div class="p-2">
                                                <div class="d-flex">
                                                    <div class="avatar-xs align-self-center me-2">
                                                        <div
                                                            class="avatar-title rounded bg-transparent text-danger font-size-20">
                                                            <i class="mdi mdi-play-circle-outline"></i>
                                                        </div>
                                                    </div>

                                                    <div class="overflow-hidden me-auto">
                                                        <h5 class="font-size-13 text-truncate mb-1">Video</h5>
                                                        <?php
                                                        $sql = "SELECT * FROM `video` WHERE status = '1'";
                                                        $results = $conn->query($sql);

                                                        ?>
                                                        <p class="text-muted text-truncate mb-0"><?php echo $results
                                                                                                        ->num_rows ?>
                                                            Files</p>
                                                    </div>

                                                    <div class="ms-2">

                                                        <p class="text-muted"> <?php
                                                        $sql = "SELECT SUM(video_size) AS size FROM `video` where status='1'";
                                                        $results = $conn->query($sql);
                                                        $size = $results->fetch_assoc()['size'];
                                                        echo convertBytes($size)
                                                        ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="card border shadow-none mb-2">
                                        <a href="javascript: void(0);" class="text-body">
                                            <div class="p-2">
                                                <div class="d-flex">
                                                    <div class="avatar-xs align-self-center me-2">
                                                        <div
                                                            class="avatar-title rounded bg-transparent text-info font-size-20">
                                                            <i class="mdi mdi-music"></i>
                                                        </div>
                                                    </div>

                                                    <div class="overflow-hidden me-auto">
                                                        <h5 class="font-size-13 text-truncate mb-1">Music</h5>
                                                        <p class="text-muted text-truncate mb-0">0 Files</p>
                                                    </div>
                                                    <div class="ms-2">
                                                        <p class="text-muted">0 kb</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="card border shadow-none mb-2">
                                        <a href="javascript: void(0);" class="text-body">
                                            <div class="p-2">
                                                <div class="d-flex">
                                                    <div class="avatar-xs align-self-center me-2">
                                                        <div
                                                            class="avatar-title rounded bg-transparent text-primary font-size-20">
                                                            <i class="mdi mdi-file-document"></i>
                                                        </div>
                                                    </div>

                                                    <div class="overflow-hidden me-auto">
                                                        <h5 class="font-size-13 text-truncate mb-1">Document</h5>
                                                        <p class="text-muted text-truncate mb-0">0 Files</p>
                                                    </div>

                                                    <div class="ms-2">
                                                        <p class="text-muted">0 kb</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
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
                            Cultural portal
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                            </div>
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