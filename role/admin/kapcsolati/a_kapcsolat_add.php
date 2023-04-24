<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $masodik_oszlop = $_GET['masodik_oszlop'];
    $elso_oszlop = $_GET['elso_oszlop'];
    $tabla = $_GET['tabla'];
    $elso = $_POST['elso'];
    $masodik = $_POST['masodik'];

    $mod = 'INSERT INTO "'.$tabla.'" ("'.$elso_oszlop.'","'.$masodik_oszlop.'") VALUES'."(".$elso.",".$masodik.")";
    print $mod;
    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_kapcsolat_page.php?value=".$tabla);
}
?>