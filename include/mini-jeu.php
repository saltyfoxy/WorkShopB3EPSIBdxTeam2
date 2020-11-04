<div class="container" id="jeu">
    <div class="row">

        <div class="col-4 d-flex align-items-center">
            <img id="prof" src="assets/images/prof.png" style="bottom: 0">
        </div>

        <div class="col-8">
            <?php

                //===== $_POST['difficulté'] est initialisé dans un autre fichier mais tkt
                $lvl = $_POST['difficulté'];

                //===== Requête selon le niveau selectioné
                switch ($lvl)
                {
                    case 1:// Facile
                        $SQL_Scenario = "SELECT * FROM scenario where difficulte = $lvl";
                        break;
                    case 2:// Normal
                        $SQL_Scenario = "SELECT * FROM scenario where difficulte = $lvl";
                        break;
                    case 3:// Difficile
                        $SQL_Scenario = "SELECT * FROM scenario where difficulte = $lvl";
                        break;
                    default :
                        header("Refresh:0");// Recharge la page (Permets de resélectionner le niveau)
                }

                //===== Stocke le résultat dans un tableau
                $SQL_Result = $dbConn->query($SQL_Scenario);

                //===== Parcoure le tableau pour afficher les scénarios
                $script = '';
                while($SQL_Row = $SQL_Result->fetch())
                {
                    $script .= '<div class="scenario h-75">';
                    $script .= '<p class="text-center bg-white rounded shadow-lg p-4 mb-5 ">'.$SQL_Row['question'].'</p>';
                    $script .= '<p class="text-center text-light">Choisis une réponse :</p>';

                    //===== Affichage des différente réponse possible
                    $SQL_Reponse = "SELECT * FROM reponse where question =". $SQL_Row['id'];// Requête
                    $SQL_Result_2 = $dbConn->query($SQL_Reponse);//Stocke le résultat dans un tableau
                    while($SQL_Row_2 = $SQL_Result_2->fetch())//Parcoure le tableau pour afficher les reponses
                    {
                        $script .= '<p class="text-center bg-white rounded p-4 mt-3 mb-3 pointer" onclick="next_question('.$SQL_Row_2['points'].', '.$SQL_Row_2['id'].','.$SQL_Row_2['VF'].')">'.$SQL_Row_2['nText'].'</p>';
                    }
                    $script .= '</div>';

                    //===== Affichage des différents commentaires pour chaque réponse
                    $SQL_Pourquoi = "SELECT * FROM reponse where question =". $SQL_Row['id'];// Requête
                    $SQL_Result_3 = $dbConn->query($SQL_Pourquoi);//Stocke le résultat dans un tableau
                    while($SQL_Row_3 = $SQL_Result_3->fetch())//Parcoure le tableau pour afficher les reponses
                    {
                        $script .= '<div id="'.$SQL_Row_3['id'].'" class="pourquoi">';
                        if($SQL_Row_3['VF'] == 0)
                        {
                            $script .= '<p class="text-center bg-white rounded p-4 mb-5 vrai">';
                            $script .= '<span class="text-success">VRAI</span><br/>';
                        }
                        else
                        {
                            $script .= '<p class="text-center bg-white rounded p-4 mb-5 faux">';
                            $script .= '<span class="text-danger">FAUX</span><br/>';
                        }
                        $script .= ''.$SQL_Row_3['pourquoi'].'</p>';
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
</div>


<!--====== START : ECRANT DE FIN ======-->
    <form id="end" class="container">
        <div class="row justify-content-around">
            <h1 class="text-center text-light">ECO-SCORE <br/> <span id="score"></span></h1>
        </div>
        <div class="row justify-content-around mb-4 mt-4">
            <p class="text-light" id="commentaire"></p>
        </div>
        <div class="row justify-content-around">
            <button class="col-6 btn btn-info btn-lg shadow-lg" id="sub" type="submit">recommencer</button>
        </div>
    </form>
<!--====== END : ECRANT DE FIN ======-->

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
    .pointer {
        cursor: pointer;
    }
    .pointer:hover {
        box-shadow: 0 0 11px rgba(30, 139, 195, 1)
    }
    .vrai {
        box-shadow: 0 0 11px rgba(0, 255, 0, 1)
    }
    .faux {
        box-shadow: 0 0 11px rgba(255, 0, 0, 1)
    }
    #prof {
        animation-duration: 2s;
        animation-name: hautbas;
        animation-iteration-count: infinite;
        animation-direction: alternate;
    }
    @keyframes hautbas {
        from {
            transform: translate(0,10px);
        }
        to {
            transform: translate(0,-10px);
        }
    }
</style>

<!--====== JAVASCRIPT ======-->
<script type="application/javascript">
    //===== Initialisation des variable
    var scenarios   = Array.from(document.getElementsByClassName('scenario'));
    scenarios[0].classList.add('active'); // Affiche le premier élément du tableau
    var nb_scenario = scenarios.length;
    var score       = 0;
    var i           =0;

    function next_question(point, pourquoi,vf)
    {
        i++;
        score += point;

        //===== Plusieurs modification selon le score
        if (score < 250)
        {
            document.getElementById('bg_ville').style.backgroundImage = "url(assets/images/ville_0.png)";
            document.getElementById('score').innerHTML = "<span class='text-danger'>"+score+"</span>";
            document.getElementById('commentaire').innerHTML = "Il y a du progrès !";
        }
        else if (score < 500)
        {
            document.getElementById('bg_ville').style.backgroundImage = "url(assets/images/ville_1.png)";
            document.getElementById('score').innerHTML = "<span class='text-warning'>"+score+"</span>";
            document.getElementById('commentaire').innerHTML = "C'est moyen quand même";
        }
        else if (score < 750 )
        {
            document.getElementById('bg_ville').style.backgroundImage = "url(assets/images/ville_2.png)";
            document.getElementById('score').innerHTML = "<span class='text-info'>"+score+"</span>";
            document.getElementById('commentaire').innerHTML = "Bon bah c'est bien";
        }
        else
        {
            document.getElementById('bg_ville').style.backgroundImage = "url(assets/images/ville_3.png)";
            document.getElementById('score').innerHTML = "<span class='text-success'>"+score+"</span>";
            document.getElementById('commentaire').innerHTML = "Excellent rien à dire !";
        }

        scenarios.forEach( function(scenario) {
            scenario.classList.remove('active');
        })

        document.getElementById(pourquoi).style.display = "block";// Affiche un commentaire selon la réponse
        //===== Change l'image de la prof selon la réponse
        if(vf === 0 )
            document.getElementById('prof').src = "assets/images/prof_vrai.png";
        else
            document.getElementById('prof').src = "assets/images/prof_faux.png";


        //===== Affiche l'ecran de fin quand tous les scénarios on était joué sinon continue
        if (i >= nb_scenario)
        {
            setTimeout(function () {
                document.getElementById(pourquoi).style.display = "none";
                document.getElementById("jeu").style.display = "none";
                document.getElementById('end').style.display = "block";
                document.getElementById('sub').value = score;
            }, 3000)
        }
        else
        {
            setTimeout(function () {
                document.getElementById('prof').src = "assets/images/prof.png";
                document.getElementById(pourquoi).style.display = "none";
                scenarios[i].classList.add('active')
            }, 3000);
        }
    }
</script>