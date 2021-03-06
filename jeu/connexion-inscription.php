<?php
    include("include/bdd.php");
    include("include/login.php");
    include("include/register.php");
?>
<!doctype html>
<html class="no-js" lang="fr">

    <head>
        <meta charset="utf-8">

        <!--====== Title ======-->
        <title>GreenCity - Jeu</title>

        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--====== Favicon Icon ======-->
        <link rel="shortcut icon" href="../assets/images/logo_flavicon.png" type="image/png">

        <!--====== Animate CSS ======-->
        <link rel="stylesheet" href="../assets/css/animate.css">

        <!--====== Line Icons CSS ======-->
        <link rel="stylesheet" href="../assets/css/LineIcons.2.0.css">

        <!--====== Bootstrap CSS ======-->
        <link rel="stylesheet" href="../assets/css/bootstrap-4.5.0.min.css">

        <!--====== Default CSS ======-->
        <link rel="stylesheet" href="../assets/css/default.css">

        <!--====== Style CSS ======-->
        <link rel="stylesheet" href="../assets/css/style.css">

    </head>

    <body style="background-image: url(../assets/images/bgDashboard.jpg);  background-size: cover; background-repeat: no-repeat">
        <!--[if IE]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
      <![endif]-->


        <!--====== START : PRELOADER PART  ======-->
            <div class="preloader">
                <div class="loader">
                    <div class="ytp-spinner">
                        <div class="ytp-spinner-container">
                            <div class="ytp-spinner-rotator">
                                <div class="ytp-spinner-left">
                                    <div class="ytp-spinner-circle"></div>
                                </div>
                                <div class="ytp-spinner-right">
                                    <div class="ytp-spinner-circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--====== END : PRELOADER PART ======-->

        <!--====== START : FORMULAIRES ======-->
            <div class="container justify-content-around">
                <div class="mt-150 sak2 sak background" id="bg_ville" style="border-radius: 50px;border:3px solid #d8d0b9; height: 700px">
                    <div class="p-5 d-flex align-items-center justify-content-around filtre-sak" style="border-radius: 45px;border:20px solid #fff; background-color: rgba(50,50,50,0.3); p-5; width: 100%; height: 100%">

                        <!--====== START : FROM CONNEXION ======-->
                            <form method="post" id="connexion" class="col-8 d-none">
                                <h3 class="text-center text-light m-4">Connectez-vous</h3>
                                <p class="text-center text-light m-4">Connectez-vous pour avoir accès au jeu</p>
                                <?php
                                    //===== Message d'erreur
                                    if(isset($_SESSION['message']))
                                    {
                                        echo "<div class=\"text-danger\">".$_SESSION['message']."</div>";
                                        unset($_SESSION['message']);
                                    }
                                ?>
                                <div class="form-group"><!--====== E-mail ======-->
                                    <input type="email" name="email" class="form-control" placeholder="Entrez vôtre e-mail">
                                </div>
                                <div class="form-group"><!--====== Mot de passe ======-->
                                    <input type="password" name="password" class="form-control" placeholder="mot de passe">
                                </div>
                                <div class="row justify-content-around" ><!--====== Bouton connexion ======-->
                                    <button type="submit" name="login_btn" value="Log In" class="btn btn-primary btn-lg shadow-lg rounded-pill">se connecter</button>
                                </div>
                                <div class="row justify-content-around mt-3" ><!--====== Bouton formulaire inscription ======-->
                                    <button type="button" y class="btn btn-sm btn-outline-dark" onclick="affiche_inscription()">s'inscrire</button>
                                </div>
                            </form>
                        <!--====== END : FROM CONNEXION ======-->

                        <!--====== START : FROM INSCRIPTION ======-->
                            <form method="post" id="inscription" class="col-8 d-none">
                                <h3 class="text-center text-light m-4">Inscrivez-vous</h3>
                                <p class="text-center text-light m-4">Inscrivez-vous dès maintenant !</p>
                                <?php
                                //===== Message d'erreur
                                if(isset($_SESSION['message']))
                                {
                                    echo "<div class=\"text-danger\">".$_SESSION['message']."</div>";
                                    unset($_SESSION['message']);
                                }
                                ?>
                                <div class="form-group"><!--====== Prénom ======-->
                                    <input type="text" class="form-control" name="prenom" placeholder="Prénom">
                                </div>
                                <div class="form-group"><!--====== Nom ======-->
                                    <input type="text" class="form-control" name="nom" placeholder="Nom">
                                </div>
                                <div class="form-group"><!--====== E-mail ======-->
                                    <input type="email" class="form-control" name="email" placeholder="E-mail">
                                </div>
                                <div class="form-group"><!--====== Mot de passe ======-->
                                    <input type="password" class="form-control" name="password" placeholder="Mot de passe">
                                </div>
                                <div class="form-group"><!--====== Mot de passe 2 ======-->
                                    <input type="password" class="form-control" name="password2" placeholder="Vérification du mot de passe">
                                </div>
                                <div class="row justify-content-around" ><!--====== Bouton inscription ======-->
                                    <button type="submit" name="register_btn" value="Log In" class="btn btn-primary btn-lg shadow-lg rounded-pill">s'inscrire</button>
                                </div>
                                <div class="row justify-content-around mt-1" ><!--====== Bouton formulaire connexion ======-->
                                    <button type="button" class="btn btn-sm btn-outline-dark" onclick="affiche_connexion()">se connecter</button>
                                </div>
                            </form>
                        <!--====== END : FROM INSCRIPTION ======-->

                        <!--====== JAVASCRIPT EN PLUS ======-->
                        <script type="application/javascript">
                            //===== Initialisation des variable
                            var connexion   = document.getElementById('connexion');
                            var inscription = document.getElementById('inscription');

                            connexion.classList.remove('d-none');

                            //===== Affiche connexion
                            function affiche_connexion()
                            {
                                inscription.classList.add('d-none');
                                connexion.classList.remove('d-none');
                            }

                            //===== Affiche le choix de niveau
                            function affiche_inscription()
                            {
                                connexion.classList.add('d-none');
                                inscription.classList.remove('d-none');
                            }
                        </script>
                        <!--====== CSS EN PLUS ======-->
                        <style>
                            .background {
                                background-size: cover;
                                background-position: center;
                                background-image: url('../assets/images/ville.png')
                            }
                            .sak {
                                animation-duration: 3s;
                                animation-name: slidein;
                                animation-iteration-count: infinite;
                                animation-direction: alternate;
                            }
                            .sak2 {
                                animation-duration: 5s;
                                animation-name: slidein2;
                                animation-iteration-count: revert;
                                animation-direction: alternate;
                            }

                            @keyframes slidein {
                                from {
                                    box-shadow: 0 0 75px #fff;
                                }
                                to {
                                    box-shadow: 0 0 10px #429548;
                                }
                            }

                            @keyframes slidein2 {
                                from {
                                    transform: rotate3d(90, 0, 0, 30deg);
                                }
                                to {
                                    transform: rotate3d(1, 1, 1, 0deg);
                                }
                            }
                        </style>

                    </div>
                </div>
            </div>
        <!--====== END : FORMULAIRES ======-->

        <!--====== BUBULE ======-->
        <div id="particles-1" class="particles"></div>

        <!--====== Jquery js ======-->
        <script src="../assets/js/vendor/jquery-3.5.1-min.js"></script>
        <script src="../assets/js/vendor/modernizr-3.7.1.min.js"></script>

        <!--====== Bootstrap js ======-->
        <script src="../assets/js/popper.min.js"></script>
        <script src="../assets/js/bootstrap-4.5.0.min.js"></script>

        <!--====== Plugins js ======-->
        <script src="../assets/js/plugins.js"></script>

        <!--====== Counter Up js ======-->
        <script src="../assets/js/waypoints.min.js"></script>
        <script src="../assets/js/jquery.counterup.min.js"></script>



        <!--====== Scrolling Nav js ======-->
        <script src="../assets/js/jquery.easing.min.js"></script>
        <script src="../assets/js/scrolling-nav.js"></script>

        <!--====== wow js ======-->
        <script src="../assets/js/wow.min.js"></script>

        <!--====== Particles js ======-->
        <script src="../assets/js/particles.min.js"></script>

        <!--====== Main js ======-->
        <script src="../assets/js/main.js"></script>

    </body>

</html>
