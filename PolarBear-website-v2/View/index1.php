<?php
session_start();

require_once "header.php";?>

<main id="main" class="homepage">
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
                <!-- <button class="carousel-caption">
                    Check this out.
                </button> -->
            </div>
            <div class="item">
                <img src='../images/banner1.png' />
            </div>
            <div class="item">
                <img src="../images/banner2.png" />
            </div>
            <div class="item">
                <img src="../images/banner3.png" />
            </div>
        </div>
        <!-- Left and right controls CAROSAL -->
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
    <div class="container">
        <form class="navbar-form row" role="search">
            <div class="input-group add-on col-sm-12">
                <input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit">search<!-- <i class="glyphicon glyphicon-search"></i> --></button>
                </div>
            </div>
        </form>
    </div>
</main>
<?php require_once "footer.php";?>