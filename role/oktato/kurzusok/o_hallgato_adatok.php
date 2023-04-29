<?php
session_start();
include_once('../../../functions/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hallgató adatai</title>
    <link rel="stylesheet" href="../../../style/menu.css"/>
</head>
<body>
<!-- MENU -->
<div class="menu">
    <ul>
        <li><a href="../szinter/o_szinter_page.php">Kezdőlap</a></li>
        <?php if(isset($_SESSION["felhasznalo"]) ){ ?>
            <li><a href="../../../be_kijelentkezes/kijelentkezes.php">Kijelentkezés</a></li>
        <?php } else { ?>
            <li><a href="../../../be_kijelentkezes/belepes_page.php">Bejelentkezés</a></li>
        <?php }?>
        <?php if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'oktato' ){ ?>
            <li><a class="active" href="o_kurzus_page.php">Kurzusok</a></li>
            <li><a href="../orarend/o_orarend_page.php">Órarend</a></li>
            <li><a href="../vizsgak/o_vizsga_page.php">Vizsgák</a></li>
        <?php } ?>
    </ul>

    <div class="adatok">
        <?php
        $select = 'SELECT ADATB."Hallgato".HALLGATO_NEV, ADATB."Hallgato".HALLGATO_ID, ADATB."Hallgato".NEPTUN_KOD, ADATB."Hallgato".FELEV, ADATB."Szak".SZAK_NEV, ADATB."Szak".SZAK_KOD 
                    FROM ADATB."Hallgato", ADATB."Szak", ADATB."Hallgato_Szak" WHERE ADATB."Hallgato".HALLGATO_ID = ADATB."Hallgato_Szak"."hs_Hallgato_id" AND ADATB."Szak".SZAK_ID = ADATB."Hallgato_Szak"."hs_Szak_id"';

        $params = lekerdez($select);
        echo '<div>A hallgató adatai</div>';
        while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        if( $_POST["hallgato-id"] === $record['HALLGATO_ID']) {
            echo sprintf('<div><b>Hallgató neve:</b> %s</div>
                                 <div><b>Hallgató neptun kódja:</b> %s</div>
                                 <div><b>Félév:</b> %s</div>
                                 <div><b>Szak neve:</b> %s </div>
                                 <div><b>Szak kódja:</b></b> %s</div>',
                $record['HALLGATO_NEV'], $record['NEPTUN_KOD'], $record['FELEV'], $record['SZAK_NEV'],
                $record['SZAK_KOD']);
        }
        }

        close($params[0], $params[1]);
        ?>

    </div>
</html>


