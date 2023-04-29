<?php
session_start();
include_once('../../../functions/functions.php');
include_once('../../../nav/nav_bar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_POST['kurzus_nev']; ?></title>
    <link rel="stylesheet" href="/etr/style/menu.css"/>
    <link rel="stylesheet" href="h_kurzus_style.css">
</head>
<body>
<!-- MENU -->
<!--<div class="menu">-->
<!--    <ul>-->
<!--        <li><a href="../../../szinter/szinter_page.php">Kezdőlap</a></li>-->
<!--        --><?php //if(isset($_SESSION["felhasznalo"]) ){ ?>
<!--            <li><a href="../../../be_kijelentkezes/kijelentkezes.php">Kijelentkezés</a></li>-->
<!--        --><?php //} else { ?>
<!--            <li><a href="../../../be_kijelentkezes/belepes_page.php">Bejelentkezés</a></li>-->
<!--        --><?php //}?>
<!--        --><?php //if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'hallgato' ){ ?>
<!--            <li><a href="../adatok/h_adatok_page.php">Adatok</a></li>-->
<!--            <li><a href="../kurzus_felvetel/h_kurzus_felvetel_page.php">Kurzus felvétel</a></li>-->
<!--            <li><a class="active" href="../kurzusok/h_kurzus_page.php">Kurzusok</a></li>-->
<!--            <li><a href="../orarend/h_orarend_page.php">Órarend</a></li>-->
<!--            <li><a href="../vizsgak/h_vizsga_page.php">Vizsgák</a></li>-->
<!--        --><?php //} ?>
<!--    </ul>-->
<!--</div>-->
<div class="adatok">
    <?php

    $select = 'SELECT ADATB."Szak".SZAK_NEV, ADATB."Szak".SZAK_KOD,
               ADATB."Kar".KAR_KOD, ADATB."Kar".KAR_NEV,
               ADATB."Oktato".OKTATO_NEV,
               ADATB."Ora".ORA, ADATB."Ora".NAP,
               ADATB."Terem".TEREM_NEV, ADATB."Terem".EPULET, ADATB."Kurzus".KURZUS_KOD, ADATB."Hallgato".NEPTUN_KOD
               FROM ADATB."Hallgato", ADATB."Kurzus", ADATB."Szak", ADATB."Kar", ADATB."Oktato", ADATB."Ora", ADATB."Terem",
               ADATB."Kuzus_Szak", ADATB."Kuzus_Oktato", ADATB."Kuzus_Ora", ADATB."Kuzus_Terem", ADATB."Szak_Kar", ADATB."Hallgato_Kurzus"
               WHERE ADATB."Hallgato".HALLGATO_ID = ADATB."Hallgato_Kurzus"."hk_Hallgato_id" AND ADATB."Kurzus".KURZUS_ID = ADATB."Hallgato_Kurzus"."hk_Kurzus_id"
               AND ADATB."Szak_Kar"."sk_Szak_id" = ADATB."Szak".SZAK_ID AND ADATB."Szak_Kar"."sk_Kar_id" = ADATB."Kar".KAR_ID
               AND ADATB."Kurzus".KURZUS_ID = ADATB."Kuzus_Szak"."ks_Kurzus_id" AND ADATB."Szak".SZAK_ID = ADATB."Kuzus_Szak"."ks_Szak_id"
               AND ADATB."Kurzus".KURZUS_ID = ADATB."Kuzus_Oktato"."ko_Kurzus_id" AND ADATB."Kuzus_Oktato"."ko_Oktato_id" = ADATB."Oktato".OKTATO_ID
               AND ADATB."Kurzus".KURZUS_ID = ADATB."Kuzus_Ora"."ko_Kurzus_id" AND ADATB."Kuzus_Ora"."ko_Ora_id" = ADATB."Ora".ORA_ID
               AND ADATB."Kurzus".KURZUS_ID = ADATB."Kuzus_Terem"."kt_Kurzus_id" AND ADATB."Kuzus_Terem"."kt_Terem_id" = ADATB."Terem".TEREM_ID';

    $params = lekerdez($select);
    echo '<div id="alcim">'.$_POST["kurzus_nev"].'</div>';
    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        if( $_SESSION['felhasznalo']['neptun'] === $record['NEPTUN_KOD'] && $_POST["kurzus_kod"] === $record['KURZUS_KOD']){
            echo sprintf('<div><b>Kurzus kódja:</b> %s</div>
                                 <div><b>Szak:</b> %s (%s)</div>
                                 <div><b>Kar:</b> %s (%s)</div>
                                 <div><b>Felelős oktató:</b> %s </div>
                                 <div><b>Helyszín:</b></b> %s, %s </div>
                                 <div><b>Időpont:</b></b> %s, %d óra</div><br>',
                $record['KURZUS_KOD'], $record['SZAK_NEV'], $record['SZAK_KOD'], $record['KAR_NEV'],
                $record['KAR_KOD'], $record['OKTATO_NEV'], $record['EPULET'], $record['TEREM_NEV'],
                getday($record['NAP']), $record['ORA']);
        }
    }

    close($params[0], $params[1]);
    ?>

</div>

</body>
</html>
