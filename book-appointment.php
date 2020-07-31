<?php

include('templates/header.php'); ?>

<div class="container-fluid p-0 position-relative">
    <img src="images/mercedes-girl.jpg" class="img-fluid w-100"  alt="">
    <h1 class="position-absolute text-white book-title px-5 w-50 font-weight-light">Book a Sales Appointment</h1>
</div>

<div class="container p-5">
    <p class="p-4">Our sales team is available to assist you, ready to provide you information and quotations for vehicles you are interested in.</p>
    
    <form class="p-4">
        <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" class="form-control" id="fname">
        </div>
        <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" class="form-control" id="lname">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="msg">Tell us what you're looking for</label>
            <textarea class="form-control" id="msg" rows="3"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
    </form>
</div>



<?php 
include('templates/footer.php'); 
?>