<?php include('partials-front/menu.php'); ?>

<!-- Food Search Section -->
<section class="food-search text-center">
    <div class="container"> 
    </div>
</section>

 <!--Contact Info-->
 <form action="<?php echo SITEURL; ?>contact.php" method="POST">
    <section class="contact-box">
        <br /><br />
        <div class="container">
            <h2 class="text-center">Contact Info</h2>

            <div class="order-label">Full Name</div>
            <input type="text" name="full-name" placeholder="Jay Patel" class="input-responsive" required>

            <div class="order-label">Phone Number</div>
            <input type="tel" name="contact" placeholder="999-999-9999" class="input-responsive" required>

            <div class="order-label">Email</div>
            <input type="email" name="email" placeholder="john_doe_323@gmail.com" class="input-responsive" required>

            <div class="order-label">Address</div>
            <textarea name="address" rows="10" placeholder="Street, City, Country" class="input-responsive" required></textarea>

            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </div>
 </form>

