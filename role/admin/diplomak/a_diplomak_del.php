<?php

if (isset($_GET['value'])) {
    $value = $_GET['value'];

    $del = 'DELETE "Diploma" WHERE DIPLOMA_ID='. $value;

    include_once('../../../functions/functions.php');

    excecute($del);
    header("Location: a_diplomak_page.php");
}
?>