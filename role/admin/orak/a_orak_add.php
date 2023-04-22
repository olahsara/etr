<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $NAP = $_POST['NAP'];
    $ORA = $_POST['ORA'];

    $mod = 'INSERT INTO "Ora" (NAP, ORA)  VALUES'." ( '".$NAP.  "','".$ORA.   "'  )";

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_orak_page.php");
}
?>