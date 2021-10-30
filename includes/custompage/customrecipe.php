<?php
get_header();
?>
<div class="no-margin">
    <h3>Let's get started! </h3>
    <input placeholder="Recipe name" />
    <input placeholder="Recipe Source" />
    <input placeholder="Serves " />
    <input placeholder="Effort " />
</div>
<h1 class="top-margin">SHOP IT!</h1>
<div class="no-margin">

    <span> Aisle Name:</span>
    <input id="aislename" placeholder="Aisle Name" />
    <button class="btn-add" onclick="onAdd()">
        +
    </button>
</div>

<table id="Aisle-table" class="no-margin">
    <tr>
        <th>Aisle</th>
        <th class="edit">Edit</th>
        <th class="delete">Delete</th>
    </tr>
</table>
<button class="nextbtn" onclick="next()">
    Next
</button>

<script>
var row_id = 1;

function onEdit(btn) {
    var id = btn.id;
    if (btn.value == "Edit") {
        document.getElementById('aisle' + id).removeAttribute("Readonly");
        document.getElementById('aisle' + id).style.border = "solid 1px";
        document.getElementById('aisle' + id).style.fontSize = "larger";
        document.getElementById(id).value = "Save";
        return false;
    }
    if (btn.value == "Save") {
        document.getElementById('aisle' + id).setAttribute("Readonly", "readonly");
        document.getElementById('aisle' + id).style.border = "none";
        document.getElementById('aisle' + id).style.fontSize = "unset";
        document.getElementById(id).value = "Edit";
        return false;
    }

}

function next() {
    alert("Thanks for fill up Aisle");
}

function onAdd() {
    var table = document.getElementById("Aisle-table");
    var row = table.insertRow(-1);
    var cell1 = row.insertCell(-1);
    var cell2 = row.insertCell(-1);
    var cell3 = row.insertCell(-1);
    cell1.innerHTML = '<input readonly="readonly" id="aisle' + row_id + '" value="' + document.getElementById(
        "aislename").value + '" type="text" />'
    cell2.innerHTML = '<input id="' + row_id + '" value="Edit" onclick="return onEdit(this)" ; type="button" />';
    cell3.innerHTML = '<input id="' + row_id + '" value="Delete" onclick="return onDelete(this)" ; type="button" />';
    document.getElementById(
        "aislename").value = "";
    row_id++;
}
</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
function onDelete(btn) {
    var row = $(btn).closest("TR");
    var name = $("TD", row).eq(0).html();

    var table = $("#Aisle-table")[0];

    table.deleteRow(row[0].rowIndex);
}
</script>
<style>
.btn-add {
    border: solid black 1px;
    height: 30px;
    width: 47px;
    padding-top: 0px;
    padding-left: 19px;
}

.nextbtn {
    float: right;
    margin-right: 1px;
}


.no-margin {
    margin: 0;
}

.top-margin {
    margin-top: 10px;
}

body {
    background: white;
}

input[type="text"] {
    border: 0;
}

input: focus: focus {
    outline: none;
}
</style>
<?php get_footer();
?>