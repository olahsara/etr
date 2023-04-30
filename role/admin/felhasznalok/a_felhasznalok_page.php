<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Felhasználók</title>
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
<!-- MENU -->
<!--<div class="menu">-->
<!--    <ul>-->
<!--        <li><a  href="../../../szinter/szinter_page.php">Kezdőlap</a></li>-->
<!--        --><?php //if(isset($_SESSION["felhasznalo"]) ){ ?>
<!--            <li><a href="../../../be_kijelentkezes/kijelentkezes.php">Kijelentkezés</a></li>-->
<!--        --><?php //} else { ?>
<!--            <li><a href="../../../be_kijelentkezes/belepes_page.php">Bejelentkezés</a></li>-->
<!--        --><?php //}?>
<!--        --><?php //if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'admin' ){ ?>
<!--            <li><div class="dropdown">-->
<!--                    <button class="dropbtn">Adatmódostás-->
<!--                    </button>-->
<!--                    <div class="dropdown-content">-->
<!--                        <a href="../felhasznalok/a_felhasznalok_page.php">Felhasználó</a>-->
<!--                        <a href="../diplomak/a_diplomak_page.php">Diplomák</a>-->
<!--                        <a href="../ertesitesek/a_ertesitesek_page.php">Értestések</a>-->
<!--                        <a href="../forumok/a_forumok_page.php">Fórumok</a>-->
<!--                        <a href="../karok/a_karok_page.php">Karok</a>-->
<!--                        <a href="../szakok/a_szakok_page.php">Szakok</a>-->
<!--                        <a href="../oktatok/a_oktatok_page.php">Oktatók</a>-->
<!--                        <a href="../orak/a_orak_page.php">Órák</a>-->
<!--                        <a href="../kurzusok/a_kurzusok_page.php">Kurzusok</a>-->
<!--                        <a href="../termek/a_termek_page.php">Termek</a>-->
<!--                        <a href="../vizsgak/a_vizsgak_page.php">Vizsgák</a>-->
<!--                    </div>-->
<!--                </div></li>-->
<!--        --><?php //} ?>
<!--    </ul>-->
<!--</div>-->

<!-- TODO: felhasználók megjelenítése és kezelése (admin)-->
<div style="margin-top: 100px">
<?php if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'admin' ){

    include_once('../../../functions/functions.php');

    $select = 'SELECT HALLGATO_ID as "ID", HALLGATO_NEV as "Nev", JELSZO as "Jelszo",FELEV as "Felev", NEPTUN_KOD as "Neptun-kod"
FROM "Hallgato"';

    $params = lekerdez($select);

    echo '<table> <tr> <th>Hallgato ID</th> <th>Hallgato Nev</th> <th>Hallgato Jelszo</th> <th>Hallgato Felev</th> <th>Hallgato Neptun-kod</th> <th>Hallgato Adatainak módositasa</th> </tr>';

    echo ('<form action="a_felhasznalo_add.php" method="post">
                                        <tr>
                                            <td>Új Felhasználó</td>
                                            <td>
                                                <input type="text" name="nev" id="nev" >
                                            </td>
                                            <td>
                                                <input type="text" name="jelszo" id="jelszo" >
                                            </td>
                                            <td>
                                                <input type="text" name="felev" id="felev" >
                                            </td>
                                            <td>
                                                <input type="text" name="neptunk" id="neptunk" >
                                            </td>
                                            <td>
                                                <input class="submit" type="submit" value="Add User">
                                            </td>
                                            </tr>
                                    </form>');

    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo sprintf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><a href="a_mod_del_user.php?value=' . urlencode($record['ID']) . '">Adatok módostása/törlése</a></td></tr>', $record['ID'], $record['Nev'], $record['Jelszo'], $record['Felev'], $record['Neptun-kod']);
    }



    echo '</table>';

    close($params[0], $params[1]);
    ?>

<?php } ?>
</div>
        </div>
    </div>
</div>
</body>
</html>