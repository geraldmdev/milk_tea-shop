<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }
        ?>
        <br><br>

        <!-- Add Category Form Starts-->
       <form action="" method="POST" enctype="multipart/form-data"> <!-- enctype attribute allows to upload file -->
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Category Title"></td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add Category Form Ends-->

        <?php 
            //Check if the submit button is clicked
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //1. Get the value from category form
                $title=mysqli_real_escape_string($conn, $_POST['title']);

                //for Radio Type, we need to check if the button is selected or not
                if(isset($_POST['featured']))
                {
                    //Get the value from form
                    $featured = $_POST['featured'];
                } else
                {
                    //Get the default value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    //Get the value from form
                    $active = $_POST['active'];
                } else
                {
                    //Get the default value
                    $active = "No";
                }

                //check if the image is selected and set the value for the image name accordingly
                //print_r($_FILES['image']);

                //die(); //break the code here

                if(isset($_FILES['image']['name']))
                {
                    //Upload the image
                    //To upload the image, we need image name, source path and destination path
                    $image_name=$_FILES['image']['name'];

                    //Upload the image only if image is selected
                    if($image_name != "")
                    {
                        //Auto Rename the image
                        //Get the Extension of our image (jpg, png, gif, etc) e.g. "food1.jpg"
                        $ext = end(explode('.', $image_name));

                        //Rename the image
                        $image_name= "Food_Category_".rand(000, 999).'.'.$ext; //new name will be Food_Category_834.jpg

                        $source_path=$_FILES['image']['tmp_name'];

                        $destination_path="../images/category/".$image_name;

                        //Finally uplaod the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check if the image is uploaded
                        //and if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            //Set message
                            $_SESSION['upload']="<div class='error'>Failed to Upload Image</div>";
                            // Redirect to Add Category Page
                            header('location:'.SITEURL.'admin/add-category.php');

                            //Stop the process
                            die();
                        }
                    }
                }
                else
                {
                    //Can't upload the image and set to blank
                    $image_name="";
                }

                //2. Create SQL to Query to inset Category
                $sql = "INSERT INTO tbl_category SET title='$title', image_name='$image_name', featured='$featured', active='$active'";

                //3. Execute the query and save in database
                $res=mysqli_query($conn, $sql);

                //4. Check if the query is excuted or not and data added or not
                if($res==true)
                {
                    //Query executed and add category
                    $_SESSION['add']="<div class='success'>Category Added Successfuly</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //Failed to Add
                    $_SESSION['add']="<div class='error'>Category Added Failed</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        ?>

    </div>
</div>


<?php include('partials/footer.php'); ?>
