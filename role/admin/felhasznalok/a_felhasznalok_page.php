<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Felhasználók</title>
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

<!-- TODO: felhasználók megjelenítése és kezelése (admin)-->
<div style="margin-top: 100px">
<?php if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'admin' ){

    include_once('../../../functions/functions.php');

    $select = 'SELECT HALLGATO_ID as "ID", HALLGATO_NEV as "Nev", JELSZO as "Jelszo",FELEV as "Felev", NEPTUN_KOD as "Neptun-kod"
FROM "Hallgato"';

    $params = lekerdez($select);

    echo '<table> <tr> <th>Hallgato ID</th> <th>Hallgato Nev</th> <th>Hallgato Jelszo</th> <th>Hallgato Felev</th> <th>Hallgato Neptun-kod</th> <th>Hallgato Adatainak módositasa</th> </tr>';

    echo printf('<form action="a_felhasznalo_add.php" method="post">
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
                                                <input type="submit" value="Add User">
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
</body>
</html>