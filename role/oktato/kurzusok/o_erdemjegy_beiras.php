<?php
include_once('../../../functions/functions.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $HALLGATO_ID = $_POST['hallgato-id'];
    $KURZUS_ID = $_POST['kurzus-id'];
    $ERDEM_JEGY = $_POST['uj-erdemjegy'];

    $mod = 'UPDATE ADATB."Hallgato_Kurzus" SET "Erdem_jegy" = \'' . $ERDEM_JEGY . '\' WHERE "hk_Hallgato_id" = ' . $HALLGATO_ID . ' AND "hk_Kurzus_id" = ' . $KURZUS_ID;


    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: o_kurzus_page.php");
}


?>
