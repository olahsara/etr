<?php
session_start();
include_once('../../../functions/functions.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_POST['kurzus_nev'].' leadása'; ?></title>
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
    <div id="alcim"> Biztos hogy leadod a(z) <?php echo $_POST["kurzus_nev"]; ?> kurzust? </div>
        <form action="h_lead.php" method="POST">
            <input type="hidden" name="kurzus_nev" value="<?php echo $_POST['kurzus_nev']; ?>">
            <input type="hidden" name="kurzus_id" value="<?php echo $_POST['kurzus_id']; ?>">
            <input class="button" type="submit" value="Leadás">
        </form>
    <?php
    ?>

</div>
        </div>
    </div>
</div>
</body>
</html>


