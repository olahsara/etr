<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Lekérdezések</title>
    <link rel="stylesheet" href="../style/index.css"/>
    <link rel="stylesheet" href="../style/menu.css"/>

</head>
<body>
<!-- MENU -->
<div class="menu">
    <ul>
        <li><a href="../index.php">Kezdőlap</a></li>
        <?php if(isset($_SESSION["felhasznalo"]) ){ ?>
            <li><a href="../be_kijelentkezes/kijelentkezes.php">Kijelentkezés</a></li>
        <?php } else { ?>
            <li><a href="../be_kijelentkezes/belepes.php">Bejelentkezés</a></li>
        <?php }?>
        <li><a class="active" href="../select/selectpage.php">Lekérdezések</a></li>
    </ul>
</div>
<div>
    <div class="text" >Diplomák száma szakokra lebontva
        <form action="selects.php" method="POST">
            <input type="hidden" name="table" value="szak_diploma"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>
    <div class="text" >TTIK-en található szakok
        <form action="selects.php" method="POST">
            <input type="hidden" name="table" value="ttik_szak"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>
    <div class="text" >A karokon tanuló hallgatók száma
        <form action="selects.php" method="POST">
            <input type="hidden" name="table" value="kar_hallgato"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>
    <div class="text" >A kurzusok amibe lettek kuldve uzenetek
        <form action="selects.php" method="POST">
            <input type="hidden" name="table" value="kurzus_uzenetek"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>
    <div class="text" >Mikor vannak a termekben órák tartva
        <form action="selects.php" method="POST">
            <input type="hidden" name="table" value="teremhasznaltsag"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>
    <div class="text" >Diákok akik 1 értestésnél többet kaptak
        <form action="selects.php" method="POST">
            <input type="hidden" name="table" value="ertesites_zapor"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>
    <div class="text" >Diákok keddi óráinak száma
        <form action="selects.php" method="POST">
            <input type="hidden" name="table" value="kedd_darabszam"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>
    <div class="text" >Admin tábla tartalma
        <form action="selects.php" method="POST">
            <input type="hidden" name="table" value="admin"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>
    <div class="text" >Hány tanár tanít a karokon
        <form action="selects.php" method="POST">
            <input type="hidden" name="table" value="mennyi_tanar"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>
    <div class="text" >Tanárok akik még nem posztoltak a fórumra
        <form action="selects.php" method="POST">
            <input type="hidden" name="table" value="inaktiv_tanarok"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>
    <div class="text" >A diákok vizsgái
        <form action="selects.php" method="POST">
            <input type="hidden" name="table" value="vizsgak"><br>
            <input class="button" type="submit" value="Lekérdez">
        </form>
    </div>

</div>


</body>
</html>