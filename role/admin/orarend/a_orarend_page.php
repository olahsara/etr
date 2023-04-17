<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Órarend</title>
    <link rel="stylesheet" href="../../../style/menu.css"/>
</head>
<body>
<!-- MENU -->
<div class="menu">
    <ul>
        <li><a  href="../../../szinter/szinter_page.php">Kezdőlap</a></li>
        <?php if(isset($_SESSION["felhasznalo"]) ){ ?>
            <li><a href="../../../be_kijelentkezes/kijelentkezes.php">Kijelentkezés</a></li>
        <?php } else { ?>
            <li><a href="../../../be_kijelentkezes/belepes_page.php">Bejelentkezés</a></li>
        <?php }?>
        <?php if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'admin' ){ ?>
            <li><a  href="../felhasznalok/a_felhasznalok_page.php">Felhasználók</a></li>
            <li><a  href="../kurzusok/a_kurzus_page.php">Kurzusok</a></li>
            <li><a class="active" href="a_orarend_page.php">Órarend</a></li>
            <li><a href="../select/a_select_page.php">Lekérdezések</a></li>
        <?php } ?>
    </ul>
</div>

<!-- TODO: órarend megjelenítése és kezelése (admin) -->

</body>
</html>
