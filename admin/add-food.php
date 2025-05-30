<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Food Title">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"placeholder="Food's Description"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php
                                //Create PHP code to display categories form database
                                //1. Create SQl to get all active categories
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                $res =mysqli_query($conn, $sql);

                                //count rows to check if we have categories active
                                $count = mysqli_num_rows($res);

                                if($count>0)
                                {
                                    //We have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //Get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }

                                } else
                                {
                                    //We do not have
                                    ?>
                                        <option value="0">No Categories Found</option>
                                    <?php
                                }

                                //2. Display on Dropdown
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            //check if the submit button is clicked
            if(isset($_POST['submit']))
            {
                //Add the food in database
                // echo "clicked";

                //1. Get the data from form
                $title= mysqli_real_escape_string($conn, $_POST['title']);
                $description= mysqli_real_escape_string($conn, $_POST['description']);
                $price= mysqli_real_escape_string($conn, $_POST['price']);
                $category= mysqli_real_escape_string($conn, $_POST['category']);

                //check if radio button is checked
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                } else
                {
                    $featured = "No"; //Setting the default value
                }
                
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                } else
                {
                    $active = "No"; //Setting the default value
                }
                
                //2. upload the image if selected
                //check if the image is selected and upload only if selected
                if(isset($_FILES['image']['name']))
                {
                    //Get the details
                    $image_name =$_FILES['image']['name'];

                    //check if the image is selected and upload image only if selected
                    if($image_name != "")
                    {
                        //Image is selected
                        //A. Rename the image
                        //Get the extension
                        $ext = end(explode('.',$image_name));

                        //create new image name
                        $image_name = "Food-Name-".rand(0000, 9999).".".$ext;

                        //B. Upload the image
                        //Get the src path and destination path
                        //Src path is the current location of the image
                        $src =$_FILES['image']['tmp_name'];

                        //Destination
                        $dst = "../images/food/".$image_name;

                        //Finally Upload Image
                        $upload = move_uploaded_file($src, $dst);

                        //check if the image is uploaded
                        if($upload==false){
                            //failed to upload the image
                            //redirect to add food page with error message
                            $_SESSION['upload'] = "<div class='error'>Failed To Upload Image</div>";
                            header('locaton:'.SITEURL.'admin/add-food.php');
                            //stop the process
                            die();
                        }
                    }
                } else
                {
                    $image_name = ""; //Setting the value as blank
                }

                //3. Insert to database
                  //4. Redirect to manage food page with message
                //create sql query
                $sql2 = "INSERT INTO tbl_food SET title='$title', description='$description', price=$price, image_name='$image_name', category_id=$category, featured='$featured', active='$active' ";

                //execute the query
                $res2 =mysqli_query($conn, $sql2);

                if($res2==true)
                {
                    $_SESSION['add']="<div class='success'>Food Added Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                } else
                {
                    $_SESSION['add']="<div class='error'>Failed to Add Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
              
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>