<?php
session_start();
include_once('../../../functions/functions.php');
include_once('../shared/hallgato_menu.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fórum</title>
    <link rel="stylesheet" href="../../../style/menu.css"/>
    <link rel="stylesheet" href="h_szinter_style.css"/>
</head>
<body>
    <div class="szinter">
        <?php
        $select = 'SELECT ADATB."Kurzus".KURZUS_NEV, ADATB."Kurzus".KURZUS_ID
                   FROM ADATB."Kurzus",ADATB."Hallgato",ADATB."Hallgato_Kurzus"
                   WHERE ADATB."Hallgato".HALLGATO_ID = ADATB."Hallgato_Kurzus"."hk_Hallgato_id" AND ADATB."Kurzus".KURZUS_ID = ADATB."Hallgato_Kurzus"."hk_Kurzus_id"
                   AND ADATB."Hallgato".HALLGATO_ID LIKE '.$_SESSION["felhasznalo"]["id"];
        $params = lekerdez($select);

        echo '<div id="alcim">Kurzusfórumok:</div>';
        while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
                echo '<div><a href="h_kurzus_szinter.php?id='.urlencode($record['KURZUS_ID']).'&name='.urlencode($record['KURZUS_NEV']).'">'.$record['KURZUS_NEV'].'</a></div>';
        }
        close($params[0], $params[1]);
        ?>


    </div>

</body>
</html>

