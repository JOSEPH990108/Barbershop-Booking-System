<?php include('partials-front/header.php'); ?>

    <div class="col s12 m6">
      <div class="card blue-grey">
        <div class="card-content white-text">
          <h1 class="card-title">Newsletter</h1>
        </div>
      </div>
    </div>
    <div class='container1'>
    <table  class="tbl-full" >
          <tr>
              <th style="width:20%"> </th>
              <th style="width:50%">Newsletter</th>
              <th>Publish Date</th>
          </tr>
            <?php

              $per_page_record = 2;

              // Look for a GET variable page if not found default is 1.        
              if (isset($_GET["page"])) {    
              $page  = $_GET["page"];    
              }    
              else {    
                  $page=1;    
              }

              $offset = ($page-1) * $per_page_record; 
              $total_pages_sql = "SELECT COUNT(*) FROM tbl_newsletter WHERE active='Yes'";
              $result = mysqli_query($conn,$total_pages_sql);
              $total_rows = mysqli_fetch_array($result)[0];
              $total_pages = ceil($total_rows / $per_page_record);

              //Create SQL Query to get all the food
              $sql = "SELECT * 
                      FROM tbl_newsletter
                      WHERE active='Yes' 
                      ORDER BY ndate, edate
                      LIMIT $offset, $per_page_record";
                //Display service that active 
                //SQL QUery

                //Execute the query
                $res = mysqli_query($conn, $sql);
                
                //Count rows
                $count = mysqli_num_rows($res);
                //$active = $active['active'];

                //Check whether the services are available
                if($count>0)
                {
                    //Services available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $news_id = $row['news_id'];
                        $title = $row['title'];
                        $content = $row['content'];
                        $ndate = $row['ndate'];
                        $edate = $row['edate'];
                        $image = $row['image_name'];
                        ?>

                    <tr>
                        <td><img class="image" width='200px' height='200px' src="<?php echo SITEURL; ?>images/newsletter/<?php echo $image; ?>" alt="Picture" class="img-responsive img-curve"></td>
                        <td class="grey lighten-4">
                        	<h5><strong><?php echo $title; ?></strong></h5>
                        	<p><?php echo $content; ?></p>
                        </td>
                        <td class="grey lighten-4">
                        	<p><?php echo $ndate; ?></p></td>
                    </tr>
                        <?php
                    }
                }
                else
                {
                    //Service not available
                    echo "<div class='error'>No Newsletter available</div>";                
                }
                ?>
            </table>
            <div class="pagination">
                <?php

                    $pagLink = "";

                    if($page>=2){   
                        echo "<a href='newsletter.php?page=".($page-1)."'>  Prev </a>";   
                    }       
                               
                    for ($i=1; $i<=$total_pages; $i++) {   
                      if ($i == $page) {   
                          $pagLink .= "<a class = 'active' href='newsletter.php?page="  
                                                            .$i."'>".$i." </a>";   
                      }               
                      else  {   
                          $pagLink .= "<a href='newsletter.php?page=".$i."'>   
                                                            ".$i." </a>";     
                      }   
                    };     
                    echo $pagLink;   
              
                    if($page<$total_pages){   
                        echo "<a href='newsletter.php?page=".($page+1)."'>  Next </a>";   
                    }

                ?>
            </div> 
          </div>
          <div class="clearfix"></div>
    </section>
