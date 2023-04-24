<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST'&&isset($_GET['tabla'])) {
    $elso = $_POST['elso'];
    $masodik = $_POST['masodik'];
    $masodik_ertek = $_GET['masodik_ertek'];
    $elso_ertek = $_GET['elso_ertek'];
    $masodik_oszlop = $_GET['masodik_oszlop'];
    $elso_oszlop = $_GET['elso_oszlop'];
    $tabla = $_GET['tabla'];

    $mod = 'UPDATE "'.$tabla.'" SET "'.$elso_oszlop.'"='.$elso.',"'.$masodik_oszlop.'"='.$masodik.' WHERE "'.$elso_oszlop.'"='.$elso_ertek.' AND "'.$masodik_oszlop.'"='.$masodik_ertek;

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_kapcsolat_page.php?value=".$tabla);
}
?>
