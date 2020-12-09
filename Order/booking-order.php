<?php

    // Make a database connection
    include('../include/db_connect.php');

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
    <link href="../assets/css/ds.css" rel="stylesheet">
    <!-- <link href="" rel="stylesheet"> -->
    <link href="../assets/css/dashboard.css" rel="stylesheet">
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
                <img src="<?php echo '../register/'.$user_row['profileImage'] ?>" class="img-fluid" alt="Responsive image"><br><br>

                <!-- Display Details -->
                <h4>Your Details</h4>
                <p>User Rating: <?php echo $user_row['rating'] ?></p>
                <p>Credits: <?php echo $user_row['credits'] ?> </p>
                <p>Total Deliveries: <?php echo $user_row['deliveries'] ?></p>
                <p>User Since: <?php echo substr($user_row['registerDate'], 0, 10) ?></p>
            </div>
        <ul class="sidebar-navigation">
            <li class="header">Navigation</li>
            <li>
                <a href="booking-order.php?id=<?php echo $page_id ?>">
                    <i class="fa fa-home" aria-hidden="true"></i> Book a courier
                </a>
            </li>
            <li>
                <a href="../Pickup/all_orders.php?id=<?php echo $page_id ?>">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Pick a courier
                </a>
            </li>
            <li class="header">Orders</li>
            <li>
                <a href="../myorders.php?id=<?php echo $page_id; ?>">
                    <i class="fa fa-users" aria-hidden="true"></i> My Orders
                </a>
            </li>
            <li>
                <a href="../myrequests.php?id=<?php echo $page_id ?>">
                    <i class="fa fa-cog" aria-hidden="true"></i> My Requests
                </a>
            </li>
            <li class="header">Account Details</li>
            <li>
                <a href="../edit-details.php?id=<?php echo $page_id ?>">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Edit Details
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Add Credits
                </a>
            </li>
            <li>
                <a href="../index.html">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Logout
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

        <div class="container-fluid">

            <div class="container-fluid">
                <h3 style="text-align: center;">Book a Courier</h3>
                <h5 style="text-align: center;">Enter the correct details to place your order.</h5>
                <hr>
                <br>
                <div class="row">
                    <div class="col">
                        <form action="order_process.php?id=<?php echo $page_id; ?>" enctype="multipart/form-data" method="post">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Recepient Name</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="name" id="inputEmail" required>
                                </div>
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Recepient Phone Number</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" name='number' id="inputEmail" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Pickup Address</label>
                                <div class="col-sm-10">
                                    <input type="text" name="pickup-address" class="form-control" id="phonenumber" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Delivery Address</label>
                                <div class="col-sm-10">
                                    <input type="text" name="deliver-address" class="form-control" id="phonenumber" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Destination City</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name='city' id="inputEmail" required>
                                </div>
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Zip Code</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" name="zip" id="inputEmail" required>
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 pt-0">Insurance</legend>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="Yes" checked>
                                                    <label class="form-check-label" for="gridRadios1">
                                                        Yes
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="No">
                                                    <label class="form-check-label" for="gridRadios2">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <label for="inputWeight3" class="col-sm-2 col-form-label">Approx weight (gm)</label>
                                <div class="col-sm-2">
                                    <input type="number" value="500" name="weight" data-decimals="2" min="0" step="10" required/>
                                </div>
                                <label for="inputWeight3" class="col-sm-2 col-form-label">Approx height (cm)</label>
                                <div class="col-sm-2">
                                    <input type="number" value="10" name="height" data-decimals="2" min="0" step="2" required/>
                                </div>
                                <label for="inputWeight3" class="col-sm-2 col-form-label">Approx length (cm)</label>
                                <div class="col-sm-2">
                                    <input type="number" value="10" name="length" data-decimals="2" min="0" step="2" required/>
                                </div>
                                <label for="inputWeight3" class="col-sm-2 col-form-label">Approx width (cm)</label>
                                <div class="col-sm-2">
                                    <input type="number" value="10" name="width" data-decimals="2" min="0" step="2" required/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <input type="text" name="desc" class="form-control" id="phonenumber" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Special Instructions</label>
                                <div class="col-sm-10">
                                    <input type="text" name="inst" class="form-control" id="phonenumber" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Price Offering (credits)</label>
                                <div class="col-sm-4">
                                    <input type="number" name="cost" class="form-control" id="phonenumber" required>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-2">Insert image</div>
                                <div class="col-sm-10">
                                    <div class="custom-file mb-3">
                                        <input type="file" name="orderImage" class="custom-file-input" id="validatedCustomFile" required>
                                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" name="order-submit" class="btn btn-primary">Book</button>
                                </div>
                            </div>

                        </form>
                    </div>
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
