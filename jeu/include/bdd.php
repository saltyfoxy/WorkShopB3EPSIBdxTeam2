<?php
    $dbConn = null;
    try{
        /*
         * Ouverture de la connexion à la base de données
         */
        $dbConn = new PDO('mysql:host=localhost;port=3306;charset=utf8;dbname=greencity', 'root', 'root');
    }catch (PDOException $ex){
        /*
         * En cas d'erreur, gestion d'une exception (à voir plus tard)
         */
        header('Location: ../index.php');
        exit();
    }
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'greencity');


$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>