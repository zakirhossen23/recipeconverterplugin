<div id="all" class="all">
    <div class="no-margin">
        <h1 class="headername top-margin">MAKE IT!</h1>
        <h1 style="margin-top: -24px;">Please enter the tools or cooking techniques you need for this recipe:</h1>
        <div class="no-margin">
            <div style="display: flex;"> </div>
            <div style="display: flex;">
                <textarea id="itemname" placeholder="Tools or Cooking Techniques" name="tools" type="textarea"
                    style="margin: 0px;width: 318px;height: 98px;padding: 11px;"></textarea>

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
        ' <iframe name = "makeit-addingredient" src = "makeit-add-ingredient" />'

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
}

.Ingredientsbtn:active {
    background-color: #fffdf6;
}

iframe {
    width: 100%;
    height: 100%;
    writing-mode: vertical-lr;
    border: none;
}


input {
    font-family: Calibri;
}

.no-margin {
    margin: 1px;
}

.top-margin {
    margin-top: 10px;
}

body {
    background: white;
    font-family: Calibri;
}

input[type="text"] {
    border: 0;
}
</style>