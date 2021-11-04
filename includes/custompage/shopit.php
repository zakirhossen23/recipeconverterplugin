<div id="all" class="all">
    <div class="no-margin">
        <h1 class="headername top-margin">SHOP IT!</h1>
        <div class="no-margin">
            <div style="display: flex;">
                <strong style="
" class="aisletext"> Aisle Name:</strong>
                <input id="aislename" placeholder="Aisle Name" style="
" autocomplete="off" class="Aisle">
                <button class="btn-add" onclick="onAdd()" style="">
                    +
                </button>
            </div>
        </div>

        <table id="Aisle-table" class="table-margin no-margin">
            <tbody>

            </tbody>
        </table>

        <button class="Ingredientsbtn" onclick="Ingredients()">
            Add Ingredients
        </button>
    </div>
</div>
</div>
<script>
var row_id = 1;

function onEdit(btn) {
    var id = btn.id;
    if (btn.value == "Edit") {
        document.getElementById('aisle' + id).removeAttribute("Readonly");
        document.getElementById('aisle' + id).style.border = "solid 1px";
        document.getElementById('aisle' + id).style.fontSize = "larger";
        btn.style.background = "#debf54";
        document.getElementById('aisle' + id).style.margin = "0px 0px 0px 10px";
        document.getElementById('aisle' + id).style.height = "93%";
        document.getElementById('aisle' + id).style.width = "97%";
        document.getElementById(id).value = "Save";
        document.getElementById('aisle' + id).style.pointerEvents = "all";
        return false;
    }
    if (btn.value == "Save") {
        document.getElementById('aisle' + id).setAttribute("Readonly", "readonly");
        document.getElementById('aisle' + id).style.border = "none";
        document.getElementById('aisle' + id).style.fontSize = "revert";
        document.getElementById(id).value = "Edit";
        document.getElementById('aisle' + id).style.margin = "0px 0px 0px 0px";
        document.getElementById('aisle' + id).style.height = "93%";
        document.getElementById('aisle' + id).style.width = "97%";
        document.getElementById('aisle' + id).style.pointerEvents = "none";
        btn.style.background = "";

        return false;
    }

}

function Ingredients() {

    var allaisle = document.getElementsByName("aisle");
    var savingaisle = [];
    allaisle.forEach(v => savingaisle.push(v.value));
    localStorage.setItem("aisles", savingaisle);
    document.getElementById("all").innerHTML =
        ' <iframe name = "addingredient" src = "add-ingredient" />'

}


function onAdd() {
    var table = document.getElementById("Aisle-table");
    var row = table.insertRow(-1);
    var cell1 = row.insertCell(-1);
    var cell2 = row.insertCell(-1);
    var cell3 = row.insertCell(-1);
    cell1.innerHTML = '<input readonly="readonly" id="aisle' + row_id + '" name="aisle" value="' + document
        .getElementById(
            "aislename").value + '" style="pointer-events:none;" type="text" />'
    cell2.innerHTML = '<input id="' + row_id +
        '" value="Edit" class="editbtn" onclick="return onEdit(this)" ; type="button" />';
    cell3.innerHTML = '<input id="' + row_id +
        '" value="Delete" onclick="return onDelete(this)" ; class="deletebtn" type="button" />';
    document.getElementById(
        "aislename").value = "";
    row_id++;
}
</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
function onDelete(btn) {
    var row = $(btn).closest("TR");
    var name = $("TD", row).eq(0).html();

    var table = $("#Aisle-table")[0];

    table.deleteRow(row[0].rowIndex);
}
</script>
<style>
.btn-add {
    border: solid black 1px;
    background: #debf54;
    font-size: 29px;
    width: 57px;
    height: 38px;
    cursor: pointer;

}

.btn-add:active {
    background-color: #fffdf6;
}

.Ingredientsbtn {
    float: right;
    width: 125px;
    height: 37px;
    margin: 10px 1px 12px 0px;
    cursor: pointer;
    background: #debf54;
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

th,
td {
    border: 1px solid black;
    height: 39px;

}

table {
    border-collapse: collapse;
    width: 500px;
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

.edit {
    width: 61px;
}

.delete {
    width: 71px;
}

.table-margin {
    margin-top: 30px;
}

.Aisle {
    font: 15px/24px "Lato", Calibri, sans-serif;
    color: #333;
    letter-spacing: 1px;
    outline: none !important;
    padding: 5px 5px;
    height: 38px;
    margin: 0px 6px 0px 6px;
}

.aisletext {
    vertical-align: middle;
    margin: 9px 0px;
}

.editbtn {
    width: 100%;
    height: 100%;
    cursor: pointer;
    background: #debf54;
    border: none;
    color: black;
}

.editbtn:active {
    background: #897636;
    color: #adadad;
}

.deletebtn {
    width: 100%;
    height: 100%;
    background: #debf54;
    border: none;
    color: black;
    cursor: pointer;
}

.deletebtn:active {
    background: #897636;
    color: #ffffffb8;
}

.headername {
    font-size: 40px;
}
</style>