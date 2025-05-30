<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Password</h1>
        <br><br>

        <?php  
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
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
    //check whether the submit is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Clicked";

        //1. Get the data form Form
        $id=$_POST['id'];
        $current_password=md5($_POST['current_password']);
        $new_password=md5($_POST['new_password']);
        $confirm_password=md5($_POST['confirm_password']);

        //2. Create query to check if the data exist
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        //execute query
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            //chech whether data is exist
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                //User Exists and Password Can be changed
                //echo "User Found.";

               //check if the new and confirm password is match
               if($new_password==$confirm_password)
               {
                    //Update Password
                    //echo "Password Match";
                    $sql2="UPDATE tbl_admin SET password='$new_password' WHERE id=$id";

                    //Execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check if the query is excuted
                    if($res2==true)
                    {
                        //Display the success message
                        $_SESSION['change-pwd']="<div class='success'>Password Changed Successfully.</div>";
                        //Redirect to manage admin page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        //Display the error message
                        $_SESSION['change-pwd']="<div class='error'>Failed to Change Password.</div>";
                        //Redirect to manage admin page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
               }
               else
               {
                    //Create SESSION message
                    $_SESSION['pwd-not-match']="<div class='error'>Password did not match.</div>";
                    //Redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
               }

            }
            else
            {
                //User does not found
                $_SESSION['user-not-found']="<div class='error'>User Not Found.</div>";
                //Redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');

            }
        }

        //3. Check if the New Password and Confirm Password is match

        //4. Update Password if above is all true
    }
?>

<?php include('partials/footer.php'); ?>