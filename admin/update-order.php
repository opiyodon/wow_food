<?php include('partials/menu.php'); ?>

<div class="main-content2">

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
                    
            <h2 class="text-center">Update Order</h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <div class="forms">


        <?php 
        
            //CHeck whether id is set or not
            if(isset($_GET['id']))
            {
                //GEt the Order Details
                $id=$_GET['id'];

                //Get all other details based on this id
                //SQL Query to get the order details
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                //Execute Query
                $res = mysqli_query($conn, $sql);
                //Count Rows
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Detail Availble
                    $row=mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address= $row['customer_address'];
                }
                else
                {
                    //DEtail not Available/
                    //Redirect to Manage Order
                    header('location:'.ADMINURL.'manage-order.php');
                    ob_end_flush();
                }
            }
            else
            {
                //REdirect to Manage ORder PAge
                header('location:'.ADMINURL.'manage-order.php');
                ob_end_flush();
            }
        
        ?>

        <form action="" method="POST" class="myform" enctype="multipart/form-data">
        
            
                <div>
                    <div>Food Name:
                    <b> <?php echo $food; ?> </b></div>
                </div>

                <div>
                    <div>Price:
                        <b> Ksh. <?php echo $price; ?></b>
                    </div>
                </div>

                <div>
                    <div>Qty:
                        <input required class="input" type="number" name="qty" value="<?php echo $qty; ?>">
                    </div>
                </div>

                <div>
                    <div>Status:
                        <select required class="input" name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>

                <div>
                    <div>Customer Name: 
                        <input required class="input" type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </div>
                </div>

                <div>
                    <div>Customer Contact: 
                        <input required class="input" type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </div>
                </div>

                <div>
                    <div>Customer Email: 
                        <input required class="input" type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </div>
                </div>

                <div>
                    <div>Customer Address: 
                        <textarea required class="input3" name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </div>
                </div>

                <div>
                    <div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="Update Order" class="btnn btn-secondary">
                    </div>
                </div>
            
        
        </form>


        <?php 
            //CHeck whether Update Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //Get All the Values from Form
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty;

                $status = $_POST['status'];

                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                //Update the Values
                $sql2 = "UPDATE tbl_order SET 
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id=$id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //CHeck whether update or not
                //And REdirect to Manage Order with Message
                if($res2==true)
                {
                    //Updated
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                    header('location:'.ADMINURL.'manage-order.php');
                    ob_end_flush();
                }
                else
                {
                    //Failed to Update
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                    header('location:'.ADMINURL.'manage-order.php');
                    ob_end_flush();
                }
            }
        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>
