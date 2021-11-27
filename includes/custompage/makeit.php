<div id="all" class="all">
    <div class="no-margin">
        <h1 class="headername top-margin">MAKE IT!</h1>
        <h1 class="no-margin">Please enter the tools or cooking techniques you need for this recipe:</h1>
        <div class="top-margin">
            <div style="display: flex;"> </div>
            <div style="display: flex;">
                <textarea id="itemname" placeholder="Tools or Cooking Techniques" name="tools" type="textarea" style="margin: 0px;width: 318px;height: 98px;padding: 11px;"></textarea>

            </div>
        </div><button class="Ingredientsbtn" onclick="addItmes()">Add Make It! Steps</button>
    </div>
</div>
<script>
    var row_id = 1;

    function addItmes() {

        var allitem = document.getElementById("itemname").value;

        localStorage.setItem("tools", allitem);
        document.getElementById("all").innerHTML =
            ' <iframe name = "makeit-steps" src = "makeit-steps" />'

    }
</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<style>
    .Ingredientsbtn {
        width: 172px;
        height: 37px;
        margin: 10px 1px 12px 0px;
        cursor: pointer;
        color: white;
        background: #88a28e;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .Ingredientsbtn:active {
        background-color: #fffdf6;
        font-family: Calibri !important;
        font-size: 15px;
    }

    iframe {
        width: 100%;
        height: 100%;
        writing-mode: vertical-lr;
        border: none;
        font-family: Calibri !important;
        font-size: 15px;
    }


    input {
        font-family: Calibri;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .no-margin {
        margin: 1px;
        font-family: Calibri !important;

    }

    .hiddenrow {
        opacity: 0 !important;
        margin: 0px !important;
        height: 0 !important;
        border: 0 !important;
    }

    .headername {
        font-size: 40px;
        font-family: Calibri !important;
    }

    textarea {
        font-family: Calibri !important;
        font-size: 15px;

    }

    .top-margin {
        margin-top: 10px;
        font-family: Calibri !important;

    }

    body {
        background: white;
        font-family: Calibri;
        margin: 0px;
        font-family: Calibri !important;
        font-size: 15px;
    }

    input[type="text"] {
        border: 0;
        font-family: Calibri !important;
        font-size: 15px;
    }


    td{font-family: Calibri;}
    h1{font-family: Calibri;}
    p{font-family: Calibri;}
    span{font-family: Calibri;}
</style>