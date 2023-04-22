<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $KURZUS_KOD = $_POST['KURZUS_KOD'];
    $KURZUS_NEV = $_POST['KURZUS_NEV'];
    $AJANLOTT_FELEV = $_POST['AJANLOTT_FELEV'];
    $KREDIT = $_POST['KREDIT'];
    $ORASZAM = $_POST['ORASZAM'];
    $MEGNYITVA = $_POST['MEGNYITVA'];

    $mod = 'INSERT INTO "Kurzus" (KURZUS_KOD, KURZUS_NEV, AJANLOTT_FELEV, KREDIT, ORASZAM, MEGNYITVA)  VALUES'." ( '".$KURZUS_KOD.  "','".$KURZUS_NEV. "','".$AJANLOTT_FELEV. "','".$KREDIT. "','".$ORASZAM. "','".$MEGNYITVA.   "'  )";

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_kurzusok_page.php");
}
?>