<?php
    session_start();
    if(isset($_GET['login_btn']))
    {
        $email=mysqli_real_escape_string($dbConn,$_POST['email']);
        $password=mysqli_real_escape_string($dbConn,$_POST['password']);
        $password=md5($password); //Remember we hashed password before storing last time
        $sql="SELECT * FROM utilisateur WHERE email='$email' AND password='$password'";
        $result= $dbConn->query($sql);

        if($result)
        {
            if( mysqli_num_rows($result)>=1)
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