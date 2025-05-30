<?php
    // include('user-nav.php');
    include ('config/constants.php'); 
    include('admin/partials/login-check.php');
 ?>

<?php
    //check if the id is passed or not
    if(isset($_GET['category_id']))
    {
        //category id is set and get the id
        $category_id=$_GET['category_id'];

        //Get the category title based on category id
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        //Execute
        $res=mysqli_query($conn, $sql);

        //get the values from database
        $row = mysqli_fetch_assoc($res);

        //get the title
        $category_title = $row['title'];

    } else
    {
        //Category not passed
        //Redirect to home page
        header('location:'.SITEURL);
    }
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
            
            <h2 style="background: #fab1a0;margin: auto; padding: 1%;border:1px solid white;  border-radius: 5px; max-width:500px; color:black;">Products on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Product Menu</h2>

            <?php
                //Query based on selected category
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

                //Execut
                $res2 =mysqli_query($conn, $sql2);

                //Count the rows
                $count = mysqli_num_rows($res2);

                //check if the food is available
                if($count>0)
                {
                    //Food is available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id =$row2['id'];
                        $title =$row2['title'];
                        $description =$row2['description'];
                        $price =$row2['price'];
                        $image_name =$row2['image_name'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if($image_name=="")
                                        {
                                            echo "<div class='error'>Image Not Available</div>";
                                        } else
                                        {
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
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
                }else
                {
                    echo "<div class='error'>Food Not Available</div>";
                }
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>