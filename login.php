<?php
//include header
include('templates/header.php'); 

//proccessing the login
if (isset($_POST['submit'])){
    //connect to db
    include('config/connect-db.php');

    // escape bad characters
    $username = $conn -> real_escape_string($_POST['username']);
    $entered_password = $conn -> real_escape_string($_POST['password']);
   
    // check to see if the username exists in the db
    $query = "SELECT * FROM users WHERE username = '$username'";

    //query the db and output the results
    $result = $conn -> query($query);
    if (!mysqli_num_rows($result)){ ?>
        <div class="container p-4">
            <div class="alert alert-danger" role="alert">
                The username <?php echo $username; ?> doesn't exists! 
            </div>
        </div>
        <?php
    }else{  //if the username exist then check if the password is valid
        $query = "SELECT * FROM users WHERE username = '$username'";
        if ($conn -> query($query)){ 
            $row = $result -> fetch_assoc(); 
            
            //if the password is valid set a session variable and go to homepage
            if(password_verify($entered_password , $row['password'])){
                $_SESSION['username'] = htmlspecialchars($username);
                $_SESSION['name'] = htmlspecialchars($row['name']);
                header('Location: index.php');
            }else{ ?>
            <div class="container p-4">
                <div class="alert alert-danger" role="alert">
                    Wrong Password! 
                </div>
            </div>
            <?php
            }
        }

    }
}

?>

<!-- Login Form -->
<div class="container p-5">
    <h2 class="my-3 mb-5">Login to your account</h2>
    <form action="" method="POST">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Login</button>
    </form>
   
</div>

<div class="container text-center">
    <p>Not registered yet? <a href="register.php">Register Here</a></p>
</div>




<?php
include('templates/footer.php'); 
?>