
    <?php include('partials-front/menu.php'); ?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php 

                //Gets the Search Keyword
                // $search = $_POST['search'];
                $search = mysqli_real_escape_string($conn, $_POST['search']);
            
            ?>


            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>



    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

                //Query to Get foods based on searched keyword
                // $search = burger '; DROP database name;
                // "SELECT * FROM tbl_food WHERE title LIKE '%burger'%' OR description LIKE '%burger%'";

                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //Executes the Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //Check whether or not food is available
                if($count>0)
                {
                    //Food Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Gets the details
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    // Check whether or not the image name is available
                                    if($image_name=="")
                                    {
                                        //Image is not Available
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        //Image is Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                                        <?php 

                                    }
                                ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">$<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    //Food is Not Available
                    echo "<div class='error'>Food not found.</div>";
                }
            
            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>

    <?php include('partials-front/footer.php'); ?>