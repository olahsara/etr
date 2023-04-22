<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kurzusok</title>
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
            <div class="dropdown">
                <button class="dropbtn">Adatmódostás
                </button>
                <div class="dropdown-content">
                    <a href="../felhasznalok/a_felhasznalok_page.php">Felhasználó</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                </div>
            </div>
        <?php } ?>
    </ul>
</div>

<!-- TODO: kurzusok megjelenítése és kezelése (admin) -->

</body>
</html>
