<?php
session_start();
include_once('../../../functions/functions.php');
include_once('../../../nav/nav_bar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Órarend</title>
    <link rel="stylesheet" href="/etr/style/menu.css"/>
    <link rel="stylesheet" href="h_orarend_style.css"/>
</head>
<body>

<div class="adatok">
    <?php
    $select = 'SELECT ADATB."Kurzus".KURZUS_NEV, ADATB."Kurzus".KURZUS_KOD,
                   ADATB."Oktato".OKTATO_NEV,
                   ADATB."Ora".ORA, ADATB."Ora".NAP,
                   ADATB."Terem".EPULET, ADATB."Terem".TEREM_NEV, 
                   ADATB."Hallgato".NEPTUN_KOD
                   FROM ADATB."Kurzus", ADATB."Oktato", ADATB."Ora", ADATB."Terem", ADATB."Hallgato",
                   ADATB."Kuzus_Ora", ADATB."Hallgato_Ora", ADATB."Oktato_Ora", ADATB."Kuzus_Terem"
                   WHERE ADATB."Kurzus".KURZUS_ID = ADATB."Kuzus_Terem"."kt_Kurzus_id" AND ADATB."Kuzus_Terem"."kt_Terem_id" = ADATB."Terem".TEREM_ID 
                   AND ADATB."Hallgato".HALLGATO_ID = ADATB."Hallgato_Ora"."ho_Hallgato_id" AND ADATB."Hallgato_Ora"."ho_Ora_id" = ADATB."Ora".ORA_ID
                   AND ADATB."Oktato".OKTATO_ID = ADATB."Oktato_Ora"."oo_Oktato_id" AND ADATB."Ora".ORA_ID = ADATB."Oktato_Ora"."oo_Ora_id"
                   AND ADATB."Kurzus".KURZUS_ID = ADATB."Kuzus_Ora"."ko_Kurzus_id" AND ADATB."Kuzus_Ora"."ko_Ora_id" = ADATB."Ora".ORA_ID
                   ORDER BY ADATB."Ora".ORA';

    $params = lekerdez($select);
    $table = array();

    echo '<div id="alcim"></div>';
    echo '<table> <tr> <th>Hétfő</th> <th>Kedd</th> <th>Szerda</th> <th>Csütörtök</th> <th>Péntek</th> </tr>';
    $napok = array(1,2,3,4,5);
    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        global $table;
        if( $record['NEPTUN_KOD'] === $_SESSION['felhasznalo']['neptun'] ){
            $table[$record['NAP']] = $record;

            echo '<tr>';
            foreach ($napok as $nap){
                if(empty($table[$nap])){
                    echo '<td></td>';
                } else {
                    echo '<td><b>'.$table[$nap]['KURZUS_NEV'].'</b><br>'
                          .$table[$nap]['OKTATO_NEV'].'<br>'
                          .$table[$nap]['EPULET'].', '.$table[$nap]['TEREM_NEV'].'<br>'
                          .$table[$nap]['ORA'].' óra <br>
                          </td>';
                    $table[$nap] = [];
                }
            }
            echo '</tr>';
        }

    }
    close($params[0], $params[1]);

    echo '</table>';
    ?>
</div>

</body>
</html>

