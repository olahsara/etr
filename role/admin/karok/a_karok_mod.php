<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'&&isset($_GET['value'])) {
    $KAR_NEV = $_POST['KAR_NEV'];
    $KAR_KOD = $_POST['KAR_KOD'];
    $value = $_GET['value'];

    $mod = 'UPDATE "Kar" '."SET KAR_NEV='".$KAR_NEV.   "', KAR_KOD='".$KAR_KOD.    "' WHERE ".'KAR_ID ='. $value;

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_karok_page.php");
}
?>
