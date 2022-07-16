<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])) //Checking whether or not the session is set
            {
                echo $_SESSION['add']; //Displays the Session Message if it's set
                unset($_SESSION['add']); //Removes the Session Message
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php 
    //Processes the Value from the form and save it in the Database

    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button Clicked
        //echo "Button Clicked";

        //Get the Data from the form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encryption with MD5

        //SQL Query to Save the data into database
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
 
        //Executing Query and Saving Data into Datbase
        $res = mysqli_query($conn, $sql) or die(mysqli_error());


        //Check whether the (Query is Executed) data is inserted or not and display an appropriate message
        if($res==TRUE)
        {
            //Create a Session Variable to Display the Message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
            
            //Redirects the Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Creates a Session Variable to Display Message
            $_SESSION['add'] = "<div class='error'>An error has occured</div>";
            
            //Redirects Page to Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }

    }
    
?>