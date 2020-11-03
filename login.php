<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "db_connnection.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
 <!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    
    <!--====== Title ======-->
    <title>Basic - SaaS Landing Page</title>
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">
        
    <!--====== Animate CSS ======-->
    <link rel="stylesheet" href="assets/css/animate.css">
                
    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="assets/css/LineIcons.2.0.css">
        
    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="assets/css/bootstrap-4.5.0.min.css">
    
    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="assets/css/default.css">
    
    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="assets/css/style.css">

    
    
</head>

<body>
   
    
    <!--====== HEADER PART START ======-->
    
    <header class="header-area">
        <div class="navbar-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="index.html">
                                <img src="assets/images/logo.svg" alt="Logo">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="page-scroll" href="#home">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#features">Features</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#about">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#facts">Why</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#team">Team</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#blog">Blog</a>
                                    </li>
                                </ul>
                            </div> <!-- navbar collapse -->
                            
                            <div class="navbar-btn d-none d-sm-inline-block">
                                <a class="main-btn" data-scroll-nav="0" href="https://uideck.com/templates/basic/" rel="nofollow">Download Now</a>
                            </div>

                            <button style="margin-left: 3%;" type="button" onclick="location.href='login.php'" class="btn btn-success">Connexion</button>
                            <button style="margin-left: 3%;" type="button" onclick="location.href='signup.php'" class="btn btn-warning">Inscription</button>
                            
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- navbar area -->
        
        <div id="home" class="header-hero bg_cover" style="background-image: url(assets/images/banner-bg.png)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="header-hero-content text-center">
                            <h3 class="header-sub-title wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.2s">Basic - SaaS Landing Page</h3>
                            <h2 class="header-title wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.5s">Kickstart Your SaaS or App Site</h2>
                            <p class="text wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.8s">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor</p>
                            <a href="#" class="main-btn wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="1.1s">Get Started</a>
                        </div> <!-- header hero content -->
                    </div>
                </div> <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-hero-image text-center wow fadeIn" data-wow-duration="1.3s" data-wow-delay="1.4s">
                            <img src="assets/images/header-hero.png" alt="hero">
                        </div> <!-- header hero image -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
            <div id="particles-1" class="particles"></div>
        </div> <!-- header hero -->
    </header>
    
    <!--====== HEADER PART ENDS ======-->
<body>

    <!--======= FORM PART ==========--> 


    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>    

    <!--======= FORM PART END ==========--> 
    <!--====== FOOTER PART START ======-->
    
    <footer id="footer" class="footer-area pt-120">
        <div class="container">
            <div class="subscribe-area wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="subscribe-content mt-45">
                            <h2 class="subscribe-title">Subscribe Our Newsletter <span>get reguler updates</span></h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="subscribe-form mt-50">
                            <form action="#">
                                <input type="text" placeholder="Enter eamil">
                                <button class="main-btn">Subscribe</button>
                            </form>
                        </div>
                    </div>
                 </div> <!-- row -->
            </div> <!-- subscribe area -->
            <div class="footer-widget pb-100">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="footer-about mt-50 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
                            <a class="logo" href="#">
                                <img src="assets/images/logo.svg" alt="logo">
                            </a>
                            <p class="text">Lorem ipsum dolor sit amet consetetur sadipscing elitr, sederfs diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam.</p>
                            <ul class="social">
                                <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="#"><i class="lni lni-twitter-filled"></i></a></li>
                                <li><a href="#"><i class="lni lni-instagram-filled"></i></a></li>
                                <li><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
                            </ul>
                        </div> <!-- footer about -->
                    </div>
                    <div class="col-lg-5 col-md-7 col-sm-7">
                        <div class="footer-link d-flex mt-50 justify-content-md-between">
                            <div class="link-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s">
                                <div class="footer-title">
                                    <h4 class="title">Quick Link</h4>
                                </div>
                                <ul class="link">
                                    <li><a href="#">Road Map</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Refund Policy</a></li>
                                    <li><a href="#">Terms of Service</a></li>
                                    <li><a href="#">Pricing</a></li>
                                </ul>
                            </div> <!-- footer wrapper -->
                            <div class="link-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.6s">
                                <div class="footer-title">
                                    <h4 class="title">Resources</h4>
                                </div>
                                <ul class="link">
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">Page</a></li>
                                    <li><a href="#">Portfolio</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </div> <!-- footer wrapper -->
                        </div> <!-- footer link -->
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-5">
                        <div class="footer-contact mt-50 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.8s">
                            <div class="footer-title">
                                <h4 class="title">Contact Us</h4>
                            </div>
                            <ul class="contact">
                                <li>+809272561823</li>
                                <li>info@gmail.com</li>
                                <li>www.yourweb.com</li>
                                <li>123 Stree New York City , United <br> States Of America 750.</li>
                            </ul>
                        </div> <!-- footer contact -->
                    </div>
                </div> <!-- row -->
            </div> <!-- footer widget -->
            <div class="footer-copyright">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright d-sm-flex justify-content-between">
                            <div class="copyright-content">
                                <p class="text">Designed and Developed by <a href="https://uideck.com" rel="nofollow">UIdeck</a></p>
                            </div> <!-- copyright content -->
                        </div> <!-- copyright -->
                    </div>
                </div> <!-- row -->
            </div> <!-- footer copyright -->
        </div> <!-- container -->
        <div id="particles-2"></div>
    </footer>
    
    <!--====== FOOTER PART ENDS ======-->
    
    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni lni-chevron-up"></i></a>

    <!--====== BACK TOP TOP PART ENDS ======-->   
    
    <!--====== PART START ======-->
    
<!--
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-"></div>
            </div>
        </div>
    </section>
-->
    
    <!--====== PART ENDS ======-->




    <!--====== Jquery js ======-->
    <script src="assets/js/vendor/jquery-3.5.1-min.js"></script>
    <script src="assets/js/vendor/modernizr-3.7.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    
    <!--====== Bootstrap js ======-->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap-4.5.0.min.js"></script>
    
    <!--====== Plugins js ======-->
    <script src="assets/js/plugins.js"></script>
    
    <!--====== Counter Up js ======-->
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    

    
    <!--====== Scrolling Nav js ======-->
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/scrolling-nav.js"></script>
    
    <!--====== wow js ======-->
    <script src="assets/js/wow.min.js"></script>
    
    <!--====== Particles js ======-->
    <script src="assets/js/particles.min.js"></script>
    
    <!--====== Main js ======-->
    <script src="assets/js/main.js"></script>

    <!--====== Ajax PHP calls ======-->
    <script src="assets/js/ajax_php_calls.js"></script>
    

</body>
</html>