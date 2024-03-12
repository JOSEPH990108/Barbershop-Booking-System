<?php include('partials/header.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Newsletter</h1>

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
                        <input type="text" name="title" placeholder="Title of Newsletter" required>
                    </td>
                </tr>

                <tr>
                    <td>Content: </td>
                    <td>
                        <textarea name="content" cols="30" rows="8" placeholder="Content of the newsletter"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Newsletter date: </td>
                    <td>
                        <input type="date" required id="ndate" name="ndate" value="<?=date("Y-m-d")?>">
                    </td>
                </tr>

                <tr>
                    <td>Newsletter expired date: </td>
                    <td>
                        <input type="date" required id="edate" name="edate" value="<?=date("Y-m-d")?>">
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
                        <input type="submit" name="submit" value="Add Newsletter" class="btn-secondary">
                        <input type="button" value="Cancel" class="btn-danger" onClick="document.location.href='http://localhost/barbershopbookingsystem/admin/manage-newsletter.php';" />
                    </td>
                </tr>

            </table>
        </form>

        <?php
            //Check whether the submit button is clicked
            if(isset($_POST['submit']))
            {
                //Add the newsletter to database
                //1. Get the data from form
                $title = $_POST['title'];
                $content = $_POST['content'];
                $ndate = $_POST['ndate'];
                $edate = $_POST['edate'];
                
                //Check whether radio button for active are checked or not

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

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
                            $image_name = "Barber_Newsletter_".rand(000, 999).'.'.$ext; 
                            
                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/newsletter/".$image_name;

                            //Upload the Image
                            $upload = move_uploaded_file($source_path, $destination_path);

                            //Check whether the image is uploaded or not
                            //And if the image is not uploaded then we will stop the process and redirect with error message
                            if($upload==FALSE)
                            {
                                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                                //Redirect to newsletter page
                                header('location:'.SITEURL.'admin/manage-newsletter.php');
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

                //3. Insert into database
                //Creat  a SQL Quert to save service
                $sql3 = "INSERT INTO tbl_newsletter SET
                    title = '$title',
                    content = '$content',
                    image_name = '$image_name',
                    ndate = '$ndate',
                    edate = '$edate',
                    active = '$active'
                ";

                //Excute Query
                $res3 = mysqli_query($conn, $sql3);

                if($res3==TRUE)
                {
                    //Data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Newsletter Added Successfully</div>";
                   header('location:'.SITEURL.'admin/manage-newsletter.php');
                }
                else
                {
                    //Failed to insert data
                    $_SESSION['add'] = "<div class='error'>Newsletter Added Unsuccessfully</div>";
                    echo 'query error:'.mysqli_error($conn);
                    header('location:'.SITEURL.'admin/manage-newsletter.php');
                }
                //4. Redirect with message to manage service page
                header('location:'.SITEURL.'admin/manage-newsletter.php');
                
            }
        ?>


    </div>
</div>

<?php include('partials/footer.php') ?>