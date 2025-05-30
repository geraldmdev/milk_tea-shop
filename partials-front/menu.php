<?php include ('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo"  style="padding-top: 2%;">
                <a href="index.php" title="Logo">
                    <strong><h3>BINIbeybi</h3></strong><!-- <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive"> -->
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>home.php">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Menu</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>admin/register-process.php" class="btn-primary" style="padding: 1%; border-radius: 5px; color: #fff;">Register</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>admin/login.php" class="btn-primary" style="padding: 1%; border-radius: 5px; color: #fff;">Log in</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->