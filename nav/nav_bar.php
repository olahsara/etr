<head>
    <meta charset="UTF-8">

    <title></title>
</head>
<?php
$page = explode('/',$_SERVER['PHP_SELF']);

?>
<!-- MENU -->
<div class="menu">
    <ul>
<!-- ADMIN ------------------------------------------------------------------------------------------------------------>
        <?php if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'admin' ){ ?>
            <li<?php if(end($page)==="szinter_page.php" )    { echo " class=\"active\""; } ?>><a href="/etr/szinter/szinter_page.php">Kezdőlap</a></li>
            <li<?php if(end($page)==="kijelentkezes.php")   { echo " class=\"active\""; } ?>><a href="/etr/be_kijelentkezes/kijelentkezes.php"> Kijelentkezés</a></li>

            <li<?php if(end($page)==="a_felhasznalok_page.php" || end($page)==="a_diplomak_page.php"
                || end($page)==="a_ertesitesek_page.php" || end($page)==="a_forumok_page.php"
                || end($page)==="a_karok_page.php" || end($page)==="a_szakok_page.php"
                || end($page)==="a_oktatok_page.php" || end($page)==="a_orak_page.php"
                || end($page)==="a_kurzusok_page.php" || end($page)==="a_termek_page.php"
                || end($page)==="a_vizsgak_page.php") { echo " class=\"active\""; } ?>><div class="dropdown">
                    <button class="dropbtn">Adatmódostás
                    </button>
                    <div class="dropdown-content">
                        <a href="/etr/role/admin/felhasznalok/a_felhasznalok_page.php">Felhasználó</a>
                        <a href="/etr/role/admin/diplomak/a_diplomak_page.php">Diplomák</a>
                        <a href="/etr/role/admin/ertesitesek/a_ertesitesek_page.php">Értestések</a>
                        <a href="/etr/role/admin/forumok/a_forumok_page.php">Fórumok</a>
                        <a href="/etr/role/admin/karok/a_karok_page.php">Karok</a>
                        <a href="/etr/role/admin/szakok/a_szakok_page.php">Szakok</a>
                        <a href="/etr/role/admin/oktatok/a_oktatok_page.php">Oktatók</a>
                        <a href="/etr/role/admin/orak/a_orak_page.php">Órák</a>
                        <a href="/etr/role/admin/kurzusok/a_kurzusok_page.php">Kurzusok</a>
                        <a href="/etr/role/admin/termek/a_termek_page.php">Termek</a>
                        <a href="/etr/role/admin/vizsgak/a_vizsgak_page.php">Vizsgák</a>
                    </div>
                </div></li>
            <li<?php if(end($page)==="a_kapcsolat_page.php" ) { echo " class=\"active\""; } ?>><div class="dropdown">
                    <button class="dropbtn">Kapcsolati
                    </button>
                    <div class="dropdown-content">
                        <a href="/etr/role/admin/kapcsolati/a_kapcsolat_page.php?value=Hallgato_Diploma">Hallgato_Diploma</a>
                        <a href="/etr/role/admin/kapcsolati/a_kapcsolat_page.php?value=Hallgato_Ertesites">Hallgato_Ertesites</a>
                        <a href="/etr/role/admin/kapcsolati/a_kapcsolat_page.php?value=Hallgato_Forum">Hallgato_Forum</a>
                        <a href="/etr/role/admin/kapcsolati/a_kapcsolat_page.php?value=Hallgato_Ora">Hallgato_Ora</a>
                        <a href="/etr/role/admin/kapcsolati/a_kapcsolat_page.php?value=Hallgato_Szak">Hallgato_Szak</a>
                        <a href="/etr/role/admin/kapcsolati/a_kapcsolat_page.php?value=Kuzus_Forum">Kuzus_Forum</a>
                        <a href="/etr/role/admin/kapcsolati/a_kapcsolat_page.php?value=Kuzus_Oktato">Kuzus_Oktato</a>
                        <a href="/etr/role/admin/kapcsolati/a_kapcsolat_page.php?value=Kuzus_Ora">Kuzus_Ora</a>
                        <a href="/etr/role/admin/kapcsolati/a_kapcsolat_page.php?value=Kuzus_Szak">Kuzus_Szak</a>
                        <a href="/etr/role/admin/kapcsolati/a_kapcsolat_page.php?value=Kuzus_Terem">Kuzus_Terem</a>
                        <a href="/etr/role/admin/kapcsolati/a_kapcsolat_page.php?value=Kuzus_Vizsga">Kuzus_Vizsga</a>
                        <a href="/etr/role/admin/kapcsolati/a_kapcsolat_page.php?value=Oktato_Forum">Oktato_Forum</a>
                        <a href="/etr/role/admin/kapcsolati/a_kapcsolat_page.php?value=Oktato_Kar">Oktato_Kar</a>
                        <a href="/etr/role/admin/kapcsolati/a_kapcsolat_page.php?value=Oktato_Ora">Oktato_Ora</a>
                        <a href="/etr/role/admin/kapcsolati/a_kapcsolat_page.php?value=Szak_Diploma">Szak_Diploma</a>
                        <a href="/etr/role/admin/kapcsolati/a_kapcsolat_page.php?value=Szak_Kar">Szak_Kar</a>
                    </div>
                </div></li>
        <?php } else ?>

<!-- HALLGATO --------------------------------------------------------------------------------------------------------->
        <?php  if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'hallgato' ){ ?>

            <li<?php if(end($page)==="szinter_page.php" || end($page)==="h_ertesites_page.php")    { echo " class=\"active\""; } ?>><div class="dropdown">
                    <button class="dropbtn">Kezdőlap
                    </button>
                    <div class="dropdown-content">
                        <a href="/etr/szinter/szinter_page.php">Szintér</a>
                        <a href="/etr/role/hallgato/ertesites/h_ertesites_page.php">Értesítések</a>
                    </div>
                </div>
            </li>
            <li<?php if(end($page)==="kijelentkezes.php")   { echo " class=\"active\""; } ?>><a href="/etr/be_kijelentkezes/kijelentkezes.php"> Kijelentkezés</a></li>

            <li<?php if(end($page)==="h_adatok_page.php")   { echo " class=\"active\""; } ?>><a href="/etr/role/hallgato/adatok/h_adatok_page.php"> Adatok</a></li>
            <li<?php if(end($page)==="h_kurzus_page.php" || end($page)==="h_kurzus_felvetel_page.php"
                || end($page)==="h_selected_kurzus_felvetel.php" || end($page)==="h_selected_kurzus_ora.php"
                || end($page)==="h_kurzus_leadas.php")   { echo " class=\"active\""; } ?>><div class="dropdown">
                    <button class="dropbtn">Kurzusok
                    </button>
                    <div class="dropdown-content">
                        <a href="/etr/role/hallgato/kurzusok/h_kurzus_page.php">Kurzusaim</a>
                        <a href="/etr/role/hallgato/kurzus_felvetel/h_kurzus_felvetel_page.php">Kurzus felvétel</a>
                    </div>
                </div>
            </li>
            <li<?php if(end($page)==="h_orarend_page.php")   { echo " class=\"active\""; } ?>><a href="/etr/role/hallgato/orarend/h_orarend_page.php"> Órarend</a></li>
            <li<?php if(end($page)==="h_vizsga_page.php")   { echo " class=\"active\""; } ?>><a href="/etr/role/hallgato/vizsgak/h_vizsga_page.php"> Vizsgák</a></li>
            <li<?php if(end($page)==="a_select_page.php")   { echo " class=\"active\""; } ?>><a href="/etr/role/hallgato/select/a_select_page.php"> Statisztikák</a></li>

        <?php } else ?>

<!-- OKTATO ----------------------------------------------------------------------------------------------------------->
        <?php if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'oktato' ){ ?>
            <li<?php if(end($page)==="o_szinter_page.php" )    { echo " class=\"active\""; } ?>><a href="/etr/role/oktato/szinter/o_szinter_page.php">Kezdőlap</a></li>
            <li<?php if(end($page)==="kijelentkezes.php")   { echo " class=\"active\""; } ?>><a href="/etr/be_kijelentkezes/kijelentkezes.php"> Kijelentkezés</a></li>

            <li<?php if(end($page)==="o_kurzus_page.php")   { echo " class=\"active\""; } ?>><a href="/etr/role/oktato/kurzusok/o_kurzus_page.php">Kurzusok</a></li>
            <li<?php if(end($page)==="o_orarend_page.php")   { echo " class=\"active\""; } ?>><a href="/etr/role/oktato/orarend/o_orarend_page.php">Órarend</a></li>
            <li<?php if(end($page)==="o_vizsga_page.php")   { echo " class=\"active\""; } ?>><a href="/etr/role/oktato/vizsgak/o_vizsga_page.php">Vizsgák</a></li>
        <?php } else if(!isset($_SESSION["felhasznalo"])){ ?>
            <li<?php if(end($page)==="belepes_page.php")   { echo " class=\"active\""; } ?>><a href="/etr/be_kijelentkezes/belepes_page.php"> Bejelentkezés</a></li>
        <?php } ?>

    </ul>
</div>
