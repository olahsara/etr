<?php
include_once('../../../functions/functions.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $HALLGATO_ID = $_POST['valasztotthallgato'];
    $KURZUS_ID = $_POST['valasztottkurzus'];

    $mod = 'INSERT INTO ADATB."Hallgato_Kurzus" ("hk_Hallgato_id", "hk_Kurzus_id") VALUES'." ( '".$HALLGATO_ID.  "','".$KURZUS_ID."')";

    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: o_kurzus_page.php");
}


?>