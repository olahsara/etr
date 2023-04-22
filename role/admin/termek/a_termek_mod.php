<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'&&isset($_GET['value'])) {
    $TEREM_NEV = $_POST['TEREM_NEV'];
    $EPULET = $_POST['EPULET'];
    $FEROHELY = $_POST['FEROHELY'];
    $GEPEK_SZAMA = $_POST['GEPEK_SZAMA'];
    $value = $_GET['value'];

    $mod = 'UPDATE "Terem" '."SET TEREM_NEV='".$TEREM_NEV.   "', EPULET='".$EPULET."', FEROHELY='".$FEROHELY."', GEPEK_SZAMA='".$GEPEK_SZAMA.    "' WHERE ".'TEREM_ID ='. $value;

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_termek_page.php");
}
?>
