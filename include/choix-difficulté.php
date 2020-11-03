<form method="post">
    <?php
    //Définition de la requête à exécuter
    $SQLQuery="SELECT * FROM difficulte ";

    //Exécution de la requête
    $SQLResult = $dbConn->query($SQLQuery);

    //Lecture du résultat renvoyé par l'exécution précédente
    $script = '';
    while($SQLRow = $SQLResult->fetch()){
        $script .='<button type="submit" name="difficulté" value="'.$SQLRow['id'].'">'.$SQLRow['text'].'</button>';
    }
    $SQLResult->closeCursor();
    print($script);
    ?>
</form>
