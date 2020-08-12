<?php


//include header
include('templates/header.php');

//connect to db
include('config/connect-db.php'); ?>

<!-- search form -->
<form action="" method="POST">
    <div class="container p-4">
        <div class="row">
            <div class="text-sm-right p-2 col-sm-3">
                <label for="search-input" class="text-secondary">Search Anything</label>
            </div>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="search-input" placeholder="i.e. 2017 Red C300" name="search">   
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </div>
</form>

<?php
//check to se if there's a delete query in the url
if (isset($_GET['delete_id'])){
    $id_to_delete = $conn -> real_escape_string($_GET['delete_id']);
    //query the db to remove the car
    $query = "DELETE FROM inventory WHERE id = $id_to_delete";
    if ($conn -> query($query)){ ?>

        <div class="container p-3">
            <div class="alert alert-warning" role="alert">
            The vehicle has been removed successfully!
            </div>
        </div>
        
    <?php }else{
        echo "Error removing the record";
    }

    // remove the car's images folder
    $dir_to_delete = 'images/inventory/' . $id_to_delete;
    // first all the images in the folder should be removed
    $images_in_dir = scandir($dir_to_delete);
    foreach($images_in_dir as $image_in_dir){
        if($image_in_dir !='.' && $image_in_dir !='..'){
            unlink($dir_to_delete.'/'.$image_in_dir);
        }  
    }

    //then remove the empty folder
    if (! rmdir($dir_to_delete)){
        echo "Error removing the images directory";
    }

} // end of delete proccess

// check if a search query is submitted - query based on the search
if (isset($_POST['search'])){
    require_once('search-parser.php');
    // escape bad characters
    $cleaned_search_term = $conn -> real_escape_string($_POST['search']);
    // use the parser function to parse the search term
    $parsed_search = search_parser($cleaned_search_term);
    
    $query = "SELECT * FROM inventory";
    $i=0;
    foreach($parsed_search as $k => $v){
        $operator = ($i===0)? 'WHERE' : 'AND';
        
        $query = $query .' ' . $operator. ' ' . $k . ' LIKE '. "'%$v%'";
        $i++;
    }
    
}else{
    // If a search is not submitted then query all the inventory
    // create the query string
    $query = "SELECT * FROM inventory";
}

//query the db and output the results
$result = $conn -> query($query);
if (mysqli_num_rows($result)){

    while ($row = $result -> fetch_assoc()): ?>
        <div class="container inventory-card  p-3 my-4">
            <div class="row">

                <div class="col-lg-4 mt-4">
                    <a href="details.php?id=<?php echo $row['id']; ?>"> <img src=<?php echo explode(',',$row['images'])[0]; ?> alt="car"> </a> 
                </div>

                <div class="col-lg-8">
                    <h3 class="mt-3 ml-2"><?php echo $row['year'].' '. $row['model']; ?></h3>
                    <h6 class="ml-2">VIN: <?php echo $row['vin']." &nbsp; &nbsp; &nbsp; STOCK #: ". $row['stock']; ?></h6>
                    
                    <div class="row bg-light p-4 m-1 mt-4">
                        <div class="col-sm-8">
                            <p class="small my-0 text-secondary">Make: <?php echo $row['make']; ?></p>
                            <p class="small my-0 text-secondary">Body: <?php echo $row['body']; ?></p>
                            <p class="small my-0 text-secondary">Exterior: <?php echo $row['exterior']; ?></p>
                            <p class="small my-0 text-secondary">Interior: <?php echo $row['interior']; ?></p>
                            <p class="small my-0 text-secondary">Kilometers: <?php echo $row['kilometers']; ?></p>
                        </div>
                        <div class="col-sm-4">
                            <p class="mb-0 small text-secondary">TOTAL PRICE</p>
                            <h2 class="m-0 font-weight-normal">$<?php echo $row['price'] ?></h2>
                            <p class="mt-0 small text-secondary">+ TAX</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-6">
                    <a href="details.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary px-4">Details</a>
                </div>
                <div class="col-6">
                    <a href="book-appointment.php?id=<?php echo $row['id']; ?>" class="btn btn-primary float-right px-3">Inquire Now</a>
                </div>
            </div>
        </div>
    <?php endwhile;

}else{ ?>
    <div class="container">
        <h2 class="text-secondary text-center m-4">No Results Found</h2>
        <div class="text-center m-5">
            <img  class="img-fluid" src="images/old-mercedes.png" alt="">
        </div>
        
    </div>

<?php    
}



include('templates/footer.php'); 
?>