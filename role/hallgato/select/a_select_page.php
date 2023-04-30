<?php
session_start();
include_once('../../../functions/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kurzusaim</title>
    <link rel="stylesheet" href="../../../style/egesz.css"/>
</head>
<body>
<div class="page">
    <div class="pageHeader">
        <img src="../../../style/kep.jpg" alt="Neptunusz" width="950" height="300">
        <div>
            <?php include_once('../../../nav/nav_bar.php');?>
        </div>
        <div class="pageContent">
<div class="adatok">
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
        </div>
    </div>
</div>

</body>
</html>
