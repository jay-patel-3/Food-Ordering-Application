<?php 
    include('../config/constants.php');

    // Gets the ID of Admin to be deleted
    $id = $_GET['id'];

    //SQL Query to Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    // Check whether or not the query executed successfully
    if($res==true)
    {
        //Query is Executed Successully and Admin is Deleted
        //Create a Session Variable to Display the Message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        
        //Redirects to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Failed to Delete the Admin
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    //Redirect to Manage Admin page with message (success/error)

?>