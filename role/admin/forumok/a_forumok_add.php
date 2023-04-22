<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $IDOPONT = $_POST['IDOPONT'];
    $UZENET = $_POST['UZENET'];

    $mod = 'INSERT INTO "Forum" (UZENET_IDOPONT, UZENET)  VALUES'." ( TO_DATE('".$IDOPONT.  "', 'YYYY-MM-DD'),'".$UZENET."'  )";

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_forumok_page.php");
}
?>