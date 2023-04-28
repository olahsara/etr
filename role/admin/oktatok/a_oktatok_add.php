<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $OKTATO_NEV = $_POST['OKTATO_NEV'];
    $JELSZO = $_POST['JELSZO'];
    $JELSZO = password_hash($JELSZO, PASSWORD_DEFAULT);
    $BEOSZTAS = $_POST['BEOSZTAS'];
    $NEPTUN_KOD = $_POST['NEPTUN_KOD'];

    $mod = 'INSERT INTO "Oktato" (OKTATO_NEV, JELSZO, BEOSZTAS, NEPTUN_KOD)  VALUES'." ( '".$OKTATO_NEV.  "','".$JELSZO."','".$BEOSZTAS."','".$NEPTUN_KOD.   "'  )";

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_oktatok_page.php");
}
?>