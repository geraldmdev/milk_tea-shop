<?php
    //Add constants
    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //Process to delete
        //echo "Process to Delete";

        //1. get the id and image name
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        //2. Remove the image if available
        if($image_name !="")
        {
            $path = "../images/food/".$image_name;

            //remove image file from the folder
            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['upload']="<div class='error'>Failed to Remove File.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
        }

        //3. Delete Food from Database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        $res = mysqli_query($conn, $sql);

         //4. Redirect to Manage-food page
        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }else
        {
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

       
    } else
    {
        //Redirect to Manage food Page
        //echo "Redirect";
        $_SESSION['unauthorized'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>