<div id="all" class="all">
    <div class="no-margin">
        <h1 class="headername top-margin">SHOP IT!</h1>
        <h1 class="no-margin">Please select or enter your First Aisle in the proper order:</h1>
        <div class="top-margin">
            <div style="display: flex;">
                <input id="aislename" placeholder="Aisle Name" style="margin-left: 0;" autocomplete="off" class="Aisle">
                <button class="btn-add" onclick="onAdd()">
                    +
                </button>

                <!------------------------------------ Total ---------------------------------->
                <div style="display: flex;height: 38px;">
                    <p style="margin: 10px 0px 0px 7px;">Total:</p>
                    <p id="totalamount" style="margin: 4px 0px 0px 4px;display: inline-block;background: white;    width: 30px;    height: 23px;    padding: 4px 0px 0px 1px;    border: 2px solid;    text-align: center;">0</p>
                </div>
            </div>
        </div>

        <table id="Aisle-table" class="table-margin no-margin">
            <tbody>

            </tbody>
        </table>

        <button class="Ingredientsbtn" onclick="Ingredients()">
            Add Shop It! List
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
            document.getElementById('aisle' + id).setAttribute("contenteditable", true);
            return false;
        }
        if (btn.value == "Save") {
            document.getElementById('aisle' + id).setAttribute("Readonly", "readonly");
            document.getElementById('aisle' + id).style.border = "none";
            document.getElementById('aisle' + id).style.fontSize = "15px";
            document.getElementById(id).value = "Edit";
            document.getElementById('aisle' + id).style.margin = "0px 0px 0px 0px";
            document.getElementById('aisle' + id).style.height = "93%";
            document.getElementById('aisle' + id).style.width = "97%";
            document.getElementById('aisle' + id).style.pointerEvents = "none";
            document.getElementById('aisle' + id).setAttribute("contenteditable", false);
            btn.style.background = "";

            return false;
        }

    }

    function Ingredients() {

        var allaisle = document.getElementsByName("aisle");
        var savingaisle = [];
        allaisle.forEach(v => savingaisle.push(v.innerText));
        localStorage.setItem("aisles", JSON.stringify(savingaisle));
        document.getElementById("all").innerHTML =
            ' <iframe name = "addingredient" src = "add-ingredient" />'

    }
var totalamount = document.getElementById("totalamount");

    function onAdd() {
        document.getElementById("totalamount").innerHTML =  Number(totalamount.innerHTML) + Number(1);
        console.log("clicked");
        var table = document.getElementById("Aisle-table");
        var row = table.insertRow(-1);
        var cell1 = row.insertCell(-1);
        var cell2 = row.insertCell(-1);
        var cell3 = row.insertCell(-1);
        cell1.innerHTML = '<span readonly="readonly" id="aisle' + row_id + '" name="aisle" >' + document
            .getElementById(
                "aislename").value + '</span>'
        cell1.style = "width:100%; padding-left: 7px;";
        cell2.innerHTML = '<input id="' + row_id +
            '" value="Edit" class="editbtn" onclick="return onEdit(this)" ; type="button" />';
        cell2.style = "min-width: 43px; max-width: 43px;";
        cell3.innerHTML = '<input id="' + row_id +
            '" value="Delete" onclick="return onDelete(this)" ; class="deletebtn" type="button" />';
        cell3.style = "min-width: 65;max-width: 65;";
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
        document.getElementById("totalamount").innerHTML =   Number(totalamount.innerHTML) - Number(1);
    }
</script>
<style>
    .btn-add {
        font-family: Calibri !important;
        border: solid black 1px;
        background: #debf54;
        font-size: 27px;
        width: 57px;
        height: 38px;
        cursor: pointer;

    }

    .btn-add:active {
        font-family: Calibri !important;
        background-color: #fffdf6;
        font-size: 15px;
    }

    .Ingredientsbtn {
        font-family: Calibri !important;
        float: right;
        width: 125px;
        height: 37px;
        margin: 10px 1px 12px 0px;
        cursor: pointer;
        background: #debf54;
        font-size: 15px;
    }

    .Ingredientsbtn:active {
        font-family: Calibri !important;
        background-color: #fffdf6;
        font-size: 15px;
    }

    iframe {
        font-family: Calibri !important;
        width: 100%;
        height: 100%;
        writing-mode: vertical-lr;
        border: none;
        font-size: 15px;
    }

    th,
    td {
        font-family: Calibri !important;
        border: 0.5px solid black;
        height: 41px;
        font-size: 15px;

    }

    table {
        font-family: Calibri !important;
        border-collapse: collapse;
        width: 500px;
        font-size: 15px;
        margin-top: 30px;
    }


    input {
        font-family: Calibri !important;
        font-size: 15px;
    }

    .no-margin {
        font-family: Calibri !important;
        margin: 1px;
    }

    .top-margin {
        font-family: Calibri !important;
        margin-top: 10px;
    }

    body {
        font-family: Calibri !important;
        background: white;
        font-size: 15px;
        margin: 0px;
    }

    input[type="text"] {
        font-family: Calibri !important;
        border: 0;
        font-size: 15px;
    }

    .edit {
        font-family: Calibri !important;
        width: 61px;
        font-size: 15px;
    }

    .delete {
        font-family: Calibri !important;
        width: 71px;
        font-size: 15px;
    }

    .table-margin {
        font-family: Calibri !important;
        margin-top: 30px;
        font-size: 15px;
    }

    .Aisle {
        font-family: Calibri !important;
        color: #333;
        letter-spacing: 1px;
        outline: none !important;
        padding: 5px 5px;
        height: 38px;
        margin: 0px 6px 0px 6px;
        font-size: 15px;
    }

    .aisletext {
        font-family: Calibri !important;
        vertical-align: middle;
        margin: 9px 0px;
        font-size: 15px;
    }

    .editbtn {
        font-family: Calibri !important;
        width: 100%;
        height: 100%;
        cursor: pointer;
        background: #debf54;
        border: none;
        color: black;
        font-size: 15px;
    }

    .editbtn:active {
        font-family: Calibri !important;
        background: #897636;
        color: #adadad;
        font-size: 15px;
    }


    .deletebtn {
        font-family: Calibri !important;
        width: 100%;
        height: 100%;
        background: #debf54;
        border: none;
        color: black;
        cursor: pointer;
        font-size: 15px;
    }

    .deletebtn:active {

        background: #897636;
        color: #ffffffb8;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .headername {
        font-family: Calibri !important;
        font-size: 40px;

    }
</style>