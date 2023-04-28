<?php
session_start();
include_once('../../../functions/functions.php');
$kurzus_id = substr($_POST["kurzus_id"],0,-1);
$ora_id_select = 'SELECT ADATB."Ora"."ORA_ID"
                  FROM ADATB."Kuzus_Ora", ADATB."Hallgato_Ora", ADATB."Hallgato", ADATB."Kurzus", ADATB."Ora"
                  WHERE ADATB."Kuzus_Ora"."ko_Kurzus_id" = ADATB."Kurzus".KURZUS_ID AND ADATB."Kuzus_Ora"."ko_Ora_id" = ADATB."Ora".ORA_ID
                  AND ADATB."Hallgato".HALLGATO_ID = ADATB."Hallgato_Ora"."ho_Hallgato_id" AND ADATB."Ora".ORA_ID = ADATB."Hallgato_Ora"."ho_Ora_id"
                  AND ADATB."Hallgato".HALLGATO_ID LIKE '.$_SESSION["felhasznalo"]["id"].' AND ADATB."Kurzus".KURZUS_ID LIKE '.$kurzus_id;
echo $ora_id_select;
$ora_params = lekerdez($ora_id_select);

global $ora_id;
$ora_id = 0;

while ($record = oci_fetch_array($ora_params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
   $ora_id = $record["ORA_ID"];
   echo $ora_id;
}
close($ora_params[0], $ora_params[1]);
//header("Location: hiba.php?id=$ora_id");
//if ( $ora_id === 0 ){
//    header("Location: hiba.php?id=$ora_id");
//}

//$delete1 = 'DELETE FROM ADATB."Hallgato_Ora"
//           WHERE ADATB."Hallgato_Ora"."ho_Ora_id" = '.$ora_id.'
//           AND ADATB."Hallgato_Ora"."ho_Hallgato_id" = '.$_SESSION["felhasznalo"]["id"];
//
//excecute($delete1);
//
//$delete2 = 'DELETE FROM ADATB."Hallgato_Kurzus" WHERE ADATB."Hallgato_Kurzus"."hk_Kurzus_id" = '.$_POST["kurzus_id"].'
//           AND ADATB."Hallgato_Kurzus"."hk_Hallgato_id" = '.$_SESSION["felhasznalo"]["id"];
//
//excecute($delete2);
//
//
//header("Location: h_kurzus_page.php");

