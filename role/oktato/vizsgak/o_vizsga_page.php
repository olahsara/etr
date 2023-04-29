<?php
session_start();
include_once('../../../functions/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vizsgák</title>
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
            <li><a href="../kurzusok/o_kurzus_page.php">Kurzusok</a></li>
            <li><a href="../orarend/o_orarend_page.php">Órarend</a></li>
            <li><a class="active" href="../vizsgak/o_vizsga_page.php">Vizsgák</a></li>
        <?php } ?>
    </ul>

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
</html>


