<?php

if (isset($_GET['value'])) {
    $value = $_GET['value'];

    $del = 'DELETE "Ora" WHERE ORA_ID='. $value;

    include_once('../../../functions/functions.php');

    excecute($del);
    header("Location: a_orak_page.php");
}
?>