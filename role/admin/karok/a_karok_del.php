<?php

if (isset($_GET['value'])) {
    $value = $_GET['value'];

    $del = 'DELETE "Kar" WHERE KAR_ID='. $value;

    include_once('../../../functions/functions.php');

    excecute($del);
    header("Location: a_karok_page.php");
}
?>