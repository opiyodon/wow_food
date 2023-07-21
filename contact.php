
<?php include('partials-front/menu.php'); ?>

<!-- Contact Section Starts Here -->
<section class="contact text-center">
    <div class="container contact-form">

        <!-- Contact form Start HEre -->
        <form action="" method="POST" class="myform text-center">
        
                <h1 class="text-center">Contact Us</h1>

                <div class="row">
                    <input required class="input" type="text" name="username" placeholder="Enter Username...">

                    <input required class="input" type="email" name="email" placeholder="Enter Email...">
                </div>
                    
                <div>
                    <input required class="input2" type="text" name="subject" placeholder="Enter Subject...">
                </div>

                <div>
                    <textarea required class="input3" type="text" name="message" placeholder="Write your message here..."></textarea>
                </div>
                    
                <div>
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                </div>

        </form>
        <!-- Contact form Ends HEre -->

    </div>
</section>
<!-- Contact Section Ends Here -->


<?php include('partials-front/footer.php'); ?>