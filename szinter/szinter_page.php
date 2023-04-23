<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Szintér</title>
    <link rel="stylesheet" href="../style/menu.css"/>
</head>
<body>
<!-- MENU -->
<div class="menu">
    <ul>
        <li><a  class="active" href="../szinter/szinter_page.php">Kezdőlap</a></li>
        <?php if(isset($_SESSION["felhasznalo"]) ){ ?>
            <li><a href="../be_kijelentkezes/kijelentkezes.php">Kijelentkezés</a></li>
        <?php } else { ?>
            <li><a href="../be_kijelentkezes/belepes_page.php">Bejelentkezés</a></li>
        <?php }?>
        <?php if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'admin' ){ ?>
            <li><div class="dropdown">
                    <button class="dropbtn">Adatmódostás
                    </button>
                    <div class="dropdown-content">
                        <a href="../role/admin/felhasznalok/a_felhasznalok_page.php">Felhasználó</a>



                    </div>
                </div></li>
        <?php } ?>
        <?php if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'hallgato' ){ ?>
            <li><a href="../role/hallgato/adatok/h_adatok_page.php">Adatok</a></li>
            <li><a href="../role/hallgato/kurzus_felvetel/h_kurzus_felvetel_page.php">Kurzus felvétel</a></li>
            <li><a href="../role/hallgato/kurzusok/h_kurzus_page.php">Kurzusok</a></li>
            <li><a href="../role/hallgato/orarend/h_orarend_page.php">Órarend</a></li>
            <li><a href="../role/hallgato/vizsgak/h_vizsga_page.php">Vizsgák</a></li>
        <?php } ?>
        <?php if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'oktato' ){ ?>
            <li><a href="../role/oktato/kurzusok/o_kurzus_page.php">Kurzusok</a></li>
            <li><a href="../role/oktato/orarend/o_orarend_page.php">Órarend</a></li>
            <li><a href="../role/oktato/vizsgak/o_vizsga_page.php">Vizsgák</a></li>
        <?php } ?>
    </ul>
</div>

<!-- TODO: fórum megjelenítése -->
<?php
if( $_SESSION["felhasznalo"]["role"] === "hallgato" ){
    header("../role/hallgato/szinter/h_szinter_page.php");
}
?>

</body>
</html>