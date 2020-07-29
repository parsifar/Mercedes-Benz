<?php
//include header
include('templates/header.php');

//connect to db
include('config/connect-db.php');

//get the id of the car
$id = $conn -> real_escape_string($_GET['id']);

//query string
$query = "SELECT * FROM inventory WHERE id = $id";

//query the db
$result = $conn -> query($query);

// if the car with given id exists in db we fetch the data
if (!$result -> num_rows ==0){
    $car = $result -> fetch_assoc();
    // $images array contains url of all images  
    $images = explode(',',$car['images']); ?>
        <div class="container-fluid bg-secondary p-5">
            <div class="container">
                <div class="row ">
                    <div class="col">
                    <h1 class="text-center text-light font-weight-light p-3"><?php echo htmlspecialchars($car['year']).' '.htmlspecialchars($car['model']); ?></h1>
                    </div>  
                </div>
                <div class="row"> 
                    <div class="col-md-6">
                        <!-- in this section we put the carousel for the images -->
                        <div id="car-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <!-- first image has the class active -->
                            <div class="carousel-item active">
                                    <img src=<?php echo $images[0]; ?> class="d-block w-100" alt="Mercedes">
                                </div>
                            <?php
                            array_shift($images);
                            // then for all the other images we iterate
                            foreach($images as $image):?>
                                <div class="carousel-item">
                                    <img src=<?php echo $image; ?> class="d-block w-100" alt="Mercedes">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        </div>

                    </div>
                    <div class="col-md-6 text-light px-5">
                        <h4>Experience this vehicle in person.</h4>
                        <p>Call or submit a web inquiry to connect with one of our friendly and knowledgeable Sales Consultants who will be happy to help you learn more and get a quote.

                        </p>
                        <a href="#" class="btn btn-primary w-100"> Inquire Now</a>
                        <hr class="bg-light">
                        <div class="row">
                            <div class="col-4">
                                <p class="pt-2">Total Price</p>
                            </div>
                            <div class="col-8">
                                <h3 class="font-weight-light">$<?php echo htmlspecialchars($car['price']); ?> +Tax</h3>
                            </div>
                        </div>
                        <hr class="bg-light">
                    </div>
                </div>
            </div>
        </div>

        <!-- Info section  -->
        <div class="container-fluid py-5">
            <div class="container bg-light py-3">
                <div class="row">
                    <div class="col text-center">
                        <h3>Basic Info</h3>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 px-4">
                        <div class="row ">
                            <div class="col-4">
                                <p class="my-0">VIN #:</p>
                            </div>
                            <div class="col-8">
                                <p class="float-right my-0"><?php echo htmlspecialchars($car['vin']); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p class="my-0">Stock #:</p>
                            </div>
                            <div class="col-8">
                                <p class="float-right my-0"><?php echo htmlspecialchars($car['stock']); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p class="my-0">Exterior:</p>
                            </div>
                            <div class="col-8">
                                <p class="float-right my-0"><?php echo htmlspecialchars($car['exterior']); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p class="my-0">Interior:</p>
                            </div>
                            <div class="col-8">
                                <p class="float-right my-0"><?php echo htmlspecialchars($car['interior']); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p class="my-0">Tranmission:</p>
                            </div>
                            <div class="col-8">
                                <p class="float-right my-0"><?php echo htmlspecialchars($car['tranmission']); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 px-4">
                        <div class="row ">
                            <div class="col-4">
                                <p class="my-0">Make:</p>
                            </div>
                            <div class="col-8">
                                <p class="float-right my-0"><?php echo htmlspecialchars($car['make']); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p class="my-0">Model:</p>
                            </div>
                            <div class="col-8">
                                <p class="float-right my-0"><?php echo htmlspecialchars($car['model']); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p class="my-0">Body:</p>
                            </div>
                            <div class="col-8">
                                <p class="float-right my-0"><?php echo htmlspecialchars($car['body']); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p class="my-0">Kilometers:</p>
                            </div>
                            <div class="col-8">
                                <p class="float-right my-0"><?php echo htmlspecialchars($car['kilometers']); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p class="my-0">Fuel Economy:</p>
                            </div>
                            <div class="col-8">
                                <p class="float-right my-0"><?php echo htmlspecialchars($car['fuel-economy']); ?> L/100km</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    <?php
}else{
    echo "Sorry, We don't have that car!";
}







include('templates/footer.php'); 
?>