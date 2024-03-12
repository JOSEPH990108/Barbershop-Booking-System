<?php include('partials/header.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>

                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; //Displaying Session message
                        unset($_SESSION['add']); //Removing Session message
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload']; //Displaying Session message
                        unset($_SESSION['upload']); //Removing Session message
                    }
                ?>
            <br><br>
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-40">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title" maxlength=99 required>
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                            <input type="button" value="Cancel" class="btn-danger" onClick="document.location.href='http://localhost/barbershopbookingsystem/admin/manage-category.php';" />
                        </td>
                    </tr>
                </table>
            </form>

            <?php

                //Check whether the submit button is clicked
                if(isset($_POST['submit']))
                {
                    //echo "Clicked";
                    //1. Get the data from the form
                    $title = $_POST['title'];
                    
                    //For the radio input type, we need to check whther the button is selected
                    if(isset($_POST['featured']))
                    {
                        //Get the value 'Yes' or 'No' from form
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        //Set default value
                        $featured = "No";
                    }

                    if(isset($_POST['active']))
                    {
                        //Get the value 'Yes' or 'No' from form
                        $active = $_POST['active'];
                    }
                    else
                    {
                        //Set default value
                        $active = "No";
                    }

                    //Check Image is selected or not and set the value for image name according
                    //print_r($_FILES['image']);
                    //die();//Break the Code here
                    if(isset($_FILES['image']['name']))
                    {
                        //Upload the image
                        //To upload image we need image name, source path and destination part
                        $image_name = $_FILES['image']['name'];
                        
                        //Upload the image only if image is selected
                        if($image_name != "")
                        {
                            //Auto Rename Image
                            //Get the Extension of our image (jpg, png, gif, etc) e.g food1.jpg
                            $ext = end(explode('.', $image_name));

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
                                header('location:'.SITEURL.'admin/add-category.php');
                                //Stop the process
                                die();
                            }
                        }
                    }
                    else
                    {   
                        //Don't upload image and set the image name value as blank
                        $image_name = "";
                    }


                    //2. Create SQL Query to insert Category into Database
                    $sql = "INSERT INTO tbl_category SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                    ";

                    //3. Execute the Query and Save in Database
                    $res = mysqli_query($conn, $sql);

                    //4. Check whether the query executed or not and data added or not
                    if($res==TRUE)
                    {
                        //Query executed and Category added
                        $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
                        //Redirect to Manage Category Page
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        //Failed to add category
                        $_SESSION['add'] = "<div class='error'>Failed to Add Category</div>";
                        //Redirect to Manage Category Page
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                }
            ?>

        </div>
    </div>

<?php include('partials/footer.php'); ?>