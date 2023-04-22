<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $IDOPONT = $_POST['IDOPONT'];

    $mod = 'INSERT INTO "Vizsga" (VIZSGA_IDOPONT)  VALUES'." ( TO_DATE('".$IDOPONT.  "', 'YYYY-MM-DD'))";

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_vizsgak_page.php");
}
?>