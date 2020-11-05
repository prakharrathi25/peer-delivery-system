<?php

// Make the SQL connection
include('../include/db_connect.php');

// Load helper functions
include('../include/helper.php');

// UTILITY FUNCTIONS

//Function to get the path from an uploaded image
function upload_profile($file) {

    $targetDir = "user_images/";
    $default = "user_images/default_profile.png";

    // get the filename
    $filename = basename($file['name']);
    $targetFilePath = $targetDir.$filename;
    $filetype = pathinfo($targetFilePath, PATHINFO_EXTENSION);

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

    return $default;
}

// Clean the input and save the data from SQL injection
// Create a function to validate the input
function validate_input_text($textValue) {
    if(!empty($textValue)){

        $trim_text = trim($textValue); //remove whitespaces
        //remove illegal chars
        $sanitized_str = filter_var($trim_text, FILTER_SANITIZE_STRING);
        return $sanitized_str;
    }
    return "";
}

// error variable
$error = array();

$email = (string)$_POST['email'];

$password = (string)validate_input_text($_POST['password']);
if (empty($password)){
    $error[] = "No password found";
}

if(empty($error)){

    // Sql query
    $sql = "SELECT userID, firstName, lastName, email, password FROM users WHERE email = '$email'";

    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    $row = $result->fetch_assoc();
    if(!empty($row)){
        // verify the password
        if(password_verify($password, $row['password'])){

            // Start a new session
            session_start();

            // Create a session variable
            $_SESSION['userID'] = mysqli_insert_id($conn);


            header('location: dashboard.php');
            console.log(True);
            exit();

        }else{
            print("Incorrect password!");
        }
    }else{
        print("Email not found!");
    }

}else {
    echo "Please fill out the correct details";
}

?>
