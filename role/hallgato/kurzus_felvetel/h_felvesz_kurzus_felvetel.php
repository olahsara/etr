<?php
//-----------------------------------------------------------------------------
//  Ha felvesz a hallgató egy kurzust bekerül egy új rekord a:               ||
//      -Hallgato-Kurzus-ba:                                                 ||
//          session-ben lévő hallgató id-je, kiválasztott kurzus id-je       ||
//      -Hallgato-Ora-ba:                                                    ||
//          session-ben lévő hallgató id-je, kiválasztott időpont ora id-je  ||
//-----------------------------------------------------------------------------

session_start();
include_once('../../../functions/functions.php');

$insert= 'INSERT INTO "Hallgato_Kurzus" ("hk_Hallgato_id", "hk_Kurzus_id") 
          VALUES (\''.$_SESSION["felhasznalo"]["id"].'\',\''.$_POST["kurzus_id"].'\')';
$params = lekerdez($insert); //$params[0] = $stid, $params[1] = $conn

oci_commit($params[1]);

close($params[0], $params[1]);

$insert2= 'INSERT INTO "Hallgato_Ora" ("ho_Hallgato_id", "ho_Ora_id") 
           VALUES (\''.$_SESSION["felhasznalo"]["id"].'\',\''.$_POST["kurzus_id"].'\')';
$params2 = lekerdez($insert2);

oci_commit($params2[1]);

close($params2[0], $params2[1]);

//--------------------------------------------------------------------------------------------
//  Értesítés küldése a hallgatónak kurzusfelvétel után                                     ||
//      -Ertesites táblába:                                                                 ||
//          Üzenet a sikeres kurzusfelvételről (kurzus neve az üzenetben), Aktuális időpont ||
//                                                                                          ||
//  Értesítés hozzákötése a megfelelő hallgatóhoz:                                          ||
//      -Hallgato_Ertsites táblába:                                                         ||
//          Hallgato_id a sessionben lévő hallgató id-je                                    ||
//          Ertesites_id: lekérni a $date és $message alapján megkeresett értesités id-ját  ||
//--------------------------------------------------------------------------------------------

$uzenet = 'Sikeresen felvetted a(z) '.$_POST["kurzus_nev"].' kurzust!';
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

header("Location: h_kurzus_felvetel_page.php");