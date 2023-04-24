<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xxx = $_POST['xxx'];

    $mod = 'INSERT INTO "XXX" (XXX)  VALUES'." ( '".$xxx.  "','".$xxx.   "'  )";

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_XXX_page.php");
}
?>