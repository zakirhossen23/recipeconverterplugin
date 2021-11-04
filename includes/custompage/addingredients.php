<html>

<head></head>

<body>
    <div id="all">
        <h1>Please enter your Shop It! List:</h1>
        <div style="display: flex;">
            <input id="ingredientname" style=" padding:0px 0px 0px 4px; " placeholder="Ingredient">
            <input id="overbuy" type="radio" placeholder="Overbuy"
                style="width: 41px; height:38px; margin: 0;vertical-align: top;" />

            <select id="aislename" placeholder="Please select Aisle" style="padding:0px 0px 0px 4px; width: 139px;">

            </select>
            <button class="btn-add" onclick="onAdd()">+ </button>
        </div>


        <div>

            <table id="Item-table">
                <tr>

                </tr>
            </table>

        </div>

        <button class="miseitbtn" onclick="Miseit()">
            Let's Mise It!
        </button>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script>
    var row_id = 1;

    var aislefield = document.getElementById("aislename");
    var allaislecode = [];
    var codeaisle = [];
    var item = localStorage.getItem("aisles");
    allaislecode = item.split(",");
    allaislecode.forEach(element => {
        codeaisle.push("<option>" + element + "</option>");
    });
    aislefield.innerHTML = codeaisle;
    var aisle_id = 1;
    makegroup();

    function Miseit() {
        var allaisle = document.getElementsByClassName("ingredient");
        var alloverbuy = document.getElementsByClassName("overbuybtn");
        var savingshopit = [];
        for (let i = 0; i < alloverbuy.length; i++) {
            var text = "shopit:" + allaisle[i].name + ":" + allaisle[i].value + ":" + alloverbuy[i].checked;
            savingshopit.push(text)

        }
        localStorage.setItem("shopit", savingshopit);
        document.getElementById("all").innerHTML =
            ' <iframe name = "miseit" id="miseit"  src = "miseit" />'
    }

    function onEdit(btn) {
        var id = btn.id;
        if (btn.value == "Edit") {

            document.getElementById('ingredient' + id).removeAttribute("Readonly");
            document.getElementById('ingredient' + id).style.border = "solid 1px";
            document.getElementById('ingredient' + id).style.fontSize = "larger";
            btn.style.background = "#debf54";
            document.getElementById('ingredient' + id).style.margin = "0px 0px 0px 10px";
            document.getElementById('ingredient' + id).style.height = "93%";
            document.getElementById('ingredient' + id).style.width = "97%";
            document.getElementById('ingredient' + id).style.pointerEvents = "all";
            document.getElementById('overbuyrow' + id).style.pointerEvents = "all";
            document.getElementById('overbuyrow' + id).style.margin = "0px -3px 0px 7px";
            document.getElementById(id).value = "Save";

            return true;
        }
        if (btn.value == "Save") {

            document.getElementById('ingredient' + id).setAttribute("Readonly", "readonly");
            document.getElementById('ingredient' + id).style.border = "none";
            document.getElementById('ingredient' + id).style.fontSize = "revert";
            document.getElementById(id).value = "Edit";
            document.getElementById('ingredient' + id).style.margin = "0px 0px 0px 0px";
            document.getElementById('ingredient' + id).style.height = "93%";
            document.getElementById('ingredient' + id).style.width = "97%";
            document.getElementById('ingredient' + id).style.pointerEvents = "none";
            document.getElementById('overbuyrow' + id).style.pointerEvents = "none";
            document.getElementById('overbuyrow' + id).style.margin = "";
            btn.style.background = "";
            return false;

        }

    }

    function onDelete(btn) {
        var row = $(btn).closest("TR");
        var name = $("TD", row).eq(0).html();

        var table = $("#Item-table")[0];

        table.deleteRow(row[0].rowIndex);
    }

    function makegroup() {
        var table = document.getElementById("Item-table");
        allaislecode.forEach(element => {
            var row = table.insertRow(-1);
            row.innerHTML = '<tr id = "2"><td colspan="4" class="aislegroup">' + element +
                '</td></tr>';
            row.id = element;
            aisle_id++;
        })
    }

    function insertAfter(referenceNode, newNode) {
        referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
    }


    function onAdd() {
        var rowname = document.getElementById("aislename").value;
        var ingredientvalue = document.getElementById("ingredientname").value
        var overbuyvalue = document.getElementById("overbuy").checked;
        var el = document.createElement("tr");
        el.innerHTML = '<td><input readonly="readonly" class="ingredient" id="ingredient' + row_id + //inputbox
            '" name="' + rowname + '" value="' +
            ingredientvalue + '" /></td>' + "<td>" +
            "<input class='overbuybtn' name='" +
            row_id + "'id='overbuyrow" + row_id + "' type = 'radio' /> " + //overbuy
            "</td>" +
            '<td><input type="button" class="editbtn" id="' + row_id + //edit button
            '" value="Edit" onclick="return onEdit(this)"></td>' +
            '<td><input type="button" class="deletebtn" id="' + row_id + //delete button
            '" value="Delete" onclick="return onDelete(this)"></td>';
        insertAfter(document.getElementById(rowname), el);
        document.getElementById("ingredientname").value = "";

        if (overbuyvalue == true) {

            document.getElementById("overbuyrow" + row_id).checked = true;
        }
        row_id++;
        document.getElementById("overbuy").checked = false;
    }
    </script>
</body>

</html>
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


th,
td {
    border: 0.5px solid black;
    height: 41px;

}

table {
    border-collapse: collapse;
    width: 500px;
}

input {
    font-family: Calibri;
}

.edit {
    width: 20%;
}

.ingredient {
    border: none;
    outline: none;
    pointer-events: none;
}

.delete {
    width: 20%;
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
    background: #6c5f31;
    color: black;
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
    background: #6c5f31;
    color: black;
}


.aislegroup {
    text-align: center;
    width: 100%;
    pointer-events: none;
    background-color: #ffe69a;
    font-weight: bolder;
}

body {
    font-family: Calibri;
}

button {
    font-family: Calibri;
}

select {
    font-family: Calibri;
}


.overbuybtn {
    margin-left: 34%;

    pointer-events: none;
}

iframe {
    width: 100%;
    height: 100%;

    border: none;
}

.miseitbtn {
    width: 146px;
    font-size: 85%;
    padding: 8px;
    float: right;
    margin: 13px 0px 2px 3px;
    background-color: #debf54;
}
</style>