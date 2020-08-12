<?php
//proccessing the registration
if (isset($_POST['submit'])){
    //connect to db
    include('config/connect-db.php');

    // escape bad characters
    $name = $conn -> real_escape_string($_POST['name']);
    $username = $conn -> real_escape_string($_POST['username']);
    $entered_password = $conn -> real_escape_string($_POST['password']);
    $hashed_password = password_hash($entered_password , PASSWORD_DEFAULT);
   
    // check to see if the username exists in the db
    $query = "SELECT * FROM users WHERE username = '$username'";

    //query the db and output the results
    $result = $conn -> query($query);
    if (mysqli_num_rows($result)){ ?>
        <div class="container p-4">
            <div class="alert alert-danger" role="alert">
                The username <?php echo $username; ?> Already exists! 
            </div>
        </div>
        <?php
    }else{  //if the username doesn't already exist then create the user
        $query = "INSERT INTO users (name , username , password) VALUES('$name' , '$username','$hashed_password')";
        if ($conn -> query($query)){ ?>
            <div class="container p-4">
                <div class="alert alert-success" role="alert">
                    Successfully Registered! 
                </div>
            </div>
        <?php
        }

    }
}

//include header
include('templates/header.php'); ?>

<!-- Registration Form -->
<div class="container p-5">
<h2 class="my-3 mb-5">Register your account</h2>
    <form action="" method="POST">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Select your username">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Register</button>
    </form>
</div>

<div class="container text-center">
    <p>Already have an account? <a href="login.php">Login Here</a></p>
</div>



<?php
include('templates/footer.php'); 
?>