<?php
get_header();
?>
<html>

<head></head>

<body>
    <div id="all">
        <h1 class="headertwo no-margin">Please enter your Mise It! List:</h1>
        <div style="display: flex;" class="headerthree">
            <input id="ingredientname" style=" padding:0px 0px 0px 4px;  width:161px;" placeholder="Qty and Ingredient">
            <input id="Preparation" style=" padding:0px 0px 0px 4px; " placeholder="Preparation Instructions">
            <select id="itemname" placeholder="Please select Item" style="padding:0px 0px 0px 4px; width: 139px;">

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
                    <th class="hiddenrow"></th>
                    <th class="hiddenrow"></th>
                    <th class="hiddenrow" style="min-width: 48px;"></th>
                    <th class="hiddenrow" style="min-width: 25.2px;"></th>
                    <th class="hiddenrow" style="min-width: 39.8px;"></th>
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
        allitemcode = JSON.parse(item);
        var count = 1;
        allitemcode.forEach(element => {
            codeitem.push("<option>" + count + " - " + element + "</option>");
            count++;
        });
        itemfield.innerHTML = codeitem;
        var item_id = 1;
        makegroup();

        function Makeit() {
            var allitem = document.getElementsByClassName("ingredient")
            var allperep = document.getElementsByClassName("perep");
            var savingmiseit = [];
            for (let i = 0; i < allperep.length; i++) {
                let obj = {
                    id: (Number(allitem[i].getAttribute("name"))),
                    groupname: allitem[i].getAttribute("groupname"),
                    ingredient: allitem[i].innerText,
                    prep: allperep[i].innerText
                };
                savingmiseit.push(JSON.stringify(obj))
            }
            localStorage.setItem("miseit", JSON.stringify(savingmiseit));

            document.getElementById("all").innerHTML =
                ' <iframe name = "makeit" id="makeit"  src = "makeit" />'
        }

        function onEdit(btn) {
            var id = btn.name;
            if (btn.value == "Edit") {


                btn.style.background = " #4E5975";
                document.getElementById('ingredient' + id).removeAttribute("Readonly");
                document.getElementById('ingredient' + id).style.border = "solid 1px";
                document.getElementById('ingredient' + id).style.fontSize = "larger";
                document.getElementById('ingredient' + id).style.margin = "0px 0px 0px 10px";
                document.getElementById('ingredient' + id).style.height = "93%";
                document.getElementById('ingredient' + id).style.width = "95%";
                document.getElementById('ingredient' + id).style.pointerEvents = "all";
                document.getElementById('ingredient' + id).setAttribute("contenteditable", true);

                document.getElementById('perep' + id).removeAttribute("Readonly");
                document.getElementById('perep' + id).style.border = "solid 1px";
                document.getElementById('perep' + id).style.fontSize = "larger";
                document.getElementById('perep' + id).style.margin = "0px 0px 0px 10px";
                document.getElementById('perep' + id).style.height = "93%";
                document.getElementById('perep' + id).style.width = "95%";
                document.getElementById('perep' + id).style.pointerEvents = "all";
                document.getElementById('perep' + id).setAttribute("contenteditable", true);

                document.getElementsByName(id)[0].value = "Save";

                return true;
            }
            if (btn.value == "Save") {
                document.getElementsByName(id)[0].value = "Edit";
                document.getElementById('ingredient' + id).setAttribute("Readonly", "readonly");
                document.getElementById('ingredient' + id).style.border = "none";
                document.getElementById('ingredient' + id).style.fontSize = "";
                document.getElementById('ingredient' + id).style.margin = "0px 0px 0px 0px";
                document.getElementById('ingredient' + id).style.height = "93%";
                document.getElementById('ingredient' + id).style.width = "97%";
                document.getElementById('ingredient' + id).style.pointerEvents = "none";
                document.getElementById('ingredient' + id).setAttribute("contenteditable", false);

                document.getElementById('perep' + id).setAttribute("Readonly", "readonly");
                document.getElementById('perep' + id).style.border = "none";
                document.getElementById('perep' + id).style.fontSize = "";
                document.getElementById('perep' + id).style.margin = "0px 0px 0px 0px";
                document.getElementById('perep' + id).style.height = "93%";
                document.getElementById('perep' + id).style.width = "97%";
                document.getElementById('perep' + id).style.pointerEvents = "none";
                document.getElementById('perep' + id).setAttribute("contenteditable", false);

                btn.style.background = "";
                return false;

            }

        }

        function onDelete(btn) {
            document.getElementById("totalamount").innerHTML = Number(totalamount.innerHTML) - Number(1);
            var row = $(btn).closest("TR");
            var name = $("TD", row).eq(0).html();

            var table = $("#Item-table")[0];

            table.deleteRow(row[0].rowIndex);

        }

        function makegroup() {
            var table = document.getElementById("Item-table");
            allitemcode.forEach(element => {
                var row = table.insertRow(-1);
                row.innerHTML = '<tr><td colspan="4" class="itemgroup">' + element +
                    '</td>' + '<td colspan="4" style="text-align:center;">' + '<div class="numbers">' + item_id +
                    '</div>' +
                    '</td>' + ' </tr>';
                row.id = item_id - 1;
                item_id++;
            })
            var row = table.insertRow(-1);
            row.id = allitemcode.length;
        }

        function insertAfter(referenceNode, newNode) {
            referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
        }

        function insertBefore(referenceNode, newNode) {
            referenceNode.parentNode.insertBefore(referenceNode, newNode);
        }

        function onAdd() {
            document.getElementById("totalamount").innerHTML = Number(totalamount.innerHTML) + Number(1);
            var rowname = document.getElementById("itemname").selectedIndex;
            var ingredientvalue = document.getElementById("ingredientname").value
            var pereperationvalue = document.getElementById("Preparation").value

            var el = document.createElement("tr");
            el.innerHTML = '<td class="cell"><span readonly="readonly" class="ingredient" groupname="' + document
                .getElementById("itemname").value + '" id="ingredient' + row_id +
                //inputbox
                '" name="' + rowname + '" >' +
                ingredientvalue + '</span></td>' +

                '<td class="cell"><span readonly="readonly" class="perep" id="perep' + row_id + //inputbox
                '" name="' + rowname + '" >' +
                pereperationvalue + '</span></td>' +
                '<td><input type="button" class="editbtn" name="' + row_id + //edit button
                '" value="Edit" onclick="return onEdit(this)"></td>' +
                '<td colspan="2"><input type="button" class="deletebtn" name="' + row_id + //delete button
                '" value="Delete" onclick="return onDelete(this)"></td>';
            document.getElementById(rowname + 1).before(el);
            document.getElementById("ingredientname").value = "";
            document.getElementById("Preparation").value = "";

            row_id++;

        }
    </script>
</body>

</html>
<style>
    .btn-add {
        font-family: Calibri !important;
        border: solid black 1px !important;
        background: #4E5975 !important;
        font-size: 20px !important;
        width: 57px !important;
        height: 38px !important;
        cursor: pointer !important;
        padding: 0 !important;
        color: white !important;
        margin: 0 !important;
    }


    .btn-add:active {
        background-color: #fffdf6;
        font-family: Calibri !important;
        font-size: 15px;
        color: black !important;
    }

    .cell {
        min-width: 130px;
        max-width: 130px;
        padding-left: 7px !important;
        font-family: Calibri !important;
        font-size: 15px;

    }

  

    .makeitbtn {
        width: 121px;
        color: white !important; 
        padding: 8px;
        float: right;
        margin: 10px 1px 12px 0px;
        background-color: #4E5975 !important;
        font-family: Calibri !important;
        font-size: 15px;
        border: 1px solid black;
    }
    .makeitbtn:hover{
        color: white;
    
    }
    .makeitbtn:active{
        font-family: Calibri !important;
        background-color: #fffdf6 !important;
        font-size: 15px !important;
        color: black !important;
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
        width: 592px;
        font-family: Calibri !important;
        font-size: 15px;
        margin-top: 30px;
    }

    input {
        font-family: Calibri;
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

    .perep {
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

    .hiddenrow {
        opacity: 0 !important;
        margin: 0px !important;
        height: 0 !important;
        border: 0 !important;
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
        background: #2e364a;
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


    .itemgroup {
        text-align: center;
        width: 100%;
        pointer-events: none;
        background-color: #D9E2F3;
        font-weight: bolder;
        color: black;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .numbers {
    background: black;
    color: white;
    font-size: 20px;
    font-family: calibri;
    width: 33px;
    padding: 0 !important;
    margin: 0px 3px !important;
    border-radius: 35px;
    height: 33px;
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
        border: 1px solid grey;
        color: black;
    }


    .perepbtn {
        margin-left: 34%;
        font-family: Calibri !important;
        font-size: 15px;
        pointer-events: none;
    }

    iframe {
        width: 100%;
        height: 100%;
        font-family: Calibri !important;
        font-size: 15px;
        border: none;
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
    }
</style>