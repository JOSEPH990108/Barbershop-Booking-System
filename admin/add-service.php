<?php include('partials/header.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Service</h1>

        <br><br>

        <?php
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset ($_SESSION['upload']);
                }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-40">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of Service" maxlength=99 required>
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="8" placeholder="Description of the service"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" required>
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php 
                                //Create php code to display categories from database
                                //1. Create SQL to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes' ORDER BY title";

                                //Execute Query
                                $res = mysqli_query($conn, $sql);

                                //Count rows to check whether we have category or not
                                $count = mysqli_num_rows($res);
                                
                                //If $count is greater than 0, we have category
                                if($count>0)
                                {
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        //Get the details of categories
                                        $category_id = $row['category_id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $category_id; ?>"><?php echo $title; ?></option>
                                        
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>

                                    <option value="0">No Category Found</option>

                                    <?php
                                }
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Service" class="btn-secondary">
                        <input type="button" value="Cancel" class="btn-danger" onClick="document.location.href='http://localhost/barbershopbookingsystem/admin/manage-service.php';" />
                    </td>
                </tr>

            </table>
        </form>

        <?php
            //Check whether the submit button is clicked
            if(isset($_POST['submit']))
            {
                //Add the service to database
                //1. Get the data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];//$category instead of $category_id
                
                //Check whether radio button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                //3. Insert into database
                //Creat  a SQL Quert to save service
                $sql2 = "INSERT INTO tbl_service SET
                    title = '$title',
                    description = '$description',
                    price = $price, 
                    category_id = $category, 
                    featured = '$featured',
                    active = '$active'
                ";

                //Excute Query
                $res2 = mysqli_query($conn, $sql2);

                if($res2==TRUE)
                {
                    //Data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Service Added Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-service.php');
                }
                else
                {
                    //Failed to insert data
                    $_SESSION['add'] = "<div class='error'>Service Added Unsuccessfully</div>";
                    header('location:'.SITEURL.'admin/manage-service.php');
                }
                //4. Redirect with message to manage service page
                header('location:'.SITEURL.'admin/manage-service.php');
            }
        ?>


    </div>
</div>

<?php include('partials/footer.php') ?>