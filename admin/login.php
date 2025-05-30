<?php
    include('../config/constants.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BINIBeysik</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="">
        
        <br><br>

        <?php
            if(isset($_SESSION['login']))
            {
               echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message']))
            {
               echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>
        <br><br>

        <!-- Login Form Starts -->
        <div class="wrapper-login">
        <form action="" method="POST">
            <h2>Login</h2>
            <div class="input-field">
            <input type="text" name="username" required>
            <label>Enter your username</label>
            </div>
            <div class="input-field">
            <input type="password" name="password" required>
            <label>Enter your password</label>
            </div>

            <input type="submit" name="submit" value="Login" class="input">
            <div class="register">
            <p>Don't have an account? &emsp;<a href="<?php echo SITEURL; ?>admin/register-process.php">Register Here</a>.</p>
            </div>
        </form>
        </div>

        <!-- Login Form Ends -->


        <!-- <p class="text-center">Created By - <a href="#">Ge Magda</a></p> -->
    </div>
</body>
</html>

<?php
    //Check if the submit button is cliked
    if(isset($_POST['submit']))
    {
        //Process for login
        //1. Get the data from Login Form
        //$username = $_POST['username']; //Not secured
        $username = mysqli_real_escape_string($conn, $_POST['username']); //Secured code
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        //2. SQL to check if the username and password is exist
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. execute the query
        $res = mysqli_query($conn, $sql);

        //4. count the rows to check the user exist
        $count = mysqli_fetch_assoc($res);

        if($count["usertype"]=="user")
        {
            //User Available and Login Success
            $_SESSION['login']="<div class='success'>Login Successful</div>";
            $_SESSION['user'] = $username; //to check if the user is login and logout will unset it
            //Redirect to Home page dashboard
           
            //header('location:'.SITEURL.'user/user-home.php');
            echo "<script type='text/javascript'>
            alert('Welcome BINI $username!');
            window.location.href='" . SITEURL . "user/user-home.php';
            </script>";
            
        }
        elseif ($count["usertype"]=="admin")
        {
            //User Available and Login Success
            $_SESSION['login']="<div class='success'>Login Successful</div>";
            $_SESSION['user'] = $username; //to check if the user is login and logout will unset it
            //Redirect to Home page dashboard
            //header('location:'.SITEURL.'admin-home.php');
            echo "<script type='text/javascript'>
            alert('Welcome BINI $username! (admin)');
            window.location.href='" . SITEURL . "admin-home.php';
            </script>";
        }
        else
        {
            //User not available
            $_SESSION['login']="<div class='error text-center'>Login Failed</div>";
            //Redirect to Home page dashboard
            header('location:'.SITEURL.'admin/login.php');
        }

        
        
    }
?>
