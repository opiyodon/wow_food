<?php include('partials/menu.php'); ?>

<div class="main-content2">

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
                    
            <h2 class="text-center">Update Admin</h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <div class="forms">

        <?php 
            //1. Get the ID of Selected Admin
            $id=$_GET['id'];

            //2. Create SQL Query to Get the Details
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            //Execute the Query
            $res=mysqli_query($conn, $sql);

            //Check whether the query is executed or not
            if($res==true)
            {
                // Check whether the data is available or not
                $count = mysqli_num_rows($res);
                //Check whether we have admin data or not
                if($count==1)
                {
                    // Get the Details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    //Redirect to Manage Admin PAge
                    header('location:'.SITEURL.'admin/manage-admin.php');
                    ob_end_flush();
                }
            }
        
        ?>


        <form action="" method="POST" class="myform" enctype="multipart/form-data">

            
                <div>
                    <div>Full Name:
                        <input required class="input" type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </div>
                </div>

                <div>
                    <div>Username:
                        <input required class="input" type="text" name="username" value="<?php echo $username; ?>">
                    </div>
                </div>

                <div>
                    <div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btnn btn-secondary">
                    </div>
                </div>

            

        </form>
    </div>
</div>

<?php 

    //Check whether the Submit Button is Clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button CLicked";
        //Get all the values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //Create a SQL Query to Update Admin
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id='$id'
        ";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed successfully or not
        if($res==true)
        {
            //Query Executed and Admin Updated
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
            ob_end_flush();
        }
        else
        {
            //Failed to Update Admin
            $_SESSION['update'] = "<div class='error'>Failed to Delete Admin.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
            ob_end_flush();
        }
    }

?>


<?php include('partials/footer.php'); ?>