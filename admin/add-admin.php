<?php 
    include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add']; //Displaying session message
                    unset($_SESSION['add']); //Removing session message
                }
            ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Full Name"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" placeholder="Username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="Password"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Add Admin" class="btn-secondary"></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
    include('partials/footer.php');
   ?>

   <?php 
        //Process the value from form and save it to Database

        //Check whether the submit button is clicked or not

        // if(isset($_POST['submit']))
        // {
        //     //Button clicked
            
            
        //     //1. Get the data from form
        //     $full_name=$_POST['full_name']; //<- name-property of the form-input tag
        //     $username=$_POST['username'];
        //     $password=md5($_POST['password']); //Password encryption with MD5
        //     $usertype = "admin";

        //     //2. SQL save the data to database
        //     $sql = "INSERT INTO tbl_admin SET 
        //    /*coloumn name ->*/ full_name='$full_name',
        //                         username='$username',
        //                         user_type=$usertype,
        //                         password='$password'";

        //     //3. Execute Query and Save Data in database (was put in constants afterwards)
        //     // $conn = mysqli_connect('localhost', 'root', 'Xampp04!.1') or die(mysqli_error()); //Database connection
        //     // $db_select=mysqli_select_db($conn, 'food_order') or die(mysqli_error()); //Selecting Database name

        //     $res=mysqli_query($conn, $sql) or die(mysqli_error());

        //     //4. Check whether the Query is Executed data i inserted or not and display appropriate message
        //     if($res==true)
        //     {
        //         //Data inserted
        //         //echo "Data inserted";
        //         //Create a session variable to display message
        //         $_SESSION['add'] = "<div class='success'>Admin Add Successfuly!</div>";

        //         //Redirect page to Manage Admin
        //         header("location:".SITEURL.'admin/manage-admin.php');
        //     } else
        //     {
        //         // Failed to insert
        //         //echo "Failed to insert data";
        //         $_SESSION['add'] = "<div class='error'>Failed to Add Admin!</div>";

        //         //Redirect page to Add Admin
        //         header("location:".SITEURL.'add-admin.php');
        //     }
        // }

        if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $fullname = $_POST['full_name'];
    $username = $_POST['username'];
    $usertype = "admin";
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    // Hash the password
   // $password = mysqli_real_escape_string($conn, $plain_password);

    // Prepare and bind
    $check="SELECT * FROM tbl_admin WHERE username='$username' ";
    $check_user=mysqli_query($conn, $check);

    $row_count=mysqli_num_rows($check_user);

    if($row_count==1){
        echo " <script type='text/javascript'>
        alert('Username Already Exist.');
        window.location.href = 'add-admin.php';
        </script>";
        
    } else 
    {
        $sql = "INSERT INTO tbl_admin (full_name, username, usertype, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $fullname, $username, $usertype, $password); // If you want to turn the password into hush just change the "$plain_password" to "$hash_password"

            if ($stmt->execute()) {
                // Redirect to login page after successful registration
                header('location:'.SITEURL.'admin/manage-admin.php');
                exit(); // Ensure no further code is executed after redirection
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }
}

$conn->close();

   ?>
    