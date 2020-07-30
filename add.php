<?php
//include header
include('templates/header.php'); 

//initialize all the input variables
$make = $model = $year = $vin = $stock = $exterior = $interior = $transmission = $kilometers = $body = $fuel_economy = $price = "";

//initialize the form_error variable - this variable is used to check if there's any error in the form
$form_error = 0;


//check to see if form is submitted
if(isset($_POST['submit'])){
    $make = filter_var($_POST['make'], FILTER_SANITIZE_STRING);
    $model = filter_var($_POST['model'], FILTER_SANITIZE_STRING);
    $year = filter_var($_POST['year'], FILTER_SANITIZE_NUMBER_INT);
    $vin = filter_var($_POST['vin'], FILTER_SANITIZE_STRING);
    $stock = filter_var($_POST['stock'], FILTER_SANITIZE_STRING);
    $exterior = filter_var($_POST['exterior'], FILTER_SANITIZE_STRING);
    $interior = filter_var($_POST['interior'], FILTER_SANITIZE_STRING);
    $transmission = filter_var($_POST['transmission'], FILTER_SANITIZE_STRING);
    $kilometers = filter_var($_POST['kilometers'], FILTER_SANITIZE_NUMBER_INT);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_STRING);
    $fuel_economy = filter_var($_POST['fuel-aconomy'], FILTER_SANITIZE_NUMBER_FLOAT);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    
    
    // Proccessing the images if at least one image was uploaded
    if($_FILES['images']['name'][0] ){
       
        //check to see if there's any PHP errors in the images 
        foreach ($_FILES['images']['error'] as $error){
            if (!$error == 0):
                $form_error = 1; ?>
                <div class="alert alert-danger" role="alert">
                <p>There was an error uploading the files.</p>
                </div>
            <?php endif;
        }

        //check to see if the file sizes are below 5mb
        foreach ($_FILES['images']['size'] as $file_size){
            if ($file_size > 5000000): 
                $form_error = 1;?>
                <div class="alert alert-danger" role="alert">
                <p>File sizes should be less than 5mb.</p>
                </div>
            <?php endif;
        }

        //check the file extensions
        $accepted_extensions = array('jpg', 'jpeg', 'png', 'gif');
        foreach ($_FILES['images']['name'] as $file_name){
            $file_name_exploded = explode('.',$file_name);
            $file_extension = strtolower(end($file_name_exploded));
            if (!in_array($file_extension, $accepted_extensions)): 
                $form_error = 1;?>
                <div class="alert alert-danger" role="alert">
                <p>You can only upload images.</p>
                </div>
            <?php endif;
        }

    }else{ 
        $form_error = 1; ?>
        <div class="alert alert-danger" role="alert">
        <p>No images were uploaded</p>
        </div>
    <?php }

    //if there was no error then insert into the db
    if ($form_error == 0){

        //connect to db
        include('config/connect-db.php');

        // escape bad characters
        $make = $conn -> real_escape_string($make);
        $model = $conn -> real_escape_string($model);
        $year = $conn -> real_escape_string($year);
        $vin = $conn -> real_escape_string($vin);
        $stock = $conn -> real_escape_string($stock);
        $exterior = $conn -> real_escape_string($exterior);
        $interior = $conn -> real_escape_string($interior);
        $transmission = $conn -> real_escape_string($transmission);
        $kilometers = $conn -> real_escape_string($kilometers);
        $body = $conn -> real_escape_string($body);
        $fuel_economy = $conn -> real_escape_string($fuel_economy);
        $price = $conn -> real_escape_string($price);

        // create the query string
        $query = "INSERT INTO inventory (make, model, year, vin, stock, exterior, interior, tranmission, kilometers, body , `fuel-economy` ,price) VALUES ('$make', '$model',$year, '$vin', '$stock', '$exterior', '$interior', '$transmission', $kilometers, '$body', $fuel_economy,  $price)";
        

        //query the db and get the id of inserted record
        if ($conn -> query($query)) {
            $inserted_record_id = $conn -> insert_id;
            echo $conn->affected_rows .'rows inserted. id= '.$inserted_record_id;

            //upload the images to a folder named as the id 
            $target_dir = 'images/inventory/' . $inserted_record_id . '/';

            //create the folder to upload the images
            if (!mkdir($target_dir)){
                echo "failed to create the folder " .$target_dir;
            }else{
                //initialize a string to update the images field in db
                $images_comma_seperated_list ="";
                // loop over all the uploaded images and move them to target folder
                for($i=0 ; $i<count($_FILES['images']['name']) ; $i++){
                    $file_name_exploded = explode('.',$_FILES['images']['name'][$i]);
                    $file_extension = strtolower(end($file_name_exploded));
                    $target_file = $target_dir .$i .'.'.$file_extension;
                    $images_comma_seperated_list = $images_comma_seperated_list . $target_file .',';
                    // move the image to the target folder
                    if( !move_uploaded_file($_FILES['images']['tmp_name'][$i], $target_file)){
                        echo 'image couldn\'t be created in targret folder';
                    }else {
                        // the images are successfully moved, now we update the "images" field in the db
                        $query = "UPDATE inventory SET images = '$images_comma_seperated_list' WHERE id = $inserted_record_id";
                        // update the images field in the db
                        if ($conn -> query($query)){ ?>
                            <div class="alert alert-success" role="alert">
                            You've successfully added the vehicle!
                            </div>
                        <?php }
                    }
                }
            }

        } else{
            echo("Error description: " . $conn -> error); 
        }
    }

}

?>

<div class="container p-4">
    <h1 class="text-center">Add a vehicle to the inventory</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="make">Make</label>
            <input type="text" class="form-control" id="make" name="make" value= <?php echo $make; ?> >
        </div>
        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" class="form-control" id="model" name="model" value= <?php echo $model; ?>>
        </div>
        <div class="form-group">
            <label for="year">Year</label>
            <input type="number" class="form-control" id="year" name="year" value= <?php echo $year; ?>>
        </div>
        <div class="form-group">
            <label for="vin">VIN #</label>
            <input type="text" class="form-control" id="vin" name="vin" value= <?php echo $vin; ?>>
        </div>
        <div class="form-group">
            <label for="stock">Stock #</label>
            <input type="text" class="form-control" id="stock" name="stock" value= <?php echo $stock; ?>>
        </div>
        <div class="form-group">
            <label for="exterior">Exterior</label>
            <input type="text" class="form-control" id="exterior" name="exterior" value= <?php echo $exterior; ?>>
        </div>
        <div class="form-group">
            <label for="interior">Interior</label>
            <input type="text" class="form-control" id="interior" name="interior" value= <?php echo $interior; ?>>
        </div>
        <div class="form-group">
            <label for="tranmission">Tranmission</label>
            <select class="form-control" id="tranmission" name="transmission" >
                <option>Automatic</option>
                <option>Manual</option>
            </select>
        </div>
        <div class="form-group">
            <label for="kilometers">Kilometers</label>
            <input type="number" class="form-control" id="kilometers" name="kilometers" value= <?php echo $kilometers; ?>>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <select class="form-control" id="body" name="body">
                <option>Sedan</option>
                <option>SUV</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fuel-aconomy">Fuel-aconomy</label>
            <input type="number" step="0.01" class="form-control" id="fuel-aconomy" name="fuel-aconomy" value= <?php echo $fuel_economy; ?>>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number"  class="form-control" id="price" name="price" value= <?php echo $price; ?>>
        </div>
        <div class="form-group">
            <label for="images">Images</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple>
        </div>
        
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>




<?php
include('templates/footer.php'); 
?>