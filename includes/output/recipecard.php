<html>

<head>
    <div class="header">
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
        <table style="width:100%">
            <tbody>
                <tr>
                    <th> SHOP IT!</th>
                    <th> MISE IT!</th>
                    <th> MAKE IT!</th>
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
                                <tr class="miseittr">
                                    <th colspan="2" class="itemgroup">bvnvbn</th>
                                    <td colspan="1" style="text-align:center;">
                                        <div class="numbers">1</div>
                                    </td>
                                </tr>
                                <tr class="miseittr">
                                    <td class="cell"><span readonly="readonly" class="ingredient" groupname="bvnvbn" id="ingredient1" name="0">sdfsd</span></td>
                                    <td class="cell" colspan="2"><span readonly="readonly" class="perep" id="perep1" name="0">sdf</span></td>
                                </tr>
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
                                <tr id="startheader">
                                    <td colspan="0" class="makeititemgroup do">DO</td>
                                    <td colspan="1" class="makeititemgroup with">WITH</td>
                                    <td colspan="2" class="makeititemgroup how">HOW</td>
                                    <td colspan="3" class="makeititemgroup important">IMPORTANT</td>
                                </tr>
                                <tr groupname="yrtyrt">
                                    <td colspan="5" header="yrtyrt" headerid="0" class="headergroup">yrtyrt</td>
                                </tr>
                                <tr groupname="yrtyrt">
                                    <td class="maindocell" colspan="0"><span readonly="readonly" class="docell" id="do1" style="pointer-events:none;" type="text" name="do">Form/Heat</span></td>
                                    <td class="withcell" colspan="1"><span name="withvalue1">try</span></td>
                                    <td colspan="2" class="howmaincell"><span readonly="readonly" class="howcell" id="how1" name="how" style="pointer-events:none;" type="text">rtyrty</span>
                                    </td>
                                    <td colspan="3" class="importantmaincell"><span readonly="readonly" class="importantcell" id="important1" name="important" style="pointer-events:none;" type="text">rt</span></td>
                                </tr>
                            </tbody>
                        </table>

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
            var trelement = '<tr class = "shopittr" tablefor="shopit" groupnameshopit="' + groupname +
                '"><td>' + ingredientname + '</td><td class="shopitradio">' + radioelement + '</td></tr>'
            var allgrouptr = $('[groupnameshopit="' + groupname + '"]');
            $(trelement).insertAfter(allgrouptr[allgrouptr.length - 1]);
        }


        // Mise It! ******************************************************************************************
        //***************************** Mise It! Item Name ******************************
        var item = localStorage.getItem("items");
        allitemcode = JSON.parse(item);
        for (let i = 0; i < allitemcode.length; i++) {
            var trelement = '<tr class = "miseittr" tablefor="miseit" groupnamesmiseit="' + allitemcode[i] +
                '"><th colspan="2" class="itemgroup">' + allitemcode[i] + '</th> <td colspan="1" style="text-align:center;"> <div class="numbers">' + (i + 1) + '</div></td></tr>'
            var allmiseitttr = $('[tablefor="miseit"]');
            $(trelement).insertAfter(allmiseitttr[allmiseitttr.length - 1]);
        }
        //***************************** Mise It! ingredients ******************************
        var all = JSON.parse(localStorage.getItem("miseit"));
        for (let i = 0; i < all.length; i++) {
            var ingredientname = JSON.parse(all[i]).ingredient;
            var groupname = JSON.parse(all[i]).groupname;
            var prepname = JSON.parse(all[i]).prep;

            var trelement = '<tr class = "miseittr" tablefor="miseit" groupnamemiseit="' + groupname +
                '"><td class="cell"><span  class="ingredient"  >' + ingredientname + '</span></td><td class="cell" colspan="2"><span class="perep">' + prepname + '</span></td></tr>';
            var allgrouptr = $('[groupnamesmiseit="' + groupname + '"]');
            $(trelement).insertAfter(allgrouptr[allgrouptr.length - 1]);
        }



    };
</script>

</html>




<style>
    .tdheader {
        color: blue;
        font-style: italic;
    }

    img {
        width: 20%;
    }

    .border1 {
        height: 1px;
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


    .shopittr th,
    .shopittr td {
        border: 0.5px solid black;
        height: 30px;
        font-family: Calibri !important;
        font-size: 15px;

    }

    .shopittr td {
        padding-left: 8px;
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
        padding-left: 8px;
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

    /********** Make it ************/
    .makeit {
        width: 405px;
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
        padding-left: 10px;
        font-size: 15px;
    }

    .makeit th,
    .makeit td {
        font-family: Calibri !important;
        border: 0.5px solid black;
        height: 30px;
        font-size: 15px;
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

    .docell {
        font-family: Calibri !important;
        padding-left: 10px;
        font-size: 15px;
    }

    .withcell {
        font-family: Calibri !important;
        text-align: center;
        min-width: 133px;
        max-width: 175px;
        font-size: 15px;
    }

    .howcell {
        font-family: Calibri !important;
        padding-left: 10px;
        font-size: 15px;
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
        font-size: 15px;
    }

    .importantmaincell {
        font-family: Calibri !important;
        text-align: center;
        min-width: 97px;
        max-width: 97px;
        font-size: 15px;
    }

    .hiddenrow {

        opacity: 0 !important;
        margin: 0px !important;
        height: 0 !important;
        border: 0 !important;

    }
</style>