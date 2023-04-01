<?php
session_start();
include "dbconnect.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

    <!-- owl.carousel css -->
    <link rel="stylesheet" href="assets/libs/owl.carousel/assets/owl.carousel.min.css" />

    <link rel="stylesheet" href="assets/libs/owl.carousel/assets/owl.theme.default.min.css" />

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body class="auth-body-bg">
    <?php
  if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE users.username = '$username'";
    $results = $conn->query($sql);
    while($user = $results->fetch_assoc()){
      if($user['password'] == $password){
        if($user['role'] == 0){
          $_SESSION['user'] = $user;
          $username = $user['username'];
          $transaction_id = "#".date('Ym').time();
          $sql = "INSERT INTO `logs`(`transaction_id`, `transaction_type`, `user`) VALUES ('$transaction_id', 'Logged in into the system successfully', '$username')";
          $conn->query($sql);
        header("location: dashboard.php");
        }else if($user['role'] == 1){
        
          $_SESSION['user'] = $user;
          $username = $user['username'];
          $transaction_id = "#".date('Ym').time();
          $sql = "INSERT INTO `logs`(`transaction_id`, `transaction_type`, `user`) VALUES ('$transaction_id', 'Logged in into the system successfully', '$username')";
          $conn->query($sql);
        header("location: article.php");
        }else{
       
          $_SESSION['user'] = $user;
          $username = $user['username'];
          $transaction_id = "#".date('Ym').time();
          $sql = "INSERT INTO `logs`(`transaction_id`, `transaction_type`, `user`) VALUES ('$transaction_id', 'Logged in into the system successfully', '$username')";
          $conn->query($sql);
        header("location: index.php");
        }
      }
    }
  }
  
  ?>
    <div>
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xl-4">
                    <div class="auth-full-bg pt-lg-5 p-4">
                        <div class="w-100">
                            <div class="bg-overlay"></div>
                            <div class="d-flex h-100 flex-column">
                                <div class="p-4 mt-auto">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-7">
                                            <div class="text-center">
                                                <h4 class="mb-3">
                                                    <i
                                                        class="bx bxs-quote-alt-left text-primary h1 align-middle me-3"></i><span
                                                        class="text-primary"></span>Insightful Quotes About Culture <i
                                                        class="bx bxs-quote-alt-right text-primary h1 align-middle me-3"></i>
                                                </h4>

                                                <div dir="ltr">
                                                    <div class="owl-carousel owl-theme auth-review-carousel"
                                                        id="auth-review-carousel">
                                                        <div class="item">
                                                            <div class="py-3">
                                                                <p class="font-size-16 mb-4">
                                                                    " The beauty of the world lies in the diversity of
                                                                    its people. "
                                                                </p>

                                                                <div>
                                                                    <h4 class="font-size-16 text-primary">
                                                                        - Fransica Johnson
                                                                    </h4>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="item">
                                                            <div class="py-3">
                                                                <p class="font-size-16 mb-4">
                                                                    "Never judge someone by the way he looks or a book
                                                                    by the way it’s covered;
                                                                    For inside those tattered pages, there’s a lot to be
                                                                    discovered "
                                                                </p>

                                                                <div>
                                                                    <h4 class="font-size-16 text-primary">
                                                                        - Stephen Cosgrove.
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <div class="py-3">
                                                                <p class="font-size-16 mb-4">
                                                                    "The crucial differences which distinguish human
                                                                    societies and human beings
                                                                    are not biological. They are cultural.” "
                                                                </p>

                                                                <div>
                                                                    <h4 class="font-size-16 text-primary">
                                                                        - Ruth Benedict.
                                                                    </h4>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-xl-6">
                    <div class="auth-full-page-content p-md-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5">
                                    <a href="index.html" class="d-block auth-logo">
                                        <h1>Cultural Portal</h1>
                                    </a>
                                </div>
                                <div class="my-auto">
                                    <div>
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p class="text-muted">
                                            Log in to continue to Cultural Portal.
                                        </p>
                                    </div>

                                    <div class="mt-4">
                                        <form action="" method="post">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="username"
                                                    placeholder="Enter username" name="username" />
                                            </div>

                                            <div class="mb-3">
                                                <div class="float-end">
                                                    <a href="auth-recoverpw-2.html" class="text-muted">Forgot
                                                        password?</a>
                                                </div>
                                                <label class="form-label">Password</label>
                                                <div class="input-group auth-pass-inputgroup">
                                                    <input type="password" class="form-control"
                                                        placeholder="Enter password" aria-label="Password"
                                                        aria-describedby="password-addon" name="password" />
                                                    <button class="btn btn-light" type="button" id="password-addon">
                                                        <i class="mdi mdi-eye-outline"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remember-check" />
                                                <label class="form-check-label" for="remember-check">
                                                    Remember me
                                                </label>
                                            </div>

                                            <div class="mt-3 d-grid">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit"
                                                    name="login">
                                                    Log In
                                                </button>
                                            </div>
                                        </form>
                                        <div class="mt-5 text-center">
                                            <p>
                                                Don't have an account ?
                                                <a href="auth-register-2.html" class="fw-medium text-primary">
                                                    Signup now
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">
                                        ©
                                        <script>
                                        document.write(new Date().getFullYear());
                                        </script>
                                        my culture portal
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <!-- owl.carousel js -->
    <script src="assets/libs/owl.carousel/owl.carousel.min.js"></script>

    <!-- auth-2-carousel init -->
    <script src="assets/js/pages/auth-2-carousel.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

<!-- Mirrored from themesbrand.com/skote/layouts/auth-login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Mar 2023 19:07:55 GMT -->

</html>