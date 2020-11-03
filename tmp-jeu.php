<?php
    include("include/bdd.php");
?>

<?php
    if ( isset($_POST['difficulté']) )
    {
        $lvl = $_POST['difficulté'];

        switch ($lvl)
        {
            // Facile
            case 1:
                $SQLQuery="SELECT * FROM senario where dificulte = $lvl";
            break;
            // Normal
            case 2:
                $SQLQuery="SELECT * FROM senario where dificulte = $lvl";
            break;
            // Difficile
            case 3:
                $SQLQuery="SELECT * FROM senario where dificulte = $lvl";
            break;

            default :
                header('Location: temp-jeu.php');
                exit();
        }

    }
    else
    {
        include("include/choix-difficulté.php");
    }
?>