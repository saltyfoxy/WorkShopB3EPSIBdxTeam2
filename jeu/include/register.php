<?php
session_start();
if(isset($_POST['register_btn']))
{
    $prenom=$_POST['prenom'];
    $nom=$_POST['nom'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password2=$_POST['password2'];

    $query = "SELECT * FROM utilisateur WHERE prenom = '$prenom' AND nom = '$nom'";
    $result= $dbConn->query($query);

    if( $result->fetchColumn() > 0)
    {
        $_SESSION['message']="compte déjà existant";
    }

    else
    {

        if($password==$password2)
        {           //Create User
            $password=md5($password); //hash password before storing for security purposes
            $sql="INSERT INTO utilisateur(prenom,nom,email,password ) VALUES('$prenom','$nom','$email', '$password')";
            if($dbConn->query($sql))
            {
                $_SESSION['email']=$email;
                header("location:index.php");  //redirect home page
            }
            else
                $_SESSION['message']="Erreur";
        }
        else
            $_SESSION['message']="les deux mots de passe ne sont pas les mêmes";
    }
}
?>