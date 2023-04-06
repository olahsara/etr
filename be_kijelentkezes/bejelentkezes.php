<?php
session_start();
include_once("../functions/functions.php");
$neptun = $_POST['neptun'];
$password = $_POST['password'];

$select = 'SELECT ADATB."Hallgato".HALLGATO_NEV AS "nev", ADATB."Hallgato".JELSZO AS "jelszo", "ADATB"."Hallgato".NEPTUN_KOD AS "neptun", ADATB."Hallgato".FELEV AS "felev", ADATB."Hallgato".HALLGATO_ID AS "id" FROM ADATB."Hallgato"';

$params = lekerdez($select);

while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
    if(strtolower($record["neptun"]) === strtolower($neptun) && $record["jelszo"]  === $password) {
        $_SESSION["felhasznalo"] = $record;
        $siker = "true";
        close($params[0], $params[1]);
    }
}
if ( $siker !== "true"){
    die("Nincs ilyen felhasználó!");
}

header("Location: ../index.php");


