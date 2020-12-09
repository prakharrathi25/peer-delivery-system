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
                <img src="<?php echo 'register/'.$user_row['profileImage'] ?>" class="img-fluid" alt="Responsive image"><br><br> 

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
                <a href="Pickup/all_orders.php?id=<?php echo $page_id; ?>">
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
                <a href="myrequests.php?id=<?php echo $page_id; ?>">
                    <i class="fa fa-cog" aria-hidden="true"></i> My Requests
                </a>
            </li>
            <li class="header">Account Details</li>
            <li>
                <a href="edit-details.php?id=<?php echo $page_id ?>">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Edit Details
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Add Credits
                </a>
            </li>
            <li>
                <a href="index.html">
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
    <div class="p-3 mb-2 bg-dark text-white">
    <div class="content-container">
        <div class="container">
            <h3 style="text-align: center; ">Your editable details</h3>
            <p style="text-align: center;">These are the details that you're allowed to edit through this page</p>
            <h5>First Name: <?php echo $user_row['firstName'] ?></h5>
            <h5>Last Name: <?php echo $user_row['lastName'] ?></h5>
            <h5>Email: <?php echo $user_row['email'] ?></h5> <br>
            <div class="row">
                <div class="col-4">
            <form class="" action="edit-details.php?id=<?php echo $user_row['user_id']; ?>" method="post">
                <label for="att">Select Atribute you want to change</label>

                <select name="att" id="att">
                  <option value="firstName">First Name</option>
                  <option value="lastName">Last Name</option>
                  <option value="email">Email</option>
                  <!-- Add email check in above -->
                  <option value="password">Password</option>
                </select>
                <br>
</div>
                <div class="col-4">
                <input type="text" name="newValue" placeholder="Value" required>
                <input type="submit" name="submit-edit" value="Submit">
</div>
</div>
            </form>
            <br>
            <br>

            <h4>Changes to profile picture</h4>
            <p>You can upload a new image to change your profile picture.</p>
            <form enctype="multipart/form-data" class="" action="edit-details.php?id=<?php echo $user_row['user_id']?>" method="post">
                <input type="file" name="newImage" value="" required>
                <input type="submit" name="picture-edit" value="Submit Changes">
            </form>


            <?php

            // If a non-picture edit is made
            if(isset($_POST['submit-edit'])){
                $newVal = $_POST['newValue'];
                $field =  $_POST['att'];

                // Email Check
                if($field == 'email'){
                    if (!filter_var($newVal, FILTER_VALIDATE_EMAIL)) {
                        echo("$newVal is not a valid email address");
                        exit;
                    }
                }elseif ($field == 'password') {

                    // Hash the password
                    $newVal = password_hash($newVal, PASSWORD_DEFAULT);
                }

                // Update value
                $update_sql = "UPDATE users SET $field = '$newVal' where user_id = {$user_row['user_id']}";

                // Perform a query, check for error
                if(mysqli_query($conn, $update_sql)){
                    echo "Your changes have been saved!";
                    header("location: edit-details.php?id={$user_row['user_id']}");
                }else{
                    die(mysqli_error($conn));
                }

            }

            // If a picture edit is made
            if(isset($_POST['picture-edit'])){

                // Get the file data
                $file = $_FILES["newImage"];

                $targetDir = "register/user_images/";

                // get the filename
                $filename = basename($file['name']);
                $filename = time()."_".$filename;
                $targetFilePath = $targetDir.$filename;
                $filetype = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                // Move into target file path
                if(!empty($filename)) {
                    $allowed = array('jpeg', 'jpg', 'png', 'gif', 'jfif');
                    if(in_array($filetype, $allowed)) {
                        if(move_uploaded_file($file['tmp_name'], $targetFilePath)){
                            echo "The Image has been saved";
                        }
                    }else{
                        echo "You cannot use this file type!";
                    }
                }

                $targetFilePath = substr($targetFilePath, 9);

                // Save the image path
                $update_sql = "UPDATE users SET profileImage = '$targetFilePath' where user_id = {$user_row['user_id']}";

                // Perform a query, check for error
                if(mysqli_query($conn, $update_sql)){
                    echo "Your changes have been saved!";
                    header("location: edit-details.php?id={$user_row['user_id']}");
                }else{
                    die(mysqli_error($conn));
                }
            }

            ?>

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
