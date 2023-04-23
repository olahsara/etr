<?php
session_start();
include_once('../../../functions/functions.php');
include_once ('../shared/hallgato_menu.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_POST['kurzus_nev']; ?></title>
    <link rel="stylesheet" href="h_kurzus_felvetel_style.css">
</head>
<body>

<div class="adatok">
    <?php
    $select = 'SELECT ADATB."Szak".SZAK_NEV, ADATB."Szak".SZAK_KOD,
               ADATB."Kar".KAR_KOD, ADATB."Kar".KAR_NEV,
               ADATB."Oktato".OKTATO_NEV, ADATB."Kurzus".KURZUS_KOD, ADATB."Kurzus".KURZUS_NEV
               FROM ADATB."Kurzus", ADATB."Szak", ADATB."Kar", ADATB."Oktato",
               ADATB."Kuzus_Szak", ADATB."Kuzus_Oktato", ADATB."Szak_Kar"
               WHERE ADATB."Szak_Kar"."sk_Szak_id" = ADATB."Szak".SZAK_ID AND ADATB."Szak_Kar"."sk_Kar_id" = ADATB."Kar".KAR_ID
               AND ADATB."Kurzus".KURZUS_ID = ADATB."Kuzus_Szak"."ks_Kurzus_id" AND ADATB."Szak".SZAK_ID = ADATB."Kuzus_Szak"."ks_Szak_id"
               AND ADATB."Kurzus".KURZUS_ID = ADATB."Kuzus_Oktato"."ko_Kurzus_id" AND ADATB."Kuzus_Oktato"."ko_Oktato_id" = ADATB."Oktato".OKTATO_ID';

    $params = lekerdez($select);
    echo '<div id="alcim">'.$_POST['kurzus_nev'].'</div>';
    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        if( $_POST['kurzus_kod'] === $record['KURZUS_KOD'] ){
            echo sprintf('<div><b>Kurzus kódja:</b> %s</div>
                                 <div><b>Szak:</b> %s (%s)</div>
                                 <div><b>Kar:</b> %s (%s)</div>
                                 <div><b>Felelős oktató:</b> %s </div>
                                 <div>
                                    <form action="h_selected_kurzus_ora.php" method="POST">
                                    <input type="hidden" name="kurzus_kod" value=' .$record['KURZUS_KOD'].'>
                                    <input type="hidden" name="kurzus_nev" value=' .$record['KURZUS_NEV'].'>
                                    <input class="button" type="submit" value="Időpontok">
                                    </form>
                                 </div>',
                $record['KURZUS_KOD'], $record['SZAK_NEV'], $record['SZAK_KOD'], $record['KAR_NEV'], $record['KAR_KOD'], $record['OKTATO_NEV']);
        }
    }

    close($params[0], $params[1]);
    ?>

</div>

</body>
</html>
