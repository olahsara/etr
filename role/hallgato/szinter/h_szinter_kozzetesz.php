<?php
//-----------------------------------------------------------------------------
//  Ha a hallgató közzétesz egy üzenetet a kurzusfórumba egy új rekord kerül a: ||
//      -Forumba:                                                               ||
//          POST tömbben kapott adatok                                          ||
//      -Hallgato-Forum-ba:                                                     ||
//          session-ben lévő hallgató id-je, az új Forum rekord id-ja           ||
//      -Kuzus-Forum-ba:                                                        ||
//          POST-ban lévő kurzus id-je, az új Forum rekord id-ja                ||
//-----------------------------------------------------------------------------

session_start();
include_once('../../../functions/functions.php');
$uzenet_date=date('Y-m-d H:i:s');

$insert= 'INSERT INTO "Forum" ("UZENET", "UZENET_IDOPONT") 
          VALUES (\'' .$_POST["uzenet"]. '\', TO_DATE(\''.$uzenet_date.'\',\'YYYY-MM-DD HH24:MI:SS\'))';
$params = lekerdez($insert); //$params[0] = $stid, $params[1] = $conn

oci_commit($params[1]);

close($params[0], $params[1]);

$seged = 'SELECT ADATB."Forum".UZENET_ID FROM ADATB."Forum"
          WHERE ADATB."Forum".UZENET LIKE \''.$_POST["uzenet"].'\' AND ADATB."Forum".UZENET_IDOPONT LIKE TO_DATE(\''.$uzenet_date .'\',\'YYYY-MM-DD HH24:MI:SS\')';
$seged_params = lekerdez($seged);

$uzenet_id = -1;
while ($record = oci_fetch_array($seged_params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
    $uzenet_id = $record['UZENET_ID'];
}
close($seged_params[0], $seged_params[1]);

$insert2= 'INSERT INTO "Hallgato_Forum" ("hf_Hallgato_id", "hf_Forum_id") 
           VALUES (\''.$_SESSION["felhasznalo"]["id"].'\',\''.$uzenet_id.'\')';
$params2 = lekerdez($insert2);

oci_commit($params2[1]);

close($params2[0], $params2[1]);

$insert3= 'INSERT INTO "Kuzus_Forum" ("kf_Kurzus_id", "kf_Forum_id") 
           VALUES (\''.$_POST["kurzus_id"].'\',\''.$uzenet_id.'\')';
$params3 = lekerdez($insert3);

oci_commit($params3[1]);

close($params3[0], $params3[1]);

//--------------------------------------------------------------------------------------------
//  Értesítés küldése a hallgatónak kurzusfelvétel után                                     ||
//      -Ertesites táblába:                                                                 ||
//          Üzenet a sikeres közzétételről (kurzus neve az üzenetben), Aktuális időpont     ||
//                                                                                          ||
//  Értesítés hozzákötése a megfelelő hallgatóhoz:                                          ||
//      -Hallgato_Ertsites táblába:                                                         ||
//          Hallgato_id a sessionben lévő hallgató id-je                                    ||
//          Ertesites_id: lekérni a $date és $message alapján megkeresett értesités id-ját  ||
//--------------------------------------------------------------------------------------------

$uzenet = 'Hozzászoltál a(z) '.$_POST["kurzus_nev"].' fórumhoz!';
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

header("Location: h_szinter_page.php");