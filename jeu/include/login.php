<?php
    session_start();
    if(isset($_GET['login_btn']))
    {
        $email=$_POST['email'];
        $password=$_POST['password'];
        $password=md5($password); //Remember we hashed password before storing last time
        $sql="SELECT * FROM utilisateur WHERE email='$email' AND password='$password'";
        $result= $dbConn->query($sql);

        if($result)
        {
            if( $result->fetchColumn() >= 1)
            {
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