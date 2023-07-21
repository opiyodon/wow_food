<?php 

    include('../config/constants.php'); 
    include('login-check.php');

?>


<html>
    <head>
        <meta charset="UTF-8">
        <!-- Important to make website responsive -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin - wowFood</title>

        <!-- Website Logo -->
        <link  href="../images/logo2.png"  type="image/x-icon" rel="icon">

        <!-- Link our CSS file -->
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    
    <body>
        <!-- Navbar Section Starts Here -->
        <section class="navbar">
            <div class="container">
                <div class="logo">
                    <a href="<?php echo ADMINURL; ?>" title="Logo">
                        <img src="../images/logo.png" alt="Restaurant Logo" class="img-responsive">
                    </a>
                </div>

                <div class="menu text-right">
                    <ul>
                        <li>
                            <a href="<?php echo ADMINURL; ?>">Home</a>
                        </li>
                        <li>
                            <a href="<?php echo ADMINURL; ?>manage-admin.php">Admin</a>
                        </li>
                        <li>
                            <a href="<?php echo ADMINURL; ?>manage-category.php">Category</a>
                        </li>
                        <li>
                            <a href="<?php echo ADMINURL; ?>manage-food.php">Food</a>
                        </li>
                        <li>
                            <a href="<?php echo ADMINURL; ?>manage-order.php">Order</a>
                        </li>
                        <li>
                            <a href="<?php echo SITEURL; ?>index.php">User</a>
                        </li>
                        <li>
                            <a href="<?php echo ADMINURL; ?>logout.php">Logout</a>
                        </li>
                    </ul>
                </div>

                <div class="clearfix"></div>
            </div>
        </section>
        <!-- Navbar Section Ends Here -->