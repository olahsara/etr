<?php
session_start();
if( $_SESSION["felhasznalo"]["role"] === 'hallgato' ){
    header("Location: /etr/role/hallgato/szinter/h_szinter_page.php");
}
if( $_SESSION["felhasznalo"]["role"] === 'oktato' ){
    header("Location: /etr/role/oktato/szinter/o_szinter_page.php");
}
include_once('../nav/nav_bar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Szintér</title>
    <link rel="stylesheet" href="/etr/style/menu.css"/>
</head>
<body>
<!-- MENU -->
<!--<div class="menu">-->
<!--    <ul>-->
<!--        <li><a  class="active" href="../szinter/szinter_page.php">Kezdőlap</a></li>-->
<!--        --><?php //if(isset($_SESSION["felhasznalo"]) ){ ?>
<!--            <li><a href="../be_kijelentkezes/kijelentkezes.php">Kijelentkezés</a></li>-->
<!--        --><?php //} else { ?>
<!--            <li><a href="../be_kijelentkezes/belepes_page.php">Bejelentkezés</a></li>-->
<!--        --><?php //}?>
<!--        --><?php //if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'admin' ){ ?>
<!--            <li><div class="dropdown">-->
<!--                    <button class="dropbtn">Adatmódostás-->
<!--                    </button>-->
<!--                    <div class="dropdown-content">-->
<!--                        <a href="../role/admin/felhasznalok/a_felhasznalok_page.php">Felhasználó</a>-->
<!--                        <a href="../role/admin/diplomak/a_diplomak_page.php">Diplomák</a>-->
<!--                        <a href="../role/admin/ertesitesek/a_ertesitesek_page.php">Értestések</a>-->
<!--                        <a href="../role/admin/forumok/a_forumok_page.php">Fórumok</a>-->
<!--                        <a href="../role/admin/karok/a_karok_page.php">Karok</a>-->
<!--                        <a href="../role/admin/szakok/a_szakok_page.php">Szakok</a>-->
<!--                        <a href="../role/admin/oktatok/a_oktatok_page.php">Oktatók</a>-->
<!--                        <a href="../role/admin/orak/a_orak_page.php">Órák</a>-->
<!--                        <a href="../role/admin/kurzusok/a_kurzusok_page.php">Kurzusok</a>-->
<!--                        <a href="../role/admin/termek/a_termek_page.php">Termek</a>-->
<!--                        <a href="../role/admin/vizsgak/a_vizsgak_page.php">Vizsgák</a>-->
<!--                    </div>-->
<!--                </div></li>-->
<!--                <li><div class="dropdown">-->
<!--                        <button class="dropbtn">Kapcsolati-->
<!--                        </button>-->
<!--                        <div class="dropdown-content">-->
<!--                            <a href="../role/admin/kapcsolati/a_kapcsolat_page.php?value=Hallgato_Diploma">Hallgato_Diploma</a>-->
<!--                            <a href="../role/admin/kapcsolati/a_kapcsolat_page.php?value=Hallgato_Ertesites">Hallgato_Ertesites</a>-->
<!--                            <a href="../role/admin/kapcsolati/a_kapcsolat_page.php?value=Hallgato_Forum">Hallgato_Forum</a>-->
<!--                            <a href="../role/admin/kapcsolati/a_kapcsolat_page.php?value=Hallgato_Ora">Hallgato_Ora</a>-->
<!--                            <a href="../role/admin/kapcsolati/a_kapcsolat_page.php?value=Hallgato_Szak">Hallgato_Szak</a>-->
<!--                            <a href="../role/admin/kapcsolati/a_kapcsolat_page.php?value=Kuzus_Forum">Kuzus_Forum</a>-->
<!--                            <a href="../role/admin/kapcsolati/a_kapcsolat_page.php?value=Kuzus_Oktato">Kuzus_Oktato</a>-->
<!--                            <a href="../role/admin/kapcsolati/a_kapcsolat_page.php?value=Kuzus_Ora">Kuzus_Ora</a>-->
<!--                            <a href="../role/admin/kapcsolati/a_kapcsolat_page.php?value=Kuzus_Szak">Kuzus_Szak</a>-->
<!--                            <a href="../role/admin/kapcsolati/a_kapcsolat_page.php?value=Kuzus_Terem">Kuzus_Terem</a>-->
<!--                            <a href="../role/admin/kapcsolati/a_kapcsolat_page.php?value=Kuzus_Vizsga">Kuzus_Vizsga</a>-->
<!--                            <a href="../role/admin/kapcsolati/a_kapcsolat_page.php?value=Oktato_Forum">Oktato_Forum</a>-->
<!--                            <a href="../role/admin/kapcsolati/a_kapcsolat_page.php?value=Oktato_Kar">Oktato_Kar</a>-->
<!--                            <a href="../role/admin/kapcsolati/a_kapcsolat_page.php?value=Oktato_Ora">Oktato_Ora</a>-->
<!--                            <a href="../role/admin/kapcsolati/a_kapcsolat_page.php?value=Szak_Diploma">Szak_Diploma</a>-->
<!--                            <a href="../role/admin/kapcsolati/a_kapcsolat_page.php?value=Szak_Kar">Szak_Kar</a>-->
<!--                        </div>-->
<!--                    </div></li>-->
<!--        --><?php //} ?>
<!--        --><?php //if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'hallgato' ){ ?>
<!--            <li><a href="../role/hallgato/adatok/h_adatok_page.php">Adatok</a></li>-->
<!--            <li><a href="../role/hallgato/kurzus_felvetel/h_kurzus_felvetel_page.php">Kurzus felvétel</a></li>-->
<!--            <li><a href="../role/hallgato/kurzusok/h_kurzus_page.php">Kurzusok</a></li>-->
<!--            <li><a href="../role/hallgato/orarend/h_orarend_page.php">Órarend</a></li>-->
<!--            <li><a href="../role/hallgato/vizsgak/h_vizsga_page.php">Vizsgák</a></li>-->
<!--        --><?php //} ?>
<!--        --><?php //if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'oktato' ){ ?>
<!--            <li><a href="../role/oktato/kurzusok/o_kurzus_page.php">Kurzusok</a></li>-->
<!--            <li><a href="../role/oktato/orarend/o_orarend_page.php">Órarend</a></li>-->
<!--            <li><a href="../role/oktato/vizsgak/o_vizsga_page.php">Vizsgák</a></li>-->
<!--        --><?php //} ?>
<!--    </ul>-->
<!--</div>-->

<!-- TODO: fórum megjelenítése -->

</body>
</html>
