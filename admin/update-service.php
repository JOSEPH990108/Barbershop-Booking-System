<?php include('partials/header.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Service</h1>

            <br><br>
        <!-- Get the data from database -->
        <?php
            //Check whether the category_id is set or not
            if(isset($_GET['service_id']))
            {
                //Get the id and all other details
                $service_id = $_GET['service_id'];

                //Create SQL Query to get all other details
                $sql = "SELECT * FROM tbl_service WHERE service_id = $service_id";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Check Whether the Query is executed or not
                if($res==TRUE)
                {
                    //Chech whether the data is available or not
                    $count = mysqli_num_rows($res);

                    //Check whether we have admin data or not
                    if($count==1)
                    {
                        //Get the details
                        $rows = mysqli_fetch_assoc($res);
                        $service_id = $rows['service_id'];
                        $current_category = $rows['category_id'];
                        $price = $rows['price'];
                        $title = $rows['title'];
                        $description = $rows['description'];
                        $featured = $rows['featured'];
                        $active = $rows['active'];
                    }
                    else
                    {
                        //Redirect to Manage Admin Page
                        $_SESSION['no-service-found'] = "<div class='error'>Service Not Found</div>";
                        header('location:'.SITEURL.'admin/manage-service.php');
                    }
                }
            }
            else
            {
                //Redirect to manage category
                header('location:'.SITEURL.'admin/manage-service.php');
            }
        ?>

            <!-- enctype="multipart/form-data" used to upload form function -->
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-40">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>" maxlength=99>
                        </td>
                    </tr>

                    <tr>
                        <td>Description: </td>
                        <td>
                            <textarea name="description" cols="30" rows="8"><?php echo $description; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td>
                            <input type="number" name="price" value="<?php echo $price; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Category: </td>
                        <td>
                            <select name="category">

                                <?php
                                //Query to get active category
                                    $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";
                                //Execute the query
                                    $res2 = mysqli_query($conn, $sql2);
                                //Count rows
                                    $count1 = mysqli_num_rows($res2);

                                //Check whether category available
                                if($count1>0)
                                {
                                    //Category Available
                                    while($row=mysqli_fetch_assoc($res2))
                                    {
                                        $category_title = $row['title'];
                                        $category_id = $row['category_id'];

                                        //echo "<option value='$category_id'>$category_title</option>";
                                        ?>

                                        <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        
                                        <?php
                                    }
                                }
                                else
                                {
                                    //Catgory Not Available
                                    echo "<option value='0'>Category Not Available</option>";
                                }
                                ?>
                                
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                            <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="service_id" value="<?php echo $service_id; ?>">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                        <input type="button" value="Cancel" class="btn-danger" onClick="document.location.href='http://localhost/barbershopbookingsystem/admin/manage-service.php';" />
                    </td>
                </tr>

                </table>
            </form>
                                
            <?php

            if(isset($_POST['submit']))
            {
                //1. Get all the values from form
                $service_id = $_POST['service_id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. Update the database
                $sql3 = "UPDATE tbl_service SET
                    title = '$title',
                    description = '$description',
                    category_id = '$category',
                    price = $price,
                    featured = '$featured',
                    active = '$active'
                    WHERE service_id = $service_id
                ";

                //Execute the Query
                $res3 = mysqli_query($conn,$sql3);

                //4. Redirect to Manage Service with Message
                //Check Whether Query executed or not
                if($res3==TRUE)
                {
                    //Service Updated
                    $_SESSION['updated'] = "<div class='success'>Service Updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-service.php');
                }
                else
                {
                    //Failed to update Service
                    $_SESSION['updated'] = "<div class='error'>Service Updated Unsuccessfully</div>";
                    header('location:'.SITEURL.'admin/manage-service.php');
                }
            }
        ?>

        </div>
    </div>

<?php include('partials/footer.php'); ?>