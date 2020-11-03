<?php
    // $_POST['difficulté'] est initialisé dans un autre fichier mais tkt
    $lvl = $_POST['difficulté'];

    // Requête selon le niveau selectioné
    switch ($lvl)
    {
        case 1:// Facile
            $SQL_Scenario = "SELECT * FROM scenario where dificulte = $lvl";
            break;
        case 2:// Normal
            $SQL_Scenario = "SELECT * FROM scenario where dificulte = $lvl";
            break;
        case 3:// Difficile
            $SQL_Scenario = "SELECT * FROM scenario where dificulte = $lvl";
            break;
        default :
            header("Refresh:0");// Recharge la page (Permets de resélectionner le niveau)
    }
    //Stocke le résultat dans un tableau
    $SQL_Result = $dbConn->query($SQL_Scenario);
    //Parcoure le tableau pour afficher les scenarios
    $script = '';
    while($SQL_Row = $SQL_Result->fetch())
    {
        $script .= '<div class="scenario">';
        $script .= '<p>'.$SQL_Row['quesion'].'</p>';

        $SQL_Reponse = "SELECT * FROM reponse where question =". $SQL_Row['id'];// Requête
        $SQL_Result_2 = $dbConn->query($SQL_Reponse);//Stocke le résultat dans un tableau
        while($SQL_Row_2 = $SQL_Result_2->fetch())//Parcoure le tableau pour afficher les reponses
        {
            $script .= '<button onclick="next_question('.$SQL_Row_2['points'].')">'.$SQL_Row_2['nText'].'</button>';
        }
        $script .= '</div>';
    }
    $SQL_Result->closeCursor();
    $SQL_Result_2->closeCursor();
    print($script);
?>

<div id="pourquoi">
    <p id="pore"></p>
</div>

<!--====== Formulaire qui s'affiche à la fin du jeu ======-->
    <form id="end">
        <p>Votre score est de <span id="score"></span></p>
        <p>commentaire...</p>
        <button id="sub" type="submit">continuer</button>
    </form>
<!--====== Formulaire qui s'affiche à la fin du jeu ======-->

<!--====== CSS ======-->
<style type="text/css">
    #end {
        display: none;
    }
    .scenario {
        display: none;
    }
    .active {
        display: block;
    }
</style>

<!--====== JAVASCRIPT ======-->
<script type="application/javascript">
    var scenarios = Array.from(document.getElementsByClassName('scenario'));
    scenarios[0].classList.add('active');
    var nb_scenario = scenarios.length;
    var score = 0;
    var i=0;

    function next_question(point) {
        i++;

        score += point;

        console.log(i);
        console.log(score);
        console.log(nb_scenario);

        scenarios.forEach( function(scenario) {
            scenario.classList.remove('active');
        })

        if (i >= nb_scenario){
            document.getElementById('end').style.display = "block";
            document.getElementById('score').innerHTML = score;
            document.getElementById('sub').value = score;
        }
        else {
            scenarios[i].classList.add('active')
        }
    }
</script>