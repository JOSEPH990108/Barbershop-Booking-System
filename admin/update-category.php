<?php include('partials/header.php');?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>

            <br><br>

        <?php
            //Check whether the category_id is set or not
            if(isset($_GET['category_id']))
            {
                //Get the id and all other details
                $category_id = $_GET['category_id'];

                //Create SQL Query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE category_id = $category_id";

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
                        
                        $row = mysqli_fetch_assoc($res);
                        $category_id = $row['category_id'];
                        $title = $row['title'];
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    }
                    else
                    {
                        //Redirect to Manage Admin Page
                       $_SESSION['no-category-found'] = "<div class='error'>Category Not Found</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                }
            }
            else
            {
                //Redirect to manage category
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
           <table class="tbl-40">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>"maxlength=99>
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image != "")
                            {
                                //Display the image
                                ?>
                                     <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else{
                                //Display Message
                                echo "<div class='error'>Image Not Added</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
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
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                        <input type="button" value="Cancel" class="btn-danger" onClick="document.location.href='http://localhost/barbershopbookingsystem/admin/manage-category.php';" />
                    </td>
                </tr>

           </table>
        </form>

        <?php

            if(isset($_POST['submit']))
            {
                //1. Get all the values from form
                $category_id = $_POST['category_id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. Updating New image if selected
                //Check whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //Get the image details
                    $image_name = $_FILES['image']['name'];

                    //Check whether the image is available or not
                    if($image_name != "")
                    {
                        //Image available
                        //A. Upload the new image
                         //Auto Rename Image
                        //Get the Extension of our image (jpg, png, gif, etc) e.g food1.jpg
                        $temp = explode('.', $image_name);
                        $ext = end($temp);
                        //Rename the Image
                        $image_name = "Barber_Category_".rand(000, 999).'.'.$ext; //Barber_Category_101.jpg
                            
                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==FALSE)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                            //Redirect to category page
                            header('location:'.SITEURL.'admin/manage-category.php');
                            //Stop the process
                            die();
                        }
                        //B. Remove the current image
                        if($current_image != "")
                        {
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);

                            //Check whether the image is removed or not
                            //If failed to remove then display message and stop the process
                            if($remove==FALSE)
                            {
                                //Faile to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove Current Image</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();
                            } 
                        }   
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }
                //3. Update the database
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE category_id = $category_id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn,$sql2);

                //4. Redirect to Manage Category with Message
                //Check Whether Query executed or not
                if($res2==TRUE)
                {
                    //Category Updated
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //Failed to update Category
                    $_SESSION['update'] = "<div class='error'>Category Updated Unsuccessfully</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        ?>

        </div>
    </div>

<?php include('partials/footer.php');?>