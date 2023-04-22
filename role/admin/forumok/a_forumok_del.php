<?php

if (isset($_GET['value'])) {
    $value = $_GET['value'];

    $del = 'DELETE "Forum" WHERE UZENET_ID='. $value;

    include_once('../../../functions/functions.php');

    excecute($del);
    header("Location: a_forumok_page.php");
}
?>