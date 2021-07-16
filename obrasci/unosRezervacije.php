<?php
include '../phpscripts/rezervacijaProcedure.php';

if (!isset($_SESSION["uloga"])) {
    header("Location: ./prijava.php");
    exit();
}
?>

<!DOCTYPE html>

<html lang = "hr">
    <head>
        <title>Unos rezervacije</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="datum" content="27.03.2021">
        <meta name="autor" content="Emanuel Radotović">
        <meta name="keywords" content="rezervacija izlet broj mjesta">
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
            <h2>UNOS REZERVACIJE</h2>
            <p class="podnaslovi">Rezerviraj izlet:</p>
            <div>
                <form id="unosRezervacije" method="post" name="unosRezervacije" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <label for="imeRez">Unesite svoje ime:</label><br>
                    <input type="text" id="imeRez" name="imeRez" size="32" maxlength="30" placeholder="Ime" <?php
            if (isset($rezervacija_id) && isset($ime_rez) && isset($prez_rez) && isset($br_rez_mjesta)) {
                echo "value='$ime_rez'";
            }
            ?>><br><br>

                    <label for="prezimeRez">Unesite svoje prezime:</label><br>
                    <input type="text" id="prezimeRez" name="prezimeRez" size="32" maxlength="30" placeholder="Prezime" <?php
                    if (isset($rezervacija_id) && isset($ime_rez) && isset($prez_rez) && isset($br_rez_mjesta)) {
                        echo "value='$prez_rez'";
                    }
            ?>><br><br>

                    <label for="brMjestaRez">Unesite broj mjesta za rezervaciju:</label><br>
                    <input type="number" id="brMjestaRez" name="brMjestaRez" <?php
                    if (isset($rezervacija_id) && isset($ime_rez) && isset($prez_rez) && isset($br_rez_mjesta)) {
                        echo "value='$br_rez_mjesta'";
                    }
            ?>><br><br>

                    <?php
                    if (isset($rezervacija_id) && isset($ime_rez) && isset($prez_rez) && isset($br_rez_mjesta)) {
                        echo "<input class='gumb' id='unosRezButton' name='submit' type='submit' value='Promjeni'>";
                        echo "<input class='gumb' id='unosRezButton' name='obrisi' type='submit' value='Obriši'>";
                    } else {
                        echo "<input class='gumb' id='unosRezButton' name='submit' type='submit' value='Rezerviraj'>";
                    }
                    ?>
                </form>
                <br>
                <button class="gumb" id="odustaniOdRezButton" onClick="window.location.href = '../rezervacija.php'">Odustani</button>
            </div>
            <br>
            <div class="tablica">
                <p class="podnaslovi">Ostali korisnici koji imaju rezervacije:</p>
                <div id="ostaleRezervacije">

                </div>
            </div>
        </section>
        <footer>
            <p>Autor: <a href="../autor.html">Emanuel Radotović</a></p>
            <p>&copy; 2021</p>
            <div>
                <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2020%2Fzadaca_04%2Feradotovi%2Fobrasci%2Fregistracija.php">
                    <img src="https://barka.foi.hr/WebDiP/2020/materijali/zadace/HTML5.png" alt="HTML5" height="39"/>
                </a>
                <a href="https://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2020%2Fzadaca_04%2Feradotovi%2Fcss%2Feradotovi.css&profile=css3svg&usermedium=all&warning=1&vextwarning=&lang=en">
                    <img src="https://barka.foi.hr/WebDiP/2020/materijali/zadace/CSS3.png" alt="CSS3" height="44"/>
                </a>
            </div>
        </footer>


    </body>
</html>

