<?php
session_start();
include_once('../../../functions/functions.php');
include_once ('../shared/hallgato_menu.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adatok</title>
    <link rel="stylesheet" href="../../../style/menu.css"/>
    <link rel="stylesheet" href="h_adatok_style.css"/>
</head>
<body>

<div class="adatok">
    <?php
    $select = 'SELECT ADATB."Hallgato".HALLGATO_NEV, ADATB."Hallgato".NEPTUN_KOD, ADATB."Hallgato".FELEV,
               ADATB."Szak".SZAK_NEV, ADATB."Szak".SZAK_KOD,
               ADATB."Kar".KAR_NEV, ADATB."Kar".KAR_KOD
               FROM ADATB."Hallgato",ADATB."Szak_Kar",ADATB."Szak", ADATB."Kar", ADATB."Hallgato_Szak"
               WHERE "Hallgato".HALLGATO_ID = "Hallgato_Szak"."hs_Hallgato_id" AND "Hallgato_Szak"."hs_Szak_id"="Szak".SZAK_ID
               AND "Kar".KAR_ID = "Szak_Kar"."sk_Kar_id" AND "Szak_Kar"."sk_Szak_id" = "Szak".SZAK_ID';
    $page = explode('/',$_SERVER['PHP_SELF']);
    end($page);
    $params = lekerdez($select);
    echo '<div id="alcim">Hallgató adatai</div>';
    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        if( $record['NEPTUN_KOD'] === $_SESSION["felhasznalo"]["neptun"]){

            echo sprintf('<div><b>Hallgató neve:</b> %s</div>
                                 <div><b>Hallgató neptun kódja:</b> %s</div>
                                 <div><b>Kar:</b> %s (%s)</div>
                                 <div><b>Szak:</b> %s (%s)</div>
                                 <div><b>Félév:</b> %d</div>'
                , $record['HALLGATO_NEV'], $record['NEPTUN_KOD'], $record['KAR_NEV'], $record['KAR_KOD']
                , $record['SZAK_NEV'], $record['SZAK_KOD'], $record['FELEV']);
            break;
        }
    }
    close($params[0], $params[1]);
    ?>

</div>

<!--TODO: átlag-->

</body>
</html>
