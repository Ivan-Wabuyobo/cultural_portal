<?php
session_start();

include "dbconnect.php";
if (!isset($_SESSION['user'])) {
    header("location:login.php");
    
}
    $role = $_SESSION['user']['role'];
    $username = $_SESSION['user']['username'];
    $userId = $_SESSION['user']['user_id'];

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

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include "header.php" ?>

        <!-- ========== Left Sidebar Start ========== -->
        <?php include "usersidebar.php" ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="section-body">

                        <?php
                        if (isset($_POST['submit'])) {

                            //calculate pass mark of the Quiz

                            $total = 0;

                            foreach ($_POST as $key => $value) {
                                if ($value == '1') {
                                    echo "I reached here \n";
                                    $total = $total + 1;
                                }
                            }
                            echo "<script>alert('Hey $username, Thanks for trying out our quiz. You were able to pass $total questions, Well done!!!!. Click OK to try again')</script>";
                        }


                        ?>
                        <form action="" method="post">
                            <div class="col-3">
                                <div class="form-floating mb-2">
                                    <label for="floatingSelect">Attempt Quiz from other tribes</label>
                                    <select class="form-control" id="floatingSelect" aria-label="Floating label select example" name="tribe">
                                        <option selected></option>
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

                        <form action="" method="post">
                            <?php
                            if (isset($_POST['filter'])) {
                                $id = $_POST['tribe'];
                                $query = "SELECT * FROM `questions` WHERE questions.tribe_id='$id'";
                            } else {
                                $query = "SELECT * FROM `questions` WHERE questions.tribe_id='$tribe'";
                            }

                            $results = $conn->query($query);
                            $sn = 1;
                            $questions = $results->num_rows;

                            if ($results->num_rows > 0) {

                                while ($questions = $results->fetch_assoc()) {

                                    $question = $questions['text'];
                                    $question_number = $questions['question'];
                            ?>

                                    <h2 class="mb-4"> <?php echo $sn . ".  "; ?><?php echo $question ?></h2>
                                    <?php
                                    //Get the choices to the question

                                    $sql = "SELECT * FROM `choices` WHERE choices.question_number = '$question_number'";
                                    $result = $conn->query($sql);


                                    while ($choices = $result->fetch_assoc()) {
                                        $name = rand();
                                    ?>
                                        <div class="form-check mb-2" style="margin-left: 30px">
                                            <input class="form-check-input" type="checkbox" value="<?php echo $choices['is_correct']; ?>" name="<?php echo $name; ?>">
                                            <label class="form-check-label text-warning" for="flexCheckDefault" style="font-family: sans-serif;">
                                                <?php echo $choices['choice'] ?>
                                            </label>
                                        </div>
                                    <?php } ?>
                                <?php $sn = $sn + 1;
                                } ?>
                            
                                        <button type="submit" class="btn btn-outline-success" name="submit"><i class='bx bxs-send text-success'></i>Submit Answers</button>
                                   

                        </form>
                    <?php } else { ?>

                        <div class="text-center text-success">
                            <h1>
                                We don't have any quizes for your tribe but your can try quizes for other tribes
                            </h1>
                        </div>
                    <?php } ?>

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