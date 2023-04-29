<?php
session_start();
include_once('../../../functions/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vizsgáról hallgató törlése</title>
    <link rel="stylesheet" href="../../../style/menu.css"/>
</head>
<body>
<!-- MENU -->
<div class="menu">
    <ul>
        <li><a href="../szinter/o_szinter_page.php">Kezdőlap</a></li>
        <?php if(isset($_SESSION["felhasznalo"]) ){ ?>
            <li><a href="../../../be_kijelentkezes/kijelentkezes.php">Kijelentkezés</a></li>
        <?php } else { ?>
            <li><a href="../../../be_kijelentkezes/belepes_page.php">Bejelentkezés</a></li>
        <?php }?>
        <?php if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'oktato' ){ ?>
            <li><a href="../kurzusok/o_kurzus_page.php">Kurzusok</a></li>
            <li><a href="../orarend/o_orarend_page.php">Órarend</a></li>
            <li><a class="active" href="../vizsgak/o_vizsga_page.php">Vizsgák</a></li>
        <?php } ?>
    </ul>

    <div class="adatok">
        <div id="alcim"> Biztos hogy törölni szeretnéd  <?php echo $_POST["hallgato-nev"]; ?> hallgatót a vizsgaalkalomról? </div>
        <form action="o_vizsgarol_torles.php" method="POST">
            <input type="hidden" name="hallgato-nev" value="<?php echo $_POST['hallgato-id']; ?>">
            <input type="hidden" name="vizsga-id" value="<?php echo $_POST['vizsga-id']; ?>">
            <input class="button" type="submit" value="Törlés">
        </form>
        <?php
        ?>

    </div>

</body>
</html>


