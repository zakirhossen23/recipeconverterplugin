<?php
get_header();
?>
<html>

<head></head>

<body>
    <div id="all">
        <h1 class="headertwo no-margin">Please enter your Shop It! List:</h1>
        <div style="display: flex;" class="headerthree">
            <input id="ingredientname" style=" padding:0px 0px 0px 4px; " placeholder="Ingredient">
            <input id="overbuy" type="radio" placeholder="Overbuy" style="width: 41px; height:38px; margin: 0;vertical-align: top;" />

            <select id="aislename" placeholder="Please select Aisle" style="padding:0px 0px 0px 4px; width: 139px; margin: 0px 4px 0 0;">

            </select>
            <button class="btn-add" onclick="onAdd()">+ </button>

            <!------------------------------------ Total ---------------------------------->
            <div style="display: flex;height: 38px;">
                <p style="margin: 6px 0px 0px 7px;">Total:</p>
                <p id="totalamount" class="totalamount">0</p>
            </div>
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
        allaislecode = JSON.parse(item);
        allaislecode.forEach(element => {
            codeaisle.push("<option>" + element + "</option>");
        });
        aislefield.innerHTML = codeaisle;
        var aisle_id = 0;
        makegroup();

        function Miseit() {
            var allaisle = document.getElementsByClassName("ingredient");
            var alloverbuy = document.getElementsByClassName("overbuybtn");
            var savingshopit = [];
            for (let i = 0; i < alloverbuy.length; i++) {
                let obj = {
                    groupname: allaisle[i].getAttribute("groupname"),
                    ingredient: allaisle[i].innerHTML,
                    radiochecked: alloverbuy[i].checked
                };
                var text = "shopit:" + allaisle[i].getAttribute("groupname") + ":" + allaisle[i].value + ":" + alloverbuy[i].checked;
                savingshopit.push(JSON.stringify(obj))

            }
            localStorage.setItem("shopit", JSON.stringify(savingshopit));
            document.getElementById("all").innerHTML =
                ' <iframe name = "miseit" id="miseit"  src = "miseit" />'
        }

        function onEdit(btn) {
            var id = btn.name;
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

                document.getElementById('ingredient' + id).setAttribute("contenteditable", true);
                btn.value = "Save";

                return true;
            }
            if (btn.value == "Save") {

                document.getElementById('ingredient' + id).setAttribute("Readonly", "readonly");
                document.getElementById('ingredient' + id).style.border = "none";
                document.getElementById('ingredient' + id).style.fontSize = "";
                document.getElementById('ingredient' + id).setAttribute("contenteditable", false);
                btn.value = "Edit";
                document.getElementById('ingredient' + id).style.margin = "0px 0px 0px 0px";
                document.getElementById('ingredient' + id).style.height = "93%";
                document.getElementById('ingredient' + id).style.width = "97%";
                document.getElementById('ingredient' + id).style.pointerEvents = "none";
                document.getElementById('overbuyrow' + id).style.pointerEvents = "none";

                btn.style.background = "";
                return false;

            }

        }

        function onDelete(btn) {
            var row = $(btn).closest("TR");
            var name = $("TD", row).eq(0).html();

            var table = $("#Item-table")[0];

            table.deleteRow(row[0].rowIndex);
            document.getElementById("totalamount").innerHTML = Number(totalamount.innerHTML) - Number(1);
        }

        function makegroup() {
            var table = document.getElementById("Item-table");
            aisle_id = 1;
            allaislecode.forEach(element => {
                var row = table.insertRow(-1);
                row.innerHTML = '<tr id = "2"><td colspan="4" class="aislegroup">' + element +
                    '</td></tr>';
                row.id = aisle_id - 1;
                aisle_id++;
            })
            var row = table.insertRow(-1);
            row.id = allaislecode.length;
        }

        function insertAfter(referenceNode, newNode) {
            referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
        }


        function onAdd() {
            document.getElementById("totalamount").innerHTML = Number(totalamount.innerHTML) + Number(1);
            var groupname = document.getElementById("aislename").value;
            var rowname = document.getElementById("aislename").selectedIndex;
            var ingredientvalue = document.getElementById("ingredientname").value
            var overbuyvalue = document.getElementById("overbuy").checked;
            var el = document.createElement("tr");
            el.innerHTML = '<td style="padding-left: 7px !important;"><span readonly="readonly" class="ingredient" id="ingredient' + row_id + //inputbox
                '" name="' + rowname + '" groupname="' + groupname + '" >' +
                ingredientvalue + '</span></td>' + '<td class="radiotd">' +
                "<input class='overbuybtn cellchecked' name='" +
                row_id + "'id='overbuyrow" + row_id + "' type = 'radio' /> " + //overbuy
                "</td>" +
                '<td style="min-width: 43px; max-width: 43px;"><input type="button" class="editbtn" name="' + row_id +
                //edit button
                '" value="Edit" onclick="return onEdit(this)"></td>' +
                '<td style="min-width: 65;max-width: 65;"><input type="button" class="deletebtn" name="' + row_id +
                //delete button
                '" value="Delete" onclick="return onDelete(this)"></td>';
            document.getElementById(rowname + 1).before(el);

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
        font-family: Calibri !important;
        border: solid black 1px !important;
        background: #debf54 !important;
        font-size: 20px !important;
        width: 57px !important;
        height: 38px !important;
        cursor: pointer !important;
        padding: 0 !important;
        color: black !important;
        margin: 0 !important;
    }

    .btn-add:active {
        background-color: white;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .radiotd {
        min-width: 35px;
    }

    th,
    td {
        width: 100%;
        border: 0.5px solid black !important;
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

        font-family: Calibri !important;
        font-size: 15px;
    }

    .edit {
        width: 20%;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .ingredient {
        border: none;
        outline: none;
        pointer-events: none;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .delete {
        width: 20%;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .editbtn {
        width: 100%;
        height: 100%;
        cursor: pointer;
        background: #debf54;
        border: none;
        color: black;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .editbtn:active {
        background: #6c5f31;
        color: black;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .deletebtn {
        width: 100%;
        height: 100%;
        background: #debf54;
        border: none;
        color: black;
        cursor: pointer;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .deletebtn:active {
        background: #6c5f31;
        color: black;
        font-family: Calibri !important;
        font-size: 15px;
    }


    .aislegroup {
        text-align: center;
        width: 100%;
        pointer-events: none;
        background-color: #ffe69a;
        font-weight: bolder;
        font-family: Calibri !important;
        font-size: 15px;
    }

    body {
        font-family: Calibri;
        font-family: Calibri !important;
        font-size: 15px;
        margin: 0px;
    }

    button {
        font-family: Calibri;
        font-family: Calibri !important;
        font-size: 15px;
    }

    select {
        font-family: Calibri !important;
        font-size: 15px;
        border: 1px solid;
        color: black;
    }


    .overbuybtn {
        pointer-events: none;
        font-family: Calibri !important;
        font-size: 15px;
    }

    iframe {
        width: 100%;
        height: 100%;

        border: none;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .miseitbtn {
        width: 146px;

        padding: 8px;
        float: right;
        margin: 13px 0px 2px 3px;
        background-color: #debf54;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .headername {
        font-family: Calibri !important;
        font-size: 40px;

    }

    .headertwo {
        font-size: 30px;
    }

    .headerthree {
        font-size: 16px;
    }

    .totalamount {
        margin: 4px 0px 0px 4px;
        background: white;
        width: 33px;
        height: 31px;
        border: 2px solid;
        text-align: center;
    }

    table td,
    table th,
    .wp-block-table td,
    .wp-block-table th {
        padding: 0 0 0 0 !important;

    }

    input {
        font-family: Calibri !important;
        font-size: 15px;
    }

    .no-margin {
        font-family: Calibri !important;
        margin: 12px 0;
    }

    .top-margin {
        font-family: Calibri !important;
        margin-top: 10px;
    }

    /********************* Checkedbox ******************/
    input[type=radio]:after {
        content: none;
        outline: none !important;
    }

    input[type=checkbox],
    input[type=radio] {
        position: relative;
        height: 25px !important;
        align-self: center;
        -webkit-appearance: revert;
    }

    input[type=radio]:checked {
        border: 2px solid #000000;
        align-self: center;
        outline: none !important;
    }

    /*************************** Selectbox ************************/
    select:focus {
        outline-offset: 2px;
        outline: none;
    }

    .cellchecked {
        vertical-align: middle;
        width: 100% !important;
        position: relative !important;
        align-self: center !important;
        pointer-events: none;
        padding: 0px !important;
        height: 24px !important;
        margin: 0;
    }

    /************************************Button **************************/

    button:focus {
        outline: none;
    }

    button:active {
        font-family: Calibri !important;
        background-color: #fffdf6 !important;
        outline: none;

        background: white !important;
        font-size: 21px !important;

    }
</style>