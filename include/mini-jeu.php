<div>
    <div>
        <?php
            //===== $_POST['difficulté'] est initialisé dans un autre fichier mais tkt
            $lvl = $_POST['difficulté'];

            //===== Requête selon le niveau selectioné
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
            //===== Stocke le résultat dans un tableau
            $SQL_Result = $dbConn->query($SQL_Scenario);
            //===== Parcoure le tableau pour afficher les scenarios
            $script = '';
            while($SQL_Row = $SQL_Result->fetch())
            {
                $script .= '<div class="scenario h-75">';
                $script .= '<p class="text-center bg-white rounded shadow-lg p-4 mb-5 ">'.$SQL_Row['quesion'].'</p>';
                $script .= '<p class="text-center">Choisis une réponse :</p>';
                //===== Affichage des differente réponse possible
                $SQL_Reponse = "SELECT * FROM reponse where question =". $SQL_Row['id'];// Requête
                $SQL_Result_2 = $dbConn->query($SQL_Reponse);//Stocke le résultat dans un tableau
                while($SQL_Row_2 = $SQL_Result_2->fetch())//Parcoure le tableau pour afficher les reponses
                {
                    $script .= '<p class="text-center bg-white rounded shadow-lg p-4 mt-3 mb-3 pointer-sak" onclick="next_question('.$SQL_Row_2['points'].', '.$SQL_Row_2['id'].')">'.$SQL_Row_2['nText'].'</p>';
                }
                $script .= '</div>';
                //===== Affichage des differents commentaires pour chaque réponse
                $SQL_Pourquoi = "SELECT * FROM reponse where question =". $SQL_Row['id'];// Requête
                $SQL_Result_3 = $dbConn->query($SQL_Pourquoi);//Stocke le résultat dans un tableau
                while($SQL_Row_3 = $SQL_Result_3->fetch())//Parcoure le tableau pour afficher les reponses
                {
                    $script .= '<div id="'.$SQL_Row_3['id'].'" class="pourquoi">';
                    $script .= '<p class="text-center bg-white rounded shadow-lg p-4 mb-5 ">'.$SQL_Row_3['pourquoi'].'</p>';
                    $script .= '</div>';
                }
            }
            $SQL_Result->closeCursor();
            $SQL_Result_2->closeCursor();
            $SQL_Result_3->closeCursor();
            print($script);


        ?>
    </div>
</div>

<!--====== Formulaire qui s'affiche à la fin du jeu ======-->
    <form id="end">
        <p>Votre score est de <span id="score"></span></p>
        <p id="commentaire"></p>
        <button id="sub" type="submit">continuer</button>
    </form>
<!--====== Formulaire qui s'affiche à la fin du jeu ======-->

<!--====== CSS ======-->
<style type="text/css">
    .pourquoi {
        display: none;
    }
    #end {
        display: none;
    }
    .scenario {
        display: none;
    }
    .active {
        display: block;
    }
    .pointer-sak {
        cursor: pointer;
    }
    .pointer-sak:hover {
        box-shadow: 0 0 11px rgba(30, 139, 195, 1)
    }
</style>

<!--====== JAVASCRIPT ======-->
<script type="application/javascript">
    var scenarios = Array.from(document.getElementsByClassName('scenario'));
    scenarios[0].classList.add('active');
    var nb_scenario = scenarios.length;
    var score = 0;
    var i=0;

    function next_question(point, pourquoi)
    {
        i++;

        score += point;

        console.log(i);
        console.log(score);
        console.log(nb_scenario);

        scenarios.forEach( function(scenario) {
            scenario.classList.remove('active');
        })

        document.getElementById(pourquoi).style.display = "block";

        if (i >= nb_scenario)
        {
            setTimeout(function () {
                document.getElementById(pourquoi).style.display = "none";
                document.getElementById('end').style.display = "block";
                document.getElementById('score').innerHTML = score;
                document.getElementById('sub').value = score;
                if (score < 15)
                {
                    document.getElementById('commentaire').innerHTML = "Il y a du progrès";
                }
                else if (score < 30)
                {
                    document.getElementById('commentaire').innerHTML = "C'est moyen quand meme";
                }
                else
                {
                    document.getElementById('commentaire').innerHTML = "Bon bah c'est bien";
                }
            }, 3000)
        }
        else
        {
            setTimeout(function () {
                document.getElementById(pourquoi).style.display = "none";
                scenarios[i].classList.add('active')
            }, 3000);
        }
    }
</script>