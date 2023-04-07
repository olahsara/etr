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
            <li><a href="be_kijelentkezes/belepes_page.php">Bejelentkezés</a></li>
            <?php }?>
            <?php if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'admin' ){ ?>
            <li><a href="select/select_page.php">Lekérdezések</a></li>
            <?php } ?>
        </ul>
    </div>

    <div class="title"> <h1>Üdvözöllek<?php if(isset($_SESSION["felhasznalo"])) {
                                                if ($_SESSION["felhasznalo"]["role"] === 'admin'){
                                                    echo ' Admin';
                                                } else {
                                                    echo ' ' . $_SESSION["felhasznalo"]["nev"];
                                                }
    } else {
        echo '! Kérlek jelentkezz be';
            } ?>! </h1></div>

</body>
</html>