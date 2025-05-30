<?php 
    include('../config/constants.php');
    include('login-check.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demonstrative Performance</title>
    <link rel="stylesheet" href="../css/admin1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <!-- Menu Section Starts -->
    <div class="menu text-center">
        <div class="wrapper">
             <ul>
                <li><a href="../admin-home.php"><i class="fas fa-arrow-left"></i>
                </a></li>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-user.php">Registered</a></li>
                <li><a href="manage-category.php">Category</a></li>
                <li><a href="manage-food.php">Product</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <li ><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </div>
        
    </div>

    <!-- Menu Section Ends -->