<?php
session_start();
if (!isset($_SESSION['user'])) {
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
    <?php
    if (isset($_POST['add_quiz'])) {
        //Save the question
        $question = $_POST['question'];
        $tribe = $_POST['tribe'];

         //Save the audit
         $username =  $_SESSION['user']['username'] ;
         $transaction_id = "#".date('Ym').time();
         $sql = "INSERT INTO `logs`(`transaction_id`, `transaction_type`, `user`) VALUES ('$transaction_id', 'Added a new question', '$username')";
         $conn->query($sql);

        $query = "INSERT INTO `questions`(`tribe_id`, `text`) VALUES ('$tribe', '$question')";
        $conn->query($query);

        //Save the choices to that question
        $questionId = mysqli_insert_id($conn);

        //Save the first choice
        if(isset($_POST['one']) && $_POST['answer'] == 1){
            $choice = $_POST['one'];
            $sql = "INSERT INTO `choices`(`question_number`, `choice`, `is_correct`) VALUES ('$questionId', '$choice', '1')";
            $conn->query($sql);

        }else if(isset($_POST['one'])  && !empty($_POST['one'])){
            $choice = $_POST['one'];
            $sql = "INSERT INTO `choices`(`question_number`, `choice`) VALUES ('$questionId', '$choice')";
            $conn->query($sql);

        }

        if(isset($_POST['two']) && $_POST['answer'] == 2){
            $choice = $_POST['two'];
            $sql = "INSERT INTO `choices`(`question_number`, `choice`, `is_correct`) VALUES ('$questionId', '$choice', '1')";
            $conn->query($sql);

        }else if(isset($_POST['two'])  && !empty($_POST['two'])){
            $choice = $_POST['two'];
            $sql = "INSERT INTO `choices`(`question_number`, `choice`) VALUES ('$questionId', '$choice')";
            $conn->query($sql);

        }

        if(isset($_POST['three']) && $_POST['answer'] == 3){
            $choice = $_POST['three'];
            $sql = "INSERT INTO `choices`(`question_number`, `choice`, `is_correct`) VALUES ('$questionId', '$choice', '1')";
            $conn->query($sql);

        }else if(isset($_POST['three'])  && !empty($_POST['three'])){
            $choice = $_POST['three'];
            $sql = "INSERT INTO `choices`(`question_number`, `choice`) VALUES ('$questionId', '$choice')";
            $conn->query($sql);

        }

        if(isset($_POST['four']) && $_POST['answer'] == 4){
            $choice = $_POST['four'];
            $sql = "INSERT INTO `choices`(`question_number`, `choice`, `is_correct`) VALUES ('$questionId', '$choice', '1')";
            $conn->query($sql);

        }else if(isset($_POST['four'])  && !empty($_POST['four'])){
            $choice = $_POST['four'];
            $sql = "INSERT INTO `choices`(`question_number`, `choice`) VALUES ('$questionId', '$choice')";
            $conn->query($sql);

        }

        if(isset($_POST['five']) && $_POST['answer'] == 5){
            $choice = $_POST['five'];
            $sql = "INSERT INTO `choices`(`question_number`, `choice`, `is_correct`) VALUES ('$questionId', '$choice', '1')";
            $conn->query($sql);

        }else if(isset($_POST['five']) && !empty($_POST['five'])){
            $choice = $_POST['five'];
            $sql = "INSERT INTO `choices`(`question_number`, `choice`) VALUES ('$questionId', '$choice')";
            $conn->query($sql);

        }

        if(isset($_POST['six']) && $_POST['answer'] == 6){
            $choice = $_POST['six'];
            $sql = "INSERT INTO `choices`(`question_number`, `choice`, `is_correct`) VALUES ('$questionId', '$choice', '1')";
            $conn->query($sql);

        }else if(isset($_POST['six']) && !empty($_POST['six'])){
            $choice = $_POST['six'];
            $sql = "INSERT INTO `choices`(`question_number`, `choice`) VALUES ('$questionId', '$choice')";
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
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Quiz center</h4>
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
                                            <h3>Tribes</h3>
                                            <span>
                                                <button type="button" class="js-swal-confirm btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addtribe">
                                                    <i class="fa fa-plus text-white me-1"></i> Add Quiz
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <table id="datatable" class="table table-bordered dt-responsive ">
                                        <thead>
                                            <tr>
                                                <th>sn</th>
                                                <th>Tribe</th>
                                                <th>Number of quizes</th>
                                                <th>Last added</th>
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

                                            $sql = "SELECT questions.created,(COUNT(questions.tribe_id)) AS num, (SELECT name FROM tribes WHERE tribes.tribe_id = questions.tribe_id) AS tribe FROM `questions` GROUP BY questions.tribe_id ORDER  BY questions.question DESC";
                                            $results = $conn->query($sql);

                                            $sn = 1;
                                            while ($rows = $results->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                     <td><?php echo $sn?></td>
                                                    <td><?php echo $rows['tribe'] ?></td>
                                                    <td><?php echo $rows['num'] ?></td>
                                                     <td><?php echo time_ago($rows['created']) ?></td>
                                                </tr>
                                                
                                            <?php $sn = $sn + 1; } ?>
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
                            </script> © Cultural Portal
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!--Add  Modal -->
    <div class="modal fade" id="addtribe" tabindex="-1" aria-labelledby="addtribe" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">QUIZ CENTER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="js-validation-signin" action="" method="POST">
                        <div class="form-floating mb-2">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="tribe">
                                <?php
                                $query = "SELECT * FROM `tribes`";
                                $tribes = $conn->query($query);
                                while ($rows = $tribes->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $rows['tribe_id'] ?>"><?php echo $rows['name'] ?></option>
                                <?php } ?>
                            </select>
                            <label for="">Please Select Tribe</label>

                        </div>
                        <div class="mb-2">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="question" placeholder="Write the Question">
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="one" placeholder="Choice one">
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="two" placeholder="Choice Two">
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="three" placeholder="Choice Three">
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="four" placeholder="choice Four">
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="five" placeholder="Choice Five">
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="six" placeholder="Choice Six">
                            </div>
                        </div>
                </div>
                <label for="" class="ms-4">Select the correct choice</label>
                <div class="mb-2 ms-4" style="width: 50px">
              
                    <div class="input-group">
                        <input type="number" class="form-control" name="answer" >
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" name="add_quiz">Save</button>
            </div>
            </div>
           
            </form>
        </div>
    </div>
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