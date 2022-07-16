<?php 
    include('../config/constants.php');

    //Destory the Session
    session_destroy(); //Unsets $_SESSION['user']

    //Redirects to Login Page
    header('location:'.SITEURL.'admin/login.php');
?>