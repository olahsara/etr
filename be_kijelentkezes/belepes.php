<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="../style/bejelentkezes.css"/>
    <link rel="stylesheet" href="../style/menu.css"/>
</head>
<body>
    <!-- MENU -->
    <div class="menu">
        <ul>
            <li><a href="../index.php">Kezdőlap</a></li>
            <?php if(isset($_SESSION["felhasznalo"]) ){ ?>
            <li><a href="kijelentkezes.php">Kijelentkezés</a></li>
            <?php } else { ?>
            <li><a  class="active" href="bejelentkezes.php">Bejelentkezés</a></li>
            <?php }?>
            <li><a href="../select/selectpage.php">Lekérdezések</a></li>
        </ul>
    </div>

    <!-- Bejelentkező űrlap -->
    <div>
        <form action="bejelentkezes.php" method="POST" accept-charset="utf-8">
            <label class="f_label">Neptun kód:</label>
            <input class="f_input" type="text" name="neptun" placeholder="Neptun kód" required />
            <br>
            <label class="f_label">Jelszó:</label>
            <input class="f_input" type="password" name="password" required/>
            <br>
            <input class="kuld" type="submit" value="Belépés"/>
        </form>
    </div>


</body>
</html>