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

        <button class="makeitbtn" onclick="recipecard()">
            Create Recipe Card
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
        row.innerHTML = '<tr id="startheader"><td colspan="0" class="itemgroup do">DO</td>' +
            '<td colspan="1" class="itemgroup with">WITH</td>' +
            '<td colspan="2" class="itemgroup how">HOW</td>' +
            '<td colspan="3" class="itemgroup important">IMPORTANT</td>' +
            '<td colspan="4" class="edit">Eidt</td>' +
            '<td colspan="5" class="delete">Delete</td>' +
            ' </tr>';
        row.id = "startheader";
        item_id++;

    }
    row_id = 1;

    function clear() {
        $("select").val('').change();
        $("#how").val('').change();
        $("#Important").val('').change();
        $("#groupname").val('').change();

    }

    function onAdd() {
        setstatus = 0; // 0 = normal at last
        var table = document.getElementById("Item-table");
        var placingheader = null;
        var selectedvalue = document.getElementById("groupname").value;
        if ($('[header="' + document.getElementById("groupname").value + '"]').length == 0 && selectedvalue != "") {
            var headerrow = table.insertRow(-1);
            headerrow.innerHTML = '<td colspan="5" header="' + document.getElementById("groupname").value +
                '" headerid="' + header_id +
                '" class="headergroup">' + document.getElementById("groupname").value +
                '</td>' + '<td colspan=6><input id="' + header_id + //Edit Button
                '" value="Edit" name="header" class="editbtn" onclick="return onEdit(this)" ; type="button" /></td>' +
                //Edit Button
                '<td colspan=7><input id="' + header_id + //Save Button
                '" value="Delete" onclick="return onDelete(this);" class="deletebtn" type="button" /></td>';
            var optionelement = document.createElement("option");
            optionelement.value = document.getElementById("groupname").value;
            headerrow.setAttribute("groupname", selectedvalue);
            optionelement.setAttribute("nameid", header_id);
            document.getElementById("grouplist").appendChild(optionelement);
            header_id++;
            placingheader = headerrow;
        } else if (selectedvalue != "") {
            placingheader = $('[groupname="' + selectedvalue + '"]')[$('[groupname="' + selectedvalue + '"]').length -
                1]
            setstatus = 1;
        } else if (selectedvalue == "") {
            setstatus = 1;
            var allinsertedinempty = $('[groupname=""]');
            if (allinsertedinempty.length != 0) {
                placingheader = allinsertedinempty[allinsertedinempty.length - 1];
            } else {
                var headerelement = document.getElementById("startheader");
                placingheader = headerelement;
            }

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
                withbox.push('<span name="withvalue' + row_id + '" class="numbers" >' + choosen[i].innerText
                    .replace(
                        "×", "") + '</span>');
            } else {
                withbox.push('<span name="withvalue' + row_id + '">' + choosen[i].innerText.replace("×", "") +
                    '</span>')
            }

        }


        var dohtml =
            '<td class="maindocell" colspan=0><span readonly="readonly" class="docell" id="do' + row_id +
            '"style="pointer-events:none;" type="text" name="do">' + dobox
            .join("/") +
            '</span></td>';


        var withthml = '<td class="withcell" colspan=1>' + withbox.join(" + ") + '</td>';
        var howbox = document.getElementById("how").value;
        var howhtml = '<td colspan=2 class="howmaincell"><span readonly="readonly" class="howcell" id="how' + row_id +
            '" name="how" style="pointer-events:none;" type="text">' + howbox + '</span></td>';

        var importantbox = document.getElementById("Important").value;
        var importhtml =
            '<td colspan=3 class="importantmaincell"><span readonly="readonly" class="importantcell" id="important' +
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
        clear();

        row_id++;
    }

    function recipecard() {
        var alldo = document.getElementsByClassName("docell")
        var allwith = document.getElementsByClassName("withcell");
        var allhow = document.getElementsByClassName("howcell");
        var allimportant = document.getElementsByClassName("importantcell");

        var savingmakeit = [];
        for (let i = 0; i < alldo.length; i++) {

            var text = "makeit:" + alldo[i].parentElement.parentElement.getAttribute("groupname") + ":" +
                alldo[i].innerText + ":" + allwith[i].innerText + ":" + allhow[i].innerText + ":" + allimportant[i]
                .innerText;
            savingmakeit.push(text)
        }
        localStorage.setItem("makeit", savingmakeit);

        document.getElementById("all").innerHTML = '<iframe name = "recipecard" id="recipecard"  src = "recipecard" />'
    }
    var editing = "";

    function onEdit(btn) {
        var id = btn.id;
        if (btn.value == "Edit" && btn.name != "header") {

            btn.style.background = " #88a28e";
            document.getElementById('do' + id).removeAttribute("Readonly");
            document.getElementById('do' + id).style.border = "solid 1px";
            document.getElementById('do' + id).style.fontSize = "larger";
            document.getElementById('do' + id).style.margin = "0px 0px 0px 10px";
            document.getElementById('do' + id).style.height = "93%";
            document.getElementById('do' + id).style.width = "95%";
            document.getElementById('do' + id).style.pointerEvents = "all";
            document.getElementById('do' + id).setAttribute("contenteditable", true);


            document.getElementById('how' + id).removeAttribute("Readonly");
            document.getElementById('how' + id).style.border = "solid 1px";
            document.getElementById('how' + id).style.fontSize = "larger";
            document.getElementById('how' + id).style.margin = "0px 0px 0px 10px";
            document.getElementById('how' + id).style.height = "93%";
            document.getElementById('how' + id).style.width = "95%";
            document.getElementById('how' + id).style.pointerEvents = "all";
            document.getElementById('how' + id).setAttribute("contenteditable", true);

            document.getElementById('important' + id).removeAttribute("Readonly");
            document.getElementById('important' + id).style.border = "solid 1px";
            document.getElementById('important' + id).style.fontSize = "larger";
            document.getElementById('important' + id).style.margin = "0px 0px 0px 10px";
            document.getElementById('important' + id).style.height = "93%";
            document.getElementById('important' + id).style.width = "95%";
            document.getElementById('important' + id).style.pointerEvents = "all";
            document.getElementById('important' + id).setAttribute("contenteditable", true);

            var allwithvalues = $('[name="withvalue' + id + '"]');
            for (let i = 0; i < allwithvalues.length; i++) {
                allwithvalues[i].removeAttribute("Readonly");
                allwithvalues[i].style.border = "2px solid lime";
                allwithvalues[i].style.fontSize = "larger";
                allwithvalues[i].style.margin = "0px 0px 0px 10px";
                allwithvalues[i].style.pointerEvents = "all";
                allwithvalues[i].setAttribute("contenteditable", true);
            }
            document.getElementById(id).value = "Save";

            return true;
        } else if (btn.value == "Edit" && btn.name == "header") {

            var headerlabel = $('[headerid="' + id + '"]')[0]
            editing = headerlabel.getAttribute("header")
            console.log(editing);
            headerlabel.removeAttribute("Readonly");
            headerlabel.style.border = "solid 1px";
            headerlabel.style.fontSize = "larger";
            headerlabel.style.margin = "0px 0px 0px 10px";
            headerlabel.style.height = "93%";
            headerlabel.style.width = "95%";
            headerlabel.style.pointerEvents = "all";
            headerlabel.setAttribute("contenteditable", true);
            btn.value = "Save";
            return true;
        }
        if (btn.value == "Save" && btn.name != "header") {
            document.getElementById(id).value = "Edit";


            document.getElementById('do' + id).setAttribute("Readonly", "readonly");
            document.getElementById('do' + id).style.border = "none";
            document.getElementById('do' + id).style.fontSize = "revert";
            document.getElementById('do' + id).style.margin = "0px 0px 0px 0px";
            document.getElementById('do' + id).style.height = "93%";
            document.getElementById('do' + id).style.width = "97%";
            document.getElementById('do' + id).style.pointerEvents = "none";
            document.getElementById('do' + id).setAttribute("contenteditable", false);


            document.getElementById('how' + id).setAttribute("Readonly", "readonly");
            document.getElementById('how' + id).style.border = "none";
            document.getElementById('how' + id).style.fontSize = "revert";
            document.getElementById('how' + id).style.margin = "0px 0px 0px 0px";
            document.getElementById('how' + id).style.height = "93%";
            document.getElementById('how' + id).style.width = "97%";
            document.getElementById('how' + id).style.pointerEvents = "none";
            document.getElementById('how' + id).setAttribute("contenteditable", false);

            document.getElementById('important' + id).setAttribute("Readonly", "readonly");
            document.getElementById('important' + id).style.border = "none";
            document.getElementById('important' + id).style.fontSize = "revert";
            document.getElementById('important' + id).style.margin = "0px 0px 0px 0px";
            document.getElementById('important' + id).style.height = "93%";
            document.getElementById('important' + id).style.width = "97%";
            document.getElementById('important' + id).style.pointerEvents = "none";
            document.getElementById('important' + id).setAttribute("contenteditable", false);

            var allwithvalues = $('[name="withvalue' + id + '"]');
            for (let i = 0; i < allwithvalues.length; i++) {
                allwithvalues[i].setAttribute("Readonly", "readonly");
                allwithvalues[i].style.border = "none";
                allwithvalues[i].style.fontSize = "";
                allwithvalues[i].style.margin = "0px 0px 0px 0px";
                allwithvalues[i].style.pointerEvents = "none";
                allwithvalues[i].setAttribute("contenteditable", false);
            }

            btn.style.background = "";
            return false;

        } else if (btn.value == "Save" && btn.name == "header") {
            var headerlabel = $('[headerid="' + id + '"]')[0]
            var allgroupheader = $('[groupname="' + editing + '"]');
            for (let i = 0; i < allgroupheader.length; i++) {
                allgroupheader[i].setAttribute("groupname", headerlabel.innerHTML)
            }

            var allheaderwithold = $('[header="' + editing + '"]');
            for (let i = 0; i < allheaderwithold.length; i++) {
                allheaderwithold[i].setAttribute("header", headerlabel.innerHTML)
            }


            headerlabel.setAttribute("Readonly", "readonly");
            headerlabel.style.border = "";
            headerlabel.style.fontSize = "revert";
            headerlabel.style.margin = "0px 0px 0px 0px";
            headerlabel.style.height = "";
            headerlabel.style.width = "";
            headerlabel.style.pointerEvents = "none";
            headerlabel.setAttribute("contenteditable", false);
            btn.style.background = "";
            btn.value = "Edit";
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
        tags: true,
        multiple: true

    });
    $(".js-select2with").select2({
        closeOnSelect: true,
        placeholder: "With",
        allowHtml: true,
        allowClear: false,
        tags: true,
        multiple: true

    });
    </script>
</body>

</html>
<style>
.btn-add {
    font-family: Calibri !important;
    border: solid black 1px;
    background: #88a28e;
    font-size: 27px;
    width: 57px;
    cursor: pointer;
    color: white;

    margin-top: 0%;
}

.btn-add:active {
    font-family: Calibri !important;
    background-color: #fffdf6;
    font-size: 15px;
}


.makeitbtn {
    font-family: Calibri !important;
    float: right;
    width: 172px;
    height: 37px;
    margin: 10px 1px 12px 0px;
    cursor: pointer;
    color: white;
    background: #88a28e;
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
    width: 966px;
    font-size: 15px;
}

input {
    font-family: Calibri !important;
    font-family: Calibri;
    font-size: 15px;
}

.edit {
    font-family: Calibri !important;
    width: 37px;
    text-align: center;
    font-size: 15px;
    background-color: #C5E0B3;
    font-weight: bolder;
}

.ingredient {
    font-family: Calibri !important;
    border: none;
    outline: none;
    pointer-events: none;
    font-size: 15px;
}

.perep {
    font-family: Calibri !important;
    border: none;
    outline: none;
    pointer-events: none;
    font-size: 15px;
}

.delete {
    font-family: Calibri !important;
    width: 20px;
    text-align: center;
    font-size: 15px;
    background-color: #C5E0B3;
    font-weight: bolder;
}

.editbtn {
    font-family: Calibri !important;
    width: 100%;
    height: 100%;
    cursor: pointer;
    background: #88a28e;
    border: none;
    color: white;
    font-size: 15px;
}

.editbtn:active {
    font-family: Calibri !important;
    background: #2e364a;
    font-size: 15px;
    color: #adadad;
}

.deletebtn {
    font-family: Calibri !important;
    width: 100%;
    height: 100%;
    background: #88a28e;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 15px;
}


.deletebtn:active {
    font-family: Calibri !important;
    background: #2c3240;
    color: #ffffffb8;
    font-size: 15px;
}

/***************Table******************/

.itemgroup {
    font-family: Calibri !important;
    text-align: center;
    pointer-events: none;
    background-color: #C5E0B3;
    font-weight: bolder;
    color: black;
    font-size: 15px;
}

.headergroup {
    font-family: Calibri !important;
    text-align: left;
    pointer-events: none;
    background-color: #D9D9D9;
    font-weight: bolder;
    color: black;
    padding-left: 10px;
    font-size: 15px;
}

.do {
    font-family: Calibri !important;
    width: 150px;
    font-size: 15px;
}

.with {
    font-family: Calibri !important;
    width: 150px;
    font-size: 15px;
}


.how {
    font-family: Calibri !important;
    width: 226px;
    font-size: 15px;
}



/***************** Cell******************/

.docell {
    font-family: Calibri !important;
    padding-left: 10px;
    font-size: 15px;
}

.maindocell {
    font-family: Calibri !important;
    min-width: 105px;
    max-width: 160px;
    font-size: 15px;
}

.howmaincell {
    font-family: Calibri !important;
    max-width: 225px;
    min-width: 225px;
    font-size: 15px;
}

.withcell {
    font-family: Calibri !important;
    text-align: center;
    min-width: 167px;
    max-width: 167px;
    font-size: 15px;
}

.howcell {
    font-family: Calibri !important;
    padding-left: 10px;
    font-size: 15px;
}

.importantcell {
    font-family: Calibri !important;
    text-align: center;
    min-width: 97px;
    max-width: 97px;
    font-size: 15px;
}

.importantmaincell {
    font-family: Calibri !important;
    text-align: center;
    min-width: 97px;
    max-width: 97px;
    font-size: 15px;
}

.numbers {
    font-family: Calibri !important;
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
    font-size: 15px;
    font-family: Calibri !important;
}

button {
    font-size: 15px;
    font-family: Calibri !important;
}

select {
    font-size: 15px;
    font-family: Calibri !important;
}


.perepbtn {
    margin-left: 34%;
    font-family: Calibri !important;
    pointer-events: none;
    font-size: 15px;
}

iframe {
    width: 100%;
    height: 100%;
    font-family: Calibri !important;
    border: none;
    font-size: 15px;
}

.miseitbtn {
    font-family: Calibri !important;
    width: 146px;
    font-size: 15px;
    padding: 8px;
    float: right;
    margin: 13px 0px 2px 3px;
    background-color: #debf54;
}


body {
    font-family: Calibri !important;
    /* font-weight: bold; */
    margin: 0px;
    font-size: 15px;
}

/***************Multi Select***********/
.select2-container {
    font-family: Calibri !important;
    min-width: 235px;
}

.select2-results__option {
    font-family: Calibri !important;
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
    resize: inherit;
}
</style>