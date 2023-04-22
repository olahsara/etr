<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nev = $_POST['nev'];
    $jelszo = $_POST['jelszo'];
    $felev = $_POST['felev'];
    $neptunk = $_POST['neptunk'];

    $mod = 'INSERT INTO "Hallgato" (HALLGATO_NEV, JELSZO, FELEV, NEPTUN_KOD)  VALUES'." ( '".$nev."','".$jelszo."','".$felev."','".$neptunk."')";

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_felhasznalok_page.php");
}
?>