<?php

if (isset($_GET['value'])) {
    $value = $_GET['value'];

    $del = 'DELETE "Szak" WHERE SZAK_ID='. $value;

    include_once('../../../functions/functions.php');

    excecute($del);
    header("Location: a_szakok_page.php");
}
?>