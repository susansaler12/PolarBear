<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Khand:400,500' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- Custom css-->
    <link rel="stylesheet" type="text/css" href="../../css/style-bootstrap.css">

    <!--[if lt IE 9]>-->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<!--    <![endif]-->
</head>
<body>
<header id="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <!-- Polar Bear logo -->
                <a class="navbar-brand" href="/" ><img id="logo" src="../../images/logo.png" alt="Polar Bear Logo"/></a>
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
                            <li><a href="/">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="admin.php">Sign In</a></li>
                            <li><a href="#">Wish List</a></li>

                            <!-- KEEP THIS FOR SUBNAV
                                <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">subnav demo</a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">sub-nav</a></li>
                                    <li><a href="#">sub-nav</a></li>
                                    <li><a href="#">sub-nav</a></li>
                                    <li><a href="#">sub-nav</a></li>
                                    <li><a href="#">sub-nav</a></li>
                                    <li><a href="#">sub-nav</a></li>
                                </ul>
                            </li> -->
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>

