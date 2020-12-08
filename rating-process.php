<?php

// Make database connection
include('include/db_connect.php');

$user_id = $_GET['id'];
$package_id = $_GET['pid'];
$owner_id = $_GET['oid'];

if(isset($_POST['rating-submit'])){

    $rating = $_POST['rating'];

    $sql = "UPDATE users SET rating = ($rating + rating)/2 where user_id = $user_id";
    print($sql);

    // Send the SQL Query
    if(mysqli_query($conn, $sql)) {
        echo "Rating changed";
    } else {
        die(mysqli_error($conn));
    }

    // Change the order status
    $sql = "UPDATE packages set status = 'Rated' where pid=$package_id";
    // Send the SQL Query
    if(mysqli_query($conn, $sql)) {
        echo "Package Status Updated";
        header("Location: myorders.php?id=$owner_id");
    } else {
        die(mysqli_error($conn));
    }


}


mysqli_close($conn);

?>
