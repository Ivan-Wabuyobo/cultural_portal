<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}elseif ($_SESSION['user']['role'] != 0){
    header("location:login.php");
}
include "dbconnect.php";

?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Quiz Center</title>
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
        <?php include "sidebar.php" ?>
        <!-- Left Sidebar End -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <form action="" method="post">
                            <div class="col-3">
                                <div class="form-floating mb-2">
                                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="tribe">
                                        <option selected></option>
                                        <?php
                                        $query = "SELECT * FROM `tribes`";
                                        $tribes = $conn->query($query);
                                        while ($rows = $tribes->fetch_assoc()) {
                                        ?>
                                            <option value="<?php echo $rows['tribe_id'] ?>"><?php echo $rows['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="">Filter by Tribe</label>

                                </div>

                            </div>
                            <div class="col-3 mb-4">
                                <input type="submit" class="btn btn-outline-info" name="filter" value="Filter"></input>
                            </div>
                        </form>

                    </div>
                    <!-- end page title -->
                  
                        <?php
                        if(isset($_POST['filter'])){
                            $id = $_POST['tribe'];
                            $query = "SELECT * FROM `questions` WHERE tribe_id='$id' ORDER BY tribe_id DESC";

                        }else{
                            $query = "SELECT * FROM `questions` ORDER BY tribe_id DESC";

                        }
                        $results = $conn->query($query);
                        $sn = 1;
                        if($results->num_rows > 0){

                        while ($questions = $results->fetch_assoc()) {

                            $question = $questions['text'];
                            $question_number = $questions['question'];
                        ?>

                            <h2 class="mb-4"> <?php echo $sn . ".  "; ?><?php echo $question ?></h2>
                            <?php
                            //Get the choices to the question

                            $sql = "SELECT * FROM `choices` WHERE choices.question_number = '$question_number'";
                            $result = $conn->query($sql);
                            $name = 1;

                            while ($choices = $result->fetch_assoc()) { ?>
                                <div class="form-check mb-2" style="margin-left: 30px">
                                    <input class="form-check-input" type="checkbox" value="<?php echo $choices['is_correct']; ?>" name="<?php echo $name; ?>" <?php if ($choices['is_correct'] == 1) {
                                                                                                                                                                    echo "checked";
                                                                                                                                                                } ?>>
                                    <label class="form-check-label text-warning" for="flexCheckDefault" style="font-family: sans-serif;">
                                        <?php echo $choices['choice'] ?>
                                    </label>
                                </div>
                            <?php $name = $name + 1;
                            } ?>
                        <?php $sn = $sn + 1;
                        } }else{?>
                        
                        <div class="text-center">
                        <i class='bx bx-error-alt bx-lg text-danger'></i>
                            <h1 class="text-danger">
                                No quizes Available
                            </h1>
                        </div>
                        <?php } ?>
                    
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <footer class="footer text-center">
                <div class="container-fluid text-center">
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

    </div>

    <!--end  Modal -->

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