<script>
    if (window.location.protocol == "http:") {
        window.location.protocol = "https:";
    }
</script>
<?php
include '../phpscripts/prijavaProcedure.php';
?>

<!DOCTYPE html>

<html lang = "hr">
    <head>
        <title>Stranica prijave</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="datum" content="27.03.2021">
        <meta name="autor" content="Emanuel Radotović">
        <meta name="keywords" content="prijava login zaboravljena lozinka">
        <link rel="stylesheet" type="text/css" href="../css/eradotovi.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="../javascript/eradotovi_projekt.js"></script>
    </head>
    <body>
        <header>
            <h1><span style="color:skyblue;">S</span>KIplaner</h1>
        </header>

        <div class="navigacija">
            <?php
            include '../meni.php';
            ?>
        </div>

        <section>
            <div class="rss">
                <a href="../phpscripts/rss.php"> <img src="../multimedija/800px-Feed-icon.svg.png" alt="rss logo" width="30" height="30"/></a>
            </div>
            <h2>STRANICA ZA PRIJAVU</h2>
            <p class="podnaslovi">Pijavite se:<p>
            <div style="color:red;">
                <?php
                if (isset($poruka)) {
                    echo "<p>$poruka</p>";
                }
                ?>
            </div>
            <div>
                <form novalidate id="prijava" method="get" name="prijava" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <label for="korimeP">Korisničko ime:</label><br>
                    <input type="text" id="korimeP" name="korimeP" size="32" maxlength="30" autofocus="autofocus" placeholder="Korisničko ime"
                    <?php
                    if (isset($_COOKIE['korimeP'])) {
                        echo "value=\"{$_COOKIE['korimeP']}\"";
                    }
                    ?>>
                           <?php
                           if (isset($greskaKorimeP)) {
                               echo "<p style=\"color:red; display:inline;\">$greskaKorimeP</p>";
                           }
                           ?>
                    <br>
                    <br>
                    <label for="lozinkaP">Lozinka:</label><br>
                    <input type="password" id="lozinkaP" name="lozinkaP" size="32" maxlength="30" placeholder="Lozinka">
                    <?php
                    if (isset($greskaLozinkaP)) {
                        echo "<p style=\"color:red; display:inline;\">$greskaLozinkaP</p>";
                    }
                    ?><br><br>
                    <label for="checkboxP">Zapamti me:</label>
                    <input type="checkbox" id="checkboxP" name="checkboxP"><br><br>
                    <input class="gumb" id="prijavaButton" name="submit" type="submit" value="Prijavi se"><br><br>
                    <p id="zaboravljenaLozinka" style="display:inline; cursor:pointer;">Zaboravili ste lozinku?</p>
                    <!--<div id="testiranje">
                        <br>
                        <a style="padding:5px" href="../phpscripts/prijavaKorisnik.php">Prijava korisnik</a>
                        <a style="padding:5px" href="../phpscripts/prijavaModerator.php">Prijava moderator</a>
                        <a style="padding:5px" href="../phpscripts/prijavaAdmin.php">Prijava admin</a>
                    </div>-->
                </form>
            </div>
        </section>
        <footer>
            <p>Autor: <a href="../autor.html">Emanuel Radotović</a></p>
            <p>&copy; 2021</p>
            <div>
                <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2020%2Fzadaca_04%2Feradotovi%2Fobrasci%2Fprijava.php">
                    <img src="https://barka.foi.hr/WebDiP/2020/materijali/zadace/HTML5.png" alt="HTML5" height="39"/>
                </a>
                <a href="https://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2020%2Fzadaca_04%2Feradotovi%2Fcss%2Feradotovi.css&profile=css3svg&usermedium=all&warning=1&vextwarning=&lang=en">
                    <img src="https://barka.foi.hr/WebDiP/2020/materijali/zadace/CSS3.png" alt="CSS3" height="44"/>
                </a>
            </div>
        </footer>
    </body>
</html>
