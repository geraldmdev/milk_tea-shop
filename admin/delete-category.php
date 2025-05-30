<?php
//Include constants file
include('../config/constants.php');

    //check if the id and image_name value is set
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the value and deleted
        //echo "Get value and Delete";
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        //Remove the physical imag file is availbale
        if($image_name!="")
        {
            // Image is available , so remove it
            $path = "../images/category/".$image_name;
            //Remove the image
            $remove = unlink($path);

            //if failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                //Set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to Delete Category Image.</div>";
                //Redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the process
                die();
            }
        }

        //Delete Data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //check if the data is deleted form database
        if($res==true)
        {
            //SET Success Message and Redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //SET Error Message and Redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        //Redirect to manage category Page

    } else
    {
        // Redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>