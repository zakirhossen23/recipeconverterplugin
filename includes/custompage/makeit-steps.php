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
        // allowHtml: true,
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


body {
    /* 	font-family: 'Ubuntu', sans-serif; */
    font-weight: bold;
}

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