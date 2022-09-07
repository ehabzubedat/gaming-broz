<?php 
require 'php/init.php';	

/* Header */
if(!empty($_SESSION)) { // checking if user is logged in
    include "php/includes/themes/headerSignedIn.php";
}
else {
	include "php/includes/themes/header.php";
}
?>

<!-- Carousel Wrapper -->
<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">

    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-1z" data-slide-to="1"></li>
        <li data-target="#carousel-example-1z" data-slide-to="2"></li>
    </ol>
    <!-- /.Indicators -->

    <!--Slides-->
    <div class="carousel-inner" role="listbox">

        <!-- First slide -->
        <div class="carousel-item active">
            <div class="view carousel-first-image">

                <!-- Mask & flexbox options -->
                <div class="mask rgba-black-light d-flex justify-content-center align-items-center carousel-content">

                    <!-- Content -->
                    <div class="text-center white-text mx-5 wow fadeIn">
                        <h1 class="carousel-title">Free to play <br> recommended games</h1>
                        <p>
                            <a target="_blank" href="https://www.callofduty.com/warzone/download" class="btn btn-warning carousel-btn">
                                Download Now!
                            </a>
                        </p>

                        <p>
                            <a target="_blank" href="https://www.youtube.com/watch?v=xvjn6BopsV8" class="btn btn-primary carousel-btn">
                                Trailer!
                            </a>
                        </p>
                    </div>
                    <!-- /.Content -->

                </div>
                <!-- /.Mask & flexbox options -->

            </div>
        </div>
        <!-- /.First slide -->

        <!-- Second slide -->
        <div class="carousel-item">
            <div class="view carousel-second-image">

                <!-- Mask & flexbox options -->
                <div class="mask rgba-black-light d-flex justify-content-center align-items-center carousel-content">

                    <!-- Content -->
                    <div class="text-center white-text mx-5 wow fadeIn">
                        <h1 class="carousel-title">Free to play <br> recommended games</h1>
                        <p>
                            <a target="_blank" href="https://www.ea.com/games/apex-legends/season-6" class="btn btn-warning carousel-btn">
                                Download Now!
                            </a>
                        </p>

                        <p>
                            <a target="_blank" href="youtube.com/watch?v=SCUXdRb5abU" class="btn btn-primary carousel-btn">
                                Trailer!
                            </a>
                        </p>
                    </div>
                    <!-- /.Content -->

                </div>
                <!-- /.Mask & flexbox options-->

            </div>
        </div>
        <!-- /.Second slide -->

        <!-- Third slide -->
        <div class="carousel-item">
            <div class="view carousel-third-image">

                <!-- Mask & flexbox options -->
                <div class="mask rgba-black-light d-flex justify-content-center align-items-center carousel-content">

                    <!-- Content -->
                    <div class="text-center white-text mx-5 wow fadeIn">
                        <h1 class="carousel-title">Free to play <br> recommended games</h1>
                        <p>
                            <a target="_blank" href="https://playvalorant.com/en-us/" class="btn btn-warning carousel-btn">
                                Download Now!
                            </a>
                        </p>

                        <p>
                            <a target="_blank" href="https://www.youtube.com/watch?v=IhhjcB2ZjIM" class="btn btn-primary carousel-btn">
                                Trailer!
                            </a>
                        </p>
                    </div>
                    <!-- /.Content -->

                </div>
                <!-- /.Mask & flexbox options-->

            </div>
        </div>
        <!--/Third slide-->

    </div>
    <!--/.Slides-->

    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->

</div>
<!--/.Carousel Wrapper-->

<!-- Main -->
<main class="bg-white text-dark">
    <!-- Container -->
    <div class="container">

        <!-- Section: Main info -->
        <section class="pt-5 wow fadeIn">

            <!-- Grid row -->
            <div class="row pb-5">

                <!-- Grid column -->
                <div class="col-md-6 mb-4">
                    <img src="img/bg/gaming.jpg" class="img-fluid z-depth-1-half border-black" alt>
                </div>
                <!-- /.Grid column-->

                <!--Grid column-->
                <div class="col-md-6 mb-4">
                    <!-- Main heading -->
                    <h3 class="h3 mb-3">Gaming Bro'z</h3>
                    <p>The Greatest Gaming Community!</p>
                    <p>Gaming , News, Forum, And new gamer friends.</p>
                    <!-- /.Main heading -->
                    <hr>
                    <p>Join us and be part of something special!</p>
                    <a href="signup.php" class="btn btn-md btn-signup-index-page">Sign Up Now!</a>
                </div>
                <!-- /.Grid column -->

            </div>
            <!-- /.Grid row -->

        </section>
        <!-- /.Section: Main info -->

    </div>
    <!-- /.Container -->
</main>
<!-- /.Main -->

<?php 
/* Footer */
include "php/includes/themes/footer.php" 
?>
