<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'&&isset($_GET['value'])) {
    $xxx = $_POST['xxx'];
    $value = $_GET['value'];

    $mod = 'UPDATE "XXX" '."SET XXX_XXX='".$xxx.   "', XXX='".$xxx.    "' WHERE ".'XXX_ID ='. $value;

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: XXX.php");
}
?>
