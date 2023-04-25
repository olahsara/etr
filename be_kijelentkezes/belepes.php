<?php
session_start();
include_once("../functions/functions.php");
$neptun = $_POST['neptun'];
$password = $_POST['password'];
$role = $_POST['role'];

switch ($role){
    case 'hallgato' :
        $select = 'SELECT ADATB."Hallgato".HALLGATO_NEV AS "nev", ADATB."Hallgato".JELSZO AS "jelszo", "ADATB"."Hallgato".NEPTUN_KOD AS "neptun", ADATB."Hallgato".FELEV AS "felev", ADATB."Hallgato".HALLGATO_ID AS "id" FROM ADATB."Hallgato"';

        $params = lekerdez($select);
        $siker = "false";

        while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
            if(strtolower($record["neptun"]) === strtolower($neptun) && $record["jelszo"]  === $password) {
                $_SESSION["felhasznalo"] = $record;
                $_SESSION["felhasznalo"]["role"] = $role;
                $siker = "true";
                close($params[0], $params[1]);
                break;
            }
        }
        if ( $siker !== "true"){
            die("Nincs ilyen hallgató!");
        }

        header("Location: ../index.php");
        break;
    case 'oktato':
        $select = 'SELECT ADATB."Oktato".OKTATO_NEV AS "nev", ADATB."Oktato".JELSZO AS "jelszo", "ADATB"."Oktato".NEPTUN_KOD AS "neptun", ADATB."Oktato".BEOSZTAS AS "beosztas", ADATB."Oktato".OKTATO_ID AS "id" FROM ADATB."Oktato"';

        $params = lekerdez($select);
        $siker = 'false';

        while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
            if(strtolower($record["neptun"]) === strtolower($neptun) && $record["jelszo"]  === $password) {
                $_SESSION["felhasznalo"] = $record;
                $_SESSION["felhasznalo"]["role"] = $role;
                $siker = "true";
                close($params[0], $params[1]);
            }
        }
        if ( $siker !== "true"){
            die("Nincs ilyen oktató!");
        }

        header("Location: ../index.php");
        break;
    case 'admin':
        $select = 'SELECT ADATB."Admin".ADMIN_ID AS "id", ADATB."Admin".JELSZO AS "jelszo" FROM ADATB."Admin"';

        $params = lekerdez($select);
        $siker = "false";

        while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
            if(strtolower($record["id"]) === strtolower($neptun) && $record["jelszo"]  === $password) {
                $_SESSION["felhasznalo"] = $record;
                $_SESSION["felhasznalo"]["role"] = $role;
                $siker = "true";
                close($params[0], $params[1]);
                break;
            }
        }
        if ( $siker !== "true"){
            die("Nincs ilyen admin!");
        }

        header("Location: ../index.php");
        break;
}



