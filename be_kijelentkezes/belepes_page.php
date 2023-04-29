<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bejelentkezés</title>

    <link rel="stylesheet" href="../style/egesz.css"/>
</head>
<body>
<div class="page">
    <div class="pageHeader">
        <img src="../style/kep.jpg" alt="Neptunusz" width="950" height="300">

        <div class="pageContent">
    <!-- MENU -->
<!--    <div class="menu">-->
<!--        <ul>-->
<!--            <li><a href="../index.php">Kezdőlap</a></li>-->
<!--            --><?php //if(isset($_SESSION["felhasznalo"]) ){ ?>
<!--            <li><a href="kijelentkezes.php">Kijelentkezés</a></li>-->
<!--            --><?php //} else { ?>
<!--            <li><a  class="active" href="belepes.php">Bejelentkezés</a></li>-->
<!--            --><?php //}?>
<!--        </ul>-->
<!--    </div>-->

    <!-- Bejelentkező űrlap -->

    <div class="login_form">
        <div id="alcim">Bejelentkezés</div>
        <form action="belepes.php" method="POST" accept-charset="utf-8">
            <label class="f_label">Neptun kód:
                <input type="text" name="neptun" required />
            </label>
            <br>
            <label class="f_label">Jelszó:
                <input type="password" name="password" required/>
            </label>
            <br>
            <label class="f_label">Felhasználó típusa:
                <select class="role" name="role" required>
                    <option class="role" value="hallgato">Hallgató</option>
                    <option class="role" value="oktato">Oktató</option>
                    <option class="role" value="admin">Admin</option>
                </select>
            </label>
            <br>
            <input class="kuld" type="submit" value="Belépés"/>
        </form>
    </div>

        </div>
    </div>
</div>
</body>
</html>