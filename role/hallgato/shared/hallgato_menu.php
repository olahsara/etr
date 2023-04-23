<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../style/menu.css"/>
    <title></title>
</head>
<?php
$page = explode('/',$_SERVER['PHP_SELF']);

?>
<div class="menu">
    <ul>
        <li<?php if(end($page)==="szinter_page.php" || end($page)==="h_ertesites_page.php")    { echo " class=\"active\""; } ?>><div class="dropdown">
                <button class="dropbtn">Kezdőlap
                </button>
                <div class="dropdown-content">
                    <a href="../../../szinter/szinter_page.php">Szintér</a>
                    <a href="../ertesites/h_ertesites_page.php">Értesítések</a>
                </div>
            </div>
        </li>
        <?php if(isset($_SESSION["felhasznalo"]) ){ ?>
            <li<?php if(end($page)==="kijelentkezes.php")   { echo " class=\"active\""; } ?>><a href="../../../be_kijelentkezes/kijelentkezes.php"> Kijelentkezés</a></li>
        <?php } else { ?>
            <li<?php if(end($page)==="belepes_page.php")   { echo " class=\"active\""; } ?>><a href="../../../be_kijelentkezes/belepes_page.php"> Bejelentkezés</a></li>
        <?php }?>
        <?php if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'hallgato' ){ ?>
            <li<?php if(end($page)==="h_adatok_page.php")   { echo " class=\"active\""; } ?>><a href="../adatok/h_adatok_page.php"> Adatok</a></li>
            <li<?php if(end($page)==="h_kurzus_page.php" || end($page)==="h_kurzus_felvetel_page.php"
                     || end($page)==="h_selected_kurzus_felvetel.php" || end($page)==="h_selected_kurzus_ora.php"
                     || end($page)==="h_kurzus_leadas.php")   { echo " class=\"active\""; } ?>><div class="dropdown">
                    <button class="dropbtn">Kurzusok
                    </button>
                    <div class="dropdown-content">
                        <a href="../kurzusok/h_kurzus_page.php">Kurzusaim</a>
                        <a href="../kurzus_felvetel/h_kurzus_felvetel_page.php">Kurzus felvétel</a>
                    </div>
                </div>
            </li>
            <li<?php if(end($page)==="h_orarend_page.php")   { echo " class=\"active\""; } ?>><a href="../orarend/h_orarend_page.php"> Órarend</a></li>
            <li<?php if(end($page)==="h_vizsga_page.php")   { echo " class=\"active\""; } ?>><a href="../vizsgak/h_vizsga_page.php"> Vizsgák</a></li>
        <?php } ?>
    </ul>
</div>
