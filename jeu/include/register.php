<?php

session_start();
//connect to database
if(isset($_POST['register_btn']))
{
    $prenom=mysqli_real_escape_string($dbConn,$_POST['prenom']);
    $nom=mysqli_real_escape_string($dbConn,$_POST['nom']);
    $pays=mysqli_real_escape_string($dbConn,$_POST['pays']);
    $ville=mysqli_real_escape_string($dbConn,$_POST['ville']);
    $code_postal=mysqli_real_escape_string($dbConn,$_POST['code_postal']);
    $email=mysqli_real_escape_string($dbConn,$_POST['email']);
    $password=mysqli_real_escape_string($dbConn,$_POST['password']);
    $password2=mysqli_real_escape_string($dbConn,$_POST['password2']);

    $query = "SELECT * FROM utilisateur WHERE prenom = '$prenom' AND nom = '$nom'";
    $result= $dbConn->query($query);
    if($result)
    {

        if( mysqli_num_rows($result) > 0)
        {
            $_SESSION['message']="compte déjà existant";
        }

        else
        {

            if($password==$password2)
            {           //Create User
                $password=md5($password); //hash password before storing for security purposes
                $sql="INSERT INTO utilisateur(prenom,nom,email,pays,ville,code_postal, password ) VALUES('$prenom','$nom','$email','$pays','$ville','$code_postal', '$password')";
                $dbConn->query($sql);
                $_SESSION['email']=$email;
                header("location:index.php");  //redirect home page
            }
            else
            {
                $_SESSION['message']="les deux mots de passe ne sont pas les mêmes";
            }
        }
    }
}
?>