<?php

// PHP file containing all the helper functions


// Function to get user info
function get_user_info($conn, $userID) {

    // Create a query
    $user_sql = "SELECT firstName, lastName, email, profileImage FROM users WHERE userID = '$userID'";

    $output = mysqli_query($conn, $user_sql) or die(mysqli_error($conn));

    $row = mysqli_fetch_array($result);

    if(empty($row)){
        return false;
    }else{
        return $row;
    }
}

?>
