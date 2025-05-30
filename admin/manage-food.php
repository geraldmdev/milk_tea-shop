<?php 
    include('partials/menu.php')
?>    

    <!-- Main Content Starts -->
    <div class="main-content">
         <div class="wrapper">
             <h1>Manage Food</h1>
             <br><br><br>

             <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset ($_SESSION['add']);
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset ($_SESSION['delete']);
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset ($_SESSION['upload']);
                }

                if(isset($_SESSION['unauthorized']))
                {
                    echo $_SESSION['unauthorized'];
                    unset ($_SESSION['unauthorized']);
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset ($_SESSION['update']);
                }
             ?>

             <br><br>

<!-- Add button -->
 <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
 <br><br><br><br>

<table class="tbl-full">
   <tr>
       <th>S.N.</th>
       <th>Title</th>
       <th>Price</th>
       <th>Image</th>
       <th>Featured</th>
       <th>Active</th>
       <th>Actions</th>
   </tr>

   <?php
    //Create sql query to get all data
    $sql = "SELECT * FROM tbl_food ORDER BY id DESC";

    //Execute
    $res = mysqli_query($conn, $sql);

    //Count rows
    $count = mysqli_num_rows($res);

    //create serial number variable and assign as 1
    $sn = 1;

    if($count>0)
    {
        //We have data
        while($row=mysqli_fetch_assoc($res))
        {
            // get the individual values from coulumn
            $id = $row['id'];
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
            ?>
                
                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $title; ?></td>
                    <td>₱<?php echo $price; ?></td>
                    <td>
                        <?php
                            //check if we have image
                            if($image_name=="")
                            {
                                //We do not have image. display error message
                                echo "<div class='error'>Image not added.</div>";
                            } else
                            {
                                //We have image, display image
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="150px">
                                <?php
                            }
                        ?>
                    </td>
                    <td><?php echo $featured; ?></td>
                    <td><?php echo $active; ?></td>
                    <td>
                        <a href="<?php echo SITEURL ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Edit</a>
                        <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                    </td>
                </tr>

            <?php
        }
    } else
    {
        // we do not
        echo "<tr> <td colspan='7' class='error'>No Food Added Yet </td> </tr>";
    }
   ?>

</table>

        </div>
    </div>

    <!-- Main Content Ends -->

    <?php 
    include('partials/footer.php')
   ?>