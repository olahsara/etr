<?php

if (isset($_GET['value'])) {
    $value = $_GET['value'];

    $del = 'DELETE "Oktato" WHERE OKTATO_ID='. $value;

    include_once('../../../functions/functions.php');

    excecute($del);
    header("Location: a_oktatok_page.php");
}
?>