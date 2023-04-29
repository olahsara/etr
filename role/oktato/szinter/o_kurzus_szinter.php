<?php
session_start();
include_once('../../../functions/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Szinter</title>
    <link rel="stylesheet" href="../../../style/menu.css"/>
    <link rel="stylesheet" href="o_szinter_style.css"/>
</head>
<body>
<div class="menu">
    <ul>
        <li><a class="active" href="../szinter/o_szinter_page.php">Kezdőlap</a></li>
        <?php if(isset($_SESSION["felhasznalo"]) ){ ?>
            <li><a href="../../../be_kijelentkezes/kijelentkezes.php">Kijelentkezés</a></li>
        <?php } else { ?>
            <li><a href="../../../be_kijelentkezes/belepes_page.php">Bejelentkezés</a></li>
        <?php }?>
        <?php if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'oktato' ){ ?>
            <li><a href="../kurzusok/o_kurzus_page.php">Kurzusok</a></li>
            <li><a href="../orarend/o_orarend_page.php">Órarend</a></li>
            <li><a href="../vizsgak/o_vizsga_page.php">Vizsgák</a></li>
        <?php } ?>
    </ul>
<div class="szinter">
    <?php
    $h_kuldo = array();
    $seged_select = 'SELECT adatb."Forum".UZENET_ID, adatb."Hallgato".HALLGATO_NEV, adatb."Hallgato".NEPTUN_KOD
                      FROM ADATB."Hallgato", adatb."Hallgato_Forum", adatb."Forum"
                      WHERE ADATB."Hallgato".HALLGATO_ID = ADATB."Hallgato_Forum"."hf_Hallgato_id" AND ADATB."Forum".UZENET_ID = ADATB."Hallgato_Forum"."hf_Forum_id"';
    $seged_params = lekerdez($seged_select);
    while ($record = oci_fetch_array($seged_params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        $h_kuldo[] = $record;
    }
    close($seged_params[0], $seged_params[1]);

    $o_kuldo = array();
    $seged_select = 'SELECT adatb."Forum".UZENET_ID, adatb."Oktato".OKTATO_NEV, adatb."Oktato".NEPTUN_KOD
                      FROM ADATB."Oktato", adatb."Oktato_Forum", adatb."Forum"
                      WHERE ADATB."Oktato".OKTATO_ID = ADATB."Oktato_Forum"."of_Oktato_id" AND ADATB."Forum".UZENET_ID = ADATB."Oktato_Forum"."of_Forum_id"';
    $seged_params = lekerdez($seged_select);
    while ($record = oci_fetch_array($seged_params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        $o_kuldo[] = $record;
    }
    close($seged_params[0], $seged_params[1]);


    $select = 'SELECT ADATB."Forum".UZENET, ADATB."Forum".UZENET_IDOPONT, ADATB."Kurzus".KURZUS_NEV, adatb."Kurzus".KURZUS_ID, adatb."Forum".UZENET_ID
               FROM ADATB."Forum",ADATB."Kurzus", ADATB."Kuzus_Forum"
               WHERE ADATB."Kurzus".KURZUS_ID = ADATB."Kuzus_Forum"."kf_Kurzus_id" AND ADATB."Kuzus_Forum"."kf_Forum_id" = ADATB."Forum".UZENET_ID
               AND ADATB."Kurzus".KURZUS_ID LIKE '.$_GET["id"].'
               ORDER BY ADATB."Forum".UZENET_IDOPONT';

    $params = lekerdez($select);

    echo '<div id="alcim">'.$_GET["name"].'</div>';
    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        $kuldo = '';
        foreach ($h_kuldo as $hallgato){
            if($hallgato["UZENET_ID"] === $record["UZENET_ID"]){
                $kuldo = $hallgato["HALLGATO_NEV"].' ('.$hallgato["NEPTUN_KOD"].')';
                break;
            }
        }
        if ($kuldo === '' ){
            foreach ( $o_kuldo as $oktato ){
                if($oktato["UZENET_ID"] === $record["UZENET_ID"]){
                    $kuldo = $oktato["OKTATO_NEV"].' ('.$oktato["NEPTUN_KOD"].')';
                    break;
                }
            }
        }
        echo '<div class="bejegyzes">';
        echo '<div class="kuldo">'.$kuldo.'</div>';
        echo '<div class="uzenet">'.$record['UZENET'].'</div>';
        echo '<div class="date">'.sajat_date($record['UZENET_IDOPONT']).'</div>';
        echo '</div>';
    }

    close($params[0], $params[1]);
    echo '
        <div id="kozzetesz">
            <form action="o_szinter_kozzetesz.php" method="post">
                <input type="hidden" name="kurzus_id" value="'.$_GET["id"].'">
                <input type="hidden" name="kurzus_nev" value="'.$_GET["name"].'">
                <textarea name="uzenet" maxlength="100" placeholder="Szólj hozzá! (maximum 100 karakter)"></textarea><br/>
                <input class="button" type="submit" value="Közzétesz">
            </form>
        </div>
        ';
    ?>


</div>

</body>
</html>

