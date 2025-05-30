<?php 
include ('config/constants.php'); 
include('admin/partials/login-check.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo"  style="padding-top: 2%;">
                <a href="#" title="Logo">
                    <strong><h3>BINIbeybi</h3></strong><!-- <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive"> -->
                </a>
                <br><p style="color: #e66767; margin-bottom: 0;"><b>WELCOME ADMIN</b></p>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>admin-home.php">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>admin-categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>admin-foods.php">Menu</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>admin/index.php" class="btn-primary" style="padding: 1%; border-radius: 5px;color: #fff;">Dashboard</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

<?php
    //check if food id is set or not
    if(isset($_GET['food_id']))
    {
        //Get the food id and details of the selected food
        $food_id=$_GET['food_id'];

        //Query
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        //Execute
        $res=mysqli_query($conn, $sql);
        //Count
        $count =mysqli_num_rows($res);

        //check if the data is available
        if($count==1)
        {
            $row=mysqli_fetch_assoc($res);

            $title=$row['title'];
            $price=$row['price'];
            $image_name=$row['image_name'];
            
        }else
        {
            header('location:'.SITEURL);
        }

    }else
    {
        //Redirect to homepage
        header('location:'.SITEURL);
    }
?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            if($image_name=="")
                            {
                                echo "<div class='error'>Image Not Available.</div>";
                            } else
                            {
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">₱<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter Full Name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9453xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Enter Email" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="Enter Adress" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                //check if the submit button is clicke
                if(isset($_POST['submit']))
                {
                    //Get all the details form the form
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty;

                    $order_date =date("Y-m-d h:i:sa");

                    $status = "ordered"; //ordered, on delivery, delivered ,cancelled

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    //Save the order in database
                    //Sql query
                    $sql2 = "INSERT INTO tbl_order SET 
                    food = '$food',
                    price = $price,
                    qty = $qty,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    ";

                    //execute
                    $res2 = mysqli_query($conn, $sql2);

                    // check if the executed is success
                    if($res2==true)
                    {
                        //Query executed and order save
                        $_SESSION['order']="<div class='success text-center'>Ordered Successfully</div>";
                        header('location:'.SITEURL.'admin-home.php');
                    } else
                    {
                        //Failed
                        $_SESSION['order']="<div class='error text-center'>Order Failed</div>";
                        header('location:'.SITEURL.'admin-home.php');
                    }
                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>