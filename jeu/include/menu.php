<!--- START : MENU --->
    <div class="container d-none" id="menu">
        <h2 class="text-center text-light m-4">Bienvenue dans GreenCity</h2>
        <p class="text-center text-light m-4">Les habitants de la ville comptent sur toi pour améliorer son eco-score.</p>
        <div class="row justify-content-around">
            <button class="col-6 btn btn-light btn-lg shadow-lg shadow rounded-pill"  onclick="affiche_lvl()" >Jouer</button>
        </div>
        <div class="row justify-content-around mb-4 mt-4">
            <button class="col-6 btn btn-light btn-lg shadow-lg shadow rounded-pill" >Liste des scores</button>
        </div>
        <div class="row justify-content-around">
            <a class="col-6 btn btn-info btn-lg shadow-lg shadow rounded-pill disabled" href="#" >Espace enseignant</a>
        </div>
    </div>
<!--- END : MENU --->

<!--- START : CHOIX NIVEAU --->
    <div class="container d-none" id="lvl">
        <h2 class="text-center text-light m-4">Choisis un niveau</h2>
        <form method="post" class="row justify-content-around">
            <button class="col-6 btn btn-success btn-lg shadow-lg shadow rounded-pill" type="submit" name="difficulté" value="1">Facile</button>
        </form>
        <form method="post" class="row justify-content-around mb-4 mt-4">
            <button class="col-6 btn btn-warning btn-lg shadow-lg text-light shadow rounded-pill" type="submit" name="difficulté" value="2">Moyen</button>
        </form>
        <form method="post" class="row justify-content-around">
            <button class="col-6 btn btn-danger btn-lg shadow-lg shadow rounded-pill" type="submit" name="difficulté" value="3">Difficile</button>
        </form>
        <div class="row justify-content-around mt-5" >
            <a class="col-3 btn btn-light rounded-pill" href="#menu" onclick="affiche_menu()">MENU</a>
        </div>
    </div>
<!--- END : CHOIX NIVEAU --->

<!--====== JAVASCRIPT ======-->
<script type="application/javascript">
    //===== Initialisation des variable
    var menu   = document.getElementById('menu');
    var lvl   = document.getElementById('lvl');

    menu.classList.remove('d-none');

    //===== Affiche le menu
    function affiche_menu()
    {
        lvl.classList.add('d-none');
        menu.classList.remove('d-none');
    }

    //===== Affiche le choix de niveau
    function affiche_lvl()
    {
        menu.classList.add('d-none');
        lvl.classList.remove('d-none');
    }
</script>