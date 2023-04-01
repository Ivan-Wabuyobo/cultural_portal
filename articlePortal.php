<?php
session_start();
include "dbconnect.php";

?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Article Portal</title>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <style>
        .ck-editor__editable {
            min-height: 400px !important;
        }

        textarea::placeholder {
            font: 80px/3 sans-serif;
        }
    </style>


</head>

<body data-sidebar="dark" data-layout-mode="light">

    <?php
    if (isset($_POST['addArticle'])) {
        $title = $_POST['title'];
        $clan = $_POST['clan'];
        $tribe = $_POST['tribe'];
        $article = $_POST['article'];
        $aurthor = $_SESSION['user']['user_id'];

        $sql = "INSERT INTO `articles`( `tittle`, `clan`, `tribe`, `body`, `created_by`) VALUES ('$title', '$clan', '$tribe', '$article', '$aurthor')";

        $results = $conn->query($sql);
        if ($results) {
            $username =  $_SESSION['user']['username'];
            $transaction_id = "#" . date('Ym') . time();
            $sql = "INSERT INTO `logs`(`transaction_id`, `transaction_type`, `user`) VALUES ('$transaction_id', 'A new article was added through the article portal', '$username')";
            $conn->query($sql);
        }
    }

    ?>

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box text-success  px-3 font-size-16 header-item waves-effect pt-3">
                        <h2><i class="bx bx-food-menu"></i>Article Portal</h2>
                    </div>
                    <button hidden type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    <p class="text-white">hello hello</p>
                    <a href="gallery_portal.php" class="pt-4">
                        <h3>
                            <i class="bx bx-image-add"></i>
                            Add Gallery
                        </h3>
                    </a>
                    <a href="video.php" class="pt-4 ps-5">
                        <h3>
                            <i class="bx bx-video-plus"></i>
                            Add Animations/videos
                        </h3>
                    </a>
                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-user text-success" style="font-size: 35px;"></i>
                            <span class="d-none d-xl-inline-block ms-1" key="t-henry"><?php echo $_SESSION['user']['username']?></span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i>
                                <span key="t-profile">Profile</span></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="logout.php"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">

                        <div class="col-12">
                            <h2 class="text-danger"> <i class="bx bx-food-menu"></i>Cultural portal Article Editor</h2>
                            <p class="mb-5">Use the portal article editor to customise and beautify how you would want you article to look with most features included.</p>


                            <form action="" method="post">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Article Title</label>
                                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Title of the article">
                                </div>
                                <p>Attach Tribe</p>
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
                                <p>Attach clan if any</p>
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

                                <textarea name="article" id="editor" placeholder="Add Your Article here">
                                        <!-- &lt;p&gt;Ad&lt;/p&gt; -->
                            </textarea>
                                <button class="btn btn-success mt-3" type="submit" name="addArticle"> <i class="bx bx-check-circle "></i> Save Article </button>
                            </form>


                        </div>
                    </div>

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <footer class="footer ">

                <div class="row">
                    <div class="col-sm-12 text-center font-size-15">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Cultural Portal
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
    <script>
        let editor;
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(newEditor => {
                editor = newEditor;
                height = '500px';
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