<?php

include('config/constants.php');

$mysqli = new mysqli('localhost', 'root', '', 'barbershop');

if(isset($_SESSION['username']))
{
    $user = $_SESSION['username'];                          
}

if(isset($_GET['customer_id'])&&isset($_GET['date'])&&isset($_GET['timeslot']))
{
    $customer_id = $_GET['customer_id'];
    $date = $_GET['date'];
    $timeslot = $_GET['timeslot'];

    $stmt = $mysqli->prepare("SELECT * FROM tbl_appointment WHERE date = ? AND isCancel ='No'");
    $stmt->bind_param('s', $date);
    $bookings = array();
    $cancel = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['timeslot'];        
            }            
            $stmt->close();
        }
    }

    $stmt = $mysqli->prepare("SELECT a.timeslot AS Timeslot, a.date AS Date, a.barber_id AS BarberID, a.service_id AS ServiceID, CONCAT(ad.first_name, ' ', ad.last_name) AS Barber, s.title AS Title, a.isCancel AS Cancel
                              FROM (((tbl_appointment a
                              INNER JOIN tbl_customer c ON a.customer_id = c.customer_id)
                              INNER JOIN tbl_admin ad ON a.barber_id = ad.barber_id)
                              INNER JOIN tbl_service s ON a.service_id = s.service_id)
                              WHERE a.customer_id = $customer_id AND a.date = '$date' AND a.timeslot = '$timeslot'");
                                if($stmt->execute()){
                                    $result = $stmt->get_result();
                                    if($result->num_rows==1){
                                        $row = $result->fetch_assoc();
                                        $current_barber = $row['BarberID'];
                                        $current_service = $row['ServiceID'];
                                        $current_date = $row['Date'];
                                        $current_timeslot = $row['Timeslot'];
                                        $isCancel = $row['Cancel'];
                                        //$datetime = date('Y-m-d H:i:s', strtotime("$date $end"));
                                        ?>

                                        <?php
                                    }            
                                        $stmt->close();
                                }
}



if(isset($_POST['submit'])){
    $cid = $_POST['customer_id'];
    $times = $_POST['timeslot'];
    $bid = $_POST['barber_id'];
    $sid = $_POST['service_id'];
    $sql = "UPDATE tbl_appointment 
            SET customer_id = $cid, 
                barber_id = $bid, 
                service_id = $sid, 
                timeslot = '$times'
            WHERE customer_id = $customer_id AND date = '$date' AND timeslot = '$timeslot'";

    $res = mysqli_query($conn,$sql);
    if($res==TRUE){
      $_SESSION['edit-success'] = "<div class='alert alert-success'>Edit successfully</div>";
      header('location:'.SITEURL.'history.php');  
    }
    else{
        $_SESSION['edit-unsuccess'] = "<div class='alert alert-success'>Edit unsuccessfully</div>";
        header('location:'.SITEURL.'history.php');
    }
    
}


    $duration = 30;
    $cleanup = 0;
    $start = "10:00";
    $end = "22:00";

function timeslots($duration, $cleanup, $start, $end)
{
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT".$duration."M");
    $cleanupInterval = new DateInterval("PT".$cleanup."M");
    $slots = array();

    
      for($intStart = $start; $intStart<$end; $intStart->add($interval)->add($cleanupInterval))
        {
            $endPeriod = clone $intStart;
            $endPeriod->add($interval);

            if($endPeriod>$end)
            {
                break;
            }

            $slots[] = $intStart->format("H:iA")."-".$endPeriod->format("H:iA");
        }  
    
    return $slots;
}

?>

<!doctype html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
  </head>

  <body>
    <div class="container">
        <h1 class="text-center">Edit Appointment On Date: <?php echo date('d/m/Y', strtotime($date)); ?></h1>
            <button class="pull-right"><a href="history.php"><b>Back</b></a></button>
        <br>
        <hr>
            <div class="row">
                <div class="col-md-2">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="">CUSTOMER ID</label>
                            <?php
                                $stmt = $mysqli->prepare("SELECT customer_id FROM tbl_customer WHERE username='$user'");
                                if($stmt->execute()){
                                    $result = $stmt->get_result();
                                    if($result->num_rows>0){
                                        while($row = $result->fetch_assoc()){
                                            $cus_id = $row['customer_id'];

                                            ?>

                                            <input required type="text" name="customer_id" value="<?php echo $cus_id; ?>" readonly="readonly" class="form-control">

                                            <?php
                                        }            
                                        $stmt->close();
                                    }
                                }
                            ?>
                        </div>

                        <div class="form-group">
                            <label for="">TIMESLOT</label>
                            <select name="timeslot">
                            <?php
                            $timeslots = timeslots($duration, $cleanup, $start, $end); 
                            foreach($timeslots as $ts){ 
                                if(in_array($ts, $bookings)&&$current_timeslot==$ts){ ?>
                                    <option <?php echo "selected"; ?> value="<?php echo $ts; ?>" ><?php echo $ts; ?></option>
                                <?php }else if(!in_array($ts, $bookings)){ ?>
                                    <option value="<?php echo $ts; ?>" ><?php echo $ts; ?></option>
                            <?php }
                            }
                            ?>
                            </select>   
                        </div>

                        <div class="form-group">
                            <label for="">BARBER</label>
                            <select name="barber_id">
                            <?php
                                $stmt = $mysqli->prepare("SELECT * FROM tbl_admin");
                                if($stmt->execute()){
                                    $result = $stmt->get_result();
                                    if($result->num_rows>0){
                                        while($row = $result->fetch_assoc()){
                                            $barber_id = $row['barber_id'];
                                            $fname = $row['first_name'];
                                            $lname = $row['last_name'];

                                            ?>

                                            <option <?php if($current_barber==$barber_id){echo "selected";} ?> value="<?php echo $barber_id; ?>"><?php echo $fname; ?> <?php echo $lname; ?></option>

                                            <?php
                                        }            
                                        $stmt->close();
                                    }
                                }
                            ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">SERVICE</label>
                            <select name="service_id">
                            <?php
                                $stmt = $mysqli->prepare("SELECT * FROM tbl_service WHERE active='Yes' ORDER BY title");
                                if($stmt->execute()){
                                    $result1 = $stmt->get_result();
                                    if($result1->num_rows>0){
                                        while($row1 = $result1->fetch_assoc()){
                                            $service_id = $row1['service_id'];
                                            $title = $row1['title'];
                                            
                                            ?>

                                            <option <?php if($current_service==$service_id){echo "selected";} ?> value="<?php echo $service_id; ?>"><?php echo $title; ?></option>

                                            <?php
                                        }            
                                        $stmt->close();
                                    }
                                }
                            ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>

</html>