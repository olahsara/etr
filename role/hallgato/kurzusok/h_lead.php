<?php
session_start();
include_once('../../../functions/functions.php');

//  TODO: értesítés küldése kurzus leadása után

$delete = 'DELETE FROM ADATB."Hallgato_Ora" WHERE ADATB."Hallgato_Ora"."ho_Ora_id" = 
           (SELECT ADATB."Ora"."ORA_ID"
            FROM ADATB."Kuzus_Ora", ADATB."Hallgato_Ora", ADATB."Hallgato", ADATB."Kurzus", ADATB."Ora"
            WHERE ADATB."Kuzus_Ora"."ko_Kurzus_id" = ADATB."Kurzus".KURZUS_ID AND ADATB."Kuzus_Ora"."ko_Ora_id" = ADATB."Ora".ORA_ID
            AND ADATB."Hallgato".HALLGATO_ID = ADATB."Hallgato_Ora"."ho_Hallgato_id" AND ADATB."Ora".ORA_ID = ADATB."Hallgato_Ora"."ho_Ora_id"
            AND ADATB."Hallgato".HALLGATO_ID ='.$_SESSION["felhasznalo"]["id"].' 
            AND ADATB."Kurzus".KURZUS_ID ='.$_POST["kurzus_id"].') 
            AND ADATB."Hallgato_Ora"."ho_Hallgato_id" ='.$_SESSION["felhasznalo"]["id"];

$params = lekerdez($delete);

oci_commit($params[1]);

close($params[0], $params[1]);

$delete = 'DELETE FROM ADATB."Hallgato_Kurzus" WHERE ADATB."Hallgato_Kurzus"."hk_Kurzus_id" = '.$_POST["kurzus_id"].'
           AND ADATB."Hallgato_Kurzus"."hk_Hallgato_id" ='.$_SESSION["felhasznalo"]["id"];

$params = lekerdez($delete);

oci_commit($params[1]);

close($params[0], $params[1]);

header("h_kurzus_page.php");

