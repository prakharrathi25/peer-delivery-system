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
                <form action="contact.php" method="post" onsubmit="messageFunction()">
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
                <script>
                    function messageFunction(){
                        alert("Your Message has been Sent");
                    }
                </script>

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
