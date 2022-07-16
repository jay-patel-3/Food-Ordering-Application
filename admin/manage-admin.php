<?php include('partials/menu.php'); ?>


        <!-- Main Content Section -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>

                <br />

                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; //Displaying the Session Message
                        unset($_SESSION['add']); //Removing the Session Message
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }

                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }

                ?>
                <br><br><br>

                <!-- Button to Add Admin Users-->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>

                <br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    
                    <?php 
                        //Query to Get all Admin users
                        $sql = "SELECT * FROM tbl_admin";
                        
                        //Executes the Query
                        $res = mysqli_query($conn, $sql);

                        //Checks whether or not the Query is Executed
                        if($res==TRUE)
                        {
                            // Count Rows to Check whether or not we have data in the database
                            $count = mysqli_num_rows($res); // Function to get all rows in the database

                            $sn=1; //Create a Variable and Assign the value

                            //Check the number of rows
                            if($count>0)
                            {
                                //We Have data in the database
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    //Using a While loop to get all data from the database.
                                    //The while loop will run as long as we have data in the database

                                    //Gets Individual Data
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    //Displays the Values in our Table
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                        </td>
                                    </tr>

                                    <?php

                                }
                            }
                            else
                            {
                                //We Don't Have Data in the Database
                            }
                        }

                    ?>


                    
                </table>

            </div>
        </div>

<?php include('partials/footer.php'); ?>