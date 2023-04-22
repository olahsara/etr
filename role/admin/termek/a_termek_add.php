<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $TEREM_NEV = $_POST['TEREM_NEV'];
    $EPULET = $_POST['EPULET'];
    $FEROHELY = $_POST['FEROHELY'];
    $GEPEK_SZAMA = $_POST['GEPEK_SZAMA'];

    $mod = 'INSERT INTO "Terem" (TEREM_NEV, EPULET, FEROHELY, GEPEK_SZAMA)  VALUES'." ( '".$TEREM_NEV.  "','".$EPULET."','".$FEROHELY."','".$GEPEK_SZAMA.   "'  )";

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_termek_page.php");
}
?>