<?php 
    // Start Session
    session_start();

    //Create constants to store Non repeating values

    define('SITEURL', 'http://localhost/Binibeybi/');
    define('LOCALHOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'Xampp04!.1');
    define('DB_NAME', 'food_order');

    $conn = mysqli_connect(LOCALHOST, DB_USER, DB_PASSWORD) or die(mysqli_error()); //Database connection
    $db_select=mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Selecting Database name
?>