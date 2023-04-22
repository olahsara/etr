<?php

if (isset($_GET['value'])) {
    $value = $_GET['value'];

    $del = 'DELETE "Kurzus" WHERE KURZUS_ID='. $value;

    include_once('../../../functions/functions.php');

    excecute($del);
    header("Location: a_kurzusok_page.php");
}
?>