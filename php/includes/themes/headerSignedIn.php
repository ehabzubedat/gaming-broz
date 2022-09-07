<!DOCTYPE html>
<html lang="en">

    <!-- Head -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Gaming Bro'z | <?php require 'title.php'; ?></title>
        <!-- add icon link -->
        <link rel="icon" href="img/bg/joystick.png" type="image/x-icon">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="css/mdb.min.css" rel="stylesheet">
        <!-- MDBootstrap Datatables  -->
        <link href="css/addons/datatables.min.css" rel="stylesheet">
        <!-- Your custom styles (optional) -->
        <link href="css/style.css" rel="stylesheet">
    </head>
    <!-- /.Head -->

    <!-- Body -->
    <body>
        
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
            
            <!-- Brand -->
            <a class="navbar-brand" href="index.php">
                <strong>Gaming Bro'z</strong>
            </a>
            <!-- /.Brand -->

            <!-- Collapse -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- /.Collapse -->

            <!-- Links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Left -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "index.php") echo "active-nav";?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "news.php" ||
                                                    basename($_SERVER['PHP_SELF']) === "article.php") echo "active-nav";?>" href="news.php">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "forum.php" || 
                                                    basename($_SERVER['PHP_SELF']) === "topics.php" || basename($_SERVER['PHP_SELF']) === "topic.php" || basename($_SERVER['PHP_SELF']) === "addTopic.php") echo "active-nav";?>" href="forum.php">Forum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "contact_us.php") echo "active-nav";?>" href="contact_us.php">Contact us</a>
                    </li>
                </ul>
                <!-- /.Left -->

                <!-- Right -->
                <ul class="navbar-nav nav-flex-icons">
                    <div class="container-fluid">
                        <ul class="navbar-nav d-flex flex-row">
                            <!-- Messages icon -->
                            <li class="nav-item me-3 me-lg-0">
                                <a class="nav-link" href="messages.php" data-toggle="tooltip" data-placement="bottom" title="Messages">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <li class="nav-item avatar">
                        <a class="nav-link p-0 nav-profile-picrure-container" href="account.php" data-toggle="tooltip" data-placement="bottom" 
                           title="Profile">
                            <img src="img\uploads\profile pictures\<?php echo $_SESSION['profile_picture'];?>" class="rounded-circle z-depth-0 nav-profile-picrure" alt="avatar image" height="35" width="35">
                        </a>
                    </li>
                </ul>
                <!-- /.Right -->

            </div>
            <!-- /.Links -->

        </nav>
        <!-- /.Navbar -->
