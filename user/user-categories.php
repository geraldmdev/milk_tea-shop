<?php
    include('user-nav.php')
 ?>

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
                            <a href="<?php echo SITEURL; ?>user/user-category-foods.php?category_id=<?php echo $id; ?>">
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
                                    
                                    <h3 class="float-text" style="padding:10px;"><?php echo $title; ?></h3>
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

    <?php include('../partials-front/footer.php'); ?>