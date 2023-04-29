<?php
session_start();
include_once('../../../functions/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kurzusaim</title>
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
    $select = 'SELECT ADATB."Oktato".NEPTUN_KOD, ADATB."Kurzus".KURZUS_KOD, ADATB."Kurzus".KURZUS_NEV, ADATB."Kurzus".KURZUS_ID
               FROM ADATB."Kurzus",ADATB."Oktato", ADATB."Kuzus_Oktato"
               WHERE ADATB."Oktato".OKTATO_ID = ADATB."Kuzus_Oktato"."ko_Oktato_id" AND ADATB."Kuzus_Oktato"."ko_Kurzus_id" = ADATB."Kurzus".KURZUS_ID';

    $params = lekerdez($select);
    echo '<h1>Kurzusaim</h1>';
    echo '<table> <tr> <th >Kurzus neve</th> <th>Kurzus kódja</th><th></th> </tr>';
    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        if( $_SESSION['felhasznalo']['neptun'] === $record['NEPTUN_KOD']){
            echo sprintf('<tr><td>%s</td><td>%s</td>
                            <td>
                                <form action="o_selected_kurzus.php" method="POST">
                                <input type="hidden" name="kurzus_kod" value="' .$record['KURZUS_KOD'].'">
                                <input type="hidden" name="kurzus_nev" value="'.$record['KURZUS_NEV']. '">
                                <input type="hidden" name="kurzus_id" value="'.$record['KURZUS_ID']. '">
                                <input class="button" type="submit" value="Részletek">
                                </form>
                            </td></tr>',
                $record['KURZUS_NEV'], $record['KURZUS_KOD']);
        }
    }

    echo '</table>';

    // Lekérdezés végrehajtása és eredmények tárolása
    $select2 = 'SELECT ADATB."Hallgato".HALLGATO_ID, ADATB."Hallgato".NEPTUN_KOD FROM ADATB."Hallgato"';
    $params2 = lekerdez($select2);
    $select3 = 'SELECT ADATB."Oktato".NEPTUN_KOD, ADATB."Kurzus".KURZUS_KOD, ADATB."Kurzus".KURZUS_NEV, ADATB."Kurzus".KURZUS_ID
               FROM ADATB."Kurzus",ADATB."Oktato", ADATB."Kuzus_Oktato"
               WHERE ADATB."Oktato".OKTATO_ID = ADATB."Kuzus_Oktato"."ko_Oktato_id" AND ADATB."Kuzus_Oktato"."ko_Kurzus_id" = ADATB."Kurzus".KURZUS_ID';

    $params3 = lekerdez($select);


    echo ' <h1>Hallgató hozzáadása kurzushoz:</h1><br>
        <form method="POST" action="o_kurzushoz_add.php" accept-charset="utf8">
            <label>Hallgató:</label>
            <select name="valasztotthallgato">';
    while ($record2 = oci_fetch_array($params2[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo '<option value="' . $record2["HALLGATO_ID"] . '">' . $record2["NEPTUN_KOD"] . '</option>';
    }
    echo '</select>
           <select name="valasztottkurzus">';
    while ($record3 = oci_fetch_array($params3[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
    if( $_SESSION['felhasznalo']['neptun'] === $record3['NEPTUN_KOD']) {
        echo '<option value="' . $record3["KURZUS_ID"] . '">' . $record3["KURZUS_KOD"] . '</option>';
    }
    }

   echo' <input type="submit" value="Hozzáadás">
        </form>';


    close($params2[0], $params2[1]);

    close($params[0], $params[1]);
    ?>

</div>
        </div>
    </div>
</div>
</body>
</html>