<?php
session_start();
include_once('../../../functions/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fórum</title>
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
    $select = 'SELECT ADATB."Kurzus".KURZUS_NEV, ADATB."Kurzus".KURZUS_ID
                   FROM ADATB."Kurzus",ADATB."Oktato",ADATB."Kuzus_Oktato"
                   WHERE ADATB."Oktato".OKTATO_ID = ADATB."Kuzus_Oktato"."ko_Oktato_id" AND ADATB."Kurzus".KURZUS_ID = ADATB."Kuzus_Oktato"."ko_Kurzus_id"
                   AND ADATB."Oktato".OKTATO_ID LIKE '.$_SESSION["felhasznalo"]["id"];
    $params = lekerdez($select);

    echo '<div id="alcim">Kurzusfórumok:</div>';
    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo '<a href="o_kurzus_szinter.php?id='.urlencode($record['KURZUS_ID']).'&name='.urlencode($record['KURZUS_NEV']).'">'.$record['KURZUS_NEV'].'</a>';
    }
    close($params[0], $params[1]);
    ?>


</div>

</body>
</html>

