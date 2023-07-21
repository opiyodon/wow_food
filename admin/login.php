
<?php 

    include('../config/constants.php');

?>


<html>
    <head>
        <meta charset="UTF-8">
        <!-- Important to make website responsive -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - wowFood</title>

        <!-- Website Logo -->
        <link  href="../images/logo2.png"  type="image/x-icon" rel="icon">

        <!-- Link our CSS file -->
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    
    <body>
        
        <div class="login">
            
            
                <!-- Login Form Starts HEre -->
                <form action="" method="POST" class="myform text-center">

                    <?php 
                        if(isset($_SESSION['login']))
                        {
                            echo $_SESSION['login'];
                            unset($_SESSION['login']);
                        }

                        if(isset($_SESSION['no-login-message']))
                        {
                            echo $_SESSION['no-login-message'];
                            unset($_SESSION['no-login-message']);
                        }
                    ?>
                
                    <h1>Login</h1>
        
                    <div>
                        <input required class="input" type="text" name="username" placeholder="Enter Username...">
                    </div>
                    
                    <div>
                        <input required class="input" type="password" name="password" placeholder="Enter Password...">
                    </div>
                    
                    <div>
                        <input type="submit" name="submit" value="Login" class="btnn">
                    </div>

                </form>
                <!-- Login Form Ends HEre -->
            

        </div>

    </body>
</html>

<?php 

    //CHeck whether the Submit Button is Clicked or NOt
    if(isset($_POST['submit']))
    {
        //Process for Login
        //1. Get the Data from Login form
        // $username = $_POST['username'];
        // $password = md5($_POST['password']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        //2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute the Query
        $res = mysqli_query($conn, $sql);

        //4. COunt rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //User AVailable and Login Success
            $_SESSION['login'] = "<div class='success'>Welcome back <?php echo $username; ?></div>";
            $_SESSION['user'] = $username; //TO check whether the user is logged in or not and logout will unset it

            //REdirect to HOme Page/Dashboard
            header('location:'.SITEURL.'admin/');
            ob_end_flush();
        }
        else
        {
            //User not Available and Login FAil
            $_SESSION['login'] = "<div class='error2 text-center'><b>Username or Password did not match.</b></div>";
            //REdirect to HOme Page/Dashboard
            header('location:'.SITEURL.'admin/login.php');
            ob_end_flush();
        }


    }

?>