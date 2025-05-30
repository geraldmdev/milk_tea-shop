<?php
    //Authorization - Access Control
    //Check if the user is logged in or not
    if(!isset($_SESSION['user'])) //if the user session is not set
    {
        //the user is not login
        //Redirect to login page with message
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please Login to Access Admin Panel</div>";
        //Redirect to Login Page
        header('location:'.SITEURL.'admin/login.php');
    }
?>
