<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php 
                                //PHP Code to display categories from the database
                                //SQL to get all active categories from the database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                
                                //Executing the query
                                $res = mysqli_query($conn, $sql);

                                //Count Rows to check whether we have the categories or not
                                $count = mysqli_num_rows($res);

                                //IF count is greater than zero, we have categories, otherwise we do not have any categories
                                if($count>0)
                                {
                                    //Categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //Details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    //No category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            

                                //Display on Drpopdown
                            ?>

                        </select>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        
        <?php 

            //CHeck whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the Food in Database
                
                //Get data from the Form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //Check whether or not the radio button for featured and active are checked
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //Setting the Default Value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; //Setting the Default Value
                }

                //Upload the Image if selected
                //Check whether the select image is clicked or not and upload the image only if it's selected
                if(isset($_FILES['image']['name']))
                {
                    //Gets details of the selected image
                    $image_name = $_FILES['image']['name'];

                    //Check Whether or not the Image is selected and upload it
                    if($image_name!="")
                    {
                        // Image is Selected
                        // Rename the Image
                        // Get the extension of the selected image (jpg, png, gif, etc.) "jay-patel.jpg" jay-patel jpg
                        $ext = end(explode('.', $image_name));

                        // Create a New Name for the Image
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext; //New Image Name May Be "Food-Name-657.jpg"

                        //Upload the Image
                        //Gets the Src and Destinaton path

                        // Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        //Destination Path for the image to be uploaded
                        $dst = "../images/food/".$image_name;

                        //Upload the food image
                        $upload = move_uploaded_file($src, $dst);

                        //check whether or not the image uploaded
                        if($upload==false)
                        {
                            //Failed to Upload the image
                            //Redirect to Add Food Page with Error Message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            
                            //Stop the process
                            die();
                        }

                    }

                }

                else
                {
                    $image_name = ""; //Setting DEfault Value as blank
                }

                //Insert Into the Database

                //Create a SQL Query to Save or Add food
                // For Numerical we do not need to pass value inside quotes '' But for string value it is compulsory
                $sql2 = "INSERT INTO tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Check whether or not data is inserted
                //Redirects with a Message to Manage Food page
                if($res2 == true)
                {
                    //Data inserted Successfullly
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //Failed to Insert Data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

                
            }

        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>