<?php
    include('user-nav.php');

    if(isset($_POST['add-to-cart']))
    {
        $product_name = $_POST['product-name'];
        $product_price = $_POST['product-price'];
        $product_image = $_POST['product-image'];
        $product_qty = 1;

        //checking if the data is already exist
        $check_cart=mysqli_query($conn, "SELECT * FROM `tbl_cart` WHERE name='$product_name'");

        if(mysqli_num_rows($check_cart)>0)
        {
            echo " <script type='text/javascript'>
            alert('Product Already Added!');
            
            </script>";
        } else
        {
             //insert cart data into cart table
            $insert_product = mysqli_query($conn, "INSERT INTO `tbl_cart` (name, price, image, qty) VALUES ('$product_name', '$product_price', '$product_image', $product_qty)");

            echo " <script type='text/javascript'>
            alert('Added To Cart Successfully!');
            window.location.href='user-category-foods.php';
            </script>";
        }   
    }
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
       // header('location:'.SITEURL.'user/user-category-foods.php');
       echo " <script type='text/javascript'>
       window.location.href='user-cart.php';
       </script>";
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2 style="background: #fab1a0;margin: auto; padding: 1%;border:1px solid white;  border-radius: 5px; max-width:500px; color:black;">Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a> &emsp;<i class="fa fa-arrow-down"></i></h2>

        </div>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Menu</h2>

            <?php
                //Getting foods that are active and featured
                //Sql query
                $sql2="SELECT * FROM tbl_food WHERE category_id=$category_id ";

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

                                <?php
                                    $select_product=mysqli_query($conn, "SELECT * FROM `tbl_food`");
                                    if(mysqli_num_rows($select_product)>0)
                                    {
                                       $fetch_product=mysqli_fetch_assoc($select_product);
                                
                                        ?>
                                            <form action="" method="POST">
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
                                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
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
                                                
                                                <input type="hidden" name="product-name" value="<?php echo $title; ?>">
                                                <input type="hidden" name="product-price" value="<?php echo $price; ?>">
                                                <input type="hidden" name="product-image" value="<?php echo $image_name; ?>">
                                                <input type="submit" class="btn btn-primary" value="Add To Cart" name="add-to-cart"> 
                                                <a href="<?php echo SITEURL; ?>user/user-order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                            </div>
                                            </form>
                                        <?php
                                    }
                                ?>

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
            <a href="<?php echo SITEURL; ?>user/user-foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('../partials-front/footer.php'); ?>