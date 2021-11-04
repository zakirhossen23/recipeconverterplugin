<?php
get_header();
?>
<div id="all" class="all">
    <div class="no-margin">
        <h3 class="no-margin">Let's get started! </h3>
        <div style="display: flex;">
            <div class="col-3">
                <input class="effect-1" type="text" id="recipename" placeholder="Recipe name">
                <span class="focus-border"></span>
            </div>
            <div class="col-3">
                <input class="effect-1" type="text" id="recipesource" placeholder="Recipe Source">
                <span class="focus-border"></span>
            </div>
            <div class="col-3">
                <input class="effect-1" type="text" id="serves" placeholder="Serves ">
                <span class="focus-border"></span>
            </div>
            <div class="col-3">
                <input class="effect-1" type="text" id="effort" placeholder="Effort ">
                <span class="focus-border"></span>
            </div>
            <button class="btn-Next" onclick="onNext()">
                Next
            </button>
        </div>

    </div>
</div>
<script>
function onNext() {
    var recipename = document.getElementById("recipename").value;
    var recipesource = document.getElementById("recipesource").value;
    var serves = document.getElementById("serves").value;
    var effort = document.getElementById("effort").value;
    localStorage.setItem("recipename", recipename);
    localStorage.setItem("recipesource", recipesource);
    localStorage.setItem("serves", serves);
    localStorage.setItem("effort", effort);
    document.getElementById("all").innerHTML =
        ' <iframe name = "shopit" src = "shopit" />'

}
</script>
<style>
.all {
    padding: 0px 0px 0px 48px;
}

.no-margin {
    margin: 1px;
}

.top-margin {
    margin-top: 10px;
}

body {
    background: white;
    font: cab
}

iframe {
    width: 100%;
    height: 100%;
    writing-mode: vertical-lr;
    border: none;
}

.btn-Next {
    width: 5em;
    padding: 0px;
    border: none;
    background: #d9d9d9 !important;
    color: black !important;
    margin-left: 6px;
    outline: none !important;
}

.btn-Next:hover {
    background: black !important;
    color: white !important;
    text-decoration: none;
}



input[type="text"] {
    font: 15px /24px "Lato", Arial, sans-serif;
    color: #333;
    box-sizing: border-box;
    letter-spacing: 1px;
    height: 59%;
}

:focus {
    outline: none;
}

.col-3 {
    width: 10em;
    position: relative;
    padding: 0px 2px;
    height: 0%;
}

/* necessary to give position: relative to parent. */
input[type="text"] {
    font: 15px/24px "Lato", Arial, sans-serif;
    color: #333;
    width: 100%;
    letter-spacing: 1px;
    border: solid 1px;
    outline: none !important;
}

.effect-1 {
    border: 0;
    padding: 7px 0;
    left: 5px;
    border-bottom: 1px solid #ccc;
}

.effect-1~.focus-border {
    position: absolute;
    bottom: 0;
    left: 2px;
    width: 0;
    height: 2px;
    background-color: #4caf50;
    transition: 0.4s !important;
}

.effect-1:focus~.focus-border {
    width: 97%;
    transition: 0.4s;
}
</style>
<?php get_footer();
?>