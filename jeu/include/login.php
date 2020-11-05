<?php
    session_start();
    if(isset($_POST['login_btn']))
    {
        $email=mysqli_real_escape_string($db,$_POST['email']);
        $password=mysqli_real_escape_string($db,$_POST['password']);
        $password=md5($password); //Remember we hashed password before storing last time
        $sql="SELECT * FROM utilisateur WHERE email='$email' AND password='$password'";
        $result=mysqli_query($db,$sql);

        if($result)
        {

            if( mysqli_num_rows($result)>=1)
            {
                $_SESSION['message']="Vous êtes à présent connecté(e)";
                $_SESSION['email']=$email;
                header("location:index.php");
            }
            else
            {
                $_SESSION['message']="Email ou mot de pass incorrect";
            }
        }
    }
?>