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
                        <a href="<?php echo SITEURL; ?>admin/index.php" class="btn-primary" style="padding: 1%; border-radius: 5px; color: #fff;">Dashboard</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>admin-food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
     <br><br>

    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset ($_SESSION['order']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Products</h2>

            <?php
                //Create Sql to display categories from database
                $sql= "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                //Execute 
                $res =mysqli_query($conn, $sql);
                //count rows to check if the category is availble
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //category availble
                    while( $row=mysqli_fetch_assoc($res))
                    {
                        //Get the values like id, title, image_name...
                        $id= $row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?>
                            <a href="<?php echo SITEURL; ?>admin-category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    //Check if the image is available or not
                                    if($image_name=="")
                                    {
                                        //Display Message
                                        echo "<div class='error'>Image not Available</div>";
                                    } else
                                    {
                                        //Image Available
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>

                                <h3 class="float-text"style="padding-top:10px;"><?php echo $title; ?></h3>
                            </div>
                            </a>
                        <?php
                    }
                    
                } else
                {
                    //Not available
                    echo "<div class='error'>Category not Added</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Product Menu</h2>

            <?php
                //Getting foods that are active and featured
                //Sql query
                $sql2="SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6 ";

                //Execute the query
                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2>0)
                {
                    //food available
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        //Get the values title, description, price..
                        $id=$row['id'];
                        $title=$row['title'];
                        $description=$row['description'];
                        $price=$row['price'];
                        $image_name=$row['image_name'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        //check if the image is available
                                        if($image_name=="")
                                        {
                                            //Image not available
                                            echo "<div class='error'>Image Not Available.</div>";
                                        } else
                                        {
                                            //Image available
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price">₱<?php echo $price; ?></p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>admin-order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                } else
                {
                    //Food not Available
                    echo "<div class='error'>Food Not Available.</div>";
                }
            ?>

            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>admin-foods.php">See All Products</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

 <?php include('partials-front/footer.php'); ?>