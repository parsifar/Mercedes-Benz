<?php

include('templates/header.php'); ?>

<!-- Hero Section Slider -->
<div id="hero-carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/header-images/benz2.jpg" class="d-block w-100" alt="Mercedes Benz">
        </div>
        <div class="carousel-item">
            <img src="images/header-images/benz1.jpg" class="d-block w-100" alt="Mercedes Benz">
        </div>
        <div class="carousel-item">
            <img src="images/header-images/benz3.jpg" class="d-block w-100" alt="Mercedes Benz">
        </div>
    </div>
    
    <div class="cta text-light">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h1>Welcome to Mercedes-Benz Toronto</h1>
                    <hr class="bg-light">
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p>Browse our inventory and book your sales appointment now</p>
                    <p>Rest assured we are working every day to deliver a high level of service safely and responsibly in line with public health recommendations and guidelines.</p>
                </div>
                <div class="col-md-6">
                    <a href="#" class="btn btn-primary m-2 p-3">Book a Sales Appointment</a>
                    <br>
                    <a href="inventory.php" class="btn btn-primary m-2 p-3">See Our Inventory</a>
                </div>
            </div>
        </div>   
    </div>
</div>  <!-- End of Hero Section Slider -->

<!-- four cards section -->
<div class="container p-5">

    <div class="row">

        <div class="col-xl-3 col-lg-6 my-4">
            <a href="inventory.php" class="text-white" style="text-decoration:none;">
                <div class="card bg-dark text-white text-center" style="width:100%;">
                        <i class="fas fa-search card-img-top pt-4"></i>
                        <div class="card-body bg-light text-dark">
                            <h5 class="card-title">Search Inventory</h5>
                        </div>
                        <div class="blue-slider bg-primary pt-4"><h3>Learn More</h3></div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-lg-6 my-4">
            <a href="inventory.php" class="text-white" style="text-decoration:none;">
                <div class="card bg-dark text-white text-center" style="width:100%;">
                        <i class="fas fa-wrench card-img-top pt-4"></i>
                        <div class="card-body bg-light text-dark">
                            <h5 class="card-title">Schedule Service</h5>
                        </div>
                        <div class="blue-slider bg-primary pt-4"><h3>Learn More</h3></div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-lg-6 my-4">
            <a href="inventory.php" class="text-white" style="text-decoration:none;">
                <div class="card bg-dark text-white text-center" style="width:100%;">
                        <i class="fas fa-car card-img-top pt-4"></i>
                        <div class="card-body bg-light text-dark">
                            <h5 class="card-title">New Vehicle</h5>
                        </div>
                        <div class="blue-slider bg-primary pt-4"><h3>Learn More</h3></div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-lg-6 my-4">
            <a href="inventory.php" class="text-white" style="text-decoration:none;">
                <div class="card bg-dark text-white text-center" style="width:100%;">
                        <i class="fas fa-car card-img-top pt-4 "></i>
                        <div class="card-body bg-light text-dark">
                            <h5 class="card-title">Certified Pre-Owned</h5>
                        </div>
                        <div class="blue-slider bg-primary pt-4"><h3>Learn More</h3></div>
                </div>
            </a>
        </div>

    </div>
</div>






<?php 
include('templates/footer.php'); 
?>
