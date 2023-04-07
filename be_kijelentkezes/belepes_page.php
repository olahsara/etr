<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="../style/belepes.css"/>
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
            <li><a  class="active" href="belepes.php">Bejelentkezés</a></li>
            <?php }?>
            <li><a href="../select/select_page.php">Lekérdezések</a></li>
        </ul>
    </div>

    <!-- Bejelentkező űrlap -->
    <div>
        <form action="belepes.php" method="POST" accept-charset="utf-8">
            <label class="f_label">Neptun kód:
                <input class="f_input" type="text" name="neptun" required />
            </label>
            <br>
            <label class="f_label">Jelszó:
                <input class="f_input" type="password" name="password" required/>
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


</body>
</html>