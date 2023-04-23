<?php
//-----------------------------------------------------------------------------
//  Ha felvesz a hallgató egy kurzust bekerül egy új rekord a:               ||
//      -Hallgato-Kurzus-ba:                                                 ||
//          session-ben lévő hallgató id-je, kiválasztott kurzus id-je       ||
//      -Hallgato-Ora-ba:                                                    ||
//          session-ben lévő hallgató id-je, kiválasztott időpont ora id-je  ||
//-----------------------------------------------------------------------------

//  TODO: értesítés küldése kurzus felvétele utáng

session_start();
include_once('../../../functions/functions.php');

$insert= 'INSERT INTO "Hallgato_Kurzus" ("hk_Hallgato_id", "hk_Kurzus_id") 
          VALUES ('.$_SESSION["felhasznalo"]["id"].','.$_POST["kurzus_id"].')';
$params = lekerdez($insert); //$params[0] = $stid, $params[1] = $conn

oci_commit($params[1]);

close($params[0], $params[1]);

$insert2= 'INSERT INTO "Hallgato_Ora" ("ho_Hallgato_id", "ho_Ora_id") 
           VALUES ('.$_SESSION["felhasznalo"]["id"].','.$_POST["kurzus_id"].')';
$params2 = lekerdez($insert2);

oci_commit($params2[1]);

close($params2[0], $params2[1]);

header("h_kurzus_page.php");