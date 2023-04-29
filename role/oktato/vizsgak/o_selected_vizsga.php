<?php
session_start();
include_once('../../../functions/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vizsga hallgatói</title>
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
        $select = 'SELECT ADATB."Vizsga".VIZSGA_ID, ADATB."Hallgato".NEPTUN_KOD, ADATB."Hallgato".HALLGATO_NEV, ADATB."Hallgato".HALLGATO_ID
               FROM ADATB."Kurzus",ADATB."Vizsga",ADATB."Kuzus_Vizsga", ADATB."Hallgato", adatb."Hallgato_Kurzus"
               WHERE ADATB."Kurzus".KURZUS_ID = ADATB."Kuzus_Vizsga"."kv_Kurzus_id" AND ADATB."Vizsga".VIZSGA_ID = ADATB."Kuzus_Vizsga"."kv_Vizsga_id" 
               AND ADATB."Hallgato".HALLGATO_ID = ADATB."Hallgato_Kurzus"."hk_Hallgato_id" AND ADATB."Hallgato_Kurzus"."hk_Kurzus_id" = ADATB."Kurzus".KURZUS_ID';

        $params = lekerdez($select);
        echo '<div class="alcim">Vizsga hallgatói</div>';
        echo '<table> <tr><th>Hallgató neve</th><th>Hallgató neptun kódja</th><th></th></tr>';
        $ures = true;
        while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        if( $_POST["vizsga-id"] === $record['VIZSGA_ID']) {
            echo sprintf('<tr><td>%s</td><td>%s</td>
                            <td>
                                <form action="o_vizsgarol_hallgatot_torol.php" method="POST">
                                <input type="hidden" name="hallgato-id" value="' .$record['HALLGATO_ID'].'">
                                <input type="hidden" name="hallgato-nev" value=' .$record['HALLGATO_NEV'].'>
                                <input type="hidden" name="vizsga-id" value="' .$record['VIZSGA_ID'].'">
                                <input class="button" type="submit" value="Hallgató törlése a vizsgáról">
                                </form>
                            </td></tr>',
                $record['HALLGATO_NEV'], $record['NEPTUN_KOD']);

        }

        }

        echo '</table>';

        close($params[0], $params[1]);
        ?>

    </div>
        </div>
    </div>
    </div>
</html>



