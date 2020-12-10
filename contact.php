<?php
  // Make the database connection
  include('include/db_connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width", initial-scale=1.0>
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/contact.css">
    <style>
        .navbar{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10;
            height: 3rem;
        }
        .menu{
            max-width: 72rem;
            width: 100%;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
        }
        .logo{
            font-size: 1.1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            line-height: 4rem;
        }
        .logo span {
            font-weight: 300;
        }
        .nav_links{
            list-style: none;
        }

        .nav_links li{
            display: inline-block;
            padding: 0px 20px;
        }

        .nav_links li a{
            transition: all 0.3s ease 0s;
        }

        .nav_links li a:hover{
            color: #0088a9;
        }

        li,a,button{
            font-family: "Poppins", sans-serif;
            font-weight: 500;
            font-size: 16px;
            color: white;
            text-decoration: none;
        }

        .hamburger-menu {
        height: 4rem;
        width: 3rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        }

        .bar {
        width: 1.9rem;
        height: 1.5px;
        border-radius: 2px;
        background-color: #eee;
        transition: 0.5s;
        position: relative;
        }

        .bar:before,
        .bar:after {
        content: "";
        position: absolute;
        width: inherit;
        height: inherit;
        background-color: #eee;
        transition: 0.5s;
        }

        .bar:before {
        transform: translateY(-9px);
        }

        .bar:after {
        transform: translateY(9px);
        }

    </style>
</head>
<body>
    <section class="contact">
        <div class="navbar">
            <div class="menu">
                <a href="index.html"><h3 class="logo">PEER<span>Delivery</span></h3></a>
                <ul class="nav_links">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about_us.html">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
                <div class="hamburger-menu">
                    <div class="bar"></div>
                </div>
            </div>
        </div>
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
                        <p>1/118, Mannat Villa<br>Shankar Rd, Bandra<br>Mumbai</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3>Phone</h3>
                        <p>+91-9643486525</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3>Email</h3>
                        <p>info@peerdelivery.com</p>
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

                    if(isset($_POST['submit-message'])) {

                        // Save Data in the database
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $message = $_POST['message'];

                         // Make a query
                         $sql = "INSERT into feedback(name, email, message, date_created) VALUES('$name', '$email', '$message', NOW())";

                         // Perform a query, check for error
                         if(mysqli_query($conn, $sql)) {
                             echo "Your Feedback has been saved!";
                         } else {
                             die(mysqli_error($conn));
                         }

                         mysqli_close($conn);

                         // Send email to the user
                         $to = "pr440@snu.edu.in"; // this is your Email address
                         $from = $_POST['email']; // this is the sender's Email address
                         $subject = "New Feedback!";
                         $subject2 = "Your feedback has been saved successfully";
                         $message = $name . " wrote the following:" . "\n\n" . $_POST['message'];
                         $message2 = "We thank you for your feedback. Somebody from our team will get back to you shortly. Here is a copy of your message, " . $name . ":\n\n" . $_POST['message'];

                         $headers = "From:" . $from;
                         $headers2 = "From:" . $to;
                         mail($to, $subject, $message, $headers);
                         mail($from, $subject2, $message2, $headers2); // sends a copy of the message to the sender
                         echo "Mail Sent. Thank you " . $name . ", we will contact you shortly.";

                         // Redirect to the login page
                         header("location: contact.php?success=True");

                    }
                ?>

            </div>
        </div>
    </section>

    <script type="text/javascript">
        // Function to display confirmation on clicking a button
        function showConfirmation() {
            document.getElementById("submitFeedback").style.background = "green";

            alert("Your feedback was saved successfully!");
        }
    </script>
</body>
</html>
