<?php

if (isset($_GET['value'])) {
    $value = $_GET['value'];

    $del = 'DELETE "Vizsga" WHERE VIZSGA_ID='. $value;

    include_once('../../../functions/functions.php');

    excecute($del);
    header("Location: a_vizsgak_page.php");
}
?>