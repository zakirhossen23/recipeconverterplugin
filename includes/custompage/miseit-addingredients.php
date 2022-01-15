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
            <!------------------------------------ Total ---------------------------------->
            <div style="display: flex;height: 38px;">
                <p style="margin: 10px 0px 0px 7px;">Total:</p>
                <p id="totalamount" style="margin: 4px 0px 0px 4px;display: inline-block;background: white;    width: 30px;    height: 23px;    padding: 4px 0px 0px 1px;    border: 2px solid;    text-align: center;">0</p>
            </div>
        </div>


        <div>

            <table id="Item-table">
                <tr>
                    <th class="hiddenrow"></th>
                    <th class="hiddenrow"></th>
                    <th class="hiddenrow" style="min-width: 30px;"></th>
                    <th class="hiddenrow" style="min-width: 0px;"></th>
                    <th class="hiddenrow"></th>
                </tr>
            </table>

        </div>

        <button class="makeitbtn" onclick="Back()">
            Back
        </button>
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
            var count = 1;
            allitemcode.forEach(element => {
                var row = table.insertRow(-1);
                row.innerHTML = '<tr><td colspan="4" value="' + count + " - " + element + '" class="itemgroup">' + element +
                    '</td>' + '<td colspan="4" style="text-align:center;">' + '<div class="numbers">' + item_id +
                    '</div>' +
                    '</td>' + ' </tr>';
                row.id = item_id - 1;
                item_id++;
                count++;
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


        function Back() {
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

            window.location = "/wordpress/miseit/";

        }

        function groupcheck(groupname) {
            var status = false;
            var groups = document.querySelectorAll('[class="itemgroup"]')
            groups.forEach((groupelement) => {
                if (groupelement.getAttribute("value").trim() == (groupname.trim())) {
                    status = true;
                }
            })
            return status;
        }

        onStart();

        function onStart() {
            var all = JSON.parse(localStorage.getItem("miseit"));
            for (let i = 0; i < all.length; i++) {
                var ingredientname = JSON.parse(all[i]).ingredient;
                var groupname = JSON.parse(all[i]).groupname;
                var prep = JSON.parse(all[i]).prep;

                console.log(groupname);
                document.getElementById("ingredientname").value = ingredientname;
                document.getElementById("itemname").value = groupname;
                document.getElementById("Preparation").value = prep;
                if (groupcheck(groupname) == true)
                    onAdd();
            }
        }
    </script>
</body>

</html>
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

    .btn-add:active {
        background-color: #fffdf6;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .cell {
        min-width: 130px;
        max-width: 130px;
        padding-left: 7px;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .makeitbtn {
        width: 172px;
        height: 37px;
        margin: 10px 1px 12px 0px;
        cursor: pointer;
        color: white;
        background: #4E5975;
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
        font-family: Calibri;
        font-family: Calibri !important;
        font-size: 15px;
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
        margin: 13px 0px 2px 3px;
        background-color: #debf54;
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