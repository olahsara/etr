<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ZV = $_POST['ZV'];
    $Vegzes = $_POST['Vegzes'];
    $Kredit = $_POST['Kredit'];

    $mod = 'INSERT INTO "Diploma" (ZV_JEGY, VEGZES_EVE, KREDIT)  VALUES'." ( '".$ZV."','".$Vegzes."','".$Kredit."')";

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_diplomak_page.php");
}
?>