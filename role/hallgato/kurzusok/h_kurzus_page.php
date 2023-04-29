<?php
session_start();
include_once('../../../functions/functions.php');
include_once('../../../nav/nav_bar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kurzusaim</title>
    <link rel="stylesheet" href="/etr/style/menu.css"/>
    <link rel="stylesheet" href="h_kurzus_style.css">
</head>
<body>

<div class="adatok">
    <?php
    $select = 'SELECT ADATB."Kurzus".KURZUS_NEV, ADATB."Kurzus".KURZUS_KOD, ADATB."Kurzus".AJANLOTT_FELEV, ADATB."Kurzus".KREDIT, ADATB."Kurzus".KURZUS_ID, ADATB."Hallgato".NEPTUN_KOD
               FROM ADATB."Kurzus",ADATB."Hallgato",ADATB."Hallgato_Kurzus"
               WHERE ADATB."Hallgato".HALLGATO_ID = ADATB."Hallgato_Kurzus"."hk_Hallgato_id" AND
               ADATB."Kurzus".KURZUS_ID = ADATB."Hallgato_Kurzus"."hk_Kurzus_id"';

    $params = lekerdez($select);
    echo '<div id="alcim">Kurzusok</div>';
    echo '<table> <tr> <th >Kurzus neve</th> <th>Kódja</th> <th>Ajánlott félév</th> <th>Kredit</th> <th></th> </tr>';
    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        if( $_SESSION['felhasznalo']['neptun'] === $record['NEPTUN_KOD']){
            echo sprintf('<tr><td>%s</td><td>%s</td><td>%d</td><td>%d</td>
                            <td>
                                <form action="h_selected_kurzus.php" method="POST">
                                <input type="hidden" name="kurzus_kod" value="' .$record['KURZUS_KOD'].'">
                                <input type="hidden" name="kurzus_nev" value="'.$record['KURZUS_NEV']. '">
                                <input class="button" type="submit" value="Részletek">
                                </form>
                                <form action="h_kurzus_leadas.php" method="POST">
                                <input type="hidden" name="kurzus_id" value="' .$record['KURZUS_ID'].'">
                                <input type="hidden" name="kurzus_nev" value="'.$record['KURZUS_NEV'].'">
                                <input class="button" type="submit" value="Leadás">
                                </form>
                            </td></tr>',
                $record['KURZUS_NEV'], $record['KURZUS_KOD'], $record['AJANLOTT_FELEV'], $record['KREDIT']);
        }
    }

    echo '</table>';

    close($params[0], $params[1]);
    ?>

</div>

</body>
</html>
