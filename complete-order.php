<?php

// Make database connection
include('include/db_connect.php');

$package_id = $_GET['pid'];

// Save Final image
if(isset($_POST['complete-submit'])) {
    $file = $_FILES['finalImg'];
    if($file){
        echo "HERE";
    }
}

$targetDir = "assets/images/";

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

// // Send image data to the database
// $sql = "UPDATE packages SET final_image = '$targetFilePath', status='Delivered' WHERE pid = $package_id";
//
// // Send the SQL Query
// if(mysqli_query($conn, $sql)) {
//     echo "Image data has been saved\n";
// } else {
//     die(mysqli_error($conn));
// }


// Transfer money from user to the traveller

?>
