<?php
session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Oktato módosit</title>
    <link rel="stylesheet" href="../../../style/menu.css"/>
    <link rel="stylesheet" href="../../../style/admin_table.css"/>
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
            <li><div class="dropdown">
                    <button class="dropbtn">Adatmódostás
                    </button>
                    <div class="dropdown-content">
                        <a href="../felhasznalok/a_felhasznalok_page.php">Felhasználó</a>
                        <a href="../diplomak/a_diplomak_page.php">Diplomák</a>
                        <a href="../ertesitesek/a_ertesitesek_page.php">Értestések</a>
                        <a href="../forumok/a_forumok_page.php">Fórumok</a>
                        <a href="../karok/a_karok_page.php">Karok</a>
                        <a href="../szakok/a_szakok_page.php">Szakok</a>
                        <a href="../oktatok/a_oktatok_page.php">Oktatók</a>
                        <a href="../orak/a_orak_page.php">Órák</a>
                        <a href="../kurzusok/a_kurzusok_page.php">Kurzusok</a>
                        <a href="../termek/a_termek_page.php">Termek</a>
                        <a href="../vizsgak/a_vizsgak_page.php">Vizsgák</a>
                    </div>
                </div></li>
        <?php } ?>
    </ul>
</div>

<div style="margin-top: 100px">
    <?php if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'admin' ){


        if (isset($_GET['value'])) {
            $value = $_GET['value'];

            include_once('../../../functions/functions.php');

            $select = 'SELECT OKTATO_ID as "ID", OKTATO_NEV, JELSZO, BEOSZTAS, NEPTUN_KOD
                        FROM "Oktato"
                        WHERE OKTATO_ID=' . $value;

            $params = lekerdez($select);

            echo '<table> <tr> <th>Oktato ID</th> <th>Oktato nev</th> <th>Oktato jelszo</th> <th>Oktato beosztas</th> <th>Oktato neptun kod</th>  <th>Oktato Adatainak módositasa</th> </tr>';

            while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {

                echo sprintf('
                                    <form action="a_oktatok_mod.php?value=' . urlencode($record['ID']) . '" method="post">
                                        <tr>
                                            <td>%s</td>
                                         
                                            <td>
                                                <input type="text" name="OKTATO_NEV" id="OKTATO_NEV" value="%s">
                                            </td>
                                            <td>
                                                <input type="text" name="JELSZO" id="JELSZO" value="%s">
                                            </td>
                                            <td>
                                                <input type="text" name="BEOSZTAS" id="BEOSZTAS" value="%s">
                                            </td>
                                            <td>
                                                <input type="text" name="NEPTUN_KOD" id="NEPTUN_KOD" value="%s">
                                            </td>
                                            
                                            <td>
                                                <input class="submit" type="submit" value="Update Oktato">
                                                <a href="a_oktatok_del.php?value=' . urlencode($record['ID']) . '">Delete Oktato</a>
                                            </td>
                                            </tr>
                                    </form>', $record['ID'], $record['OKTATO_NEV'], $record['JELSZO'], $record['BEOSZTAS'], $record['NEPTUN_KOD']);
            }



            echo '</table>';


            close($params[0], $params[1]);

        } else {
            echo 'Nem tudom hogy jutottal ide de nem kellet volna :/';
        }


        ?>

    <?php } ?>

</body>
</html>
