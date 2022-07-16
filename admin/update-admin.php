<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php 
            //Get the ID of the Selected Admin
            $id=$_GET['id'];

            //SQL Query to Get Details
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            //Executes the Query
            $res=mysqli_query($conn, $sql);

            //Check whether or not the query is executed
            if($res==true)
            {
                // Check whether or not the data is available
                $count = mysqli_num_rows($res);

                //Check whether or not we have admin data
                if($count==1)
                {
                    // Get the Details
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else

                {
                    //Redirects to Manage Admin PAge
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        
        ?>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php 

    //Check whether or not the Submit Button is Clicked 
    if(isset($_POST['submit']))
    {
        //Get all the values from the form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //Query to Update Admin
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id='$id'
        ";

        //Executes the Query
        $res = mysqli_query($conn, $sql);

        //Check whether or not the query executed successfully
        if($res==true)
        {
            //Query is Executed and Admin is successfully Updated
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed to Update Admin
            $_SESSION['update'] = "<div class='error'>Failed to Delete Admin.</div>";
            
            //Redirects to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

?>


<?php include('partials/footer.php'); ?>