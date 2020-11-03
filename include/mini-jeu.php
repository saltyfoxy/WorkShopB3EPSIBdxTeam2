
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
</div>

<style>
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

        scenarios.forEach( function(scenario) {
            scenario.classList.remove('active');
        })

        scenarios[i].classList.add('active')

    }

</script>