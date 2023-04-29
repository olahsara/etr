<?php
session_start();
include_once('../../../functions/functions.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adatok</title>
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

<div class="adatok">
    <?php
    $select = 'SELECT ADATB."Hallgato".HALLGATO_NEV, ADATB."Hallgato".NEPTUN_KOD, ADATB."Hallgato".FELEV,
               ADATB."Szak".SZAK_NEV, ADATB."Szak".SZAK_KOD,
               ADATB."Kar".KAR_NEV, ADATB."Kar".KAR_KOD
               FROM ADATB."Hallgato",ADATB."Szak_Kar",ADATB."Szak", ADATB."Kar", ADATB."Hallgato_Szak"
               WHERE "Hallgato".HALLGATO_ID = "Hallgato_Szak"."hs_Hallgato_id" AND "Hallgato_Szak"."hs_Szak_id"="Szak".SZAK_ID
               AND "Kar".KAR_ID = "Szak_Kar"."sk_Kar_id" AND "Szak_Kar"."sk_Szak_id" = "Szak".SZAK_ID
               AND ADATB."Hallgato".HALLGATO_ID LIKE '.$_SESSION["felhasznalo"]["id"];
    $params = lekerdez($select);
    echo '<h1>Hallgató adatai</h1>';
    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo sprintf('<div><b>Hallgató neve:</b> %s</div>
                             <div><b>Hallgató neptun kódja:</b> %s</div>
                             <div><b>Kar:</b> %s (%s)</div>
                             <div><b>Szak:</b> %s (%s)</div>
                             <div><b>Félév:</b> %d</div>'
            , $record['HALLGATO_NEV'], $record['NEPTUN_KOD'], $record['KAR_NEV'], $record['KAR_KOD']
            , $record['SZAK_NEV'], $record['SZAK_KOD'], $record['FELEV']);
    }
    close($params[0], $params[1]);

    $atlag = 'SELECT SUM(ADATB."Hallgato_Kurzus"."Erdem_jegy") AS "jegy", COUNT(ADATB."Hallgato_Kurzus"."Erdem_jegy") AS "db"
              FROM ADATB."Hallgato_Kurzus", ADATB."Hallgato", ADATB."Kurzus"
              WHERE ADATB."Hallgato".HALLGATO_ID = ADATB."Hallgato_Kurzus"."hk_Hallgato_id"
              AND ADATB."Hallgato_Kurzus"."hk_Kurzus_id" = ADATB."Kurzus".KURZUS_ID 
              AND ADATB."Hallgato".HALLGATO_ID LIKE ' .$_SESSION["felhasznalo"]["id"];
    $params = lekerdez($atlag);
    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        $eredmeny = (float) $record['jegy']/$record['db'];
        echo sprintf('<div><b>Átlag:</b> %01.3f</div>', $eredmeny);
    }
    close($params[0], $params[1]);

    //sulyozott atlag = erdemjegy_1*kredit_1+...+erdemjegy_n*kredit_n / kredit_1+...+kredit_n
    $sum_kredit = 0;
    $szamlalo = 0;
    $s_eredmeny =0;

    $sulyozott_atlag = 'SELECT ADATB."Hallgato_Kurzus"."Erdem_jegy", ADATB."Kurzus".KREDIT
              FROM ADATB."Hallgato_Kurzus", ADATB."Hallgato", ADATB."Kurzus"
              WHERE ADATB."Hallgato".HALLGATO_ID = ADATB."Hallgato_Kurzus"."hk_Hallgato_id"
              AND ADATB."Hallgato_Kurzus"."hk_Kurzus_id" = ADATB."Kurzus".KURZUS_ID 
              AND ADATB."Hallgato".HALLGATO_ID LIKE ' .$_SESSION["felhasznalo"]["id"]. '
              AND ADATB."Hallgato_Kurzus"."Erdem_jegy" IS NOT NULL ';
    $params = lekerdez($sulyozott_atlag);

    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        $sum_kredit += $record["KREDIT"];
        $szamlalo += $record["Erdem_jegy"] * $record["KREDIT"];
    }
    $s_eredmeny = (float) $szamlalo / $sum_kredit;
    echo sprintf('<div><b>Súlyozott átlag:</b> %01.3f</div>', $s_eredmeny);
    close($params[0], $params[1]);
    ?>
    
</div>
        </div>
    </div>
</div>
</body>
</html>
