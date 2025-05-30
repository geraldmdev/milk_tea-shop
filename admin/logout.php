<?php
    //Include constants
    include('../config/constants.php');

    //1. Delete the session
    session_destroy(); //unset $_SESSION['user']

    //2. Redirect to Login Page
    header('location:../index.php');
?>