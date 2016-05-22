<?php
session_start();

require_once "header.php";?>

<main id="main" class="homepage">
    <div id="mobileBanner" >
        <img src="../images/mobileBanner.png" alt="Polar Bear Gifts"/>
    </div>
    <!--CAROUSEL -->
    <div id="myCarousel" class="carousel slide container-fluid" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="../images/banner.png" />
                 <div class="carousel-caption" id="banner0">
                     <h2>Welcome to <span><br />Polar Bear Gift</span></h2>
                </div>
            </div>
            <div class="item">
                <img src='../images/banner1.png' />
                <div class="carousel-caption" id="banner1">
                    <h2>Create a Profile and Connect with other Party Friends!</h2>
                    <a href='../View/addprofileform.php'>Create a Profile</a>
<!--                    <h3 class="btn-default">Create a Profile</h3>-->
                </div>
            </div>
            <div class="item">
                <img src="../images/banner2.png" />
            </div>
            <div class="item">
                <img src="../images/banner3.png" />
                <div class="carousel-caption" id="banner3">
                   <h2>Browse Through our Product Gallery</h2>
                    <a href='../Controller/productController.php'>Browse Gallery</a>
                </div>
            </div>
        </div>
        <!-- Left and right controls CAROUSAL -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- SEARCH BAR -->
    <div id="searchBar" class="container">
        <form role="search">
            <div class="input-group">
                <input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
                <div class="input-group-btn">
                    <button class="btn btn-primary" type="submit">search<!-- <i class="glyphicon glyphicon-search"></i> --></button>
                </div>
            </div>
        </form>
    </div>
</main>
<?php require_once "footer.php";?>
