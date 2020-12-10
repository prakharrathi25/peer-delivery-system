<?php

    // Make database connection
    include('../include/db_connect.php');

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

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Login</title>

        <!-- Link Style sheets -->
        <link rel="stylesheet" href="../assets/css/register.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <style media="screen">
            body{
                background-image: url('../assets/images/bg1.jpg');
                background-size: cover;
                height: 100%;
                background-position: center;
                background-repeat: no-repeat;
            }
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

        <main id="main-register">
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
            <?php

                if(isset($_SESSION['user_id'])){
                    $user = get_user_info($conn, $_SESSION['user_id']);
                }

                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    require('login_process.php');
                }
            ?>

            <section id="login-form">

                <div class="row m-0">
                    <div class="col-lg-4 offset-lg-2">
                        <!-- Registeration Header and subtext  -->
                        <div class="text-center pb-5">
                            <h1  class="login-title text-dark">Login</h1>
                            <p class="p-1 m-0 font-ubuntu text-black-50">Login and enjoy</p>
                            <span  class="font-ubuntu text-black-50"> Don't have an account? <a href="register.php">Register</a> </span>
                        </div>

                        <!-- Profile image upload -->
                        <div class="upload-profile-image d-flex justify-content-center pb-5">
                            <div class="text-center">
                                <img src="user_images/default_profile.png" style="width: 200px; height: 200px;" class="img rounded-circle" alt="default image">

                            </div>
                        </div>

                        <!-- Registration Form Upload -->
                        <div class="d-flex justify-content-center">
                            <form id="log-form" enctype="multipart/form-data" action="login.php" method="post">

                                <div class="form-row my-4">
                                    <div class="col">
                                        <input type="email" name="email"  id="email"  class="form-control" value="" placeholder="Email*" required>
                                    </div>
                                </div>

                                <div class="form-row my-4">
                                    <div class="col">
                                        <input type="password" name="password"  id="password"  class="form-control" value="" placeholder="Password*" required>
                                    </div>
                                </div>

                                <div class="submit-btn text-center my-5">
                                    <button type="submit"  class="btn btn-warning rounded-pill text-dark px-5" name="button">Login</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </section>
        </main>


        <!-- Registration Form End -->


        <!-- Bootstrap JScripts -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../assets/js/register.js">

        </script>
    </body>
</html>
