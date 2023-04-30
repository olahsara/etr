<?php
session_start();
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Lekérdezések</title>
    <link rel="stylesheet" href="../../../style/index.css"/>
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
            <li><a  href="../orarend/a_orarend_page.php">Órarend</a></li>
            <li><a class="active" href="a_select_page.php">Lekérdezések</a></li>
        <?php } ?>
    </ul>
</div>

<!-- LEKERDEZEZSEK -->
<div>
    <div class="text" >Diplomák száma szakokra lebontva
        <form action="select.php" method="POST">
            <input type="hidden" name="table" value="szak_diploma"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>
    <div class="text" >TTIK-en található szakok
        <form action="select.php" method="POST">
            <input type="hidden" name="table" value="ttik_szak"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>
    <div class="text" >A karokon tanuló hallgatók száma
        <form action="select.php" method="POST">
            <input type="hidden" name="table" value="kar_hallgato"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>
    <div class="text" >A kurzusok amibe lettek kuldve uzenetek
        <form action="select.php" method="POST">
            <input type="hidden" name="table" value="kurzus_uzenetek"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>
    <div class="text" >Mikor vannak a termekben órák tartva
        <form action="select.php" method="POST">
            <input type="hidden" name="table" value="teremhasznaltsag"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>
    <div class="text" >Diákok akik 1 értestésnél többet kaptak
        <form action="select.php" method="POST">
            <input type="hidden" name="table" value="ertesites_zapor"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>
    <div class="text" >Diákok keddi óráinak száma
        <form action="select.php" method="POST">
            <input type="hidden" name="table" value="kedd_darabszam"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>
    <div class="text" >Admin tábla tartalma
        <form action="select.php" method="POST">
            <input type="hidden" name="table" value="admin"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>
    <div class="text" >Hány tanár tanít a karokon
        <form action="select.php" method="POST">
            <input type="hidden" name="table" value="mennyi_tanar"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>
    <div class="text" >Tanárok akik még nem posztoltak a fórumra
        <form action="select.php" method="POST">
            <input type="hidden" name="table" value="inaktiv_tanarok"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>
    <div class="text" >A diákok vizsgái
        <form action="select.php" method="POST">
            <input type="hidden" name="table" value="vizsgak"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>

</div>


</body>
</html>
