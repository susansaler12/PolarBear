<!DOCTYPE html>
<html lang="en">
<head>
    <title>Polar Bear Gifts</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../images/logo.png"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Khand:400,500' rel='stylesheet' type='text/css'>
     <!--font styles-->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600italic|Lobster+Two:400italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Khand:400,500' rel='stylesheet' type='text/css'>
    <!--SCRIPT-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- Custom css-->
    <link rel="stylesheet" type="text/css" href="../css/style-bootstrap.css">

    <!--[if lt IE 9]>-->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<!--    <![endif]-->
    <?php if($_SERVER["SCRIPT_NAME"] == "/View/calendar_view.php"):?>
        <link rel='stylesheet' href='../dependencies/fullcalendar-2.6.1/fullcalendar.min.css' />
        <link rel='stylesheet' href='../dependencies/jquery-ui-1.11.4.custom/jquery-ui.min.css' />
        <link rel='stylesheet' href='../dependencies/jquery-ui-1.11.4.custom/jquery-ui.theme.min.css' />
        <link rel='stylesheet' href='../css/calendar_style.css' />
        <script src='../dependencies/fullcalendar-2.6.1/lib/moment.min.js'></script>
        <script src='../dependencies/fullcalendar-2.6.1/fullcalendar.min.js'></script>
        <script src='../dependencies/bootstrap-3.3.6-dist/js/bootstrap.min.js'></script>
        <script src='../scripts/calendar_build.js'></script>
    <?php elseif($_SERVER["SCRIPT_NAME"] == "/View/event_view.php"):?>
        <link rel="stylesheet" type="text/css" href="../css/event_view.css"/>
    <?php endif ?>
</head>
<body>
<header id="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <!-- Polar Bear logo -->
                <a class="navbar-brand" href="../View/index1.php" ><img id="logo" src="../images/logo.png" alt="Polar Bear Logo"/></a>
            </div>
            <div id="mainNav" class="col-sm-8 col-xs-12">
                <!-- Main navigation -->
                <nav class="navbar" role="navigation">
                    <!--  let boostrap know this is not a nav button  -->
                    <div class="navbar-header">
                        <!--  for mobile hamburger  -->
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!--  main navigation links  -->
                    <div class="collapse navbar-collapse pull-right" id="mainNavBar">
                        <h2 class="hidden">Main Navigation</h2>
                        <ul class="nav navbar-nav">
                            <li><a href="../View/index1.php">Home</a></li>
                            <li><a href="../Controller/productController.php">Gallery</a></li>
                            <?php
                                $loggedIn = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false;
                                if($loggedIn == true)
                                {
                                    echo "<li><a href='../View/showprofile.php'>Profile</a></li>";
                                    echo "<li><a href='../View/messageIndex.php'>Message</a></li>";
                                    echo "<li><a href='../Controller/logout.php'>Sign Out</a></li>";
                                } else {
                                    echo "<li><a href='../View/login.php'>Sign In</a></li>";
                                }
                                ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>

