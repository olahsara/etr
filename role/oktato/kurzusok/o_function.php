<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hallgatók száma</title>
    <link rel="stylesheet" href="../../../style/egesz.css"/>
</head>
<body>
<div class="page">
    <div class="pageHeader">
        <img src="../../../style/kep.jpg" alt="Neptunusz" width="950" height="300">
        <div>
            <?php include_once('../../../nav/nav_bar.php');?>
        </div>
        <div class="pageContent">
            <div style="margin-top: 100px">
                <?php if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'oktato' && $_SERVER['REQUEST_METHOD'] === 'POST'){

                    include_once('../../../functions/functions.php');
                    //az érték átvétele
                    $kurzus = $_POST['kurzus'];

                    //a lekérdezés megalkotás | A FROM dual az azért kell hogy csak egszer adja vissza az eredményt
                    // count_hallgato_by_felev('.$FELEV.') a függvényhvás + paraméter átadás
                    // AS "DATA" későbbi hivatkozás miatt elnevezzük
                    $select = 'SELECT count_hallgato_by_kurzus('.$kurzus.') AS "DATA" FROM dual';
                    //simpla lekerdez
                    $params = lekerdez($select);





                    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
                        // ugyanúgy lehet elérni az értékeket mint egy sima select-nél a tarolt gyakorlatilag tényleg egy táblát ad vissza
                        echo ('<p>A választott kódú kurzus hallgatói összlétszáma '.$record["DATA"].'</p>');
                    }





                    close($params[0], $params[1]);
                    ?>

                <?php } ?>
                <div> <a class="link" href="o_kurzus_page.php">Vissza</a> </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
Footer
© 2023 GitHub, Inc.
Footer navigation
Terms
Privacy
Security
Status
Docs
Contact GitHub
Pricing
API
Training
Blog
About
etr/a_function1.php at master · olahsara/etr

