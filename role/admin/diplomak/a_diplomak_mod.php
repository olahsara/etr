<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'&&isset($_GET['value'])) {
    $ZV = $_POST['ZV'];
    $Vegzes = $_POST['Vegzes'];
    $Kredit = $_POST['Kredit'];
    $value = $_GET['value'];

    $mod = 'UPDATE "Diploma" '."SET ZV_JEGY='".$ZV.  "', VEGZES_EVE='".$Vegzes.   "', KREDIT='".$Kredit."' WHERE ".'DIPLOMA_ID ='. $value;

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_diplomak_page.php");
}
?>
