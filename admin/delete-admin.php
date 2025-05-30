<?php  
    // Include constants.php file here
    include('../config/constants.php');

    //1. get the ID of Admin to be deleted
    $id = $_GET['id'];

    //2. Create SQL Query to delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //Check the query if executed or not
    if($res==true)
    {
        //Query executed successfully and admin deleted
        //echo "Admin Deleted";
        //Create SESSION variable to display message
        $_SESSION['delete']= "<div class='success'>Deleted successfully!</div>";
        //Redirect to manage Admin page
        header('location:'.SITEURL.'admin/index.php');
    }
    else 
    {
        //Failed to Delete Admin
        //echo "Failed to delete Admin";
        $_SESSION['delete']= "<div class='error'>Failed to delete Admin!</div>";
        header('location:'.SITEURL.'admin/index.php');
    }

    //3. Redirect to Manage Admin page with message (success/error)
?>