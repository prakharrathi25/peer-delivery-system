<?php

// Make a database connection
include('include/db_connect.php');

// Get user id
$page_id = $_GET['id'];

// Collect User data
$sql = "SELECT * FROM users WHERE user_id = '$page_id'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$user_row = $result->fetch_assoc();

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!--Own css files-->
    <link href="assets/css/ds.css" rel="stylesheet">
    <!-- <link href="" rel="stylesheet"> -->
    <link href="assets/css/dashboard1.css" rel="stylesheet">
    <title>Dashboard</title>
</head>

<body>
    <div class="sidebar-container">
        <div class="sidebar-logo">
            <?php echo $user_row['firstName'].' '.$user_row['lastName'] ?>
        </div>
        <ul class="sidebar-navigation">
            <div class="container-fluid">
                <br>
                <img src="<?php echo 'register/'.$user_row['profileImage'] ?>" class="img-fluid" alt="Responsive image"><br>

                <!-- Display Details -->
                <h4>Your Details</h4>
                <p>User Rating: <?php echo $user_row['rating'] ?></p>
                <p>Credits: <?php echo $user_row['credits'] ?> </p>
                <p>Total Deliveries: <?php echo $user_row['deliveries'] ?></p>
                <p>User Since: <?php echo substr($user_row['registerDate'], 0, 10) ?></p>
            </div>
            <li class="header">Navigation</li>
            <li>
                <a href="Order/booking-order.php?id=<?php echo $page_id ?>">
                    <i class="fa fa-home" aria-hidden="true"></i> Book a courier
                </a>
            </li>
            <li>
                <a href="dashboard1.html">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Pick a courier
                </a>
            </li>
            <li class="header">Orders</li>
            <li>
                <a href="myorders.php?id=<?php echo $page_id; ?>">
                    <i class="fa fa-users" aria-hidden="true"></i> My Orders
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-cog" aria-hidden="true"></i> My Requests
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Payment Information
                </a>
            </li>
        </ul>
    </div>
    <div class="content-container">
        <div class="container">
                    <h3>Your Placed Requests</h3>

                    <!-- Collect order details -->
                    <?php
                        $placed_sql = "SELECT * FROM requests, packages WHERE packages.pid = requests.package_id AND user=$page_id";
                        $placed_result=mysqli_query($conn, $placed_sql) or die(mysqli_error($conn));
                        while($row = $placed_result->fetch_assoc()){
                     ?>
                     <!-- Start Showing Order Cards  -->

                     <!-- Order Card -->
                    <div class="card mb-3 text-white bg-dark">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="<?php echo substr($row['start_image'], 3)?>" class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Recepient Name: <?php echo $row['name'] ?></h5>
                                    <div class="row">
                                        <div class="col">
                                            <address>
                                                <strong>Pickup Location:</strong> <?php echo $row['pickup'] ?> <br>
                                                <strong>Drop Location:</strong> <?php echo $row['destination'] ?> <br><br>
                                                <strong>Dimenstions (cm):</strong> <?php echo $row['length'].'x'.$row['width']. 'x'.$row['height']?>


                                            </address>
                                        </div>
                                        <div class="col">
                                            <address>
                                                <strong>Description: </strong> <?php echo $row['content_description'] ?> <br>
                                                <strong>Cost: </strong> <?php echo  "Rs. ".$row['cost']; ?> <br><br>
                                                <strong>Status: </strong><?php echo $row['status'] ?><br><br>
                                                <strong>Your Quote: </strong><?php echo "Rs. ".$row['price'] ?>
                                            </address>
                                        </div>
                                        <div class="col">
                                            <p>
                                                <strong>Special Instructions: </strong><?php echo $row['instructions'] ?><br>
                                                <strong>Delivery Agent:</strong> <?php
                                                                    if($_row['traveller_id']){
                                                                        $travel_sql = "SELECT firstName, lastName from users where user_id = $tid";
                                                                        $travel_result=mysqli_query($conn, $travel_sql) or die(mysqli_error($conn));
                                                                        $t_row = $travel_result->fetch_assoc();
                                                                        echo $t_row['firstName'].$t_row['lastName'];
                                                                    }else{
                                                                        echo "Not Assigned";
                                                                    }

                                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

                <!-- Second Half: Received Requests -->
                <h3>Your Received Requests</h3>

                <!-- Collect order details -->
                <?php
                    $placed_sql = "SELECT * FROM requests, packages WHERE packages.pid = requests.package_id AND user_id=$page_id AND status='Active'";
                    $placed_result=mysqli_query($conn, $placed_sql) or die(mysqli_error($conn));
                    while($row = $placed_result->fetch_assoc()){
                 ?>
                 <!-- Start Showing Order Cards  -->

                 <!-- Order Card -->
                <div class="card mb-3 text-white bg-dark">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="<?php echo substr($row['start_image'], 3)?>" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Requester Name: <?php echo $row['r_name'] ?></h5>
                                <div class="row">
                                    <div class="col">
                                        <address>
                                            <strong>Pickup Location:</strong> <?php echo $row['pickup'] ?> <br>
                                            <strong>Drop Location:</strong> <?php echo $row['destination'] ?> <br><br>
                                            <strong>Dimenstions (cm):</strong> <?php echo $row['length'].'x'.$row['width']. 'x'.$row['height']?>


                                        </address>
                                    </div>
                                    <div class="col">
                                        <address>
                                            <strong>Description: </strong> <?php echo $row['content_description'] ?> <br>
                                            <strong>Cost: </strong> <?php echo  "Rs. ".$row['cost']; ?> <br><br>
                                            <strong>Status: </strong><?php echo $row['status'] ?><br><br>
                                            <strong>Recieved Quote: </strong><?php echo "Rs. ".$row['price'] ?>
                                        </address>
                                    </div>
                                    <div class="col">
                                        <p>
                                            <strong>Special Instructions: </strong><?php echo $row['instructions'] ?><br>
                                        </p>
                                    </div>
                                </div>
                                <div style="justify-content: center" class="row">
                                    <!-- allot the package to the user who sent the request -->
                                    <form class="" action="accept-order.php?uid=<?php echo $row['user'];?>&pid=<?php echo $row['pid']; ?>&cost=<?php echo $row['price']?>&owner=<?php echo $page_id ?>" method="post">
                                        <!--  -->
                                        <input type="submit" name="request-submit" value="Accept Order" style="float: right" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>

                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
    <script src="./src/bootstrap-input-spinner.js"></script>
    <script>
        $("input[type='number']").inputSpinner()
    </script>
</body>

</html>
