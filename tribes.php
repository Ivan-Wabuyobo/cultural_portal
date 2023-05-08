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
    <title>Tribes</title>
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
      if (isset($_POST['add_tribe'])) {
        $name = $_POST['name'];
        $leader = $_POST['leader'];
        $location = $_POST['location'];
        $totem = $_POST['totem'];
        $clans = $_POST['clans'];
        $language = $_POST['language'];
        $values = $_POST['values'];
        $political = $_POST['political'];
        $sql = "INSERT INTO `tribes`(`name`, `current_leader`, `location`, `totem`, `values _and_beliefs`, `political_organization`, `number_of_clans`, `language`) 
                    VALUES ('$name', '$leader', '$location', '$totem', '$values', '$political', '$clans', '$language')";
        $results = $conn->query($sql);
        if($results){
            $username =  $_SESSION['user']['username'] ;
            $transaction_id = "#".date('Ym').time();
            $sql = "INSERT INTO `logs`(`transaction_id`, `transaction_type`, `user`) VALUES ('$transaction_id', 'Added a new tribe', '$username')";
            $conn->query($sql);
        }
    }
    if(isset($_POST['delete'])){
        $id = $_POST['id'];
        $sql = "DELETE FROM `tribes` WHERE tribe_id = '$id'";
        $conn->query($sql);
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
                                <h4 class="mb-sm-0 font-size-18">Registered Tribes</h4>
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
                                                    <i class="fa fa-plus text-white me-1"></i> Add Tribe
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <table id="datatable" class="table table-bordered dt-responsive ">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Leader</th>
                                                <th>Number of members</th>
                                                <th>Number of contributors</th>
                                                <th>Article uploads</th>
                                                <th>Registered</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            function time_ago($datetime) {
                                                $timestamp = strtotime($datetime);
                                                $difference = time() - $timestamp;
                                             
                                                if ($difference < 60) {
                                                   return $difference . " secs ago";
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

                                             $sql = "SELECT *, (SELECT COUNT(articles.article_id) FROM articles  WHERE articles.tribe = tribes.tribe_id) AS articles, (SELECT COUNT(members.id) FROM members WHERE members.id = tribes.tribe_id) AS members, (SELECT COUNT(contributors.id) FROM contributors WHERE contributors.id=tribes.tribe_id) AS contributors FROM `tribes` WHERE tribes.status = '1' ORDER BY tribes.tribe_id DESC";
                                             $results = $conn->query($sql);
                                     
                                             while($tribes = $results->fetch_assoc()
                                             ){
                                            ?>
                                            <tr>
                                                <td><?php echo $tribes['name']?></td>
                                                <td><?php echo $tribes['current_leader']?></td>
                                                <td><?php echo $tribes['members']?></td>
                                                <td><?php echo $tribes['contributors']?></td>
                                                <td><?php echo $tribes['articles']?></td>
                                                <td><?php echo time_ago($tribes['tribe_created_at'])?></td>
                                                <td>
                                                    <div class="input-group mb-3">
                                                        <button onclick="getId(<?php echo $tribes['tribe_id'] ?>)" class="btn" data-bs-toggle="modal" data-bs-target="#deletecontributor">
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
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Tribe</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="js-validation-signin" action="" method="POST">
                        <div class="mb-4">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="name" placeholder="Tribe name">
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="leader" placeholder="Current Leader">
                                <span class="input-group-text">
                                    <i class="bx bx-user-check"></i>
                                </span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="location" placeholder="location">
                                <span class="input-group-text">
                                    <i class="bx bxs-map"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="totem" placeholder="Totem">
                                <span class="input-group-text">
                                    <i class="bx bxs-hot"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="clans" placeholder="Number of Clans">
                                <span class="input-group-text">
                                    <i class="bx bxs-hot"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="language" placeholder="Language Spoken">
                                <span class="input-group-text">
                                    <i class="bx bxs-hot"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <p>Political Organisation</p>
                            <textarea name="political" id="editor" placeholder="Add the tribes politcal organization here!!!">
                                        <!-- &lt;p&gt;Ad&lt;/p&gt; -->
                        </textarea>
                        </div>
                        <div class="mb-4">
                            <p>Culture, Values and beliefs</p>
                            <textarea name="values" id="editor2" placeholder="Add culture, beliefs and values here!!!!">
                                        <!-- &lt;p&gt;Ad&lt;/p&gt; -->
                        </textarea>
                        </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" name="add_tribe">Register Tribe</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--end  Modal -->
       <!--  Modal -->
       <div class="modal fade" id="deletecontributor" tabindex="-1" aria-labelledby="addContributor" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete  Tribe</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="js-validation-signin" action="" method="POST">
                        <input type="hidden" name="id" id="id2">
                        <div class="mb-4">
                            <h3 class="text-warning">
                                Are you sure you want to delete this tribe details
                            </h3>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" name="delete">Proceed</button>
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
    <script>
        
            function getId(id){
                document.getElementById('id2').value = id;
            }
        
    </script>

</body>

<!-- Mirrored from themesbrand.com/skote/layouts/tables-datatable.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Mar 2023 19:08:49 GMT -->

</html>