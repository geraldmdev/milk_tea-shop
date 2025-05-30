<?php
    include('user-nav.php');
?>

<?php
    // Check if cart id is set or not
    if (isset($_GET['cart_id'])) {
        // Get the cart id and details of the selected food
        $cart_id = $_GET['cart_id'];

        // Query
        $sql = "SELECT * FROM tbl_cart WHERE id=$cart_id";
        // Execute
        $res = mysqli_query($conn, $sql);
        // Count
        $count = mysqli_num_rows($res);

        // Check if the data is available
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);

            $name = $row['name'];
            $price = $row['price'];
            $image = $row['image'];
            $qty = $row['qty'];
            
        } else {
            // Redirect to cart page
            header('Location: ' . SITEURL . 'user/user-cart.php');
            exit(); // Ensure script execution stops after redirection
        }

    } else {
        // Redirect to cart page
        header('Location: ' . SITEURL . 'user/user-cart.php');
        exit(); // Ensure script execution stops after redirection
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
                    if ($image == "") {
                        echo "<div class='error'>Image Not Available.</div>";
                    } else {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image; ?>" alt="" class="img-responsive img-curve">
                        <?php
                    }
                    ?>
                </div>
    
                <div class="food-menu-desc">
                    <h3><?php echo $name; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $name; ?>">

                    <p class="food-price">₱<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="<?php echo $qty; ?>" required>
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
                <textarea name="address" rows="10" placeholder="Enter Address" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>

        <?php
        // Check if the submit button is clicked
        if (isset($_POST['submit'])) {
            // Get all the details from the form
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];

            $total = $price * $qty;
            $order_date = date("Y-m-d h:i:sa");
            $status = "ordered"; // ordered, on delivery, delivered, cancelled

            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            // Save the order in the database
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
            customer_address = '$customer_address'";

            // Execute
            $res2 = mysqli_query($conn, $sql2);

            // Check if the execution was successful
            if ($res2 == true) {
                // Query executed and order saved
                // Remove the item from the cart
                $sql3 = "DELETE FROM tbl_cart WHERE id=$cart_id";
                $res3 = mysqli_query($conn, $sql3);

                // Check if the item was successfully removed from the cart
                if ($res3 == true) {
                    // Success message and redirect
                    echo "<script type='text/javascript'>
                    alert('Ordered Successfully!');
                    window.location.href='" . SITEURL . "user/user-cart.php';
                    </script>";
                } else {
                    // Failure to remove item from cart
                    echo "<script type='text/javascript'>
                    alert('Order placed but failed to remove item from cart.');
                    window.location.href='" . SITEURL . "user/user-cart.php';
                    </script>";
                }
            } else {
                // Failed
                echo "<script type='text/javascript'>
                alert('Order Failed!');
                window.location.href='" . SITEURL . "user/user-cart.php';
                </script>";
            }
        }
        ?>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('../partials-front/footer.php'); ?>
