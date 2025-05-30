<?php 
include ('config/constants.php'); 
include('admin/partials/login-check.php');
?>


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
                <a href="#" title="Logo">
                    <strong><h3>BINIbeybi</h3></strong><!-- <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive"> -->
                </a>
                <br><p style="color: #e66767; margin-bottom: 0;"><b>WELCOME ADMIN</b></p>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>admin-home.php">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>admin-categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>admin-foods.php">Menu</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>admin/index.php" class="btn-primary" style="padding: 1%; border-radius: 5px;color: #fff;">Dashboard</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //Display all categories that are active
                //Sql Query
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                //Execute
                $res=mysqli_query($conn, $sql);

                //count rows
                $count = mysqli_num_rows($res);

                //chck if categories are available
                if($count>0)
                {
                    //Categories available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the values
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];

                        ?>
                            <a href="<?php echo SITEURL; ?>admin-category-foods.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">
                                    <?php
                                        if($image_name=="")
                                        {
                                            //Image not Available
                                            echo "<div class='error'>Image Not Available.</div>";
                                        } else
                                        {
                                            //Image Available
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                    
                                    <h3 class="float-text" style="padding-top:10px;"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        <?php
                    }
                } else
                {
                    //Not available
                    echo "<div class='error'>Category Not Available.</div>";
                }
            ?>
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>