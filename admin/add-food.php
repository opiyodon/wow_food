<?php include('partials/menu.php'); ?>

<div class="main-content2">

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
                <div class="container">
                    
                    <h2 class="text-center">Add Food</h2>

                    <?php 
                        if(isset($_SESSION['upload']))
                        {
                            echo $_SESSION['upload'];
                            unset($_SESSION['upload']);
                        }
                    ?>

                </div>
            </section>
            <!-- fOOD sEARCH Section Ends Here -->

    <div class="forms">

        <form action="" method="POST" class="myform" enctype="multipart/form-data">
        
            

                <div>
                    <div>Title:
                        <input required class="input" type="text" name="title" placeholder="Title of the Food">
                    </div>
                </div>

                <div>
                    <div>Description:
                        <textarea required class="input3" name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                    </div>
                </div>

                <div>
                    <div>Price:
                        <input required class="input" type="number" name="price">
                    </div>
                </div>

                <div>
                    <div>Select Image:
                        <input type="file" name="image">
                    </div>
                </div>

                <div>
                    <div>Category:
                        <select required class="input" name="category">

                            <?php 
                                //Create PHP Code to display categories from Database
                                //1. CReate SQL to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                
                                //Executing qUery
                                $res = mysqli_query($conn, $sql);

                                //Count Rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                //IF count is greater than zero, we have categories else we donot have categories
                                if($count>0)
                                {
                                    //WE have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    //WE do not have category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            

                                //2. Display on Drpopdown
                            ?>

                        </select>
                    </div>
                </div>

                <div>
                    <div>Featured:
                        <input required type="radio" name="featured" value="Yes"> Yes 
                        <input required type="radio" name="featured" value="No"> No
                    </div>
                </div>

                <div>
                    <div>Active:
                        <input required type="radio" name="active" value="Yes"> Yes 
                        <input required type="radio" name="active" value="No"> No
                    </div>
                </div>

                <div>
                    <div colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btnn btn-secondary">
                    </div>
                </div>

            

        </form>

        
        <?php 

            //CHeck whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the Food in Database
                //echo "Clicked";
                
                //1. Get the DAta from Form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //Check whether radion button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //SEtting the Default Value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; //Setting Default Value
                }

                //2. Upload the Image if selected
                //Check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    //Get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    //Check Whether the Image is Selected or not and upload image only if selected
                    if($image_name!="")
                    {
                        // Image is SElected
                        //A. REnamge the Image
                        //Get the extension of selected image (jpg, png, gif, etc.) "vijay-thapa.jpg" vijay-thapa jpg
                        $ext = end(explode('.', $image_name));

                        // Create New Name for Image
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext; //New Image Name May Be "Food-Name-657.jpg"

                        //B. Upload the Image
                        //Get the Src Path and DEstinaton path

                        // Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        //Destination Path for the image to be uploaded
                        $dst = "../images/food/".$image_name;

                        //Finally Uppload the food image
                        $upload = move_uploaded_file($src, $dst);

                        //check whether image uploaded of not
                        if($upload==false)
                        {
                            //Failed to Upload the image
                            //REdirect to Add Food Page with Error Message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.ADMINURL.'manage-food.php');
                            ob_end_flush();
                            //STop the process
                            die();
                        }

                    }

                }
                else
                {
                    $image_name = ""; //SEtting DEfault Value as blank
                }

                //3. Insert Into Database

                //Create a SQL Query to Save or Add food
                // For Numerical we do not need to pass value inside quotes '' But for sdiving value it is compulsory to add quotes ''
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

                //CHeck whether data inserted or not
                //4. Redirect with MEssage to Manage Food page
                if($res2 == true)
                {
                    //Data inserted Successfullly
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:'.ADMINURL.'manage-food.php');
                    ob_end_flush();
                }
                else
                {
                    //FAiled to Insert Data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header('location:'.ADMINURL.'manage-food.php');
                    ob_end_flush();
                }

                
            }

        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>