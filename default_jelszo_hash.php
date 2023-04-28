<?php
include_once('functions/functions.php');

$jelszo = "admin";
$jelszo = password_hash($jelszo, PASSWORD_DEFAULT);

$mod = 'UPDATE "Admin"' . " SET JELSZO = '" . $jelszo . "'";



excecute($mod);

//===============================================================================================

$jelszo = "hallgato";
$jelszo = password_hash($jelszo, PASSWORD_DEFAULT);

$mod = 'UPDATE "Hallgato"' . " SET JELSZO = '" . $jelszo . "'";

excecute($mod);

//===============================================================================================

$jelszo = "oktato";
$jelszo = password_hash($jelszo, PASSWORD_DEFAULT);

$mod = 'UPDATE "Oktato"' . " SET JELSZO = '" . $jelszo . "'";

excecute($mod);


