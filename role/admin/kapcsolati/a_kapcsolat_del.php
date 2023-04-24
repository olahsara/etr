<?php

if (isset($_GET['value'])) {
    $value = $_GET['value'];

    $del = 'DELETE "XXX" WHERE XXX_ID='. $value;

    include_once('../../../functions/functions.php');

    excecute($del);
    header("Location: XXX.php");
}
?>