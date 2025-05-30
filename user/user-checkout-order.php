<?php
include('user-nav.php'); // Include navigation or other necessary files

// Update quantity
// if (isset($_POST['update_qty'])) {
//     $update_values = $_POST['qty'];
//     $update_ids = $_POST['update_qty_id'];

//     foreach ($update_ids as $index => $update_id) {
//         $update_value = $update_values[$index];
//         $sql2 = mysqli_query($conn, "UPDATE `tbl_cart` SET qty=$update_value WHERE id=$update_id");
//     }
//     echo "<div class='success'>Updated Successfully</div>";
// }

// Process checkout
if (isset($_POST['submit'])) {
    // Get all cart items
    $cart_items = [];
    $sql = "SELECT * FROM tbl_cart";
    $res = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($res)) {
        $cart_items[] = $row;
    }

    if (!empty($cart_items)) {
        // Loop through each cart item and save it to the order table
        foreach ($cart_items as $item) {
            $food = $item['name'];
            $price = $item['price'];
            $qty = $item['qty'];
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
            customer_address = '$customer_address'
            ";

            // Execute
            $res2 = mysqli_query($conn, $sql2);

            // Check if the query executed successfully
            if (!$res2) {
                // Failed to insert order
                $_SESSION['order'] = "<div class='error text-center'>Order Failed</div>";
                header('Location: ' . SITEURL . 'user/user-cart.php');
                exit();
            }
        }

        // If all orders are successfully inserted, delete all items from the cart
        $sql3 = "DELETE FROM tbl_cart";
        $res3 = mysqli_query($conn, $sql3);

        if ($res3) {
            //$_SESSION['order'] = "<div class='success text-center'>Ordered Successfully and cart cleared!</div>";
           
        } else {
            $_SESSION['order'] = "<div class='error text-center'>Order placed but failed to clear the cart.</div>";
        }

        // Redirect to the cart page
        //header('Location: ' . SITEURL . 'user/user-cart.php');
        echo "<script type='text/javascript'>
        alert('Ordered Successfully!');
        window.location.href='" . SITEURL . "user/user-cart.php';
        </script>";
        exit();
    } else {
        $_SESSION['order'] = "<div class='error text-center'>No items in the cart to order.</div>";
        header('Location: ' . SITEURL . 'user/user-cart.php');
        exit();
    }
}
?>

<div class="main-content" style="background: #dcdde1;">
    <!-- <div class="container"> -->
        <section class="food-search" >
            <div class="container">
            <h1 class="text-center">Complete Your Order</h1>
            <br><br>

            <?php
            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            ?>

            <form action="" method="POST">
                
                <table class="tbl-full text-center" style=" margin: auto; padding: 5%;border:1px solid white;  border-radius: 2%; background-color: #fab1a0;">
                    <thead>
                        <tr >
                            <th>S.N.</th>
                            <th>Product Image</th>
                            <th>Product Details</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM tbl_cart ORDER BY id DESC";
                    $res = mysqli_query($conn, $sql);
                    $sn = 1;

                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $image = $row['image'];
                            $price = number_format($row['price'], 2);
                            $qty = $row['qty'];
                            $total = $price * $qty;
                    ?>
                        <tr >
                            <td><?php echo $sn++; ?>.</td>
                            <td style="text-align: center;">
                                <div class="tex-center">
                                    <?php
                                    if ($image == "") {
                                        echo "<div class='error'>Image Not Available.</div>";
                                    } else {
                                    ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image; ?>" alt="" class="img-responsive img-curve" style="width:100px;">
                                    <?php
                                    }
                                    ?>
                                </div>
                            </td>
                            <td>
                                <div class="food-menu-desc">
                                    <h4><?php echo $name; ?></h4>
                                    <input type="hidden" name="food" value="<?php echo $name; ?>">

                                    <p class="food-price">₱<?php echo $price; ?>&emsp;(<?php echo $qty; ?>pc.)</p>
                                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                                    <!-- <div class="order-label">Quantity</div>
                                    <p><?php// echo $qty; ?></p> -->
                                    <input type="hidden" name="qty[]" class="input-responsive" value="<?php echo $qty; ?>" required>
                                    <input type="hidden" name="update_qty_id[]" value="<?php echo $id; ?>">
                                </div>
                            </td>
                            <td>₱<?php echo number_format($total, 2); ?></td>
                        </tr>
                        
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='4' class='error'>No items in the cart.</td></tr>";
                    }
                    ?>
                        <tr style="background-color:#dfffff;">
                        <?php
                     //query to get total revenue by aggregate function
                     $sql = "SELECT SUM(price*qty) AS Total FROM tbl_cart";

                     //Execute
                     $res =mysqli_query($conn,$sql);

                     //Get the value
                     $row = mysqli_fetch_assoc($res);

                     //Get the Total Revenue
                     $total_revenue = $row['Total'];
            ?>
                            <td colspan="3" style="padding:10px;border-radius:5px;"><b><a href="#">All Total:</a></b></td>
                            <td  style="padding:10px;border-radius:5px;"><b>₱<?php echo number_format($total_revenue, 2); ?></b></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <fieldset class="" style=" margin: auto; max-width:400px; border-radius: 2%; border:1px solid white; color: black; background-color:#fab1a0;">
                    <legend class="text-white"><strong>Delivery Details</strong></legend>
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
            </div>
        </section>
    </div>
</div>

<?php include('../partials-front/footer.php'); ?>
