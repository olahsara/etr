<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'&&isset($_GET['value'])) {
    $IDOPONT = $_POST['IDOPONT'];
    $UZENET = $_POST['UZENET'];
    $value = $_GET['value'];

    $mod = 'UPDATE "Forum" '."SET UZENET_IDOPONT="." TO_DATE('".$IDOPONT.  "', 'YYYY-MM-DD'), ".   "UZENET='".$UZENET.    "' WHERE ".'UZENET_ID ='. $value;

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_forumok_page.php");
}
?>
