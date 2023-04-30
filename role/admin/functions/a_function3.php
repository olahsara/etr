<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>function3</title>
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
            <div>
                <?php if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'admin' && $_SERVER['REQUEST_METHOD'] === 'POST'){

                    include_once('../../../functions/functions.php');
                    $FELEV= $_POST['FELEV'];

                    $select = 'SELECT get_kurzus_by_felev('.$FELEV.') AS "DATA" FROM dual';

                    $params = lekerdez($select);



                    while ($record = oci_fetch_array($params[0], OCI_ASSOC + OCI_RETURN_NULLS)) {
                        echo ('<h3>A  '.$FELEV.'. félév ajánlott tárgyai: '.$record["DATA"].'</h3>');
                    }





                    close($params[0], $params[1]);
                    ?>

                <?php } ?>
                <div> <a class="link" href="a_functions_page.php">Vissza</a> </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

