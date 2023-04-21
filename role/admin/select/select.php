<head>
    <meta charset="utf8">
    <title>Lekérdezés</title>
    <link rel="stylesheet" href="../../../style/select.css"/>
</head>
<?php
include_once('../../../functions/functions.php');

//főoldalon megnyomott gomb lekérése
$selected = $_POST['table'];



switch ($selected){
    case 'szak_diploma' :
        //SQL lekérdezés beállítása
        $select = 'SELECT "Szak".SZAK_NEV AS "Szak nev",
                   count("Diploma".DIPLOMA_ID) AS "Kiadott diplomak szama"
                   FROM "Diploma","Szak_Diploma","Szak"
                   WHERE "Diploma".DIPLOMA_ID = "Szak_Diploma"."Diploma_id" AND "Szak_Diploma"."Szak_id"="Szak".SZAK_ID
                   GROUP BY "Szak".SZAK_NEV';

        //Csatlakozás az adatbázishoz és lekérdezés az adatbázisból
        $params = lekerdez($select);

        //Rekordok kiiratása táblázatban
        echo '<table> <tr> <th >Szak neve</th> <th>Diplomák száma</th> </tr>';
        while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo sprintf('<tr><td>%s</td><td>%s</td></tr>', $record['Szak nev'], $record['Kiadott diplomak szama']);
        }
        //vissza link
        echo '</table> <div> <a class="link" href="a_select_page.php">Vissza</a> </div>';

        //Kapcsolat lezárása
        close($params[0], $params[1]);
        break;

    case 'ttik_szak' :
        $select = 'SELECT "Szak".SZAK_NEV AS "TIKK szakok"
                   FROM "Kar","Szak_Kar","Szak"
                   WHERE "Kar".KAR_ID="Szak_Kar"."Kar_id" AND "Szak_Kar"."Szak_id"="Szak".SZAK_ID AND "Kar".KAR_KOD = \'TTIK\'';

        $params = lekerdez($select);

        echo '<p>A TTIK-en megtalálható szakok:</p>';
        while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo sprintf('<p style="font-weight: normal;">%s,</p>', $record['TIKK szakok']);
        }
        echo '<div> <a class="link" href="a_select_page.php">Vissza</a> </div>';

        close($params[0], $params[1]);
        break;

    case 'kar_hallgato' :
        $select = 'SELECT "Kar".KAR_NEV AS "Szak",
                   count("Hallgato".HALLGATO_ID) AS "Hallgatok szama"
                   FROM "Hallgato","Szak","Kar","Hallgato_Szak","Szak_Kar"
                   WHERE "Hallgato".HALLGATO_ID = "Hallgato_Szak"."Hallgato_id" AND "Hallgato_Szak"."Szak_id" = "Szak".SZAK_ID 
                         AND "Szak".SZAK_ID = "Szak_Kar"."Szak_id" AND "Szak_Kar"."Kar_id" = "Kar".KAR_ID
                   GROUP BY "Kar".KAR_NEV';

        $params = lekerdez($select);

        echo '<table> <tr> <th >Kar neve</th> <th>Hallgatók száma</th> </tr>';
        while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo sprintf('<tr><td>%s</td><td>%s</td></tr>', $record['Szak'], $record['Hallgatok szama']);
        }

        echo '</table> <div> <a class="link" href="a_select_page.php">Vissza</a> </div>';

        close($params[0], $params[1]);
        break;

    case 'kurzus_uzenetek' :
        $select = 'SELECT "Kurzus".KURZUS_NEV AS "Kurzus neve",
                   "Forum".UZENET AS "Uzenet" FROM "Kurzus","Kuzus_Forum","Forum"
                   WHERE "Kurzus".KURZUS_ID = "Kuzus_Forum"."Kurzus_id" 
                   AND "Kuzus_Forum"."Forum_id" = "Forum".UZENET_ID';

        $params = lekerdez($select);

        echo '<table> <tr> <th >Kurzus neve</th> <th> Üzenet</th> </tr>';
        while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo sprintf('<tr><td>%s</td><td>%s</td></tr>', $record['Kurzus neve'], $record['Uzenet']);
        }

        echo '</table> <div> <a class="link" href="a_select_page.php">Vissza</a> </div>';

        close($params[0], $params[1]);
        break;

    case 'teremhasznaltsag' :
        $select = 'SELECT "Terem".TEREM_NEV AS "Terem neve", "Ora".NAP AS "Nap","Ora".ORA AS "Ora" 
                   FROM "Kurzus","Terem","Ora","Kuzus_Ora","Kuzus_Terem"
                   WHERE "Terem".TEREM_ID = "Kuzus_Terem"."Terem_id" AND "Kuzus_Terem"."Kurzus_id"="Kuzus_Ora"."Kurzus_id"
                   AND "Kurzus".KURZUS_ID = "Kuzus_Ora"."Kurzus_id" AND "Kuzus_Ora"."Ora_id"="Ora".ORA_ID
                   ORDER BY NAP,ORA';

        $params = lekerdez($select);

        echo '<table> <tr> <th >Terem neve</th> <th>Nap</th> <th>Óra</th> </tr>';
        while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo sprintf('<tr><td>%s</td><td>%s</td><td>%d</td></tr>', $record['Terem neve'],getday($record['Nap']), $record['Ora']);
        }

        echo '</table> <div> <a class="link" href="a_select_page.php">Vissza</a> </div>';

        close($params[0], $params[1]);
        break;
    case 'ertesites_zapor' :
        $select = 'SELECT "Hallgato".HALLGATO_NEV As "Hallgato neve", count("Ertesites".UZENET)  AS "ertesites_db"
                   FROM "Hallgato", "Hallgato_Ertesites", "Ertesites"
                   WHERE "Hallgato".HALLGATO_ID = "Hallgato_Ertesites"."Hallgato_id" 
                   AND "Hallgato_Ertesites"."Ertesites_id" = "Ertesites".ERTESITES_ID
                   HAVING COUNT("Ertesites".UZENET) > 1 GROUP BY "Hallgato".HALLGATO_NEV';

        $params = lekerdez($select);

        echo '<table> <tr> <th >Hallgató neve</th> <th>Értesítések száma</th> </tr>';
        while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo sprintf('<tr><td>%s</td><td>%d</td></tr>', $record['Hallgato neve'], $record['ertesites_db']);
        }

        echo '</table> <div> <a class="link" href="a_select_page.php">Vissza</a> </div>';

        close($params[0], $params[1]);
        break;
    case 'kedd_darabszam' :
        $select = 'SELECT "Hallgato".HALLGATO_NEV As "Hallgato neve", COUNT("Ora".ORA_ID) AS "Orak szama"
                   FROM "Hallgato", "Hallgato_Ora","Ora"
                   WHERE "Hallgato".HALLGATO_ID = "Hallgato_Ora"."Hallgato_id" AND "Hallgato_Ora"."Ora_id" = "Ora".ORA_ID
                   AND "Ora".NAP = 2 GROUP BY "Hallgato".HALLGATO_NEV';

        $params = lekerdez($select);

        echo '<table> <tr> <th >Hallgató neve</th> <th>Órák száma</th> </tr>';
        while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo sprintf('<tr><td>%s</td><td>%d</td></tr>', $record['Hallgato neve'], $record['Orak szama']);
        }

        echo '</table> <div> <a class="link" href="a_select_page.php">Vissza</a> </div>';

        close($params[0], $params[1]);
        break;
    case 'admin' :
        $select = 'SELECT * FROM "Admin"';

        $params = lekerdez($select);

        echo '<table> <tr> <th>ID</th> <th>Jelszó</th> </tr>';
        while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo sprintf('<tr><td>%d</td><td>%s</td></tr>', $record['ADMIN_ID'], $record['JELSZO']);
        }

        echo '</table> <div> <a class="link" href="a_select_page.php">Vissza</a> </div>';

        close($params[0], $params[1]);
        break;

    case 'mennyi_tanar' :
        $select = 'SELECT "Kar".KAR_NEV AS "Kar nev", COUNT("Oktato".OKTATO_ID) AS "Tanarok szama"
                   FROM "Oktato", "Oktato_Kar", "Kar" WHERE "Oktato".OKTATO_ID="Oktato_Kar"."Oktato_id"
                   AND "Oktato_Kar"."Kar_id" = "Kar"."KAR_ID" GROUP BY "Kar".KAR_NEV';

        $params = lekerdez($select);

        echo '<table> <tr> <th>Kar neve</th> <th>Tanárok száma</th> </tr>';
        while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo sprintf('<tr><td>%s</td><td>%d</td></tr>', $record['Kar nev'], $record['Tanarok szama']);
        }

        echo '</table> <div> <a class="link" href="a_select_page.php">Vissza</a> </div>';

        close($params[0], $params[1]);
        break;

    case 'inaktiv_tanarok' :
        $select = 'SELECT "Oktato".OKTATO_NEV AS "Oktato nev" FROM "Oktato","Oktato_Forum"
                   WHERE "Oktato".OKTATO_ID != "Oktato_Forum"."Oktato_id" GROUP BY "Oktato".OKTATO_NEV';

        $params = lekerdez($select);

        echo '<p>Tanárok akik még nem posztoltak a fórumra:</p>';
        while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo sprintf('<p style="font-weight: normal;">%s,</p>', $record['Oktato nev']);
        }
        echo '<div> <a class="link" href="a_select_page.php">Vissza</a> </div>';

        close($params[0], $params[1]);
        break;

    case 'vizsgak' :
        $select = 'SELECT "Hallgato".HALLGATO_NEV AS "Hallgato neve", "Kurzus".KURZUS_NEV AS "Kurzus neve",
                   "Vizsga".VIZSGA_IDOPONT AS "Vizsganak az idopontja", "Hallgato_Kurzus"."Erdem_jegy" AS "Megszerzett jegy"
                   FROM "Hallgato","Kurzus","Vizsga","Hallgato_Kurzus","Kuzus_Vizsga"
                   WHERE "Hallgato".HALLGATO_ID = "Hallgato_Kurzus"."Hallgato_id" AND "Hallgato_Kurzus"."Kurzus_id"="Kurzus".KURZUS_ID
                   AND "Kurzus".KURZUS_ID = "Kuzus_Vizsga"."Kurzus_id" AND "Kuzus_Vizsga"."Vizsga_id" = "Vizsga".VIZSGA_ID';

        $params = lekerdez($select);

        echo '<table><tr><th>Hallgató neve</th><th>Kurzus neve</th><th>Vizsga időpontja</th><th>Megszerzett jegy</th></tr>';
        while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo sprintf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%d</td></tr>',
                         $record['Hallgato neve'], $record['Kurzus neve'], $record['Vizsganak az idopontja'], $record['Megszerzett jegy']);
        }

        echo '</table> <div> <a class="link" href="a_select_page.php">Vissza</a> </div>';

        close($params[0], $params[1]);
        break;
    default:
        header("Location: a_select_page.php");
        break;
}








