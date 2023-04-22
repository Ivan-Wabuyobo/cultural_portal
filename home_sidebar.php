<!-- Coding by CodingLab | www.codinglabweb.com -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="home_style.css">
    
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    
    <title>Culture tutor</title> 
</head>
<body>
    <nav class="sidebar close bg-dark text-white">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="logo.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">GCS</span>
                    <span class="profession">Gulu University</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="userdashboard.php  ">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="viewQuiz.php">
                            <i class='bx bx-chat icon text-success' ></i>
                            <span class="text nav-text">Quiz Time</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-male-female icon' ></i>
                            <span class="text nav-text">Find relative</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-file-find icon' ></i>
                            <span class="text nav-text">Check Your clan</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="learner_progress.php">
                            <i class='bx bx-pie-chart-alt icon' ></i>
                            <span class="text nav-text">My progress</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="feedback&support.php">
                            <i class='bx bx-heart icon' ></i>
                            <span class="text nav-text">Feedback & Support</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="user_gallery.php">
                            <i class='bx bx-wallet icon' ></i>
                            <span class="text nav-text">Gallery</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="logout.php">
                            <i class='bx bx-log-out icon' ></i>
                            <span class="text nav-text">Logout</span>
                        </a>
                    </li>
                    

                </ul>
            </div>
            <div class="bottom-content">
                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
                
            </div>
        </div>

    </nav>

    <section class="home">
        <div class="text">Culture Tutor</div>
        
    </section>

    <script src="home_script.js"></script>

</body>
</html>