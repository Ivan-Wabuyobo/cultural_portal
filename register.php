<?php 
session_start();
include 'dbconnect.php';
?>
<!doctype html>
<html lang="en">
<head>
        
        <meta charset="utf-8" />
        <title>Register</title>
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

    <body>
        <?php
         if (isset($_POST['add_member'])) {
            $surname = $_POST['surname'];
            $othernames = $_POST['othernames'];
            $contact = $_POST['contact'];
            $address = $_POST['address'];
            $tribe = $_POST['tribe'];
            $clan = $_POST['clan'];
            $sql = "INSERT INTO `members`(`surname`, `contact`, `tribe`, `clan`, `other_names`, `address`) VALUES ('$surname', '$contact', '$tribe', '$clan', '$othernames', '$address')";
            $results = $conn->query($sql);
            if ($results) {
                $username =  $_SESSION['user']['username'];
                $transaction_id = "#" . date('Ym') . time();
                $userId = mysqli_insert_id($conn);
                $sql = "INSERT INTO `logs`(`transaction_id`, `transaction_type`, `user`) VALUES ('$transaction_id', 'A new member was added', '$username')";
                $conn->query($sql);
    
                  //insert into users
                  $username = $contact;
                  $role = "2";
                  $password = time();
                  $sql = "INSERT INTO `users`(`username`, `password`, `role`, `user_id`)
                               VALUES ('$username', '$password', '$role', '$userId')";
                  $conn->query($sql);
      
            }
        }
        ?>
        
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Register to Cultural Portal</h5>
                                            <p>Become a contributer now to the cultural portal.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div>
                                    <a href="index.html">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2">
                                    <form class="needs-validation" novalidate action="" method="post">
            
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
                                <input type="text" class="form-control" name="address" placeholder="Address">
                                <span class="input-group-text">
                                    <i class="bx bxs-map"></i>
                                </span>
                            </div>
                        </div>
                    
                                        <div class="mt-4 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit" name='add_member'>Register</button>
                                        </div>
                                        <div class="mt-4 text-center">
                                            <p class="mb-0">By registering you agree to the cultural portal<a href="#" class="text-primary">Terms of Use</a></p>
                                        </div>
                                    </form>
                                </div>
            
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            
                            <div>
                                <p>Already have an account ? <a href="login.php" class="fw-medium text-primary"> Login</a> </p>
                                <p>© <script>document.write(new Date().getFullYear())</script> Cultural portal.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- validation init -->
        <script src="assets/js/pages/validation.init.js"></script>
        
        <!-- App js -->
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

<!-- Mirrored from themesbrand.com/skote/layouts/auth-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Mar 2023 19:07:56 GMT -->
</html>
