<?php
session_start();
include_once('../../../functions/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Órarend</title>
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


<div class="adatok">
    <?php

    $table =array();
    $ora = 8;
    for ($i = 0; $i < 13; $i++){
        $nap = 1;
        for($j = 0; $j < 5; $j++) {

            $conn = oci_connect('adatb', 'adatb', 'localhost/XE');
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }

            $stid = oci_parse($conn, 'begin :r := orarend_fun2(:n, :o, :h); end;');
            oci_bind_by_name($stid, ':n', $nap);
            oci_bind_by_name($stid, ':o', $ora);
            oci_bind_by_name($stid, ':h', $_SESSION["felhasznalo"]["id"]);
            oci_bind_by_name($stid, ':r', $r, 501);

            oci_execute($stid);
            global $table;
            $table[$i][$j] = $r;
            oci_free_statement($stid);
            oci_close($conn);

            $nap++;
        }
        $ora++;
    }

    echo '<div id="alcim"></div>';
    echo '<table> <tr><th>Óra</th> <th>Hétfő</th> <th>Kedd</th> <th>Szerda</th> <th>Csütörtök</th> <th>Péntek</th> </tr>';
    $ora = 8;
    for ($i = 0; $i < 13; $i++) {
        echo '<tr>';
        echo '<td>';
        echo $ora.':00';
        echo '</td>';
        for ($j = 0; $j < 5; $j++) {
            if($table[$i][$j] !== 'Nincs ora' ) {
                $tmp = explode('/',$table[$i][$j]);
                echo '<td>';
                echo '<b>'.$tmp[1].' ('.$tmp[0].')</b><br>'
                    .$tmp[2].'<br>'
                    .$tmp[3].', '.$tmp[4].'<br>
                    Óraszám: '.$tmp[5];
                echo '</td>';
            } else {
                $tmp = '';
                echo '<td>';
                echo $tmp;
                echo '</td>';
            }
        }
        echo '</tr>';
        $ora++;
    }

    echo '</table>';
    ?>
</div>
        </div>
    </div>
</div>
</body>
</html>
