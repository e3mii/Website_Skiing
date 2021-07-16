<?php
include './phpscripts/administracijaProcedure.php';

if (!isset($_SESSION["uloga"])) {
    header("Location: ./obrasci/prijava.php");
    exit();
} elseif (isset($_SESSION["uloga"]) && $_SESSION["uloga"] > "1") {
    header("Location: ./obrasci/prijava.php");
    exit();
}
?>

<!DOCTYPE html>

<html lang = "hr">
    <head>
        <title>Administracija</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="datum" content="25.03.2021">
        <meta name="autor" content="Emanuel Radotović">
        <meta name="keywords" content="administracija sustav admin">
        <link rel="stylesheet" type="text/css" href="css/eradotovi.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="javascript/eradotovi_projekt.js"></script>
    </head>
    <body>
        <header>
            <h1><span style="color:skyblue;">S</span>KIplaner</h1>
        </header>

        <div class="navigacija">
            <?php
            include 'meni.php';
            ?>
        </div>

        <section>
            <div class="rss">
                <a href="./phpscripts/rss.php"> <img src="multimedija/800px-Feed-icon.svg.png" alt="rss logo" width="30" height="30"/></a>
            </div>
            <h2>ADMINISTRACIJA</h2>
            <div class="tablica">
                <p class="podnaslovi">Popis korisnika:</p>
                <div> 
                    <input type="radio" id="prezimeKor" name="rad" value="Prezime korisnika" checked>
                    <label for="prezimeKor">Prezime korisnika</label>
                    <input type="radio" id="stanjeRac" name="rad" value="Stanje računa">
                    <label for="stanjeRac">Stanje računa</label>
                    <input class="gumb" id="SortiranjeButtonRSK" name="SortiranjeButtonRSK" type="button" value="Sortiraj">
                </div>
                <div id="rad_s_korisnicima">

                </div>
            </div>
            <div>
                <br>
                <span class="stranica_link" style="cursor:pointer; padding:6px; border:1px solid #ccc" id="1"><<</span>
                <span class="stranica_link" style="cursor:pointer; padding:6px; border:1px solid #ccc" id="2"><</span>
                <span class="stranica_link" style="cursor:pointer; padding:6px; border:1px solid #ccc" id="3">></span>
                <span class="stranica_link" style="cursor:pointer; padding:6px; border:1px solid #ccc" id="4">>></span>
            </div>

            <br><br>

            <div>
                <p class="podnaslovi">Konfiguracija sustava:</p>
                <form id="konfiguracija" method="post" name="konfiguracija" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <label for="brRedaka">Koliko želite imate redaka u tablicama:</label>
                    <input type="text" id="brRedaka" name="brRedaka" size="10" maxlength="10" placeholder="Broj redaka..."><br><br>
                    <label for="brPrijava">Postavite novi broj neuspješnih prijava prije blokiranja korisničkih računa:</label>
                    <input type="text" id="brPrijava" name="brPrijava" size="10" maxlength="10" placeholder="Broj redaka..."><br><br>
                    <input class="gumb" id="konfigSave" name="submit" type="submit" value="Spremi konfiguracije">
                </form>
                <br><br>
                <form id="virtualnoVrijeme" method="post" name="virtualnoVrijeme" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <label for="brPrijava">Postavite novo virtualno vrijeme klikom na gumb "Postavi vrijeme", a spremite na "Spremi":</label>
                    <input class="gumb" type="button" onClick="window.open('http://barka.foi.hr/WebDiP/pomak_vremena/vrijeme.html')" id="promjeniVrijemeButton" name="promjeniVrijemeButton" value="Postavi vrijeme">
                    <input class="gumb" type="submit" id="postaviVrijemeButton" name="postaviVrijemeButton" value="Spremi">
                </form>
            </div>
            <br><br>
        </section>
        <footer>
            <p>Autor: <a href="autor.html">Emanuel Radotović</a></p>
            <p>&copy; 2021</p>
            <div>
                <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2020%2Fzadaca_04%2Feradotovi%2Findex.php">
                    <img src="https://barka.foi.hr/WebDiP/2020/materijali/zadace/HTML5.png" alt="HTML5" height="39"/>
                </a>
                <a href="https://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2020%2Fzadaca_04%2Feradotovi%2Fcss%2Feradotovi.css&profile=css3svg&usermedium=all&warning=1&vextwarning=&lang=en">
                    <img src="https://barka.foi.hr/WebDiP/2020/materijali/zadace/CSS3.png" alt="CSS3" height="44"/>
                </a>
            </div>
        </footer>
    </body>
</html>