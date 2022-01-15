<?php
get_header();
?>
<div id="all" class="all">
    <div class="no-margin">
        <h3 class="no-margin">Let's get started! </h3>
        <div style="display: flex;">
            <div class="col-3 recipe">
                <input class="effect-1" type="text" id="recipename" placeholder="Recipe name">
                <span class="focus-border"></span>
            </div>
            <div class="col-3 source">
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
    function clear() {

        localStorage.setItem("shopit", "");
        localStorage.setItem("miseit", "");
        localStorage.setItem("makeit", "");
        localStorage.setItem("tools", "");
        localStorage.setItem("items", "");
        localStorage.setItem("makeitgroup", "");

    }

    function onNext() {
        var recipename = document.getElementById("recipename").value;
        var recipesource = document.getElementById("recipesource").value;
        var serves = document.getElementById("serves").value;
        var effort = document.getElementById("effort").value;
        localStorage.setItem("recipename", recipename);
        localStorage.setItem("recipesource", recipesource);
        localStorage.setItem("serves", serves);
        localStorage.setItem("effort", effort);
        clear();
        document.getElementById("all").innerHTML =
            ' <iframe name = "shopit" src = "shopit" />'

    }

    function onStartup() {
        if (localStorage.getItem("ispage") == "true") {
            document.getElementById("all").innerHTML = ' <iframe src = "' + localStorage.getItem("page") + '" />'
            localStorage.setItem("ispage", false);
            localStorage.setItem("page", "");
        }
    }
    onStartup()
</script>
<style>
    .all {
        padding: 0px 0px 0px 48px;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .no-margin {
        margin: 1px;
        font-family: Calibri !important;

    }

    .top-margin {
        margin-top: 10px;
        font-family: Calibri !important;

    }

    body {
        background: white;
        font-family: Calibri !important;
        margin: 0px;
    }

    iframe {
        width: 100%;
        height: 100%;
        writing-mode: vertical-lr;
        border: none;
        font-family: Calibri !important;
        font-size: 15px;
    }

    h3 {
        font-family: Calibri;
        font-family: Calibri !important;

    }

    .btn-Next {
        width: 5em;
        padding: 0px;
        border: none;
        background: #d9d9d9 !important;
        color: black !important;
        margin-left: 6px;
        outline: none !important;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .btn-Next:hover {
        background: black !important;
        color: white !important;
        text-decoration: none;
        font-family: Calibri !important;
        font-size: 15px;
    }



    input[type="text"] {
        color: #333;
        font-family: Calibri !important;
        width: 100%;
        letter-spacing: 1px;
        border: solid 1px;
        outline: none !important;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .recipe {
        width: 250px !important;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .source {
        width: 309px !important;
        font-family: Calibri !important;
        font-size: 15px;
    }

    :focus {
        outline: none;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .col-3 {
        width: 10em;
        position: relative;
        padding: 0px 2px;
        height: 0%;
        font-family: Calibri !important;
        font-size: 15px;
    }

    /* necessary to give position: relative to parent. */
    input[type="text"] {
        font-family: Calibri;
        color: #333;
        width: 100%;
        letter-spacing: 1px;
        border: solid 1px;
        outline: none !important;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .effect-1 {
        border: 0;
        padding: 7px 0;
        left: 5px;
        border-bottom: 1px solid #ccc;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .effect-1~.focus-border {
        position: absolute;
        bottom: 0;
        left: 2px;
        width: 0;
        height: 2px;
        background-color: #4caf50;
        transition: 0.4s !important;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .effect-1:focus~.focus-border {
        width: 97%;
        transition: 0.4s;
        font-family: Calibri !important;
        font-size: 15px;
    }
</style>
<?php get_footer();
?>