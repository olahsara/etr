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
                        //Az érték bekérése és továbbküldése egy új oldalra hogy tudjuk használni
                        echo ('
                                    <p>Hallgató szám lekérése félév alapján</p>
                                    <form action="a_function1.php" method="post">
                                        <tr>
                                            <td>
                                                <label>Félév:</label>
                                                <input type="text" name="FELEV" id="FELEV">
                                            </td>
                                            
                                            <td>
                                                <input class="submit" type="submit" value="Search Users">
                                            </td>
                                            </tr>
                                    </form>');
                        //idáig
                    echo ('
                                    <p>Termek lekérése lekérése bizonyos férőhely felett</p>
                                    <form action="a_function2.php" method="post">
                                        <tr>
                                            <td>
                                            <label>Férőhely:</label>
                                                <input type="text" name="FEROHELY" id="FEROHELY">
                                            </td>
                                            
                                            <td>
                                                <input class="submit" type="submit" value="Search Classroom">
                                            </td>
                                            </tr>
                                    </form>');

                    echo ('
                                    <p>Kurzusok lekérése ajánlott félév alapján</p>
                                    <form action="a_function3.php" method="post">
                                        <tr>
                                            <td>
                                            <label>Félév:</label>
                                                <input type="text" name="FELEV" id="FELEV">
                                            </td>
                                            
                                            <td>
                                                <input class="submit" type="submit" value="Search Course">
                                            </td>
                                            </tr>
                                    </form>');
                 echo ('
                <p>Diplomák számának lekérése bizonyos évben bizonyos zv-jeggyel</p>
                <form action="a_function4.php" method="post">
                    <tr>
                        <td>
                        <label>Év:</label>
                            <input type="text" name="EV" id="EV">
                        </td>
                        <td>
                        <label>Zv-jegy:</label>
                            <input type="text" name="ZV" id="ZV">
                        </td>

                        <td>
                            <input class="submit" type="submit" value="Search Diploma">
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