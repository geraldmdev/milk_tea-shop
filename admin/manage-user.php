<?php 
    include('partials/menu.php')
?>    

    <!-- Main Content Starts -->
    <div class="main-content">
         <div class="wrapper">
             <h1>Manage User</h1>
             <br><br><br>

            <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add']; //Displaying session message
                    unset($_SESSION['add']); //Removing session message
                }
                
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete']; //Displaying session message
                    unset($_SESSION['delete']); //Removing session message
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update']; //Displaying session message
                    unset($_SESSION['update']); //Removing session message
                }

                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found']; //Displaying session message
                    unset($_SESSION['user-not-found']); //Removing session message
                }

                if(isset($_SESSION['pwd-not-match']))
                {
                    echo $_SESSION['pwd-not-match']; //Displaying session message
                    unset($_SESSION['pwd-not-match']); //Removing session message
                }

                if(isset($_SESSION['change-pwd']))
                {
                    echo $_SESSION['change-pwd']; //Displaying session message
                    unset($_SESSION['change-pwd']); //Removing session message
                }
            ?>
            <br><br><br>

             <table class="tbl-full">
                <tr>
                    <th>Serial Number</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Date Registered</th>
                    <th>Action</th>
                </tr>

                <?php 
                    //Query to Get all Admin
                    $sql = "SELECT * FROM tbl_admin WHERE usertype = 'user' ORDER BY id DESC";
                    //Execute the Query
                    $res = mysqli_query($conn, $sql);

                    //Check whether the query is executed or not
                    if($res==true)
                    {
                        //Count rows to check whether we have data in database or not
                        $count = mysqli_num_rows($res); //Function to get all the rows in database

                        $sn=1; //Create a variable and assogn the value

                        //Check the num of rows
                        if($count>0)
                        {
                            //We have data in database
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                //Using while loop to get all the data from databse
                                //And while loop will run as long as we have data in database

                                //Get individual data
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username=$rows['username'];
                                $registered=$rows['registered_at'];

                                //Display the values in our table
                                ?>
                                    
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td><?php echo $registered; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Edit</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger" onclick="return confirm('Are you sure you want to delete this User?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        } 
                        else
                        {
                            //We do not have data in database
                        }
                    }
                ?>

             </table>

        </div>
    </div>

    <!-- Main Content Ends -->

    <?php 
    include('partials/footer.php')
   ?>