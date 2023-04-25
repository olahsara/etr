<?php
session_start();
include_once('../../../functions/functions.php');

$ora_id_select = 'SELECT ADATB."Ora"."ORA_ID", Adatb."Hallgato".HALLGATO_ID, adatb."Kurzus".KURZUS_ID
                  FROM ADATB."Kuzus_Ora", ADATB."Hallgato_Ora", ADATB."Hallgato", ADATB."Kurzus", ADATB."Ora"
                  WHERE ADATB."Kuzus_Ora"."ko_Kurzus_id" = ADATB."Kurzus".KURZUS_ID AND ADATB."Kuzus_Ora"."ko_Ora_id" = ADATB."Ora".ORA_ID
                  AND ADATB."Hallgato".HALLGATO_ID = ADATB."Hallgato_Ora"."ho_Hallgato_id" AND ADATB."Ora".ORA_ID = ADATB."Hallgato_Ora"."ho_Ora_id"';

$ora_params = lekerdez($ora_id_select);

$ora_id = 0;

while ($record = oci_fetch_array($ora_params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
    if( $_SESSION["felhasznalo"]["id"] ===  $record['HALLGATO_ID'] && $_POST["kurzus_id"] === $record['KURZUS_ID']){
        global $ora_id;
        $ora_id = $record['ORA_ID'];
    }
}
close($ora_params[0], $ora_params[1]);

if ( $ora_id === -1 ){
    header("Location: hiba.php?id=$ora_id");
}

$delete = 'DELETE FROM ADATB."Hallgato_Ora" 
           WHERE ADATB."Hallgato_Ora"."ho_Ora_id" = '.$ora_id.'
           AND ADATB."Hallgato_Ora"."ho_Hallgato_id" = '.$_SESSION["felhasznalo"]["id"].' ';

$params = lekerdez($delete);

oci_commit($params[1]);

close($params[0], $params[1]);

$delete = 'DELETE FROM ADATB."Hallgato_Kurzus" WHERE ADATB."Hallgato_Kurzus"."hk_Kurzus_id" = '.$_POST["kurzus_id"].'
           AND ADATB."Hallgato_Kurzus"."hk_Hallgato_id" = '.$_SESSION["felhasznalo"]["id"].' ';

$params = lekerdez($delete);

oci_commit($params[1]);

close($params[0], $params[1]);

//--------------------------------------------------------------------------------------------
//  Értesítés küldése a hallgatónak kurzusleadás után                                       ||
//      -Ertesites táblába:                                                                 ||
//          Üzenet a sikeres kurzusleadásról (kurzus neve az üzenetben), Aktuális időpont   ||
//                                                                                          ||
//  Értesítés hozzákötése a megfelelő hallgatóhoz:                                          ||
//      -Hallgato_Ertsites táblába:                                                         ||
//          Hallgato_id a sessionben lévő hallgató id-je                                    ||
//          Ertesites_id: lekérni a $date és $message alapján megkeresett értesités id-ját  ||
//--------------------------------------------------------------------------------------------

$uzenet = 'Sikeresen laedtad a(z) '.$_POST["kurzus_nev"].' kurzust!';
$date = date('Y-m-d H:i:s');

$ertesites = 'INSERT INTO "Ertesites" (ERTESITES_IDOPONT, UZENET) VALUES ( TO_DATE(\''.$date .'\',\'YYYY-MM-DD HH24:MI:SS\'),\''. $uzenet.'\') ';
$ertesites_params = lekerdez($ertesites);

oci_commit($ertesites_params[1]);

close($ertesites_params[0], $ertesites_params[1]);

$seged = 'SELECT ADATB."Ertesites".ERTESITES_ID FROM ADATB."Ertesites"
          WHERE ADATB."Ertesites".UZENET LIKE \''.$uzenet.'\' AND ADATB."Ertesites".ERTESITES_IDOPONT LIKE TO_DATE(\''.$date .'\',\'YYYY-MM-DD HH24:MI:SS\')';
$seged_params = lekerdez($seged);

$ertesites_id = -1;
while ($record = oci_fetch_array($seged_params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
    global $ertesites_id;
    $ertesites_id = $record['ERTESITES_ID'];
}
close($seged_params[0], $seged_params[1]);

$kapcsolati = 'INSERT INTO "Hallgato_Ertesites" ("he_Hallgato_id", "he_Ertesites_id") VALUES (\''.$_SESSION["felhasznalo"]["id"] .'\',\''. $ertesites_id.'\') ';
$kapcsolati_params = lekerdez($kapcsolati);

oci_commit($kapcsolati_params[1]);

close($kapcsolati_params[0], $kapcsolati_params[1]);

header("Location: h_kurzus_page.php");

