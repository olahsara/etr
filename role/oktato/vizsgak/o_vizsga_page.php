<?php
session_start();
include_once('../../../functions/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vizsgák</title>
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
        $select = 'SELECT ADATB."Vizsga".VIZSGA_IDOPONT, ADATB."Vizsga".VIZSGA_ID, ADATB."Kurzus".KURZUS_KOD, ADATB."Kurzus".KURZUS_NEV,  ADATB."Kurzus".KURZUS_ID, ADATB."Oktato".NEPTUN_KOD
               FROM ADATB."Kurzus",ADATB."Vizsga",ADATB."Kuzus_Vizsga", ADATB."Oktato", adatb."Kuzus_Oktato"
               WHERE ADATB."Kurzus".KURZUS_ID = ADATB."Kuzus_Vizsga"."kv_Kurzus_id" AND ADATB."Vizsga".VIZSGA_ID = ADATB."Kuzus_Vizsga"."kv_Vizsga_id" 
               AND ADATB."Oktato".OKTATO_ID = ADATB."Kuzus_Oktato"."ko_Oktato_id" AND ADATB."Kuzus_Oktato"."ko_Kurzus_id" = ADATB."Kurzus".KURZUS_ID';

        $params = lekerdez($select);
        echo '<div class="alcim">Vizsgák</div>';
        echo '<table> <tr> <th >Kurzus neve</th> <th>Kódja</th> <th> Vizsga időpontja </th>  </tr>';
        $ures = true;
        while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
            if( $_SESSION["felhasznalo"]["neptun"] === $record['NEPTUN_KOD']){
                echo sprintf('<tr><td>%s</td><td>%s</td><td>%s</td>
                            <td>
                                <form action="o_selected_vizsga.php" method="POST">
                                <input type="hidden" name="vizsga-id" value="' .$record['VIZSGA_ID'].'">
                                <input class="button" type="submit" value="Vizsgára jelentkezett hallgatók">
                                </form>
                            </td></tr>',
                    $record['KURZUS_KOD'], $record['KURZUS_NEV'], $record['VIZSGA_IDOPONT']);

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


