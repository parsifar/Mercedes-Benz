<?php
//include header
include('templates/header.php');

//connect to db
include('config/connect-db.php');

//get the inventory from db
// create the query string
$query = "SELECT * FROM inventory";

//query the db and output the results
if ($result = $conn -> query($query)){

    while ($row = $result -> fetch_assoc()): ?>
        <div class="container inventory-card  p-3 my-2">
            <div class="row">
                <div class="col-lg-4 mt-4">
                    <img src=<?php echo explode(',',$row['images'])[0]; ?> alt="">
                </div>
                <div class="col-lg-8">
                    <h3><?php echo $row['year'].' '. $row['model']; ?></h3>
                    <h6>VIN: <?php echo $row['vin']." &nbsp; &nbsp; &nbsp; STOCK #: ". $row['stock']; ?></h6>
                    
                    <div class="row bg-light p-4 m-1 mt-4">
                        <div class="col-md-8">
                            <p class="small my-0 text-secondary">Make: <?php echo $row['make']; ?></p>
                            <p class="small my-0 text-secondary">Body: <?php echo $row['body']; ?></p>
                            <p class="small my-0 text-secondary">Exterior: <?php echo $row['exterior']; ?></p>
                            <p class="small my-0 text-secondary">Interior: <?php echo $row['interior']; ?></p>
                            <p class="small my-0 text-secondary">Kilometers: <?php echo $row['kilometers']; ?></p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-0 small text-secondary">TOTAL PRICE</p>
                            <h2 class="m-0 font-weight-normal">$<?php echo $row['price'] ?></h2>
                            <p class="mt-0 small text-secondary">+ TAX</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-6">
                    <a href="#" class="btn btn-secondary px-4">Details</a>
                </div>
                <div class="col-6">
                    <a href="#" class="btn btn-primary float-right px-3">Inquire Now</a>
                </div>
            </div>
        </div>
    <?php endwhile;

}else{
    echo "No results!";
}