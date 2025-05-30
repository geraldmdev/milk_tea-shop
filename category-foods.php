<?php include ('partials-front/menu.php'); ?>

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

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
        <h2 style="background: #fab1a0;margin: auto; padding: 1%;border:1px solid white;  border-radius: 5px; max-width:500px; color:black;">Products on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a> &emsp;<i class="fa fa-arrow-down"></i></h2>

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

                                    <a href="<?php echo SITEURL; ?>admin/login.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
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