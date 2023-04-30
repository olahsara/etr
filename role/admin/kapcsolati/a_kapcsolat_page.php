<?php
session_start();


$tabla = "Hallgato_Diploma";

if (isset($_GET['value'])) {
    $tabla = $_GET['value'];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?PHP $page = explode('/',$_SERVER["PHP_SELF"]); echo $page[4]?></title>
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
<!-- MENU-->
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

<div style="margin-top: 100px">
<?php if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'admin' ){

    include_once('../../../functions/functions.php');


    $select = 'SELECT * FROM "'.$tabla.'"';

    $params = lekerdez($select);
    $ures = false;
    try {
        $oszlopnevek = array_keys(oci_fetch_array($params[0]));
    } catch (TypeError $e) {
        $ures = true;
        echo "Ures a tabla kerlek adj hozza adatot manualisan az adatbazishoz!";
    }

    if (!$ures){
        $elso_tabla = explode("_",$oszlopnevek[1]);
        $elso_tabla_select = 'SELECT * FROM "'.$elso_tabla[1].'"';
        $elso_tabla_params = lekerdez($elso_tabla_select);
        $elso_tabla_oszlopnevek = array_keys(oci_fetch_array($elso_tabla_params[0]));

        $masodik_tabla = explode("_",$oszlopnevek[3]);
        $masodik_tabla_select = 'SELECT * FROM "'.$masodik_tabla[1].'"';
        $masodik_tabla_params = lekerdez($masodik_tabla_select);
        $masodik_tabla_oszlopnevek = array_keys(oci_fetch_array($masodik_tabla_params[0]));


        echo '<table> <tr> <th> </th><th>'.$oszlopnevek[1].' </th> <th>'.$oszlopnevek[3].'</th>  <th>'.$tabla.' Adatainak módositasa</th> </tr>';

        printf('<form action="a_kapcsolat_add.php?tabla='.$tabla.'&elso_oszlop='.$oszlopnevek[1].'&masodik_oszlop='.$oszlopnevek[3].'" method="post">
                                        <tr>
                                            <td>Új '.$tabla.'</td>
                                            <td>
                                                <select name="elso" id="elso">');
        while ($record = oci_fetch_array($elso_tabla_params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
                             printf('<option value="'.$record[$elso_tabla_oszlopnevek[1]].'">'.$record[$elso_tabla_oszlopnevek[1]].'</option>');
        }
                             printf('</select>
                                                
                                            </td>
                                            <td>
                                                <select name="masodik" id="masodik">');
        while ($record = oci_fetch_array($masodik_tabla_params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
            printf('<option value="'.$record[$masodik_tabla_oszlopnevek[1]].'">'.$record[$masodik_tabla_oszlopnevek[1]].'</option>');
        }
        printf('</select>
                                            </td>
                                            
                                            <td>
                                                <input class="submit" type="submit" value="Add adat">
                                            </td>
                                            </tr>
                                    </form>');
        $params = lekerdez($select);
        while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo sprintf('<tr><td></td><td>%s</td><td>%s</td><td><a 
                                href="a_mod_del_kapcsolat.php?tabla=' . urlencode($tabla) .
                '&elso='.urlencode($oszlopnevek[1]).
                '&masodik='.urlencode($oszlopnevek[3]).
                '&harmadik='.urlencode($record[$oszlopnevek[1]]).
                '&negyedik='.urlencode($record[$oszlopnevek[3]]).
                '">Adatok módostása/törlése</a></td></tr>', $record[$oszlopnevek[1]], $record[$oszlopnevek[3]]);
        }



        echo '</table>';
    }


    close($params[0], $params[1]);
    ?>

<?php } ?>
</div>
        </div>
    </div>
</div>
</body>
</html>