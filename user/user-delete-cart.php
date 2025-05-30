<?php include ('../config/constants.php');  

if(isset($_GET['id']) && isset($_GET['image']))
{
    //Process to delete
    //echo "Process to Delete";

    //1. get the id and image name
    $id=$_GET['id'];
    //$image=$_GET['image'];

    //2. Remove the image if available
    // if($image !="")
    // {
    //     $path = "../images/food/".$image;

    //     //remove image file from the folder
    //     $remove = unlink($path);

    //     if($remove==false)
    //     {
    //         $_SESSION['upload']="<div class='error'>Failed to Remove File.</div>";
    //         header('location:'.SITEURL.'user/user-cart.php');
    //         die();
    //     }
    // }

    //3. Delete Food from Database
    $sql = "DELETE FROM tbl_cart WHERE id=$id";
    $res = mysqli_query($conn, $sql);

     //4. Redirect to Manage-food page
    if($res==true)
    {
        $_SESSION['delete'] = "<div class='success'>Product Deleted From Your Cart Successfully.</div>";
        header('location:'.SITEURL.'user/user-cart.php');
    }else
    {
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Product.</div>";
        header('location:'.SITEURL.'user/user-cart.php');
    }

   
} else
{
    //Redirect to Manage food Page
    //echo "Redirect";
    $_SESSION['unauthorized'] = "<div class='error'>Unauthorized Access.</div>";
    header('location:'.SITEURL.'user/user-cart.php');
}
?>