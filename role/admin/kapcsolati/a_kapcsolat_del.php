<?php

if (isset($_GET['tabla'])) {
    $masodik_oszlop = $_GET['masodik_oszlop'];
    $masodik_ertek = $_GET['masodik_ertek'];
    $elso_ertek = $_GET['elso_ertek'];
    $tabla = $_GET['tabla'];
    $elso_oszlop = $_GET['elso_oszlop'];

    $del = 'DELETE FROM "'.$tabla.'" WHERE "'.$elso_oszlop.'"='.$elso_ertek.' AND "'.$masodik_oszlop.'"='.$masodik_ertek;
    include_once('../../../functions/functions.php');

    excecute($del);
    header("Location: a_kapcsolat_page.php?value=".$tabla);
}
?>