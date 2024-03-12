<?php include('partials/header.php');?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Newsletter</h1>

            <br><br>

        <?php
            //Check whether the news_id is set or not
            if(isset($_GET['news_id']))
            {
                //Get the id and all other details
                $news_id = $_GET['news_id'];

                //Create SQL Query to get all other details
                $sql = "SELECT * FROM tbl_newsletter WHERE news_id = $news_id";

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
                        $news_id = $row['news_id'];
                        $title = $row['title'];
                        $current_content = $row['content'];
                        $current_image = $row['image_name'];
                        $edate = $row['edate'];
                        $active = $row['active'];
                    }
                    else
                    {
                        //Redirect to Manage Admin Page
                       $_SESSION['no-news-found'] = "<div class='error'>Newsletter Not Found</div>";
                        header('location:'.SITEURL.'admin/manage-newsletter.php');
                    }
                }
            }
            else
            {
                //Redirect to manage newletter
                header('location:'.SITEURL.'admin/manage-newsletter.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
           <table class="tbl-40">
                <tr>
                    <td>New Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>New Content: </td>
                    <td>
                        <textarea name="ncontent" cols="30" rows="8" placeholder=><?php echo $current_content; ?></textarea>
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
                                     <img src="<?php echo SITEURL; ?>images/newsletter/<?php echo $current_image; ?>" width="150px">
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
                    <td>Newsletter expire date: </td>
                    <td>
                        <input type="date" required id="edate" name="edate" value="<?=date("Y-m-d")?>">
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
                        <input type="hidden" name="news_id" value="<?php echo $news_id; ?>">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                        <input type="button" value="Cancel" class="btn-danger" onClick="document.location.href='http://localhost/barbershopbookingsystem/admin/manage-newsletter.php';" />
                    </td>
                </tr>

           </table>
        </form>

        <?php

            if(isset($_POST['submit']))
            {
                //1. Get all the values from form
                $news_id = $_POST['news_id'];
                $title = $_POST['title'];
                $content= $_POST['ncontent'];
                $image = $_POST['current_image'];
                $edate = $_POST['edate'];
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
                        $image_name = "Barber_Newsletter_".rand(000, 999).'.'.$ext; //Barber_Newsletter_101.jpg
                            
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
                        //B. Remove the current image
                        if($current_image != "")
                        {
                            $remove_path = "../images/newsletter/".$current_image;
                            $remove = unlink($remove_path);

                            //Check whether the image is removed or not
                            //If failed to remove then display message and stop the process
                            if($remove==FALSE)
                            {
                                //Faile to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove Current Image</div>";
                                header('location:'.SITEURL.'admin/manage-newsletter.php');
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
                $sql2 = "UPDATE tbl_newsletter SET
                    title = '$title',
                    content = '$content',
                    image_name = '$image_name',
                    edate = '$edate',
                    active = '$active'
                    WHERE news_id = $news_id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn,$sql2);

                //4. Redirect to Manage newsletter with Message
                //Check Whether Query executed or not
                if($res2==TRUE)
                {
                    //newsletter Updated
                    $_SESSION['updated'] = "<div class='success'>Newsletter Updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-newsletter.php');
                }
                else
                {
                    //Failed to update newsletter
                    $_SESSION['updated'] = "<div class='error'>Newsletter Updated Unsuccessfully</div>";
                    header('location:'.SITEURL.'admin/manage-newsletter.php');
                }
            }
        ?>

        </div>
    </div>

<?php include('partials/footer.php');?>