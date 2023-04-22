<?php

if (isset($_GET['value'])) {
    $value = $_GET['value'];

    $del = 'DELETE "Hallgato" WHERE HALLGATO_ID='. $value;

    include_once('../../../functions/functions.php');

    excecute($del);
    header("Location: a_felhasznalok_page.php");
}
?>