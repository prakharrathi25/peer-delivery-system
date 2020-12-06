<?php

// Database Connection
include('include/db_connect.php');

// Get user Id and package id
$user_id = $_GET['uid'];
$package_id = $_GET['pid'];
$new_cost = $_GET['cost'];
$owner = $_GET['owner'];

$sql = "UPDATE packages SET traveller_id = $user_id, status = 'In Delivery', cost=$new_cost WHERE pid = $package_id";

// Send the SQL Query
if(mysqli_query($conn, $sql)) {
    echo "Your request has been accepted\n";
    header('Location: myorders.php?id='.$owner);
} else {
    die(mysqli_error($conn));
}

?>
