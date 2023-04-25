<?php
session_start();
include_once('../../../functions/functions.php');
include_once ('../shared/hallgato_menu.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Értesítések</title>
    <link rel="stylesheet" href="../../../style/menu.css"/>
    <link rel="stylesheet" href="h_ertesites_style.css">
</head>
<body>

<div class="adatok">
    <?php
    $select = 'SELECT ADATB."Ertesites".UZENET, ADATB."Ertesites".ERTESITES_IDOPONT, ADATB."Hallgato".HALLGATO_ID
               FROM ADATB."Ertesites",ADATB."Hallgato",ADATB."Hallgato_Ertesites"
               WHERE ADATB."Hallgato".HALLGATO_ID = ADATB."Hallgato_Ertesites"."he_Hallgato_id" AND
               ADATB."Ertesites".ERTESITES_ID = ADATB."Hallgato_Ertesites"."he_Ertesites_id" 
               AND ADATB."Hallgato".HALLGATO_ID LIKE '.$_SESSION["felhasznalo"]["id"];

    $params = lekerdez($select);
    echo '<div id="alcim">Értesítések</div>';
    echo '<table xmlns="http://www.w3.org/1999/html"> <tr> <th>Üzenet</th> <th>Időpont</th></tr>';
    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo sprintf('<tr><td>%s</td><td>%s</td><td></td></tr>',
            $record['UZENET'], sajat_date($record['ERTESITES_IDOPONT']));
    }
    echo '</table>';

    close($params[0], $params[1]);
    ?>

</div>

</body>
</html>
