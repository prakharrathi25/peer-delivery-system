<?php

// Make database connection
include('include/db_connect.php');

$package_id = $_GET['pid'];
$user_id = $_GET['id'];

// Save Final image
if(isset($_POST['complete-submit'])) {

    $file = $_FILES['finalImg'];


    var_dump($_FILES)."<br>";

    $targetDir = "assets/images/";

    // get the filename
    $filename = basename($file['name']);

    // Create a unique filename
    $filename = time()."_".$filename;
    $targetFilePath = $targetDir.$filename;

    $filetype = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    echo $filetype."<br>";

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
}

// Send image data to the database
$targetFilePath = "../".$targetDir.$filename;
$sql = "UPDATE packages SET final_image = '$targetFilePath', status='Delivered' WHERE pid = $package_id";
echo $sql;
// Send the SQL Query
if(mysqli_query($conn, $sql)) {
    echo "Image data has been saved\n";
    // header("Location: myorders.php?id=$user_id");
} else {
    die(mysqli_error($conn));
}

// Update user deliveries and credits
$sql = "SELECT user_id, cost from packages where pid = $package_id";
$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
$row = $result->fetch_assoc();
$payment = $row['cost'];
$owner = $row['user_id'];

$sql = "UPDATE users set deliveries = deliveries+1, credits=credits+$payment where user_id=$user_id";

// Send the SQL Query
if(mysqli_query($conn, $sql)) {
    echo "Credits Updated\n";
} else {
    die(mysqli_error($conn));
}

$sql = "UPDATE users set credits=credits-$payment where user_id=$owner";

// Send the SQL Query
if(mysqli_query($conn, $sql)) {
    echo "Credits Updated\n";
    header("Location: myorders.php?id=$user_id");
} else {
    die(mysqli_error($conn));
}

?>
