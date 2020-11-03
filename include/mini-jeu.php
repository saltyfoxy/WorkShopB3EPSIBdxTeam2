
<div class="scenario">
    <p>scenario 1</p>
    <button onclick="next_question(3)">choix 1</button>
    <button onclick="next_question(1)">choix 2</button>
</div>

<div class="scenario">
    <p>scenario 2</p>
    <button onclick="next_question(3)">choix 1</button>
    <button onclick="next_question(1)">choix 2</button>
</div>

<div class="scenario">
    <p>scenario 3</p>
    <button onclick="next_question(3)">choix 1</button>
    <button onclick="next_question(1)">choix 2</button>
    <button onclick="next_question(1)">choix 3</button>
</div>

<form id="end">
    <p>Votre score est de <span id="score"></span></p>
    <p>commentaire...</p>
    <button id="sub" type="submit">continuer</button>
</form>


<style>
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


<script>
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