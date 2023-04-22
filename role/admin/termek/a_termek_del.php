<?php

if (isset($_GET['value'])) {
    $value = $_GET['value'];

    $del = 'DELETE "Terem" WHERE TEREM_ID='. $value;

    include_once('../../../functions/functions.php');

    excecute($del);
    header("Location: a_termek_page.php");
}
?>