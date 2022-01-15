<div id="all" class="all">
    <div class="no-margin">
        <h1 class="headername top-margin">MISE IT!</h1>
        <h1 class="no-margin">Please select or enter your First Mise It! Item in the proper order:</h1>
        <div class="top-margin">
            <div style="display: flex;">
                <input list="itemslist" class="Item" id="itemname" placeholder="Item Name" style="margin-left: 0px;" name="myBrowser" /></label>
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

                <!------------------------------------ Total ---------------------------------->
                <div style="display: none;height: 38px;">
                    <p style="margin: 10px 0px 0px 7px;">Total:</p>
                    <p id="totalamount" style="margin: 4px 0px 0px 4px;display: inline-block;background: white;    width: 30px;    height: 23px;    padding: 4px 0px 0px 1px;    border: 2px solid;    text-align: center;">0</p>
                </div>


            </div>
        </div>

        <table id="Item-table" class=" no-margin">
            <tbody>
                <tr class="hiddenrow">
                    <th class="hiddenrow">
                        <div></div>
                    </th>
                    <th class="hiddenrow"><input type="nothing"></th>
                    <th class="hiddenrow">
                        <p type="button"></p>
                    </th>
                    <th class="hiddenrow">
                        <p type="button"></p>
                    </th>
                </tr>
            </tbody>
        </table>
        <button class="Ingredientsbtn" onclick="Back()">
            Back
        </button>
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
            document.getElementById('item' + id).setAttribute("contenteditable", true);
            return false;
        }
        if (btn.value == "Save") {
            document.getElementById('item' + id).setAttribute("Readonly", "readonly");
            document.getElementById('item' + id).style.border = "none";
            document.getElementById('item' + id).style.fontSize = "";
            document.getElementById(id).value = "Edit";
            document.getElementById('item' + id).style.margin = "0px 0px 0px 0px";
            document.getElementById('item' + id).style.height = "93%";
            document.getElementById('item' + id).style.width = "97%";
            document.getElementById('item' + id).style.pointerEvents = "none";
            document.getElementById('item' + id).setAttribute("contenteditable", false);
            btn.style.background = "";

            var all = JSON.parse(localStorage.getItem("miseit"));
            var allnew = [];
            for (let i = 0; i < all.length; i++) {
                var groupname = JSON.parse(all[i]).groupname;
                var oneline = JSON.parse(all[i]);

                if (document.getElementById("item" + btn.getAttribute("id")).getAttribute("valuegroup").trim() == groupname.trim()) {
                    oneline["groupname"] = btn.getAttribute("id") + " - " + document.getElementById("item" + btn.getAttribute("id")).textContent.trim();
                    allnew.push(JSON.stringify(oneline));
                } else {
                    allnew.push(JSON.stringify(oneline));
                }
            }
            document.getElementById("item" + btn.getAttribute("id")).setAttribute("valuegroup", btn.getAttribute("id") + " - " + document.getElementById("item" + btn.getAttribute("id")).textContent.trim())

            localStorage.setItem("miseit", JSON.stringify(allnew));

            return false;
        }

    }

    function addItmes() {

        var allitem = document.getElementsByName("item");
        var savingitem = [];
        allitem.forEach(v => savingitem.push(v.innerHTML));
        localStorage.setItem("items", JSON.stringify(savingitem));
        window.top.document.getElementById("all").innerHTML =
            ' <iframe name = "miseit-addingredient" src = "miseit-add-ingredient" />'

    }

    function Back() {
        var allitem = document.getElementsByName("item");
        var savingitem = [];
        allitem.forEach(v => savingitem.push(v.innerHTML.trim()));
        localStorage.setItem("items", JSON.stringify(savingitem));
        window.location = "/add-ingredient/";

    }

    function onAdd() {
        document.getElementById("totalamount").innerHTML = Number(totalamount.innerHTML) + Number(1);
        var allserial = document.getElementsByClassName("numbers");
        var table = document.getElementById("Item-table");
        var row = table.insertRow(-1);
        var cell0 = row.insertCell(-1);
        var cell1 = row.insertCell(-1);
        var cell2 = row.insertCell(-1);
        var cell3 = row.insertCell(-1);
        var serial = Number(allserial.length) + Number(1)
        cell0.innerHTML = '<div class="numbers">' + serial + '</div>';
        var grouptext = document.getElementById("itemname").value;
        cell1.innerHTML = '<span readonly="readonly" id="item' + row_id + '" valuegroup= "' +
            serial + " - " + grouptext + '" name="item"style="pointer-events:none;" >' + grouptext + ' </span>'
        cell1.style = "width:100%; padding-left: 7px;";
        cell2.innerHTML = '<input id="' + row_id +
            '" value="Edit" class="editbtn" onclick="return onEdit(this)" ; type="button" />';
        cell2.style = "min-width: 43px; max-width: 43px;";
        cell3.innerHTML = '<input id="' + row_id +
            '" value="Delete" onclick="return onDelete(this)" ; class="deletebtn" type="button" />';
        cell3.style = "min-width: 65;max-width: 65;";
        document.getElementById(
            "itemname").value = "";
        row_id++;
    }

    onStart();

    function onStart() {
        var all = JSON.parse(localStorage.getItem("items"));
        for (let i = 0; i < all.length; i++) {
            document.getElementById("itemname").value = all[i];
            onAdd();
        }
    }
</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    function onDelete(btn) {
        document.getElementById("totalamount").innerHTML = Number(totalamount.innerHTML) - Number(1);
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
        font-size: 27px;
        width: 57px;
        height: 38px;
        cursor: pointer;
        color: white;
        font-family: Calibri !important;

    }

    .hiddenrow {
        opacity: 0 !important;
        margin: 0px !important;
        height: 0 !important;
        border: 0 !important;
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
        background-color: #96a9d8;
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
        margin-top: 30px;
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


    td {
        font-family: Calibri;
    }

    h1 {
        font-family: Calibri;
    }

    p {
        font-family: Calibri;
    }

    span {
        font-family: Calibri;
        padding: 0px 11px;
    }
</style>