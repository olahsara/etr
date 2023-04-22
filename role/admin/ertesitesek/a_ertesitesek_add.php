<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $IDOPONT = $_POST['IDOPONT'];
    $UZENET = $_POST['UZENET'];

    //INSERT INTO ADATB."Ertesites" (ERTESITES_IDOPONT, UZENET)
    //VALUES (TO_DATE('2022-05-22 16:40:55', 'YYYY-MM-DD HH24:MI:SS'), 'na rip');

    $mod = 'INSERT INTO "Ertesites" (ERTESITES_IDOPONT, UZENET)  VALUES'." ( TO_DATE('".$IDOPONT.  "', 'YYYY-MM-DD'),'".$UZENET."'  )";
    echo $mod;
    include_once('../../../functions/functions.php');

    excecute($mod);
    header("Location: a_ertesitesek_page.php");
}
?>