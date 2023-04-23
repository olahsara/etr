<?php
session_start();
include_once('../../../functions/functions.php');
include_once('../shared/hallgato_menu.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_POST['kurzus_nev'].' leadása'; ?></title>
    <link rel="stylesheet" href="../../../style/menu.css"/>
    <link rel="stylesheet" href="h_kurzus_style.css">
</head>
<body>
<div class="adatok">
    <div id="alcim"> Biztos hogy leadod a(z) <?php echo $_POST["kurzus_nev"]; ?> kurzust? </div>
        <form action="h_lead.php" method="POST">
            <input type="hidden" name="kurzus_nev" value="<?php echo $_POST['kurzus_nev']; ?>]">
            <input type="hidden" name="kurzus_id" value="<?php echo $_POST['kurzus_id']; ?>]">
            <input class="button" type="submit" value="Leadás">
        </form>
    <?php
    ?>

</div>

</body>
</html>


