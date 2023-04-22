<?php
session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Felhasználók módosit</title>
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
            <li><div class="dropdown">
                <button class="dropbtn">Adatmódostás
                </button>
                <div class="dropdown-content">
                    <a href="a_felhasznalok_page.php">Felhasználó</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
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

            $select = 'SELECT HALLGATO_ID as "ID", HALLGATO_NEV as "Nev", JELSZO as "Jelszo",FELEV as "Felev", NEPTUN_KOD as "Neptun-kod"
                        FROM "Hallgato"
                        WHERE HALLGATO_ID=' . $value;

            $params = lekerdez($select);

            echo '<table> <tr> <th>Hallgato ID</th> <th>Hallgato Nev</th> <th>Hallgato Jelszo</th> <th>Hallgato Felev</th> <th>Hallgato Neptun-kod</th> <th>Hallgato Adatainak módositasa</th> </tr>';
            while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {

                echo sprintf('
                                    <form action="a_felhasznalo_mod.php?value=' . urlencode($record['ID']) . '" method="post">
                                        <tr>
                                            <td>%s</td>
                                            <td>
                                                <input type="text" name="nev" id="nev" value=%s>
                                            </td>
                                            <td>
                                                <input type="text" name="jelszo" id="jelszo" value=%s>
                                            </td>
                                            <td>
                                                <input type="text" name="felev" id="felev" value=%s>
                                            </td>
                                            <td>
                                                <input type="text" name="neptunk" id="neptunk" value=%s>
                                            </td>
                                            <td>
                                                <input type="submit" value="Update User">
                                                <a href="a_felhasznalo_del.php?value=' . urlencode($record['ID']) . '">Delete User</a>
                                            </td>
                                            </tr>
                                    </form>', $record['ID'], $record['Nev'], $record['Jelszo'], $record['Felev'], $record['Neptun-kod']);
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
