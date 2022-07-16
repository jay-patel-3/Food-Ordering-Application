<?php 
    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name'])) //Either use '&&' or 'AND'
    {
        //Process to Delete food page

        //Get ID and Image NAme
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the Image if it's Available
        //Check whether or not the image is available and Delete it
        if($image_name != "")
        {
            // Removes the image from the folder
            // Gets the Image Path
            $path = "../images/food/".$image_name;

            //Remove Image File from Folder
            $remove = unlink($path);

            //Check whether or not the image is removed
            if($remove==false)
            {
                //Failed to Remove the image
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                
                //Redirects to Manage Food
                header('location:'.SITEURL.'admin/manage-food.php');
                
                //Stop the Process of Deleting the food
                die();
            }

        }

        //Delete Food from Database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        
        //Executes the Query
        $res = mysqli_query($conn, $sql);

        //Checks whether or not the query executed and sets the session message respectively
        //Redirects to Manage Food with Session Message
        if($res==true)
        {
            //Food Deleted
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";\
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //Failed to Delete Food
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";\
            header('location:'.SITEURL.'admin/manage-food.php');
        } 

    }
    
    else
    {
        //Redirects to Manage Food Page
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>