<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'&&isset($_GET['value'])) {
    $KURZUS_KOD = $_POST['KURZUS_KOD'];
    $KURZUS_NEV = $_POST['KURZUS_NEV'];
    $AJANLOTT_FELEV = $_POST['AJANLOTT_FELEV'];
    $KREDIT = $_POST['KREDIT'];
    $ORASZAM = $_POST['ORASZAM'];
    $value = $_GET['value'];

    $mod = 'UPDATE "Kurzus" '."SET KURZUS_KOD='".$KURZUS_KOD.   "', KURZUS_NEV='".$KURZUS_NEV."', AJANLOTT_FELEV='".$AJANLOTT_FELEV."', KREDIT='".$KREDIT."', ORASZAM='".$ORASZAM.    "' WHERE ".'KURZUS_ID ='. $value;

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_kurzusok_page.php");
}
?>
