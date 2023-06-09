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
    <title>Chat</title>
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

<body data-sidebar="dark" data-layout-mode="light">
    <!-- Sending a message -->
    <?php 
    if(isset($_GET['id'])){
        $_SESSION['chat_id'] = $_GET['id'];
    }
    
    if(isset($_POST['send']) AND isset($_POST['message'])){
    $senderId = $_SESSION['user']['id'];
    $receiverId = '4';
    $message = $_POST['message'];
    $chatId = $_SESSION['chat_id'];
    $sql = "INSERT INTO `messages`(`message`, `sender`, `receiver`, `chat_id`) 
                        VALUES ('$message', '$senderId', '$receiverId', '$chatId')";

    $results = $conn->query($sql);


    }?>

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
                                <h4 class="mb-sm-0 font-size-18">Chat</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="d-lg-flex">
                        <div class="chat-leftsidebar me-lg-4">
                            <div class="">
                                <div class="py-4 border-bottom">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 align-self-center me-3">
                                            <i class='bx bx-user bx-md'></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="font-size-15 mb-1">
                                                <?php echo ucfirst($_SESSION['user']['username']) ?></h5>
                                            <p class="text-muted mb-0"><i
                                                    class="mdi mdi-circle text-success align-middle me-1"></i> Active
                                            </p>
                                        </div>

                                        <div class="fs-2">
                                        <i class='bx bx-message-square-dots text-success'></i>
                                        <a href="">New chat</a>
                                         <span class="pb-2"> </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="search-box chat-search-box py-4">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <i class="bx bx-search-alt search-icon"></i>
                                    </div>
                                </div>

                                <div class="chat-leftsidebar-nav">
                                    <ul class="nav nav-pills nav-justified">
                                        <li class="nav-item">
                                            <a href="#chat" data-bs-toggle="tab" aria-expanded="true"
                                                class="nav-link active">
                                                <i class="bx bx-chat font-size-20 d-sm-none"></i>
                                                <span class="d-none d-sm-block">Chats</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#groups" data-bs-toggle="tab" aria-expanded="false"
                                                class="nav-link">
                                                <i class="bx bx-group font-size-20 d-sm-none"></i>
                                                <span class="d-none d-sm-block">Groups</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content py-4">
                                        <div class="tab-pane show active" id="chat">
                                            <div>
                                                <h5 class="font-size-14 mb-3">Recent</h5>
                                                <ul class="list-unstyled chat-list" data-simplebar
                                                    style="max-height: 410px;">
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
                                                            return round($difference / 3600) . " hrs ago";
                                                        } elseif ($difference < 31536000) {
                                                            return round($difference / 86400) . " days ago";
                                                        } else {
                                                            return round($difference / 31536000) . " yrs ago";
                                                        }
                                                    }
                                                    $userId = $_SESSION['user']['id'];
                                                    $sql = "SELECT chat_id FROM `user_chat` WHERE user_id = '$userId'";
                                                    $results = $conn->query($sql);
                                                    while ($users = $results->fetch_assoc()) {
                                                        $chatId = $users['chat_id'];
                                                        $sql1 = "SELECT * FROM `messages` WHERE messages.chat_id = '$chatId' ORDER BY messages.id DESC LIMIT 1";
                                                        $results2 = $conn->query($sql1);
                                                        while ($new_mess = $results2->fetch_assoc()) {

                                                    ?>
                                                    <li>
                                                        <a href="?id=<?php echo $new_mess['chat_id']; ?>">
                                                            <div class="d-flex">
                                                                <div class="flex-shrink-0 align-self-center me-3">
                                                                    <i
                                                                        class="mdi mdi-circle text-success font-size-10"></i>
                                                                </div>
                                                                <div class="avatar-xs align-self-center me-3">
                                                                    <?php
                                                                            $senderId = $new_mess['sender'];
                                                                            if ($senderId == $_SESSION['user']['id']) {
                                                                                $senderId = $new_mess['receiver'];
                                                                            }
                                                                            $sql2 = "SELECT * FROM `users` WHERE users.id = '$senderId'";
                                                                            $result2 = $conn->query($sql2);

                                                                            $sender = $result2->fetch_assoc()['username'];
                                                                            ?>
                                                                    <span
                                                                        class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                        <?php
                                                                                echo ucfirst(trim($sender)[0]);
                                                                                ?>
                                                                    </span>
                                                                </div>
                                                                <div class="flex-grow-1 overflow-hidden">
                                                                    <h5 class="text-truncate font-size-14 mb-1">

                                                                        <?php

                                                                                echo ucfirst($sender);
                                                                                ?>
                                                                    </h5>
                                                                    <p class="text-truncate mb-0">
                                                                        <?php echo $new_mess['message'] ?>
                                                                    </p>
                                                                </div>
                                                                <div class="font-size-11"><?php
                                                                                                    echo time_ago($new_mess['sent_at']);
                                                                                                    ?></div>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    <?php }
                                                    } ?>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="groups">
                                            <h5 class="font-size-14 mb-3">Groups</h5>
                                            <ul class="list-unstyled chat-list" data-simplebar
                                                style="max-height: 410px;">
                                                <li>
                                                    <a href="javascript: void(0);">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar-xs">
                                                                    <span
                                                                        class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                        B
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <div class="flex-grow-1">
                                                                <h5 class="font-size-14 mb-0">Buganda</h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="javascript: void(0);">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar-xs">
                                                                    <span
                                                                        class="avatar-title rounded-circle bg-primary bg-soft text-primary">
                                                                        B
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <div class="flex-grow-1">
                                                                <h5 class="font-size-14 mb-0">Busoga</h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <?php if (isset($_GET['id'])) {

                            $chat_id = $_GET['id'];

                            $sql = "SELECT * FROM `messages` WHERE chat_id = '$chat_id' LIMIT 1";
                            $results = $conn->query($sql);
                            while ($messages = $results->fetch_assoc()) {
                                $senderId = $messages['sender'];
                                if ($senderId == $_SESSION['user']['id']) {
                                    $senderId = $messages['receiver'];
                                } 
                                    $sql = "SELECT username FROM users WHERE users.id = '$senderId'";
                                    $sender = $conn->query($sql)->fetch_assoc()['username'];
                                
                        ?>
                        <div class="w-100 user-chat" >
                            <div class="card" id="chatBox">
                                <div class="p-4 border-bottom">
                                    <div class="row">
                                        <div class="col-md-4 col-9">
                                            <h5 class="font-size-15 mb-1"><?php echo ucfirst($sender); } ?></h5>
                                            <p class="text-muted mb-0"><i
                                                    class="mdi mdi-circle text-success align-middle me-1"></i> Active
                                                now</p>
                                        </div>
                                        <div class="col-md-8 col-3">
                                            <ul class="list-inline user-chat-nav text-end mb-0">
                                                <li class="list-inline-item d-none d-sm-inline-block">
                                                    <div class="dropdown">
                                                        <button class="btn nav-btn dropdown-toggle" type="button"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="bx bx-search-alt-2"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-md">
                                                            <form class="p-3">
                                                                <div class="form-group m-0">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Search ..."
                                                                            aria-label="Recipient's username">

                                                                        <button class="btn btn-primary" type="submit"><i
                                                                                class="mdi mdi-magnify"></i></button>

                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-inline-item  d-none d-sm-inline-block">
                                                    <div class="dropdown">
                                                        <button class="btn nav-btn dropdown-toggle" type="button"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="bx bx-cog"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">View Profile</a>
                                                            <a class="dropdown-item" href="#">Delete Chat</a>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="list-inline-item">
                                                    <div class="dropdown">
                                                        <button class="btn nav-btn dropdown-toggle" type="button"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="bx bx-dots-horizontal-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Coming soon</a>

                                                        </div>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>


                                <div>
                                    <div class="chat-conversation p-3">
                                        <ul class="list-unstyled mb-0" data-simplebar style="max-height: 486px;">

                                            <?php

                                                $chat_id = $_GET['id'];

                                                $sql = "SELECT * FROM `messages` WHERE chat_id = '$chat_id'";
                                                $results = $conn->query($sql);
                                                while ($messages = $results->fetch_assoc()) {
                                                    $senderId = $messages['sender'];
                                                    if ($senderId == $_SESSION['user']['id']) {
                                                        $sender = $_SESSION['user']['username'];
                                                    } else {
                                                        $sql = "SELECT username FROM users WHERE users.id = '$senderId'";
                                                        $sender = $conn->query($sql)->fetch_assoc()['username'];
                                                    }


                                                ?>

                                            <?php if ($sender != $_SESSION['user']['username']) { ?>

                                            <li>
                                                <div class="conversation-list">

                                                    <div class="ctext-wrap">
                                                        <div class="conversation-name  fw-bold"><?php echo ucfirst($sender) ?></div>
                                                        <p class=" fw-bold">
                                                            <?php echo $messages['message']; ?>
                                                        </p>
                                                        <p class="chat-time mb-0"><i
                                                                class="bx bx-time-five align-middle me-1"></i>
                                                            <?php echo time_ago($messages['sent_at']);?></p>
                                                    </div>

                                                </div>
                                            </li>

                                            <?php } else { ?>

                                            <li class="right">
                                                <div class="conversation-list ">

                                                    <div class="ctext-wrap" style="background-color: #dcf8c6">
                                                        <div class="conversation-name  fw-bold">You</div>
                                                        <p class=" fw-bold">
                                                            <?php echo $messages['message'] ?>
                                                        </p>

                                                        <p class="chat-time mb-0"><i
                                                                class="bx bx-time-five align-middle me-1 "></i>
                                                            <?php echo time_ago($messages['sent_at']) ?></p>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php }
                                                } ?>
                                        </ul>
                                    </div>
                                    <div class="p-3 chat-input-section">
                                        <form action="" method="post">
                                        <div class="row">
                                            <div class="col">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control chat-input" name="message"
                                                        placeholder="Enter Message...">
                                                    <div class="chat-input-links" id="tooltip-container">
                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item"><a href="javascript: void(0);"
                                                                    title="Emoji"><i
                                                                        class="mdi mdi-emoticon-happy-outline"></i></a>
                                                            </li>
                                                            <li class="list-inline-item"><a href="javascript: void(0);"
                                                                    title="Images"><i
                                                                        class="mdi mdi-file-image-outline"></i></a></li>
                                                            <li class="list-inline-item"><a href="javascript: void(0);"
                                                                    title="Add Files"><i
                                                                        class="mdi mdi-file-document-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" name="send"
                                                    class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light"><span
                                                        class="d-none d-sm-inline-block me-2">Send</span> <i
                                                        class="mdi mdi-send"></i></button>
                                            </div>
                                        </div>
                                        </form>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="w-100 user-chat text-center" , style="padding-top: 20%">
                            <div class="row text-center">
                                <i class='bx bxs-conversation bx-lg text-warning'></i>
                            </div>
                            <div class="row text-center fs-3">
                                <p>Send and receive messages instantly using this portal chat</p>
                            </div>
                        </div>

                        <?php } ?>

                    </div>
                    <!-- end row -->

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <footer class="footer text-center">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <script>
                            document.write(new Date().getFullYear())
                            </script> © Concert portal
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title d-flex align-items-center px-3 py-4">

                <h5 class="m-0 me-2">Settings</h5>

                <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
            </div>

            <!-- Settings -->
            <hr class="mt-0" />
            <h6 class="text-center mb-0">Choose Layouts</h6>

            <div class="p-4">
                <div class="mb-2">
                    <img src="assets/images/layouts/layout-1.jpg" class="img-thumbnail" alt="layout images">
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                    <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                </div>

                <div class="mb-2">
                    <img src="assets/images/layouts/layout-2.jpg" class="img-thumbnail" alt="layout images">
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch">
                    <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                </div>

                <div class="mb-2">
                    <img src="assets/images/layouts/layout-3.jpg" class="img-thumbnail" alt="layout images">
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch">
                    <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                </div>

                <div class="mb-2">
                    <img src="assets/images/layouts/layout-4.jpg" class="img-thumbnail" alt="layout images">
                </div>
                <div class="form-check form-switch mb-5">
                    <input class="form-check-input theme-choice" type="checkbox" id="dark-rtl-mode-switch">
                    <label class="form-check-label" for="dark-rtl-mode-switch">Dark RTL Mode</label>
                </div>


            </div>

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <script src="assets/js/app.js"></script>
    <script>
        const chatBox = document.getElementById('chatBox');
         chatBox.scrollTop = chatBox.scrollHeight;
    </script>

</body>

</html>