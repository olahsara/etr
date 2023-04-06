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
    <!-- MENU -->
    <div class="menu">
        <ul>
            <li><a class="active" href="index.php">Kezdőlap</a></li>
            <?php if(isset($_SESSION["felhasznalo"]) ){ ?>
            <li><a href="be_kijelentkezes/kijelentkezes.php">Kijelentkezés</a></li>
            <?php } else { ?>
            <li><a href="be_kijelentkezes/belepes.php">Bejelentkezés</a></li>
            <?php }?>
            <li><a href="select/selectpage.php">Lekérdezések</a></li>
        </ul>
    </div>

    <div class="title"> <h1>Üdvözöllek <?php if(isset($_SESSION["felhasznalo"])) { echo $_SESSION["felhasznalo"]["nev"]; } ?>! </h1></div>

</body>
</html>