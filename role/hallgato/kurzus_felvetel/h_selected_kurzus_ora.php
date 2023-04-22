<?php
session_start();
include_once('../../../functions/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_POST['kurzus_nev']; ?> felvehető időpontok</title>
    <link rel="stylesheet" href="../../../style/menu.css"/>
    <link rel="stylesheet" href="h_kurzus_felvetel_style.css">
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
            <li><a class="active" href="../kurzus_felvetel/h_kurzus_felvetel_page.php">Kurzus felvétel</a></li>
            <li><a href="../kurzusok/h_kurzus_page.php">Kurzusok</a></li>
            <li><a href="../orarend/h_orarend_page.php">Órarend</a></li>
            <li><a href="../vizsgak/h_vizsga_page.php">Vizsgák</a></li>
        <?php } ?>
    </ul>
</div>

<div class="adatok">
    <?php
    $select = 'SELECT ADATB."Ora".ORA, ADATB."Ora".NAP, ADATB."Ora".ORA_ID,
               ADATB."Terem".EPULET, ADATB."Terem".TEREM_NEV, ADATB."Terem".FEROHELY,
               ADATB."Oktato".OKTATO_NEV, ADATB."Kurzus".KURZUS_KOD, ADATB."Kurzus".KURZUS_NEV, ADATB."Kurzus".KURZUS_ID
               FROM ADATB."Kurzus", ADATB."Ora", ADATB."Terem", ADATB."Oktato",
               ADATB."Kuzus_Ora", ADATB."Kuzus_Terem", ADATB."Oktato_Ora"
               WHERE ADATB."Kuzus_Terem"."kt_Kurzus_id" = ADATB."Kurzus".KURZUS_ID AND ADATB."Kuzus_Terem"."kt_Terem_id" = ADATB."Terem".TEREM_ID
               AND ADATB."Kurzus".KURZUS_ID = ADATB."Kuzus_Ora"."ko_Kurzus_id" AND ADATB."Ora".ORA_ID = ADATB."Kuzus_Ora"."ko_Ora_id"
               AND ADATB."Ora".ORA_ID = ADATB."Oktato_Ora"."oo_Ora_id" AND ADATB."Oktato_Ora"."oo_Oktato_id" = ADATB."Oktato".OKTATO_ID';

    $params = lekerdez($select);
    echo '<div id="alcim">'.$_POST['kurzus_nev'].' felvehető időpontjai</div>';
    echo '<table> <tr> <th >Időpont</th> <th>Helyszín</th> <th>Oktató</th> <th>Férőhely</th> <th></th> </tr>';
    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        if( $_POST['kurzus_kod'] === $record['KURZUS_KOD'] ){
            echo sprintf('<tr><td>%s, %d óra</td><td>%s, %s terem</td><td>%s</td><td>%d</td>
                            <td>
                                <form action="h_felvesz_kurzus_felvetel.php" method="POST">
                                <input type="hidden" name="kurzus_id" value=' .$record['KURZUS_ID'].'>
                                <input type="hidden" name="ora_id" value='.$record['ORA_ID'].'>
                                <input class="button" type="submit" value="Felvétel">
                                </form>
                            </td></tr>',
                getday($record['NAP']), $record['ORA'], $record['EPULET'], $record['TEREM_NEV'],
                $record['OKTATO_NEV'], $record['FEROHELY']);
            //TODO: kurzus betelésének kezelése
            //TODO: kurzus felvétele
        }
    }

    close($params[0], $params[1]);
    ?>

</div>

</body>
</html>
