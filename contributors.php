<?php
session_start();
include "dbconnect.php";

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

    <?php
    if (isset($_POST['add_contributor'])) {
        $surname = $_POST['surname'];
        $othernames = $_POST['othernames'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $tribe = $_POST['tribe'];
        $clan = $_POST['clan'];
        $sql = "INSERT INTO `contributors`(`full_name`, `other_names`, `email`, `contact`, `address`, `tribe`, `clan`) 
                VALUES ('$surname', '$othernames', '$email', '$contact', '$address', '$tribe', '$clan')";
        $results = $conn->query($sql);
        if ($results) {
            $userId = mysqli_insert_id($conn);
            $username =  $_SESSION['user']['username'];
            $transaction_id = "#" . date('Ym') . time();
            $sql = "INSERT INTO `logs`(`transaction_id`, `transaction_type`, `user`) VALUES ('$transaction_id', 'A new contributor added', '$username')";
            $conn->query($sql);

            //insert into users
            $username = $contact;
            $role = "1";
            $password = time();
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
                                            <h3>Contributors</h3>
                                            <span>
                                                <button type="button" class="js-swal-confirm btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addContributor">
                                                    <i class="fa fa-plus text-white me-1"></i> Add Contributor
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <table id="datatable" class="table table-bordered dt-responsive">
                                        <thead>
                                            <tr>
                                                <th>Surname</th>
                                                <th>other names</th>
                                                <th>Contact</th>
                                                <th>Address</th>
                                                <th>Tribe</th>
                                                <th>Clan</th>
                                                <th>Article uploads</th>
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
                                            $sql = "SELECT *, (SELECT COUNT(article_id) FROM articles WHERE created_by=contributors.id) AS articles FROM `contributors` JOIN tribes ON contributors.tribe = tribes.tribe_id JOIN clans ON contributors.clan = clans.clan_id WHERE contributors.status='1' ORDER BY contributors.id DESC";
                                            $results = $conn->query($sql);
                                            while ($contributors = $results->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $contributors['full_name'] ?></td>
                                                    <td><?php echo $contributors['other_names'] ?></td>
                                                    <td><?php echo $contributors['contact'] ?></td>
                                                    <td><?php echo $contributors['address'] ?></td>
                                                    <td><?php echo $contributors['name'] ?></td>
                                                    <td><?php echo $contributors['clan_name'] ?></td>
                                                    <td><?php echo $contributors['articles'] ?></td>
                                                    <td><?php echo time_ago($contributors['created']) ?></td>

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
                                            <?php
                                            }
                                            ?>
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
    <div class="modal fade" id="addContributor" tabindex="-1" aria-labelledby="addContributor" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Contributor</h1>
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
                            <select class="form-select" aria-label="Tribe" name="tribe" id='tribe' onchange="populateClans()">
                                <option selected>Choose Tribe</option>
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
                            <select class="form-select" aria-label="Clan" name="clan" id='clan'>
                                <option selected>Choose Your Clan</option> 
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
                                <input type="email" class="form-control" name="email" placeholder="Email">
                                <span class="input-group-text">
                                    <i class="bx bx-message-square-dots"></i>
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
                    <button type="submit" class="btn btn-success" name="add_contributor">Add Contributor</button>
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
            function populateClans() {
                // get the selected tribe id
                const tribeId = document.getElementById('tribe').value;

                // make an AJAX request to fetch the clans for the selected tribe
                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'getClans.php?tribe=' + tribeId, true);
                xhr.send();
                xhr.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                    // parse the response JSON and populate the clans select element with the options
                    const clans = JSON.parse(this.responseText);
                    const clanSelect = document.getElementById('clan');
                    clanSelect.innerHTML = '<option value="">Select a clan</option>';
                    clans.forEach((clan)=> {
                        clanSelect.innerHTML += '<option value="' + clan.clan_id + '">' + clan.clan_name + '</option>';
                    });
                    }
                };
                
                }

        </script>

</body>

<!-- Mirrored from themesbrand.com/skote/layouts/tables-datatable.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Mar 2023 19:08:49 GMT -->

</html>