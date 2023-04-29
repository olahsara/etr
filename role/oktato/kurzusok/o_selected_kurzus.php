<?php
session_start();
include_once('../../../functions/functions.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_POST['kurzus_nev']; ?></title>
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
        $select = 'SELECT ADATB."Szak".SZAK_NEV, ADATB."Szak".SZAK_KOD,
               ADATB."Kar".KAR_KOD, ADATB."Kar".KAR_NEV,
               ADATB."Oktato".OKTATO_NEV,
               ADATB."Ora".ORA, ADATB."Ora".NAP,
               ADATB."Terem".TEREM_NEV, ADATB."Terem".EPULET, ADATB."Kurzus".KURZUS_KOD, ADATB."Kurzus".KURZUS_ID, ADATB."Kurzus".KURZUS_NEV, ADATB."Oktato".NEPTUN_KOD
               FROM ADATB."Kurzus", ADATB."Szak", ADATB."Kar", ADATB."Oktato", ADATB."Ora", ADATB."Terem",
               ADATB."Kuzus_Szak", ADATB."Kuzus_Oktato", ADATB."Kuzus_Ora", ADATB."Kuzus_Terem", ADATB."Szak_Kar"
               WHERE ADATB."Szak_Kar"."sk_Szak_id" = ADATB."Szak".SZAK_ID AND ADATB."Szak_Kar"."sk_Kar_id" = ADATB."Kar".KAR_ID
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

        $select2 = 'SELECT ADATB."Kurzus".KURZUS_KOD, ADATB."Kurzus".KURZUS_ID, ADATB."Kurzus".KURZUS_NEV, ADATB."Oktato".NEPTUN_KOD, ADATB."Hallgato".HALLGATO_NEV, 
                    ADATB."Hallgato".HALLGATO_ID, ADATB."Hallgato_Kurzus"."Erdem_jegy"
               FROM ADATB."Hallgato", ADATB."Kurzus", ADATB."Oktato",
               ADATB."Kuzus_Oktato", ADATB."Hallgato_Kurzus"
               WHERE ADATB."Hallgato".HALLGATO_ID = ADATB."Hallgato_Kurzus"."hk_Hallgato_id" AND ADATB."Kurzus".KURZUS_ID = ADATB."Hallgato_Kurzus"."hk_Kurzus_id"
               AND ADATB."Kurzus".KURZUS_ID = ADATB."Kuzus_Oktato"."ko_Kurzus_id" AND ADATB."Kuzus_Oktato"."ko_Oktato_id" = ADATB."Oktato".OKTATO_ID';

        $params2 = lekerdez($select2);
        echo '<table> <th>Kurzusra járó hallgatók neve</th><th>Hallgató érdemjegye</th><th></th><th></th><th></th>';
        while ($record2 = oci_fetch_array($params2[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
            if ($_SESSION['felhasznalo']['neptun'] === $record2['NEPTUN_KOD'] && $_POST["kurzus_kod"] === $record2['KURZUS_KOD']) {
                echo '<tr><td>' . $record2['HALLGATO_NEV'] . '</td><td>' . $record2['Erdem_jegy'] . '</td>
            <td>
                <form action="o_kurzusrol_torol.php" method="POST">
                    <input type="hidden" name="hallgato-id" value="' . $record2['HALLGATO_ID'] . '">
                    <input type="hidden" name="hallgato-nev" value="' . $record2['HALLGATO_NEV'] . '">
                    <input type="hidden" name="kurzus_id" value="' . $record2['KURZUS_ID'] . '">
                    <input type="hidden" name="kurzus_nev" value="' . $record2['KURZUS_NEV'] . '">
                    <input class="button" type="submit" value="Törlés a kurzusról">
                </form>
            </td>
            <td>
                <form action="o_hallgato_adatok.php" method="POST">
                    <input type="hidden" name="hallgato-id" value="' . $record2['HALLGATO_ID'] . '">
                    <input class="button" type="submit" value="Hallgató adatai">
                </form>
            </td>
            <td>';

                if (empty($record2['Erdem_jegy'])) {
                    echo '<form action="o_erdemjegy_beiras.php" method="POST">
                    <input type="text" name="uj-erdemjegy" id="uj-erdemjegy" >
                    <input type="hidden" name="hallgato-id" value="' . $record2['HALLGATO_ID'] . '">
                    <input type="hidden" name="kurzus-id" value="' . $record2['KURZUS_ID'] . '">
                    <input class="button" type="submit" value="Érdemjegy beírása">
                </form>';
                } else {
                    echo '<form action="o_erdemjegy_modositas.php" method="POST">
                    <input type="text" name="uj-erdemjegy" id="uj-erdemjegy" >
                    <input type="hidden" name="hallgato-id" value="' . $record2['HALLGATO_ID'] . '">
                    <input type="hidden" name="kurzus-id" value="' . $record2['KURZUS_ID'] . '">
                    <input class="button" type="submit" value="Érdemjegy módosítása">
                </form>';
                }

                echo '</td>
            </tr>';
            }
        }


        close($params[0], $params[1]);
        close($params2[0], $params2[1]);

        ?>
    </div>
</html>

