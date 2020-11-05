<?php

// Database connection
include('include/db_connect.php');

?>

<!DOCTYPE html>
<html>

    <link rel="stylesheet" href="playerscss.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

    <body>
      <!-- Space for Navbar -->


      <?php
            // Colllect user info
            $curr_id = $_GET['id'];
            $sql = "SELECT * FROM users WHERE user_id = '$curr_id'";
            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $row = $result->fetch_assoc();
        ?>

        <!-- User Details Start -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="cl-md-3">
                    <center>
                        <img style=" border-radius: 5px; border: 1px solid black;" src="<?php echo $row['profileImage'] ?>" width="500px" height="500px">
                    </center>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <br>
                    <br>
                    <div>
                        <h2>Name:</h2>
                    </div>
                    <p style=" word-wrap: break-word;"><?php echo $row['firstName'] ?></p>
                    <div>
                        <h2>Played Matches:</h2>
                    </div>
                    <p style=" word-wrap: break-word;"><?php echo $row['playedMatches']; ?></p>
                    <div>
                        <h2>Wins:</h2>
                    </div>
                    <p style=" word-wrap: break-word;"><?php echo $row['wins']; ?></p>
                    <div>
                        <h2>Rating:</h2>
                    </div>
                    <p style=" word-wrap: break-word;"><?php echo $row['rating']; ?></p>
                </div>



    </body>
