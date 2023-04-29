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

$insert2= 'INSERT INTO "Oktato_Forum" ("of_Oktato_id", "of_Forum_id") 
           VALUES (\''.$_SESSION["felhasznalo"]["id"].'\',\''.$uzenet_id.'\')';
$params2 = lekerdez($insert2);

oci_commit($params2[1]);

close($params2[0], $params2[1]);

$insert3= 'INSERT INTO "Kuzus_Forum" ("kf_Kurzus_id", "kf_Forum_id") 
           VALUES (\''.$_POST["kurzus_id"].'\',\''.$uzenet_id.'\')';
$params3 = lekerdez($insert3);

oci_commit($params3[1]);

close($params3[0], $params3[1]);



header("Location: o_szinter_page.php");