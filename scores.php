
<!doctype html>
<html class="no-js" lang="fr">

<head>
    <meta charset="utf-8">
    
    <!--====== Title ======-->
    <title>GreenCity - Le Serious Game</title>
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="assets/images/logo_flavicon.png" type="image/png">
        
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

    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="assets/css/tableScore.css">
    
</head>

<body>
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->    
   
   
    
    
    <!--====== HEADER PART START ======-->
    
    <header class="header-area">
        <div class="navbar-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a  href="index.php">
                                <img class="home_logo" src="assets/images/logo-greencity.png" alt="Logo">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="page-scroll" href="#home">Accueil</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#features">Fonctionnalités</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#about">Àpropos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#footer">Contact</a>
                                    </li>
                                </ul>
                            </div> <!-- navbar collapse -->
                            
                            <div class="navbar-btn d-none d-sm-inline-block">
                                <a class="main-btn" data-scroll-nav="0" href="jeu.php" rel="nofollow">Lancer le jeu</a>
                            </div>

                            <a href="logout.php"> <button style="margin-left: 3%;" type="button" class="btn btn-success">Déconnexion</button> </a>
                            <?php if (isset($_SESSION['prenom'])): ?>
                                    <p>Hello </p>
                                    <a href="logout.php"> <button style="margin-left: 3%;" type="button" class="btn btn-success">Déconnexion</button> </a>
                            <?php else: ?>
                                    <button style="margin-left: 3%;" type="button" onclick="location.href='login.php'" class="btn btn-success">Connexion</button>
                                    <button style="margin-left: 3%;" type="button" onclick="location.href='register.php'" class="btn btn-warning">Inscription</button>
                            <?php endif; ?>


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
                            <h3 class="header-title wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.2s">Green<span class="title_city">City</span></h3>
                            <h2 class="header-sub-title wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.5s">Rebâtissez le monde de demain.</h2>
                            <p class="text wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.8s">Serious Game à destination de tous, rendez-vous juste en dessous.</p>
                            <a href="jeu.php" style="height: 100%; width: 300px" class="main-btn wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="1.1s">Lancer GreenCity - Le Jeu</a>
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
    
    
    

    <div class="container">
    <div class="row col-md-6 col-md-offset-2 custyle center">
    <table class="table table-striped custab">
    <thead>
        <tr>
            <th>Score</th>
            <th>Prenom</th>
            <th>Nom</th>
        </tr>
    </thead>
        <tbody>

               
            <?php
            
            require "../WorkShop-B3/db_connection.php";

            $sql = "SELECT * FROM utilisateur ORDER BY score DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            echo "";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo 
                
                "<tr>
                    <td>".$row["score"]."</td>
                    <td>".$row["prenom"]."</td>
                    <td>".$row["nom"]."</td>
                </tr>";
            }
            echo "</table>";
            } else {
            echo "0 results";
            }
            $conn->close();
            ?>
                </tbody>
            </table>
        </div>
    </div>








    
 <!--====== FOOTER PART START ======-->
    
 <footer id="footer" class="footer-area pt-120">
        <div class="container">
            <div class="subscribe-area wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="subscribe-content mt-45">
                            <h2 class="subscribe-title">Abonnez-vous à notre newsletter<span> pour ne rien rater de notre actualité.</span></h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="subscribe-form mt-50">
                            <form action="#">
                                <input type="text" placeholder="Votre e-mail ?">
                                <button class="main-btn">S'abonner</button>
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
                                <img style="background-color: rgba(255, 255, 255, 0.4)" src="assets/images/logo-greencity.png" alt="logo">
                            </a>
                            <p class="text">GreenCity, le serious game qui fait participer tout le monde. Une solution pour bâtir un monde meilleur.</p>
                            <ul class="social">
                                <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="#"><i class="lni lni-twitter-filled"></i></a></li>
                                <li><a href="#"><i class="lni lni-instagram-filled"></i></a></li>
                                <li><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
                            </ul>
                        </div> <!-- footer about -->
                    </div>
                    <div class="col-lg-5 col-md-7 col-sm-7" style="margin-top: 30px;" >
                        <div class="footer-link d-flex mt-50 justify-content-md-between">
                            <!-- footer wrapper -->
                            <div class="link-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.6s">
                                <div class="footer-title">
                                    <h4 class="title">Resources</h4>
                                </div>
                                <ul class="link">
                                    <li><a href="#home">Acceuil</a></li>
                                    <li><a href="#features">Fonctionnalités</a></li>
                                    <li><a href="#about">Àpropos</a></li>
                                    <li><a href="#footer">Contact</a></li>
                                </ul>
                            </div> <!-- footer wrapper -->
                        </div> <!-- footer link -->
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-5" style="margin-top: 30px;">
                        <div class="footer-contact mt-50 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.8s">
                            <div class="footer-title">
                                <h4 class="title">Contactez-nous</h4>
                            </div>
                            <ul class="contact">
                                <li>greencity@gmail.com</li>
                                <li>www.GreenCity.com</li>
                                <li>114 Rue Lucien Faure , Bordeaux <br> France, 33 000.</li>
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
    
</body>

</html>
