<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin Page</h1>
        <br><br>

        <?php 
            //1. Get the id od selected admin data
            $id=$_GET['id'];

            //2. Create SQL Query to get the details
            $sql = "SELECT * FROM tbl_admin WHERE id='$id'";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Check whether the query is executed or not 
            if($res==true)
            {
                //check whether the data is available or not
                $count = mysqli_num_rows($res);
                //check whether we have admin data or not
                if($count==1)
                {
                    // Get the details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $fullname = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    //Redirect to manage Admin Page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td> Full Name</td>
                    <td>
                        <input type="text" name="fullname" value="<?php echo $fullname; ?>">
                    </td>
                </tr>
                <tr>
                    <td> Username</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php  
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";
        //Get all the values from form to update
        $id=$_POST['id'];
        $fullname=$_POST['fullname'];
        $username=$_POST['username'];

        //SQL query to update admin
        $sql = "UPDATE tbl_admin SET
                full_name = '$fullname',
                username = '$username' 
                WHERE id = '$id'";

        //Execute the query
        $res = mysqli_query($conn, $sql);

        //check if the query is executed or not
        if($res==true)
        {
            //query executed and updated admin data
            $_SESSION['update']= "<div class='success'>Updated Successfully</div>";
            //redirect to manage-admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed to Update
            $_SESSION['update']= "<div class='error'>Update Failed</div>";
            //redirect to manage-admin page
            header('location:'.SITEURL.'admin/manage-admin.php');

        }
    }

?>

<?php include('partials/footer.php'); ?>