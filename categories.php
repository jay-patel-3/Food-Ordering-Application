
<?php include('partials-front/menu.php'); ?>



    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 

                //Displays all the cateories that are active
                
                //SQL Query to display categories
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                //Executes the Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //Check whether or not categories are available
                if($count>0)
                {
                    //Categories are available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Gets the Values
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    if($image_name=="")
                                    {
                                        //Image is not Available
                                        echo "<div class='error'>Image not found.</div>";
                                    }
                                    else
                                    {
                                        //Image is Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    //Categories are Not Available
                    echo "<div class='error'>Category not found.</div>";
                }
            
            ?>
            

            <div class="clearfix"></div>
        </div>
    </section>


    <?php include('partials-front/footer.php'); ?>