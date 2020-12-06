<?php

// Make the database connection
include('../include/db_connect.php');

// Get the user id
$curr_id = (int)$_GET['id'];

// Collect Image
$file = $_FILES['orderImage'];
$targetDir = "../assets/images/";

// get the filename
$filename = basename($file['name']);

// Create a unique filename
$filename = time()."_".$filename;
$targetFilePath = $targetDir.$filename;
$filetype = pathinfo($targetFilePath, PATHINFO_EXTENSION);

// Upload the image
if(!empty($filename)) {
    $allowed = array('jpeg', 'jpg', 'png', 'gif', 'jfif');
    if(in_array($filetype, $allowed)) {
        if(move_uploaded_file($file['tmp_name'], $targetFilePath)){
            echo "Image has been saved\n";
        }else{
            echo "Image not saved in the location";
        }
    }else{
        echo "You cannot use this file type!";
    }
}

// Collect the data from the other file
if(isset($_POST['order-submit'])) {

    // Create data variables
    $name = $_POST['name'];
    $number = $_POST['number'];
    $daddress = $_POST['deliver-address'];
    $paddress = $_POST['pickup-address'];
    $city = $_POST['city'];
    $zip = (int)$_POST['zip'];
    $weight = (int)$_POST['weight'];
    $height = (int)$_POST['height'];
    $width = (int)$_POST['width'];
    $length = (int)$_POST['length'];
    $desc = $_POST['desc'];
    $inst = $_POST['inst'];
    $status = "Active";
    $cost = (int)$_POST['cost'];
    $insurance = $_POST["gridRadios"];

    // Create SQL QUery for other details
    $sql = "INSERT into packages(name, phnum, pickup, destination, destination_city, pincode, weight, height, width, length, user_id, status, start_image, cost, content_description, instructions, insurance) VALUES('$name', '$number', '$paddress', '$daddress', '$city', $zip, $weight, $height, $width, $length,";
    $sql = $sql."$curr_id, '$status','$targetFilePath', $cost, '$desc', '$inst', '$insurance')";

    // Send the SQL Query
    if(mysqli_query($conn, $sql)) {
        echo "Your order has been placed\n";
        header('Location: ../myorders.php?id='.$curr_id);
    } else {
        die(mysqli_error($conn));
    }

}

?>
