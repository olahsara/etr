<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'&&isset($_GET['value'])) {
    $OKTATO_NEV = $_POST['OKTATO_NEV'];
    $JELSZO = $_POST['JELSZO'];
    $JELSZO = password_hash($JELSZO, PASSWORD_DEFAULT);
    $BEOSZTAS = $_POST['BEOSZTAS'];
    $NEPTUN_KOD = $_POST['NEPTUN_KOD'];
    $value = $_GET['value'];

    $mod = 'UPDATE "Oktato" '."SET OKTATO_NEV='".$OKTATO_NEV.   "', JELSZO='".$JELSZO."', BEOSZTAS='".$BEOSZTAS."', NEPTUN_KOD='".$NEPTUN_KOD.    "' WHERE ".'OKTATO_ID ='. $value;

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_oktatok_page.php");
}
?>
