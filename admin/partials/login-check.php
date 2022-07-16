<?php 

    //Authorization
    //Checking whether or not the user is logged in
    if(!isset($_SESSION['user'])) //If the user session is not set
    {
        //User is not logged in
        //Redirects user to the login page with message
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access the Admin Panel.</div>";
        
        //Redirects user to the Login Page
        header('location:'.SITEURL.'admin/login.php');
    }

?>