<?php 
    include('../config/constants.php');

    //Check whether or not the id and image_name value are set
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the Value and Delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file if it is available
        if($image_name != "")
        {
            //Image is Available, and so it is removed
            $path = "../images/category/".$image_name;
            
            //Removes the Image
            $remove = unlink($path);

            //If the image cannot be removed, then the process stops with an error message
            if($remove==false)
            {
                //Session Message
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
                
                //Redirects to Manage Category page
                header('location:'.SITEURL.'admin/manage-category.php');
                
                //Stops the Process
                die();
            }
        }

        //Deletes Data from Database
        //Query to Delete Data from Database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether or not the data is deleted from the database
        if($res==true)
        {
            //Sets Success Message and Redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
            
            //Redirects to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Sets Failed Message and Redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
           
            //Redirects to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }

 

    }
    else
    {
        //Redirects to Manage Category Page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>