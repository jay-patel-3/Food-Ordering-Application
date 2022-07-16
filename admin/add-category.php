<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>

        <br><br>

        <!-- Add Category Form -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        


        <?php 
        
            //Check whether the submit button is clicked or Not
            if(isset($_POST['submit']))
            {
                //Gets the Value from the category Form
                $title = $_POST['title'];

                //For the radio input, we need to check whether the button is selected or not
                if(isset($_POST['featured']))
                {
                    //Gets the Value from the form
                    $featured = $_POST['featured'];
                }
                else
                {
                    //Default value is set
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                //Check whether the image is selected or not and set the value for the image name accordingly

                if(isset($_FILES['image']['name']))
                {
                    //Upload the Image
                    //To upload image we need the image name, source path and destination path
                    $image_name = $_FILES['image']['name'];
                    
                    // Upload the Image only if the image is selected
                    if($image_name != "")
                    {

                        //Our Image will be auto-renamed
                        //Get the Extension of our image (jpg, png, gif, etc) Example: "logo.jpg"
                        $ext = end(explode('.', $image_name));

                        //Rename the Image
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext; // e.g. Foodup_143.jpg
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Finally, the Image will need to be uploaded
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether or not the image is uploaded
                        //If the image is not uploaded then we will stop the process and redirect with an error message
                        if($upload==false)
                        {
                            //Sets message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            
                            //Redirect to the Add Category Page
                            header('location:'.SITEURL.'admin/add-category.php');
                            
                            //Stops the Process
                            die();
                        }

                    }
                }
                else
                {
                    //Don't Upload Image. Set the image_name value as blank
                    $image_name="";
                }

                //Create SQL Query to Insert a Category into the Database
                $sql = "INSERT INTO tbl_category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                //Executes the Query and Save it in the Database
                $res = mysqli_query($conn, $sql);

                //Check whether or not the query was executed and that the data has been added
                if($res==true)
                {
                    //Query is Executed and new Category Added
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                    
                    //Redirect to the Manage Category Page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //Failed to Add a Category
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                    
                    //Redirect to the Manage Category Page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>