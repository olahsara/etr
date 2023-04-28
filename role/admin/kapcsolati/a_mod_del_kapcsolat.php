<?php
session_start();
?>
<?php
$tabla = "Hallgato_Diploma";
$elso_oszlop = "hd_Hallgato_id";
$masodik_oszlop = "hd_Diploma_id";
$elso_ertek = "9";
$masodik_ertek = "1";

if (isset($_GET['tabla'])) {
    $tabla = $_GET['tabla'];
    $elso_oszlop = $_GET['elso'];
    $masodik_oszlop = $_GET['masodik'];
    $elso_ertek = $_GET['harmadik'];
    $masodik_ertek = $_GET['negyedik'];
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?PHP echo $tabla;?> módosit</title>
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


        if (isset($_GET['tabla'])) {

            include_once('../../../functions/functions.php');

            echo '<table><tr><th> '.$elso_oszlop.' </th><th>'.$masodik_oszlop.'</th><th></th></tr>';

                echo sprintf('
                                    <form action="a_kapcsolat_mod.php?tabla='.$tabla.'&elso_ertek='.$elso_ertek.'&masodik_ertek='.$masodik_ertek.'&elso_oszlop='.$elso_oszlop.'&masodik_oszlop='.$masodik_oszlop.'" method="post">
                                        <tr>
                                            
                                        
                                            <td>
                                                <input type="text" name="elso" id="elso" value="%s">
                                            </td>
                                            <td>
                                                <input type="text" name="masodik" id="masodik" value="%s">
                                            </td>
                                            
                                            <td>
                                                <input class="submit" type="submit" value="Update">
                                                <a href="a_kapcsolat_del.php?tabla='.$tabla.'&elso_ertek='.$elso_ertek.'&masodik_ertek='.$masodik_ertek.'&elso_oszlop='.$elso_oszlop.'&masodik_oszlop='.$masodik_oszlop.'">Delete</a>
                                            </td>
                                        </tr>
                                    </form>', $elso_ertek, $masodik_ertek);
            }
            echo '</table>';




        } else {
            echo 'Nem tudom hogy jutottal ide de nem kellet volna :/';
        }


        ?>



</body>
</html>
