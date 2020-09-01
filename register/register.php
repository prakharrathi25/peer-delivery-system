<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Registration</title>

        <!-- Link Style sheets -->
        <link rel="stylesheet" href="register.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    </head>
    <body>

        <main id="main-register">

            <!-- Get the PHP registration code  -->

            <?php

                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    require('register_process.php');
                }
            ?>

            <section id="register">

                <div class="row m-0">
                    <div class="col-lg-4 offset-lg-2">
                        <!-- Registeration Header and subtext  -->
                        <div class="text-center pb-5">
                            <h1  class="login-title text-dark">Register</h1>
                            <p class="p-1 m-0 font-ubuntu text-black-50">Register to enjoy additional benefits</p>
                            <span  class="font-ubuntu text-black-50"> I already have an account. <a href="login.php">Login</a> </span>
                        </div>

                        <!-- Profile image upload -->
                        <div class="upload-profile-image d-flex justify-content-center pb-5">
                            <div class="text-center">
                                <div class="d-flex justify-content-center">
                                    <img  class="camera-icon" src="../assets/images/camera.svg" alt="camera-icon">
                                </div>
                                <img src="user_images/default_profile.png" style="width: 200px; height: 200px;" class="img rounded-circle" alt="profile">
                                <small class="form-text text-black-50">Choose Image*</small>
                                <input type="file" form="reg-form" class="form-control-file" name="profileUpload"  id="upload-profile">
                            </div>
                        </div>

                        <!-- Registration Form Upload -->
                        <div class="d-flex justify-content-center">
                            <form id="reg-form" enctype="multipart/form-data" action="register.php" method="post">

                                <div class="form-row">

                                    <div class="col">
                                            <input type="text" name="firstName"  id="firstName"  class="form-control" value="" placeholder="First Name*" required>
                                    </div>
                                    <div class="col">
                                            <input type="text" name="lastName"  id="lastName"class="form-control" value="" placeholder="Last Name*" required>
                                    </div>

                                </div>

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

                                <div class="form-row my-4">
                                    <div class="col">
                                        <input type="password" name="confirmPass"  id="confirmPass"  class="form-control" value="" placeholder="Confirm Password*" required>
                                        <small  id="confirmError"  class="text-danger"></small>
                                    </div>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="agreement"  class="form-check-input" value="" required>
                                    <label for="agreement"  class="form-check-label font-ubuntu text-black-50"> I agree to the Terms and Conditions*</label>
                                </div>

                                <div class="submit-btn text-center my-5">
                                    <button type="submit"  class="btn btn-warning rounded-pill text-dark px-5" name="button">Continue</button>
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
        <script type="text/javascript" src="register.js">

        </script>
    </body>
</html>
