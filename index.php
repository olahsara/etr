<?php
session_start();
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Főoldal</title>
    <link rel="stylesheet" href="style/index.css"/>
    <link rel="stylesheet" href="style/menu.css"/>

</head>
<body>
<!--    <div class="menu">-->
<!--        <ul>-->
<!--            <li><a class="active" href="szinter/szinter_page.php">Kezdőlap</a></li>-->
<!--            --><?php //if(isset($_SESSION["felhasznalo"]) ){ ?>
<!--            <li><a href="be_kijelentkezes/kijelentkezes.php">Kijelentkezés</a></li>-->
<!--            --><?php //} else { ?>
<!--            <li><a href="be_kijelentkezes/belepes_page.php">Bejelentkezés</a></li>-->
<!--            --><?php //}?>
<!--            --><?php //if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'admin' ){ ?>
<!--                <li><a href="role/admin/select/a_select_page.php">Felhasználók</a></li>-->
<!--                <li><a href="role/admin/select/a_select_page.php">Kurzusok</a></li>-->
<!--                <li><a href="role/admin/select/a_select_page.php">Órarend</a></li>-->
<!--                <li><a href="role/admin/select/a_select_page.php">Lekérdezések</a></li>-->
<!--            --><?php //} ?>
<!--            --><?php //if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'hallgato' ){ ?>
<!--                <li><a href="role/hallgato/adatok/h_adatok_page.php">Adatok</a></li>-->
<!--                <li><a href="role/hallgato/kurzus_felvetel/h_kurzus_felvetel_page.php">Kurzus felvétel</a></li>-->
<!--                <li><a href="role/hallgato/kurzusok/h_kurzus_page.php">Kurzusok</a></li>-->
<!--                <li><a href="role/hallgato/orarend/h_orarend_page.php">Órarend</a></li>-->
<!--                <li><a href="role/hallgato/vizsgak/h_vizsga_page.php">Vizsgák</a></li>-->
<!--            --><?php //} ?>
<!--            --><?php //if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'oktato' ){ ?>
<!--                <li><a href="role/oktato/kurzusok/o_kurzus_page.php">Kurzusok</a></li>-->
<!--                <li><a href="role/oktato/orarend/o_orarend_page.php">Órarend</a></li>-->
<!--                <li><a href="role/oktato/vizsgak/o_vizsga_page.php">Vizsgák</a></li>-->
<!--            --><?php //} ?>
<!--        </ul>-->
<!--    </div>-->

    <?php if(isset($_SESSION["felhasznalo"])) {
        header("Location: szinter/szinter_page.php");
    } else {
        header("Location: be_kijelentkezes/belepes_page.php");
    }
    ?>


</body>
</html>