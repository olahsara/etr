<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'&&isset($_GET['value'])) {
    $IDOPONT = $_POST['IDOPONT'];
    $value = $_GET['value'];

    $mod = 'UPDATE "Vizsga" '."SET VIZSGA_IDOPONT= TO_DATE('".$IDOPONT."', 'YYYY-MM-DD') WHERE VIZSGA_ID =". $value;

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_vizsgak_page.php");
}
?>
