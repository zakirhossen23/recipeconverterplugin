<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>

</head>

<body>
    <div id="all">
        <h1 class="headername top-margin">MAKE IT!</h1>
        <h1 style="margin-top: -24px;">Please enter the first Make It! step in your recipe:</h1>

        <div style="display: flex;">

            <div class="container" style="display: flex;">
                <!--  DO -->
                <div class="row">
                    <select class="js-select2" multiple="multiple">
                        <option value="O1" data-badge="">Mix</option>
                        <option value="O2" data-badge="">Season</option>
                        <option value="O3" data-badge="">Form</option>
                        <option value="O4" data-badge="">Rub</option>
                        <option value="O5" data-badge="">Heat</option>
                        <option value="O6" data-badge="">Cook</option>
                        <option value="O7" data-badge="">Transfer</option>
                        <option value="O7" data-badge="">Add</option>
                        <option value="O7" data-badge="">Bring</option>
                        <option value="O7" data-badge="">Reduce</option>
                        <option value="O7" data-badge="">Lower</option>
                        <option value="O7" data-badge="">Sinmar</option>
                        <option value="O7" data-badge="">Stir</option>
                        <option value="O7" data-badge="">Top</option>
                        <option value="O7" data-badge="">Cover</option>
                        <option value="O7" data-badge="">Boil</option>
                        <option value="O7" data-badge="">Fry</option>
                    </select>
                </div>
                <!--  With -->
                <div class="row">
                    <select class="js-select2with" id="withselect" multiple="multiple">
                        <option value="O1" data-badge="">Option1</option>
                        <option value="O2" data-badge="">Option2</option>
                        <option value="O3" data-badge="">Option3</option>
                        <option value="O4" data-badge="">Option4</option>
                        <option value="O5" data-badge="">Option5</option>
                        <option value="O6" data-badge="">Option6</option>
                        <option value="O7" data-badge="">Option7</option>
                    </select>
                </div>
                <textarea id="how" placeholder="How" autocomplete="off" class="freeform"></textarea>
                <textarea id="Important" placeholder="Important" autocomplete="on" class="Important"></textarea>
                <input list="grouplist" class="Item" id="groupname" placeholder="Group Name" name="groupname" /></label>
                <datalist id="grouplist">

                </datalist>

            </div>

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

    <script>
    var row_id = 1;

    var itemfield = document.getElementById("withselect");
    var allitemcode = [];
    var codeitem = [];
    var item = localStorage.getItem("items");
    allitemcode = item.split(",");
    var item_id = 1;
    allitemcode.forEach(element => {
        codeitem.push("<option>" + item_id + "</option>");
        item_id++;
    });
    itemfield.innerHTML = codeitem;
    item_id = 1;
    makegroup();
    header_id = 0;

    function makegroup() {
        var table = document.getElementById("Item-table");
        var row = table.insertRow(-1);
        row.innerHTML = '<tr><td colspan="0" class="itemgroup do">DO</td>' +
            '<td colspan="1" class="itemgroup with">WITH</td>' +
            '<td colspan="2" class="itemgroup how">HOW</td>' +
            '<td colspan="3" class="itemgroup important">IMPORTANT</td>' +
            '<td colspan="4" class="edit">Eidt</td>' +
            '<td colspan="5" class="delete">Delete</td>' +
            ' </tr>';

        item_id++;

    }
    row_id = 1;

    function onAdd() {
        setstatus = 0; // 0 = normal at last
        var table = document.getElementById("Item-table");
        var placingheader = null;
        var selectedvalue = document.getElementById("groupname").value;
        if ($('[header="' + document.getElementById("groupname").value + '"]').length == 0) {
            var headerrow = table.insertRow(-1);
            headerrow.innerHTML = '<td colspan="12" header="' + document.getElementById("groupname").value +
                '" headerid="' + header_id +
                '" class="headergroup">' + document.getElementById("groupname").value +
                '</td>';
            var optionelement = document.createElement("option");
            optionelement.value = document.getElementById("groupname").value;
            headerrow.setAttribute("groupname", selectedvalue);
            optionelement.setAttribute("nameid", header_id);
            document.getElementById("grouplist").appendChild(optionelement);
            header_id++;
            placingheader = headerrow;
        } else {

            placingheader = $('[groupname="' + selectedvalue + '"]')[$('[groupname="' + selectedvalue + '"]').length -
                1]
            setstatus = 1;
        }

        var row = table.insertRow(-1);
        var element = document.getElementsByClassName("select2-selection select2-selection--multiple")[0]
        var choosen = element.getElementsByClassName("select2-selection__choice")

        var dobox = [];
        for (let i = 0; i < choosen.length; i++) {

            dobox.push(choosen[i].innerText.replace("×", ""));
        }

        var element = document.getElementsByClassName("select2-selection select2-selection--multiple")[1]
        var choosen = element.getElementsByClassName("select2-selection__choice")
        var withbox = [];

        for (let i = 0; i < choosen.length; i++) {
            if (isNaN(choosen[i].innerText.replace("×", "")) == false) {
                withbox.push('<input class="numbers" value="' + choosen[i].innerText.replace("×", "") + '"/>');
            } else {
                withbox.push('<span>' + choosen[i].innerText.replace("×", "") + '</span>')
            }

        }


        var dohtml =
            '<td colspan=0><span readonly="readonly" class="docell" id="do' + row_id +
            '"style="pointer-events:none;" type="text" name="do">' + dobox
            .join("/") +
            '</span></td>';


        var withthml = '<td class="withcell" colspan=1>' + withbox.join(" + ") + '</td>';
        var howbox = document.getElementById("how").value;
        var howhtml = '<td colspan=2><span readonly="readonly" class="howcell" id="how' + row_id +
            '" name="how" style="pointer-events:none;" type="text">' + howbox + '</span></td>';

        var importantbox = document.getElementById("Important").value;
        var importhtml =
            '<td colspan=3 class="importantcell"><span readonly="readonly" class="importantcell" id="important' +
            row_id +
            '" name="important" style="pointer-events:none;" type="text">' + importantbox + '</span></td>';
        row.innerHTML = '<tr>' + dohtml + withthml + howhtml + importhtml +
            '<td colspan=4><input id="' + row_id + //Edit Button
            '" value="Edit" class="editbtn" onclick="return onEdit(this)" ; type="button" /></td>' + //Edit Button
            '<td colspan=5><input id="' + row_id + //Save Button
            '" value="Delete" onclick="return onDelete(this)" ; class="deletebtn" type="button" /></td>' + //Save Button
            '</tr>';
        row.setAttribute("groupname", selectedvalue);
        if (setstatus != 0) {
            insertAfter(placingheader, row)

        }


        row_id++;
    }

    function Makeit() {
        var allitem = document.getElementsByClassName("ingredient")
        var allperep = document.getElementsByClassName("perep");
        var savingmiseit = [];
        for (let i = 0; i < allperep.length; i++) {

            var text = "miseit:" + allitem[i].name + ":" + allitem[i].value + ":" + allperep[i].value;
            savingmiseit.push(text)
        }
        localStorage.setItem("miseit", savingmiseit);

        document.getElementById("all").innerHTML = '<iframe name = "makeit" id="makeit"  src = "makeit" />'
    }

    function onEdit(btn) {
        var id = btn.id;
        if (btn.value == "Edit") {


            btn.style.background = " #88a28e";
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

    function insertAfter(referenceNode, newNode) {
        referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
    }
    </script>
    <script>
    $(".js-select2").select2({
        closeOnSelect: true,
        placeholder: "Do",
        // allowHtml: true,
        allowClear: false,
        tags: true

    });
    $(".js-select2with").select2({
        closeOnSelect: true,
        placeholder: "With",
        allowHtml: true,
        allowClear: false,
        tags: true

    });
    </script>
</body>

</html>
<style>
.btn-add {
    border: solid black 1px;
    background: #88a28e;
    font-size: 29px;
    width: 57px;
    cursor: pointer;
    color: white;

    margin-top: 0%;
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
    background: #88a28e;
}

th,
td {
    border: 0.5px solid black;
    height: 41px;

}

table {
    border-collapse: collapse;
    width: 953px;
}

input {
    font-family: Calibri;
}

.edit {
    width: 37px;
    text-align: center;
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
    width: 20px;
    text-align: center;
}

.editbtn {
    width: 100%;
    height: 100%;
    cursor: pointer;
    background: #88a28e;
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
    background: #88a28e;
    border: none;
    color: white;
    cursor: pointer;
}


.deletebtn:active {
    background: #2c3240;
    color: #ffffffb8;
}

/***************Table******************/

.itemgroup {
    text-align: center;
    pointer-events: none;
    background-color: #C5E0B3;
    font-weight: bolder;
    color: black;
}

.headergroup {
    text-align: left;
    pointer-events: none;
    background-color: #D9D9D9;
    font-weight: bolder;
    color: black;
}

.do {
    width: 150px;
}

.with {
    width: 150px;
}


.how {
    width: 226px;
}



/***************** Cell******************/


.withcell {
    text-align: center;
}

.importantcell {
    text-align: center;
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
    pointer-events: none;
    border: 0;
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


body {
    /* 	font-family: 'Ubuntu', sans-serif; */
    font-weight: bold;
}

/***************Multi Select***********/
.select2-container {
    min-width: 235px;
}

.select2-results__option {
    padding-right: 20px;
    vertical-align: middle;
}

.select2-results__option:before {
    content: "";
    display: inline-block;
    position: relative;
    height: 20px;
    width: 20px;
    border: 2px solid #e9e9e9;
    border-radius: 4px;
    background-color: #fff;
    margin-right: 20px;
    vertical-align: middle;
}

.select2-results__option[aria-selected=true]:before {
    font-family: fontAwesome;
    content: "\f00c";
    color: #fff;
    background-color: #f77750;
    border: 0;
    display: inline-block;
    padding-left: 3px;
}

.select2-container--default .select2-results__option[aria-selected=true] {
    background-color: #fff;
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: #eaeaeb;
    color: #272727;
}

.select2-container--default .select2-selection--multiple {
    margin-bottom: 10px;
}

.select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
    border-radius: 4px;
}

.select2-container--default.select2-container--focus .select2-selection--multiple {
    border-color: #f77750;
    border-width: 2px;
}

.select2-container--default .select2-selection--multiple {
    border-width: 2px;
}

.select2-container--open .select2-dropdown--below {

    border-radius: 6px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);

}

.select2-selection .select2-selection--multiple:after {
    content: 'hhghgh';
}

/* select with icons badges single*/
.select-icon .select2-selection__placeholder .badge {
    display: none;
}

.select-icon .placeholder {
    /* 	display: none; */
}

.select2-container--default .select2-selection--multiple .select2-selection__rendered {
    box-sizing: border-box;
    list-style: none;
    margin: 0;
    padding: 0 5px;
    width: 100%;
    min-height: 94%;
}

.select-icon .select2-results__option:before,
.select-icon .select2-results__option[aria-selected=true]:before {
    display: none !important;
    /* content: "" !important; */
}

.select-icon .select2-search--dropdown {
    display: none;
}

input.select2-search__field {
    width: 100px !important;
}

.select2-container--default .select2-search--inline .select2-search__field {
    background: transparent;
    border: none;
    outline: 0;
    box-shadow: none;
    -webkit-appearance: textfield;
    font-family: Calibri;
}

textarea {
    font-family: Calibri;
    height: 100%;
}
</style>