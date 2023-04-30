<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fórum</title>
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
                <?php if(isset($_SESSION["felhasznalo"]) && $_SESSION["felhasznalo"]["role"] === 'admin' ){

                        echo ('
                                    <p>Hallgató szám lekérése félév alapján</p>
                                    <form action="a_function1.php" method="post">
                                        <tr>
                                            <td>
                                                <input type="text" name="FELEV" id="FELEV">
                                            </td>
                                            
                                            <td>
                                                <input class="submit" type="submit" value="Search Users">
                                            </td>
                                            </tr>
                                    </form>');


                } ?>


            </div>
        </div>
    </div>
</div>
</body>
</html>