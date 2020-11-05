<?php
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

$firstName = (string)validate_input_text($_POST['firstName']);
if (empty($firstName)){
    $error[] = "No first name found";
}

$lastName = (string)validate_input_text($_POST['lastName']);
if (empty($lastName)){
    $error[] = "No last name found";
}

$email = (string)$_POST['email'];

$password = (string)validate_input_text($_POST['password']);
if (empty($password)){
    $error[] = "No password found";
}

$confirm = validate_input_text($_POST['confirmPass']);
if (empty($confirm)){
    $error[] = "No confirmation password found";
}

// Get the profile image
$files = $_FILES['profileUpload'];
$profileImage = upload_profile($files);

if(empty($error)) {
    // USer registration

    // hash the password
    $hash_pass = password_hash($password, PASSWORD_DEFAULT);

    // make the php connection
    require('../include/db_connect.php');

    // Make a query
    $sql = "INSERT into users(firstName, lastname, email, password, profileImage, registerDate) VALUES('$firstName', '$lastName', '$email', '$hash_pass', '$profileImage', NOW())";

    // Perform a query, check for error
    mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // Redirect to the login page
    header("location: login.php");

} else {
    echo "Not Validate";
}

?>
