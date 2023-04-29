<?php
session_start();
include_once('../../../functions/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vizsgáról hallgató törlése</title>
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
        </div>
    </div>
</div>
</body>
</html>


