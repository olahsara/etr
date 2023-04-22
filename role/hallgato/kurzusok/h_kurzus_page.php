<?php
session_start();
include_once('../../../functions/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kurzusok</title>
    <link rel="stylesheet" href="../../../style/menu.css"/>
    <link rel="stylesheet" href="h_kurzus_style.css">
</head>
<body>
<!-- MENU -->
<div class="menu">
    <ul>
        <li><a href="../../../szinter/szinter_page.php">Kezdőlap</a></li>
        <?php if(isset($_SESSION["felhasznalo"]) ){ ?>
            <li><a href="../../../be_kijelentkezes/kijelentkezes.php">Kijelentkezés</a></li>
        <?php } else { ?>
            <li><a href="../../../be_kijelentkezes/belepes_page.php">Bejelentkezés</a></li>
        <?php }?>
        <?php if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'hallgato' ){ ?>
            <li><a href="../adatok/h_adatok_page.php">Adatok</a></li>
            <li><a href="../kurzus_felvetel/h_kurzus_felvetel_page.php">Kurzus felvétel</a></li>
            <li><a class="active" href="../kurzusok/h_kurzus_page.php">Kurzusok</a></li>
            <li><a href="../orarend/h_orarend_page.php">Órarend</a></li>
            <li><a href="../vizsgak/h_vizsga_page.php">Vizsgák</a></li>
        <?php } ?>
    </ul>
</div>
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
                                <input type="hidden" name="kurzus_kod" value=' .$record['KURZUS_KOD'].'>
                                <input type="hidden" name="kurzus_nev" value='.$record['KURZUS_NEV'].'>
                                <input class="button" type="submit" value="Részletek">
                                </form>
                                <form action="h_kurzus_leadas.php" method="POST">
                                <input type="hidden" name="kurzus_id" value=' .$record['KURZUS_ID'].'>
                                <input type="hidden" name="kurzus_nev" value='.$record['KURZUS_NEV'].'>
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
