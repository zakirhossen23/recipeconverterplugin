<html>

<head>
    <div class="header" style="margin: 0 30px;">
        <div style="display: flex;"><img src="https://miseitmakeit.ca/wp-content/uploads/2021/11/cropped-Shop-It-Mise-It-Make-It-Extra-Large-scaled-1.jpg">
            <div style="vertical-align: middle;padding-top: 26px;text-align: center;width: 58%;">
                <h1 id="recipename">Recipe name</h1>
            </div>
        </div>
        <div class="border1"></div>
        <table style="width:100%">
            <tbody>
                <tr>
                    <td id="source" class="tdheader">Recipe Source: </td>
                    <td id="serves" class="tdheader">Serves: </td>
                    <td id="effort" class="tdheader">Effort:</td>
                </tr>
            </tbody>
        </table>
        <div class="border0"></div>
    </div>
</head>

<body>
    <div id="all">
        <table style="width:100%;border-spacing: 30px 0;">
            <tbody>
                <tr>
                    <th>
                        <div class="shophead">
                            <img class="shopheadimg" src="https://miseitmakeit.ca/wp-content/uploads/2021/11/shopit-icon.png" />
                            <p class="shopheadheadtext">SHOP IT!</p>
                        </div>

                    </th>
                    <th>
                        <div class="misehead">
                            <img class="miseheadimg" src="https://miseitmakeit.ca/wp-content/uploads/2021/11/mise-it-icon.jpg" />
                            <p class="miseheadheadtext">MISE IT!</p>
                        </div>
                    </th>
                    <th>
                        <div class="makehead">
                            <img class="makeheadimg" src="https://miseitmakeit.ca/wp-content/uploads/2021/11/makeit-icon.jpg" />
                            <p class="makeheadheadtext">MAKE IT!</p>
                        </div>
                    </th>
                </tr>
                <tr>
                    <!--    main td  Shop it-->
                    <td class="Shopittable">
                        <!--    inside shop it td -->
                        <table id="Item-table" style="width: 100%;border-collapse: collapse;font-family: Calibri !important;font-size: 15px;">
                            <tbody class="shopitbody" style="width: 100%;">
                                <tr tablefor="shopit">
                                    <th class="hiddenrow"></th>
                                </tr>

                            </tbody>
                        </table>
                    </td>
                    <!--    main td  mise it-->
                    <td class="miseittable">
                        <!--    inside td Mise it-->
                        <table id="Item-table" style="width: 100%;border-collapse: collapse;font-family: Calibri !important;font-size: 15px;">
                            <tbody class="miseitbody">
                                <!--  hidden-->
                                <tr tablefor="miseit">

                                    <th colspan="0"></th>
                                    <td colspan="1" style="text-align:center;">
                                        <div style="width: 92px;"></div>
                                    </td>
                                    <td colspan="1" style="text-align:center;">
                                        <div></div>
                                    </td>
                                </tr>
                                <!--  Visible-->

                            </tbody>
                        </table>

                    </td>
                    <!--    main td  make it-->
                    <td class="makeit">
                        <!--    inside td Make it-->
                        <table id="Item-table" class="makeittable">
                            <tbody>
                                <tr class="hiddenrow">
                                    <td class="hiddenrow"></td>
                                </tr>
                                <tr tablefor="makeit" id="startheader">
                                    <td colspan="0" class="makeititemgroup do">DO</td>
                                    <td colspan="1" class="makeititemgroup with">WITH</td>
                                    <td colspan="2" class="makeititemgroup how">HOW</td>
                                    <td colspan="3" class="makeititemgroup important">IMPORTANT</td>
                                </tr>
                                <tr tablefor="makeit" groupnamemakeit=""></tr>
                            </tbody>
                        </table>
                        <div class="makeittools">TOOLS AND TECHNIQUES REQUIRED</div>
                        <span id="toolstechniques"></span>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>


</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    startup();

    function startup() {
        //*********************************** Top header ***********************************
        document.getElementById("source").innerHTML = "Recipe Source: " + localStorage.getItem("recipesource");
        document.getElementById("serves").innerHTML = "Serves: " + localStorage.getItem("serves");
        document.getElementById("effort").innerHTML = "Effort: " + localStorage.getItem("effort");
        document.getElementById("recipename").innerHTML = localStorage.getItem("recipename");

        // Shop It! ******************************************************************************************
        //***************************** Shop It! Group Name ******************************
        var aisles = JSON.parse(localStorage.getItem("aisles"));
        for (let i = 0; i < aisles.length; i++) {
            var trelement = '<tr class = "shopittr" tablefor="shopit" groupnameshopit="' + aisles[i] +
                '"><th colspan="2" class="aislegroup">' + aisles[i] + '</th></tr>'
            var allshopittr = $('[tablefor="shopit"]');
            $(trelement).insertAfter(allshopittr[allshopittr.length - 1]);
        }
        //***************************** Shop It! ingredients ******************************
        var all = JSON.parse(localStorage.getItem("shopit"));
        for (let i = 0; i < all.length; i++) {
            var ingredientname = JSON.parse(all[i]).ingredient;
            var groupname = JSON.parse(all[i]).groupname;
            var radiochecked = JSON.parse(all[i]).radiochecked;
            var checkedstatus = "";
            if (radiochecked == true) {
                checkedstatus = "checked";
            }
            var radioelement = '<input class="overbuybtn" type="radio" style="pointer-events: none;" ' + checkedstatus + '>';
            var trelement = '<tr class = "shopittr ingredientcell" tablefor="shopit" groupnameshopit="' + groupname +
                '"><td class="ingredientcell"><span>' + ingredientname + '</span></td><td class="shopitradio">' + radioelement + '</td></tr>'
            var allgrouptr = $('[groupnameshopit="' + groupname + '"]');
            $(trelement).insertAfter(allgrouptr[allgrouptr.length - 1]);
        }


        // Mise It! ******************************************************************************************
        //***************************** Mise It! Item Name ******************************
        var item = localStorage.getItem("items");
        allitemcode = JSON.parse(item);
        for (let i = 0; i < allitemcode.length; i++) {
            var trelement = '<tr class = "miseittr" tablefor="miseit" groupnamesmiseit="' + allitemcode[i] +
                '" groupmiseitid="' + i + '"><th colspan="2" class="itemgroup">' + allitemcode[i] + '</th> <td class="itemgroup" colspan="1"  style="text-align:center;"> <div class="numbers">' + (i + 1) + '</div></td></tr>'
            var allmiseitttr = $('[tablefor="miseit"]');
            $(trelement).insertAfter(allmiseitttr[allmiseitttr.length - 1]);
        }
        //***************************** Mise It! ingredients ******************************
        var all = JSON.parse(localStorage.getItem("miseit"));
        for (let i = 0; i < all.length; i++) {
            var groupid = JSON.parse(all[i]).id;
            var ingredientname = JSON.parse(all[i]).ingredient;
            var groupname = JSON.parse(all[i]).groupname;
            var prepname = JSON.parse(all[i]).prep;

            var trelement = '<tr class = "miseittr" tablefor="miseit" groupnamemiseit="' + groupname +
                '"><td class="cell"><span  class="ingredient"  >' + ingredientname + '</span></td><td class="cell" colspan="2"><span class="perep">' + prepname + '</span></td></tr>';
            var allgrouptr = $('[groupmiseitid="' + groupid + '"]');
            $(trelement).insertAfter(allgrouptr[allgrouptr.length - 1]);
        }

        // Make It! ******************************************************************************************
        //***************************** Make It! Tools and Techniques ******************************
        var item = localStorage.getItem("tools");
        document.getElementById("toolstechniques").innerHTML = item;


        //***************************** Make It! Steps Groups ******************************
        var all = JSON.parse(localStorage.getItem("makeitgroup"));

        for (let i = 0; i < all.length; i++) {
            var groupname = JSON.parse(all[i]);
            if (groupname != "") {
                var groupelement = '<tr groupnamemakeit="' + groupname + '" tablefor="makeit" "> <td colspan = "5"class = "headergroup"> ' + groupname + ' </td> </tr>'
                var trelement = $('[tablefor="makeit"]');
                $(groupelement).insertAfter(trelement[trelement.length - 1]);
            }

        }

        //***************************** Make It! Steps  ******************************
        var all = JSON.parse(localStorage.getItem("makeit"));

        for (let i = 0; i < all.length; i++) {
            var groupname = JSON.parse(all[i]).groupname;
            var dotext = JSON.parse(all[i]).do;
            var withtext = JSON.parse(all[i]).with;
            var howtext = JSON.parse(all[i]).how;
            var importanttext = JSON.parse(all[i]).important;

            var trelement = '<tr  groupnamemakeit="' + groupname + '" tablefor="makeit" ><td class="maindocell" colspan="0"><span class="docell" >' + dotext + '</span></td> <td class="withcell" colspan="1"><span>' + withtext + '</span></td><td colspan="2" class="howmaincell"><span class="howcell" >' +
                howtext + '</span></td><td colspan="3" class="importantmaincell"><span class="importantcell" >' + importanttext + '</span></td></tr>';
            if (groupname == "") {
                var allspace = $('[groupnamemakeit=""]')
                $(trelement).insertAfter(allspace[allspace.length - 1]);
            } else {
                var allgrouptr = $('[groupnamemakeit="' + groupname + '"]');
                $(trelement).insertAfter(allgrouptr[allgrouptr.length - 1]);
            }

        }



    };
</script>

</html>




<style>
    .tdheader {
        color: blue;
    font-style: italic;
    padding: 8px 9px;
    font-size: revert;
    }

    img {
        width: 20%;
    }

    .border1 {
        height: 0px;
    border: 1px solid;
    border-left: 0;
    border-right: 0;
    }

    .border0 {
        height: 0px;
        border: 1px solid;
        border-left: 0;
        border-right: 0;
    }

    /****************** Below Header *****************/
    /****************** Shopit ******************/
    .Shopittable {
        width: 254px;
        height: 100%;
        vertical-align: top;
    }

    .ingredientcell {
        max-width: 221px;
    }

    td.shopitradio {
        width: 25px;
        padding-left: 0 !important;
        padding-right: 0 !important;
        text-align: center;
    }

    .shopittr th,
    .shopittr td {
        border: 0.5px solid black;
        height: 30px;
        font-family: Calibri !important;
        font-size: 15px;

    }

    .shopittr td {
        padding-left: 6px;
        padding-right: 6px;
    }

    .aislegroup {
        background-color: #ffe69a;
    }

    .shopitradio {
        width: 73px;
    }

    /******************Mise it ******************/
    .miseittable {
        width: 296px;
        height: 100%;
        vertical-align: top;
    }

    td.cell {
        width: 100%;
    }

    .miseitbody {
        width: 100%;
    }

    .miseittr th,
    .miseittr td {
        border: 0.5px solid black;
        height: 30px;
        font-family: Calibri !important;
        font-size: 15px;
    }

    .miseittr td {
        padding-left: 6px;
        padding-right: 6px;
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
        width: 28px;
        align-items: center;
        text-align: center;
        font-size: 22px;
        font-family: calibri;
        display: inline-table;
    }

    /********** Make it ************/
    .makeit {
        width: 40%;
        height: 100%;
        vertical-align: top;
    }

    .makeittable {
        width: 100%;
        border-collapse: collapse;
        font-family: Calibri !important;
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

    .makeititemgroup {
        font-family: Calibri !important;
        text-align: center;
        pointer-events: none;
        background-color: #C5E0B3;
        font-weight: bolder;
        color: black;
        font-size: 15px;
    }

    td.makeititemgroup,
    th.makeititemgroup {
        border: 0.5px solid black;
    }

    .headergroup {
        font-family: Calibri !important;
        text-align: left;
        pointer-events: none;
        background-color: #D9D9D9;
        font-weight: bolder;
        color: black;
        padding-left: 6px;
        padding-right: 6px;
        font-size: 15px;
    }

    .makeit th,
    .makeit td {
        font-family: Calibri !important;
        border: 0.5px solid black;
        height: 30px;
        font-size: 15px;
        max-width: 130px;
        padding-left: 6px;
        padding-right: 6px;
        min-width: 130px;
    }

    .makeititemgroup.do {
        font-family: Calibri !important;
        width: 150px;
        font-size: 15px;
    }

    .makeititemgroup.with {
        font-family: Calibri !important;
        width: 150px;
        font-size: 15px;
    }

    .makeititemgroup .how {
        font-family: Calibri !important;
        width: 226px;
        font-size: 15px;
    }

    .makeittools {
        text-align: center;
        background: #E2EFD9;
        margin-top: 16px;
        border-top: 2.5px solid black;
        font-family: calibri;
        font-size: 15px;
    }

    .docell {
        font-family: Calibri !important;
        font-size: 15px;
        overflow-wrap: break-word;
    }

    .withcell {
        font-family: Calibri !important;
        text-align: center;
        min-width: 133px;
        max-width: 175px;
        font-size: 15px;
        overflow-wrap: break-word;
    }

    .howcell {
        font-family: Calibri !important;

        font-size: 15px;
        overflow-wrap: break-word;
    }

    .makeititemgroup.how {
        max-width: 300px !IMPORTANT;
        min-width: 300px !important;
    }

    .howmaincell {
        font-family: Calibri !important;
        max-width: 225px;
        min-width: 225px;
        font-size: 15px;
    }

    .importantcell {
        font-family: Calibri !important;
        text-align: center;
        min-width: 97px;
        max-width: 97px;
        overflow-wrap: break-word;
        font-size: 15px;
    }

    .importantmaincell {
        font-family: Calibri !important;
        text-align: center;
        min-width: 97px;
        max-width: 97px;
        font-size: 15px;
    }

    .makeititemgroup.important {}

    .hiddenrow {
        opacity: 0 !important;
        margin: 0px !important;
        height: 0 !important;
        border: 0 !important;
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
        overflow-wrap: break-word;
    }

    th {
        font-family: Calibri;
    }

    /**************************************************** SHOP HEADER ***************************************/
    .shophead {
        color: #cdba81;
        justify-content: center;
        display: flex;
        height: auto;
    }

    .shopheadimg {
        width: auto;
        align-self: center;
    }

    .shopheadheadtext {
        font-size: 48px;
        margin: 0;
        align-self: center;
    }

    /**************************************************** Mise IT HEADER ***************************************/
    .misehead {
        color: #64647e;
        justify-content: center;
        display: flex;
        height: auto;
    }

    .miseheadimg {
        width: auto;
        align-self: center;
    }

    .miseheadheadtext {
        font-size: 48px;
        margin: 0;
        align-self: center;
    }

    /**************************************************** MAKE IT HEADER ***************************************/
    .makehead {
        color: #899f90;
        justify-content: center;
        display: flex;
        height: auto;
    }

    .makeheadimg {
        width: auto;
        align-self: center;
    }

    .makeheadheadtext {
        font-size: 48px;
        margin: 0;
        align-self: center;
    }
</style>