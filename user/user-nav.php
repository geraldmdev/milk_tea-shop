<?php 
 include ('../config/constants.php'); 
 include('../admin/partials/login-check.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
           
<div class="logo" style="padding-top: 2%;">
    <a href="#" title="Logo">
        <strong><h3>BINIbeybi</h3></strong>
        <!-- <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive"> -->
    </a>
    <br>
    <p style="color: #e66767; margin-bottom: 0;"><b>WELCOME BLOOMS</b></p>
</div>


            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>user/user-home.php">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>user/user-categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>user/user-foods.php">Menu</a>
                    </li>
                    <li>
                        <?php
                            $sql = mysqli_query($conn, "SELECT * FROM `tbl_cart`") or die('Query Failed');
                            $count = mysqli_num_rows($sql);
                        ?>
                        <a href="<?php echo SITEURL; ?>user/user-cart.php"><i class="fa fa-shopping-cart"></i><span><sup><?php echo $count; ?></sup></span></a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>admin/logout.php" class="btn-primary logout" style="padding: 1%; border-radius: 5px; color:#fff;">Logout</a>
                    </li>
                </ul>
                <!-- <div id="menu-btn" class="fas fa-bars"></div> -->  
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->