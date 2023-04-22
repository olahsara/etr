<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'&&isset($_GET['value'])) {
    $NAP = $_POST['NAP'];
    $ORA = $_POST['ORA'];
    $value = $_GET['value'];

    $mod = 'UPDATE "Ora" '."SET NAP='".$NAP.   "', ORA='".$ORA.    "' WHERE ".'ORA_ID ='. $value;

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_orak_page.php");
}
?>
