<?php

    // Making a server connection
    $server = "localhost";
    $username = "root";
    $password = "mysql";  // prakhar = mysql@123
    $dbname = "delivery_db";

    try {
        $conn = mysqli_connect($server, $username, $password, $dbname);

    } catch (Exception $exc) {
        print "Failed to connect to MySQL database: " . $exc->getMessage();
    }


    //
    // if ($conn->connect_errno) {
    //     die("Failed to connect to MySQL: " . $$conn->connect_error);
    // }

?>
