<html>

<head></head>

<body>
    <div id="all">
        <h1>Please enter your Mise It! List:</h1>
        <div style="display: flex;">
            <input id="ingredientname" style=" padding:0px 0px 0px 4px;  width:161px;" placeholder="Qty and Ingredient">
            <input id="Preparation" style=" padding:0px 0px 0px 4px; " placeholder="Preparation Instructions">
            <select id="itemname" placeholder="Please select Item" style="padding:0px 0px 0px 4px; width: 139px;">

            </select>
            <button class="btn-add" onclick="onAdd()">+ </button>
        </div>


        <div>

            <table id="Item-table">
                <tr>

                </tr>
            </table>

        </div>

        <button class="makeitbtn" onclick="Makeit()">
            Let's Make It!
        </button>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script>
    var row_id = 1;

    var itemfield = document.getElementById("itemname");
    var allitemcode = [];
    var codeitem = [];
    var item = localStorage.getItem("items");
    allitemcode = item.split(",");
    allitemcode.forEach(element => {
        codeitem.push("<option>" + element + "</option>");
    });
    itemfield.innerHTML = codeitem;
    var item_id = 1;
    makegroup();

    function Makeit() {
        var allitem = document.getElementsByClassName("ingredient")
        var allperep = document.getElementsByClassName("perep");
        var savingmiseit = [];
        for (let i = 0; i < allperep.length; i++) {

            var text = "miseit:" + allitem[i].name + ":" + allitem[i].value + ":" + allperep[i].value;
            savingmiseit.push(text)
        }
        localStorage.setItem("miseit", savingmiseit);

        document.getElementById("all").innerHTML =
            ' <iframe name = "makeit" id="makeit"  src = "makeit" />'
    }

    function onEdit(btn) {
        var id = btn.id;
        if (btn.value == "Edit") {


            btn.style.background = " #4E5975";
            document.getElementById('ingredient' + id).removeAttribute("Readonly");
            document.getElementById('ingredient' + id).style.border = "solid 1px";
            document.getElementById('ingredient' + id).style.fontSize = "larger";
            document.getElementById('ingredient' + id).style.margin = "0px 0px 0px 10px";
            document.getElementById('ingredient' + id).style.height = "93%";
            document.getElementById('ingredient' + id).style.width = "95%";
            document.getElementById('ingredient' + id).style.pointerEvents = "all";

            document.getElementById('perep' + id).removeAttribute("Readonly");
            document.getElementById('perep' + id).style.border = "solid 1px";
            document.getElementById('perep' + id).style.fontSize = "larger";
            document.getElementById('perep' + id).style.margin = "0px 0px 0px 10px";
            document.getElementById('perep' + id).style.height = "93%";
            document.getElementById('perep' + id).style.width = "95%";
            document.getElementById('perep' + id).style.pointerEvents = "all";

            document.getElementById(id).value = "Save";

            return true;
        }
        if (btn.value == "Save") {
            document.getElementById(id).value = "Edit";
            document.getElementById('ingredient' + id).setAttribute("Readonly", "readonly");
            document.getElementById('ingredient' + id).style.border = "none";
            document.getElementById('ingredient' + id).style.fontSize = "revert";
            document.getElementById('ingredient' + id).style.margin = "0px 0px 0px 0px";
            document.getElementById('ingredient' + id).style.height = "93%";
            document.getElementById('ingredient' + id).style.width = "97%";
            document.getElementById('ingredient' + id).style.pointerEvents = "none";

            document.getElementById('perep' + id).setAttribute("Readonly", "readonly");
            document.getElementById('perep' + id).style.border = "none";
            document.getElementById('perep' + id).style.fontSize = "revert";
            document.getElementById('perep' + id).style.margin = "0px 0px 0px 0px";
            document.getElementById('perep' + id).style.height = "93%";
            document.getElementById('perep' + id).style.width = "97%";
            document.getElementById('perep' + id).style.pointerEvents = "none";

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
        allitemcode.forEach(element => {
            var row = table.insertRow(-1);
            row.innerHTML = '<tr><td colspan="3" class="itemgroup">' + element +
                '</td>' + '<td colspan="4" style="text-align:center;">' + '<div class="numbers">' + item_id +
                '</div>' +
                '</td>' + ' </tr>';
            row.id = element;
            item_id++;
        })
    }

    function insertAfter(referenceNode, newNode) {
        referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
    }


    function onAdd() {
        var rowname = document.getElementById("itemname").value;
        var ingredientvalue = document.getElementById("ingredientname").value
        var pereperationvalue = document.getElementById("Preparation").value

        var el = document.createElement("tr");
        el.innerHTML = '<td><input readonly="readonly" class="ingredient" id="ingredient' + row_id + //inputbox
            '" name="' + rowname + '" value="' +
            ingredientvalue + '" /></td>' +

            '<td><input readonly="readonly" class="perep" id="perep' + row_id + //inputbox
            '" name="' + rowname + '" value="' +
            pereperationvalue + '" /></td>' +



            '<td><input type="button" class="editbtn" id="' + row_id + //edit button
            '" value="Edit" onclick="return onEdit(this)"></td>' +
            '<td><input type="button" class="deletebtn" id="' + row_id + //delete button
            '" value="Delete" onclick="return onDelete(this)"></td>';
        insertAfter(document.getElementById(rowname), el);
        document.getElementById("ingredientname").value = "";
        document.getElementById("Preparation").value = "";

        row_id++;

    }
    </script>
</body>

</html>
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
}


.makeitbtn {
    float: right;
    width: 172px;
    height: 37px;
    margin: 10px 1px 12px 0px;
    cursor: pointer;
    color: white;
    background: #4E5975;
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

.perep {
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
    background: #4E5975;
    border: none;
    color: white;
}

.editbtn:active {
    background: #2e364a;
    color: #adadad;
}

.deletebtn {
    width: 100%;
    height: 100%;
    background: #4E5975;
    border: none;
    color: white;
    cursor: pointer;
}


.deletebtn:active {
    background: #2c3240;
    color: #ffffffb8;
}


.itemgroup {
    text-align: center;
    width: 100%;
    pointer-events: none;
    background-color: #D9E2F3;
    font-weight: bolder;
    color: black;
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
    display: inline-table;
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


.perepbtn {
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