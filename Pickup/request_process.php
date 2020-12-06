<?php

echo("Enterred Processing Page");

// Make Database Connection
include('../include/db_connect.php');
echo("Connection Made");

// Collect user ID and package ID
$user_id = (int)$_GET['id'];
$package_id = (int)$_GET['pid'];

if(isset($_POST['request-submit'])){
    $price = (int)$_POST['price-quote'];
    echo $price;
    echo $user_id;
    echo $package_id;

    // Create the SQL query for request
    $request_sql = "INSERT into requests(package_id, price, user) VALUES($user_id, $package_id, $price)";

    // Send the SQL Query
    if(mysqli_query($conn, $request_sql)) {
        echo "Your order has been placed\n";
        header('Location: ../myrequests.php?id='.$user_id);
    } else {
        die(mysqli_error($conn));
    }
}




?>
