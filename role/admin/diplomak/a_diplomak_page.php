<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Diplomák</title>
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
<?php if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'admin' ){

    include_once('../../../functions/functions.php');

    $select = 'SELECT DIPLOMA_ID as "ID", ZV_JEGY , VEGZES_EVE , KREDIT
                FROM "Diploma"';

    $params = lekerdez($select);

    echo '<table> <tr> <th>Diploma ID</th> <th>Diploma Zv Jegy</th> <th>Diploma Vegzes Eve</th> <th>Diploma Kredit</th> <th>Diploma Adatainak módositasa</th> </tr>';

    echo ('<form action="a_diplomak_add.php" method="post">
                                        <tr>
                                            <td>Új Diploma</td>
                                            <td>
                                                <input type="text" name="ZV" id="ZV" >
                                            </td>
                                            
                                            <td>
                                                <input type="text" name="Vegzes" id="Vegzes" >
                                            </td>
                                            <td>
                                                <input type="text" name="Kredit" id="Kredit" >
                                            </td>
                                            <td>
                                                <input class="submit" type="submit" value="Add Diploma">
                                            </td>
                                            </tr>
                                    </form>');

    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo sprintf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><a href="a_mod_del_diplomak.php?value=' . urlencode($record['ID']) . '">Adatok módostása/törlése</a></td></tr>', $record['ID'], $record['ZV_JEGY'], $record['VEGZES_EVE'], $record['KREDIT']);
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