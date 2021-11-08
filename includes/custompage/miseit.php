<div id="all" class="all">
    <div class="no-margin">
        <h1 class="headername top-margin">MISE IT!</h1>
        <h1 class="no-margin">Please select or enter your First Mise It! Item in the proper order:</h1>
        <div class="top-margin">
            <div style="display: flex;">
                <input list="itemslist" class="Item" id="itemname" placeholder="Item Name" style="margin-left: 0px;"
                    name="myBrowser" /></label>
                <datalist id="itemslist">
                    <option value="Mini Bowl">
                    <option value="Small Bowl">
                    <option value="Medium Bowl">
                    <option value="Large Bowl">
                    <option value="X-Large Bowl">
                    <option value="Plate">
                    <option value="Food Processor">
                    <option value="Paper Towel">
                    <option value="Container">
                    <option value="Can">
                </datalist>

                <button class="btn-add" onclick="onAdd()" style="">
                    +
                </button>
            </div>
        </div>

        <table id="Item-table" class=" no-margin">
            <tbody>
                <tr style="
    height: 0px;
">
                    <th style="width:0" class="hidden">
                        <div></div>
                    </th>
                    <th class="hidden"><input type="nothing"></th>
                    <th style="width: 45px;" class="hidden">
                        <p type="button"></p>
                    </th>
                    <th style="width: 63px;" class="hidden">
                        <p type="button"></p>
                    </th>
                </tr>
            </tbody>
        </table>

        <button class="Ingredientsbtn" onclick="addItmes()">
            Add Mise It! Ingredients
        </button>
    </div>
</div>
</div>
<script>
var row_id = 1;

function onEdit(btn) {
    var id = btn.id;
    if (btn.value == "Edit") {
        document.getElementById('item' + id).removeAttribute("Readonly");
        document.getElementById('item' + id).style.border = "solid 1px";
        document.getElementById('item' + id).style.fontSize = "larger";
        btn.style.background = " #4E5975";
        document.getElementById('item' + id).style.margin = "0px 0px 0px 10px";
        document.getElementById('item' + id).style.height = "93%";
        document.getElementById('item' + id).style.width = "97%";
        document.getElementById(id).value = "Save";
        document.getElementById('item' + id).style.pointerEvents = "all";
        return false;
    }
    if (btn.value == "Save") {
        document.getElementById('item' + id).setAttribute("Readonly", "readonly");
        document.getElementById('item' + id).style.border = "none";
        document.getElementById('item' + id).style.fontSize = "revert";
        document.getElementById(id).value = "Edit";
        document.getElementById('item' + id).style.margin = "0px 0px 0px 0px";
        document.getElementById('item' + id).style.height = "93%";
        document.getElementById('item' + id).style.width = "97%";
        document.getElementById('item' + id).style.pointerEvents = "none";
        btn.style.background = "";

        return false;
    }

}

function addItmes() {

    var allitem = document.getElementsByName("item");
    var savingitem = [];
    allitem.forEach(v => savingitem.push(v.value));
    localStorage.setItem("items", savingitem);
    document.getElementById("all").innerHTML =
        ' <iframe name = "miseit-addingredient" src = "miseit-add-ingredient" />'

}


function onAdd() {
    var allserial = document.getElementsByClassName("numbers");
    var table = document.getElementById("Item-table");
    var row = table.insertRow(-1);
    var cell0 = row.insertCell(-1);
    var cell1 = row.insertCell(-1);
    var cell2 = row.insertCell(-1);
    var cell3 = row.insertCell(-1);
    var serial = Number(allserial.length) + Number(1)
    cell0.innerHTML = '<div class="numbers">' + serial + '</div>';
    cell1.innerHTML = '<input readonly="readonly" id="item' + row_id + '" name="item" value="' + document
        .getElementById(
            "itemname").value + '" style="pointer-events:none;" type="text" />'
    cell2.innerHTML = '<input id="' + row_id +
        '" value="Edit" class="editbtn" onclick="return onEdit(this)" ; type="button" />';
    cell3.innerHTML = '<input id="' + row_id +
        '" value="Delete" onclick="return onDelete(this)" ; class="deletebtn" type="button" />';
    document.getElementById(
        "itemname").value = "";
    row_id++;
}
</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
function onDelete(btn) {
    var row = $(btn).closest("TR");
    var name = $("TD", row).eq(0).html();

    var table = $("#Item-table")[0];

    table.deleteRow(row[0].rowIndex);
    var allnumberrow = document.getElementsByClassName("numbers");
    var ir = 0;
    for (let i = 0; i < allnumberrow.length; i++) {

        allnumberrow[i].innerHTML = ir + 1;

        ir++;

    };
};
</script>
<style>
.btn-add {
    border: solid black 1px;
    background: #4E5975;
    font-size: 29px;
    width: 57px;
    height: 38px;
    cursor: pointer;
    color: white;

}

.btn-add:active {
    background-color: #fffdf6;
    font-family: Calibri !important;
    font-size: 15px;
}

.numbers {
    background: black;
    color: white;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    align-items: center;
    text-align: center;
    font-size: 23px;
    font-family: calibri;

}

.Ingredientsbtn {
    float: right;
    width: 172px;
    height: 37px;
    margin: 10px 1px 12px 0px;
    cursor: pointer;
    color: white;
    background: #4E5975;
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

th,
td {
    border: 0.5px solid black;
    height: 41px;
    font-family: Calibri !important;
    font-size: 15px;

}

table {
    border-collapse: collapse;
    width: 500px;
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

.top-margin {
    margin-top: 10px;
    font-family: Calibri !important;
    font-size: 15px;
}

body {
    background: white;
    font-family: Calibri;
    font-family: Calibri !important;


    margin: 0px;
}

input[type="text"] {
    border: 0;
    font-family: Calibri !important;
    font-size: 15px;
}

.edit {
    width: 61px;
    font-family: Calibri !important;
    font-size: 15px;
}

.delete {
    width: 71px;
    font-family: Calibri !important;
    font-size: 15px;
}

.table-margin {
    margin-top: 30px;
    font-family: Calibri !important;
    font-size: 15px;
}

.Item {
    font-family: Calibri !important;
    font-size: 15px;
    color: #333;
    letter-spacing: 1px;
    outline: none !important;
    padding: 5px 5px;
    height: 38px;
    margin: 0px 6px 0px 6px;
}

.itemtext {
    vertical-align: middle;
    margin: 9px 0px;
    font-family: Calibri !important;
    font-size: 15px;
}

.editbtn {
    width: 100%;
    height: 100%;
    cursor: pointer;
    background: #4E5975;
    border: none;
    color: white;
    font-family: Calibri !important;
    font-size: 15px;
}

.editbtn:active {
    background: #2c3240;
    color: #adadad;
    font-family: Calibri !important;
    font-size: 15px;
}

.deletebtn {
    width: 100%;
    height: 100%;
    background: #4E5975;
    border: none;
    color: white;
    cursor: pointer;
    font-family: Calibri !important;
    font-size: 15px;
}

.deletebtn:active {
    background: #2c3240;
    color: #ffffffb8;
    font-family: Calibri !important;
    font-size: 15px;
}

.headername {
    font-size: 40px;
    font-family: Calibri !important;

}

.hidden {
    opacity: 0;
    border: 0;
    pointer-events: none;
    outline: none;
    font-family: Calibri !important;
    font-size: 15px;
}
</style>