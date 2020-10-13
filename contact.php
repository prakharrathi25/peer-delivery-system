<?php
  // Make the database connection
  include('db_connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width", initial-scale=1.0>
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/contact.css">
</head>
<body>
    <section class="contact">
        <div class= "content">
            <h2>Contact Us</h2>
            <p>Please feel free to contact us about any feedback, or issues you face while using our service.</p>
        </div>
        <div class="container">
            <div class="contactInfo">
                <div class="box">
                    <div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3>Address</h3>
                        <p>Address Line 1 <br>Address Line 2<br>Address Line 3</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3>Phone</h3>
                        <p>9999999999</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3>Email</h3>
                        <p>something@email.com</p>
                    </div>
                </div>
            </div>
            <div class="contactForm">
                <form action="contact.php" method="post">
                    <h2>Send us a Message</h2>
                    <div class="inputBox">
                        <input type="text" name="name" required>
                        <span>Full Name</span>
                    </div>
                    <div class="inputBox">
                        <input type="email" name="email" required>
                        <span>E-mail</span>
                    </div>
                    <div class="inputBox">
                        <textarea name="message" required></textarea>
                        <span>Your Message</span>
                    </div>
                    <div class="inputBox">
                        <input type="submit" name="submit-message" value="Send">
                    </div>
                </form>

                <!-- PHP Script to save the data -->
                <?php
                    if(isset($_POST['submit-message']){
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $message = $_POST['message'];

                         // Make a query
                         $sql = "INSERT into feedback(name, email, message, date_created) VALUES('$name', '$email', '$message', NOW())";

                         // Perform a query, check for error
                         mysqli_query($conn, $sql) or die(mysqli_error($conn));

                         // Redirect to the login page
                         header("location: index.html"); 

                    }
                ?>

            </div>
        </div>
    </section>
</body>
</html>
