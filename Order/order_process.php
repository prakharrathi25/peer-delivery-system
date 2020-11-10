<?php

echo("Reached Page 2");
// Make the database connection
include('../include/db_connect.php');

// Get the user id
$curr_id = (int)$_GET['id'];

// Collect Image
$file = $_FILES['startImage'];
$targetDir = "../assests/images/";

// get the filename
$filename = basename($file['name']);
$targetFilePath = $targetDir.$filename;
$filetype = pathinfo($targetFilePath, PATHINFO_EXTENSION);

// Upload the image
if(!empty($filename)) {
    $allowed = array('jpeg', 'jpg', 'png', 'gif');
    if(in_array($filetype, $allowed)) {
        if(move_uploaded_file($file['tmp_name'], $targetFilePath)){
            return $targetFilePath;
        }
    }else{
        echo "You cannot use this file type!";
    }
}

// Collect the data from the other file
if(isset($_POST['order-submit'])) {

    // Create data variables
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = (int)$_POST['zip'];
    $weight = (int)$_POST['weight'];
    $height = (int)$_POST['height'];
    $width = (int)$_POST['width'];
    $length = (int)$_POST['length'];
    $desc = $_POST['desc'];
    $status = "Active";
    $cost = (int)$_POST['cost'];

    // Create SQL QUery for other details
    $sql = "INSERT into packages(name, email, destination, destination_city, pincode, wight, height, width, length, user_id, status, start_image, cost, content_description) VALUES('$name', '$email', '$address', '$city', $zip, $weight, $height, $width, $length, $curr_id, $status, '$targetFilePath', $cost, '$desc')";

    // Perform a query, check for error
    if(mysqli_query($conn, $sql)) {
        console.log("Order Placed!");

    } else {
        die(mysqli_error($conn));
    }

}

?>
