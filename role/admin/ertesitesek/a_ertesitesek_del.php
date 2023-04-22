<?php

if (isset($_GET['value'])) {
    $value = $_GET['value'];

    $del = 'DELETE "Ertesites" WHERE ERTESITES_ID='. $value;

    include_once('../../../functions/functions.php');

    excecute($del);
    header("Location: a_ertesitesek_page.php");
}
?>