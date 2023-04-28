<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'&&isset($_GET['value'])) {
    $nev = $_POST['nev'];
    $jelszo = $_POST['jelszo'];
    $jelszo = password_hash($jelszo, PASSWORD_DEFAULT);
    $felev = $_POST['felev'];
    $neptunk = $_POST['neptunk'];
    $value = $_GET['value'];

    $mod = 'UPDATE "Hallgato" '."set HALLGATO_NEV='".$nev."', JELSZO='".$jelszo."', FELEV='".$felev."', NEPTUN_KOD='".$neptunk."' WHERE ".'HALLGATO_ID ='. $value;

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_felhasznalok_page.php");
}
?>
