<?php include('partials/menu.php'); ?>

<div class="main-content2">

                <!-- fOOD sEARCH Section Starts Here -->
                <section class="food-search text-center">
                    <div class="container">
                        
                        <h2 class="text-center">Add Admin</h2>

                        <?php 
                            if(isset($_SESSION['add'])) //Checking whether the SEssion is Set of Not
                            {
                                echo $_SESSION['add']; //Display the SEssion Message if SEt
                                unset($_SESSION['add']); //Remove Session Message
                            }
                        ?>

                    </div>
                </section>
                <!-- fOOD sEARCH Section Ends Here -->

    <div class="forms">

        <form action="" method="POST" class="myform" enctype="multipart/form-data">

                <div>
                    <input required class="input" type="text" name="full_name" placeholder="Enter Your Name">
                </div>

                <div>
                    <input required class="input" type="text" name="username" placeholder="Your Username">
                </div>

                <div>
                    <input required class="input" type="password" name="password" placeholder="Your Password">
                </div>

                <div>
                    <input type="submit" name="submit" value="Add Admin" class="btnn btn-secondary">
                </div>

        </form>


    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php 
    //Process the Value from Form and Save it in Database

    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button Clicked
        //echo "Button Clicked";

        //1. Get the Data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encryption with MD5

        //2. SQL Query to Save the data into database
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
 
        //3. Executing Query and Saving Data into Datbase
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res==true)
        {
            //Data Inserted
            //echo "Data Inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
            ob_end_flush();
        }
        else
        {
            //FAiled to Insert DAta
            //echo "Faile to Insert Data";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin.</div>";
            //Redirect Page to Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
            ob_end_flush();
        }

    }
    
?>