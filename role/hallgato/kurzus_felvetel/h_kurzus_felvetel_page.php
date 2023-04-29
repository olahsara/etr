<?php
session_start();
include_once('../../../functions/functions.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kurzusok felvétele</title>
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
    $felvett_kurzusok = array();
    $seged_select = 'SELECT ADATB."Kurzus".KURZUS_ID
                   FROM ADATB."Kurzus",ADATB."Hallgato",ADATB."Hallgato_Kurzus"
                   WHERE ADATB."Hallgato".HALLGATO_ID = ADATB."Hallgato_Kurzus"."hk_Hallgato_id"
                   AND ADATB."Kurzus".KURZUS_ID = ADATB."Hallgato_Kurzus"."hk_Kurzus_id"
                   AND ADATB."Hallgato".HALLGATO_ID LIKE '. $_SESSION["felhasznalo"]["id"];

    $seged_params = lekerdez($seged_select);

    while ($seged_record = oci_fetch_array($seged_params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        global $felvett_kurzusok;
        $felvett_kurzusok[] = $seged_record['KURZUS_ID'];
    }

    close($seged_params[0], $seged_params[1]);

    $select = 'SELECT ADATB."Kurzus".KURZUS_NEV, ADATB."Kurzus".KURZUS_KOD, ADATB."Kurzus".AJANLOTT_FELEV, ADATB."Kurzus".KREDIT, ADATB."Kurzus".KURZUS_ID
               FROM ADATB."Kurzus"
               WHERE ADATB."Kurzus".MEGNYITVA  = 1';

    $params = lekerdez($select);

    echo '<div id="alcim">Kurzusok</div>';
    echo '<table> <tr> <th >Kurzus neve</th> <th>Kódja</th> <th>Ajánlott félév</th> <th>Kredit</th> <th></th> </tr>';
    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        $felvett_e = false;
        foreach ($felvett_kurzusok as $felvett ){
            if( $felvett === $record['KURZUS_ID']){
                $felvett_e = true;
            }

        }
        if( !$felvett_e ){
            echo sprintf('<tr><td>%s</td><td>%s</td><td>%d</td><td>%d</td>
                            <td>
                                <form action="h_selected_kurzus_felvetel.php" method="POST">
                                <input type="hidden" name="kurzus_id" value=' .$record['KURZUS_ID'].'>
                                <input type="hidden" name="kurzus_nev" value='.$record['KURZUS_NEV'].'>
                                <input class="button" type="submit" value="Részletek">
                                </form>
                            </td></tr>',
                $record['KURZUS_NEV'], $record['KURZUS_KOD'], $record['AJANLOTT_FELEV'], $record['KREDIT']);
        }
    }

    echo '</table>';
    close($params[0], $params[1]);
    ?>

</div>
        </div>
    </div>
</div>
</body>
</html>

