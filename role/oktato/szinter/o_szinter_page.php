<?php
session_start();
include_once('../../../functions/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fórum</title>
    <link rel="stylesheet" href="../../../style/egesz.css"/>
</head>
<body>
<div class="page">
    <div class="pageHeader">
        <img src="../../../style/kep.jpg" alt="Neptunusz" width="950" height="300">
        <div>
            <?php include_once('../../../nav/nav_bar.php');?>
        </div>
        <div class="pageContent">
<div class="szinter">
    <?php
    $select = 'SELECT ADATB."Kurzus".KURZUS_NEV, ADATB."Kurzus".KURZUS_ID
                   FROM ADATB."Kurzus",ADATB."Oktato",ADATB."Kuzus_Oktato"
                   WHERE ADATB."Oktato".OKTATO_ID = ADATB."Kuzus_Oktato"."ko_Oktato_id" AND ADATB."Kurzus".KURZUS_ID = ADATB."Kuzus_Oktato"."ko_Kurzus_id"
                   AND ADATB."Oktato".OKTATO_ID LIKE '.$_SESSION["felhasznalo"]["id"];
    $params = lekerdez($select);

    echo '<div id="alcim">Kurzusfórumok:</div>';
    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo '<a href="o_kurzus_szinter.php?id='.urlencode($record['KURZUS_ID']).'&name='.urlencode($record['KURZUS_NEV']).'">'.$record['KURZUS_NEV'].'</a>';
    }
    close($params[0], $params[1]);
    ?>


</div>
        </div>
    </div>
</div>
</body>
</html>

