<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'&&isset($_GET['value'])) {
    $KAR_NEV = $_POST['KAR_NEV'];
    $KAR_KOD = $_POST['KAR_KOD'];
    $value = $_GET['value'];

    $mod = 'UPDATE "Szak" '."SET SZAK_NEV='".$KAR_NEV.   "', SZAK_KOD='".$KAR_KOD.    "' WHERE ".'SZAK_ID ='. $value;

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_szakok_page.php");
}
?>
