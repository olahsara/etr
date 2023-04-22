<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vizsga</title>
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

    include_once('../../../functions/functions.php');

    $select = 'SELECT VIZSGA_ID as "ID", VIZSGA_IDOPONT
                FROM "Vizsga"';

    $params = lekerdez($select);

    echo '<table> <tr> <th>Vizsga ID</th> <th>Vizsga Idopont</th>  <th>Vizsga Adatainak módositasa</th> </tr>';

    echo printf('<form action="a_vizsgak_add.php" method="post">
                                        <tr>
                                            <td>Új Vizsga</td>
                                            <td>
                                                <input type="date" name="IDOPONT" id="IDOPONT" >
                                            </td>
                                            
                                            <td>
                                                <input class="submit" type="submit" value="Add Vizsga">
                                            </td>
                                            </tr>
                                    </form>');

    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo sprintf('<tr><td>%s</td><td>%s</td><td><a href="a_mod_del_vizsgak.php?value=' . urlencode($record['ID']) . '">Adatok módostása/törlése</a></td></tr>', $record['ID'], $record['VIZSGA_IDOPONT']);
    }



    echo '</table>';

    close($params[0], $params[1]);
    ?>

<?php } ?>
</div>
</body>
</html>