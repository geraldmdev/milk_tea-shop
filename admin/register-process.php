<?php
$host = "localhost";
$username = "root"; // Replace with your MySQL username
$password = "Xampp04!.1"; // Replace with your MySQL password
$dbname = "food_order";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<link rel="stylesheet" href="../css/login.css">

 <!-- Login Form Starts -->
        <div class="wrapper-login">
        <form action="" method="POST">
            <h2>Register</h2>
            <div class="input-field">
            <input type="text" name="fullname" required>
            <label>Enter your Full Name</label>
            </div>
            <div class="input-field">
            <input type="text" name="user_name"  required>
            <label>Enter your Username</label>
            </div>
            <div class="input-field">
            <input type="password" name="password"  required>
            <label>Enter your Password</label>
            </div>

            <input type="submit" name="submit" value="Register" class="input">
            <div class="register">
            <p>Already have an account?&emsp;<a href="login.php">Log in Here.</a></p>
            </div>
        </form>
        </div>


<?php

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
//         $fullname = $_POST['fullname'];
//         $username1 = $_POST['user_name'];
//         $password = $_POST['password'];

//         // Process form data here
//         echo "Full Name: $fullname<br>";
//         echo "Username: $username1<br>";
//         echo "Password: $password<br>";
// } else {
//     echo "Form not submitted!";
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $fullname = $_POST['fullname'];
    $username = $_POST['user_name'];
    $usertype = "user";
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
        window.location.href = 'register-process.php';
        </script>";
        
    } else 
    {
        $sql = "INSERT INTO tbl_admin (full_name, username, usertype, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $fullname, $username, $usertype, $password); // If you want to turn the password into hush just change the "$plain_password" to "$hash_password"

            if ($stmt->execute()) {
                // Redirect to login page after successful registration
                //header("Location: login.php");
                echo "<script type='text/javascript'>
                alert('Congratulations! You are now  BINI $username!');
                window.location.href='login.php';
                </script>";
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
