<?php
session_start();
include_once('../../../functions/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_POST['kurzus_nev'].' leadása'; ?></title>
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
    <div id="alcim"> Biztos hogy leadod a(z) <?php echo $_POST["kurzus_nev"]; ?> kurzust? </div>
    <?php
    //TODO:Törlés megcsinálása
    ?>

</div>

</body>
</html>


