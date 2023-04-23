<?php
session_start();
include_once('../../../functions/functions.php');
include_once('../shared/hallgato_menu.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vizsgák</title>
    <link rel="stylesheet" href="../../../style/menu.css"/>
    <link rel="stylesheet" href="h_vizsga_style.css"/>
</head>
<body>

<div class="adatok">
    <?php
    $select = 'SELECT ADATB."Vizsga".VIZSGA_IDOPONT, ADATB."Kurzus".KURZUS_KOD, ADATB."Kurzus".KURZUS_NEV,  ADATB."Kurzus".KURZUS_ID, ADATB."Hallgato".NEPTUN_KOD
               FROM ADATB."Kurzus",ADATB."Vizsga",ADATB."Kuzus_Vizsga", ADATB."Hallgato", adatb."Hallgato_Kurzus"
               WHERE ADATB."Kurzus".KURZUS_ID = ADATB."Kuzus_Vizsga"."kv_Kurzus_id" AND ADATB."Vizsga".VIZSGA_ID = ADATB."Kuzus_Vizsga"."kv_Vizsga_id" 
               AND ADATB."Hallgato".HALLGATO_ID = ADATB."Hallgato_Kurzus"."hk_Hallgato_id" AND ADATB."Hallgato_Kurzus"."hk_Kurzus_id" = ADATB."Kurzus".KURZUS_ID';

    $params = lekerdez($select);
    echo '<div class="alcim">Vizsgák</div>';
    echo '<table> <tr> <th >Kurzus neve</th> <th>Kódja</th> <th> Vizsga időpontja </th>  </tr>';
    $ures = true;
    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        if( $_SESSION["felhasznalo"]["neptun"] === $record['NEPTUN_KOD']){
            echo sprintf('<tr><td>%s</td><td>%s</td><td>%s</td></tr>',
                $record['KURZUS_NEV'], $record['KURZUS_KOD'], sajat_date($record['VIZSGA_IDOPONT']));
                $ures = false;
        }
    }
    if ($ures){
        echo '<tr><td>Nincs vizsgád</td><td></td><td></td></tr>';
    }
    echo '</table>';

    close($params[0], $params[1]);
    ?>


</div>

</body>
</html>

