<?php
    include('user-nav.php');

    if(isset($_POST['add-to-cart']))
    {
        $product_name = $_POST['product-name'];
        $product_price = $_POST['product-price'];
        $product_image = $_POST['product-image'];
        $product_qty = 1;

        //insert cart data into cart table
        $insert_product = mysqli_query($conn, "INSERT INTO `tbl_cart` (name, price, image, qty) VALUES ('$product_name', '$product_price', '$product_image', $product_qty)");
    }
 ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>user/user-food-search.php" method="POST">
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
            <h2 class="text-center">Explore Foods</h2>

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
                            <a href="<?php echo SITEURL; ?>user/user-category-foods.php?category_id=<?php echo $id; ?>">
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

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
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
            <h2 class="text-center">Food Menu</h2>

            <?php
              $sql = "SELECT * FROM tbl_food WHERE active='Yes' LIMIT 6";
              $res = mysqli_query($conn, $sql);
              $count = mysqli_num_rows($res);
              
              if ($count > 0) {
                  while ($row = mysqli_fetch_assoc($res)) {
                      $id = $row['id'];
                      $title = $row['title'];
                      $price = $row['price'];
                      $description = $row['description'];
                      $image_name = $row['image_name'];
                      ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
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
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h3><?php echo $title; ?></h3>
                                <p>Price: <?php echo $price; ?></p>
                                <p class="food-detail">
                                        <?php echo $description; ?>
                                </p>
                                <form action="add-to-cart.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo $title; ?>">
                                    <!-- <input type="number" name="quantity" min="1" value="1" required> -->
                                    <input type="submit" name="add_to_cart" value="Add to Cart">
                                </form>
                            </div>
                        </div>
                      <?php
                  }
              } else {
                  echo "<div class='error'>No Products Available</div>";
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