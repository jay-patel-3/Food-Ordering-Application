<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
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
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php 

            //Checks whether or not the Submit Button is Clicked
            if(isset($_POST['submit']))
            {
                //Get Data from the Form
                $id=$_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);


                //Check whether or not the user with the current ID and Password Exists 
                $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

                //Executes the Query
                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    //Check whether or not data is available
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                        //User Exists and the Password Can be Changed

                        //Check whether or not the new password and confirm password match
                        if($new_password==$confirm_password)
                        {
                            //Updates the Password
                            $sql2 = "UPDATE tbl_admin SET 
                                password='$new_password' 
                                WHERE id=$id
                            ";

                            //Executes the Query
                            $res2 = mysqli_query($conn, $sql2);

                            //Checks whether or not the query executed
                            if($res2==true)
                            {
                                //Displays Success Message
                                //Redirects to Manage Admin Page with a Success Message
                                $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
                                
                                //Redirects the User
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                            else
                            {
                                //Displays Error Message
                                //Redirect to Manage Admin Page with an Error Message
                                $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password. </div>";
                                
                                //Redirects the User
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                        }
                        else
                        {
                            //Redirects to Manage Admin Page with an Error Message
                            $_SESSION['pwd-not-match'] = "<div class='error'>Password Did not Patch. </div>";
                            //Redirects the User
                            header('location:'.SITEURL.'admin/manage-admin.php');

                        }
                    }
                    else
                    {
                        //User Does not Exist. Set Message and Redirect
                        $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";
                        
                        //Redirects the User
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }

                //Checks Whether or not the New Password and Confirm Password Match

                //Change the Password if all above is true
            }

?>


<?php include('partials/footer.php'); ?>