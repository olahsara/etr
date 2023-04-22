<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $KAR_NEV = $_POST['KAR_NEV'];
    $KAR_KOD = $_POST['KAR_KOD'];

    $mod = 'INSERT INTO "Kar" (KAR_NEV, KAR_KOD)  VALUES'." ( '".$KAR_NEV.  "','".$KAR_KOD.   "'  )";

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_karok_page.php");
}
?>