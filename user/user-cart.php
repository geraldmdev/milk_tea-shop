<?php
    include('user-nav.php');

    //update quantity
    if(isset($_POST['update_qty']))
    {
        $update_value=$_POST['qty'];
        //echo $update_value;
        $update_id=$_POST['update_qty_id'];
        //echo $update_id;

        $sql2=mysqli_query($conn, "UPDATE `tbl_cart` SET qty=$update_value WHERE id=$update_id");
        echo "<div class='success'>Updated Successfully</div>";
    }

    if(isset($_GET['delete_all']))
    {
        $sql3=mysqli_query($conn, "DELETE FROM `tbl_cart`");
        header('location:'.SITEURL.'user/user-cart.php');

        if($sql3==true)
        {
            $_SESSION['delete'] = "<div class='success'>Product Deleted From Your Cart Successfully.</div>";
            header('location:'.SITEURL.'user/user-cart.php');
        }else
        {
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Product.</div>";
            header('location:'.SITEURL.'user/user-cart.php');
        }
    }

?>
<div class="main-content">
<div class="container">
    <section class="cart-page" style="">
        <h1 class="text-center">MY CART</h1> <br> <br>
        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset ($_SESSION['delete']);
            }
        ?>
        <table class="tbl-full text-center" style="border-collapse:separate;border-spacing:10px;margin: 5%; margin: auto;padding: 5%; border-radius: 2%;background-color: #fab1a0; " >
            <thead>
                <th  style="border-bottom: solid; ">S.N.</th>
                <th   style="border-bottom: solid; ">Product Name</th>
                <th   style="border-bottom: solid; ">Image</th>
                <th   style="border-bottom: solid; ">Price</th>
                <th   style="border-bottom: solid; ">Qty</th>
                <th   style="border-bottom: solid; ">&emsp;Total Price &emsp; </th>
                <th   style="border-bottom: solid; ">Action</th>
            </thead>
            <tbody>
            <?php
        //Get all the orders from the database
        $sql = "SELECT * FROM tbl_cart ORDER BY id DESC";
        //Execute
        $res=mysqli_query($conn, $sql);
        //Count
        $count = mysqli_num_rows($res);
        //check

        $sn = 1;

        if($count>0)
        {
            while($row=mysqli_fetch_assoc($res))
            {
                $id=$row['id'];
                $name=$row['name'];
                $image=$row['image'];
                $price=number_format($row['price']);
                $qty=$row['qty'];
                $total=$price*$qty;

                ?>
                    
                    <tr>
                        <td><?php echo $sn++; ?>.</td>
                        <td><?php echo $name; ?></td>
                        <td>
                            <?php
                             //check if we have image
                            if($image=="")
                            {
                                //We do not have image. display error message
                                echo "<div class='error'>Image not added.</div>";
                            } else
                            {
                                //We have image, display image
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image; ?>" width="150px">
                                <?php
                            } 
                             ?>
                        </td>
                        <td>₱<?php echo $price; ?></td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="update_qty_id" value="<?php echo $id; ?>">
                                <div class=""  style="width: 2%; padding-left:30px;display:flex;">
                                <input type="number" name="qty" class="" min="1" value="<?php echo $qty; ?>" style="width: 100px;">
                                <input type="submit" name="update_qty" class="btn-secondary" value="Update">
                                </div>
                            </form>
                            
                        </td>
                        <td>₱<?php echo $total; ?>.00</td>

                        <td>
                            <a href="<?php echo SITEURL; ?>user/user-cart-order.php?cart_id=<?php echo $id; ?>"><i class="fas fa-credit-card" style="color:#0652DD;"></i></a> &emsp;
                            <a href="<?php echo SITEURL; ?>user/user-delete-cart.php?id=<?php echo $id; ?>&image=<?php echo $image; ?>" style="color:#ff3838;" onclick="return confirm('Are you sure you want to delete this item?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    
                <?php

            }
        }else
        {
            echo "<tr><td colspan='12' class='error'>Add Product to Your Cart</td></tr>";
        }
    ?> 
            <div > 
            <tr class="tbl-30" style="background-color:#dfffff;">
            <td colspan="4" style=" padding: 1%; border-radius:5px;"><b><a href="<?php echo SITEURL; ?>user/user-home.php">ADD ITEM</a></b></td>
            <div>
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
                <td colspan="2"><b>Grand Total: <span>₱<?php echo number_format($total_revenue, 2); ?></span></b></td>
            </div>
            <td style="padding-left:10px;padding-right:10px; border-radius:5px;" class="btn-primary"><a href="<?php echo SITEURL; ?>user/user-checkout-order.php?cart_id=<?php echo $id; ?>" style="color:white;">Checkout</a></td>
        </tr>
        </div>
        
        <div >
            <tr >
                <td colspan="7"  class="btn-primary"><div style="border-collapse:separate;border-spacing:100px;padding:10px;padding-right:10px; border-radius:5px; background-color:#ff3838;"><a href="user-cart.php?delete_all"><i class="fas fa-trash" style="color:#fff;" onclick="return confirm('Deleting All the Cart Items')">&emsp;Delete All</i></a></div></td>
            </tr>
        </div>  
                   
                     
         </tbody>
        </table>
    </section>
</div>
</div>



<?php include('../partials-front/footer.php'); ?>