<?php
include '../phpscripts/registracijaProcedure.php';
?>
<!DOCTYPE html>
<html lang = "hr">
    <head>
        <title>Stranica registracije</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="datum" content="27.03.2021">
        <meta name="autor" content="Emanuel Radotović">
        <meta name="keywords" content="registracija captcha korisničko ime">
        <link rel="stylesheet" type="text/css" href="../css/eradotovi.css"/>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
            <h2>STRANICA REGISTRACIJE</h2>
            <p class="podnaslovi">Registrirajte se:</p>
            <div>
                <form id="registracija" method="post" name="registracija" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <label for="imeR">Unesite svoje ime:</label><br>
                    <input type="text" id="imeR" name="imeR" size="32" maxlength="30" placeholder="Ime"><br><br>

                    <label for="prezimeR">Unesite svoje prezime:</label><br>
                    <input type="text" id="prezimeR" name="prezimeR" size="32" maxlength="30" placeholder="Prezime"><br><br>

                    <label for="korimeR">Unesite korisničko ime:</label><br>
                    <input type="text" id="korimeR" name="korimeR" size="32" maxlength="30" placeholder="Korisničko ime"><br><br>

                    <label for="emailR">Unesite e-mail adresu:</label><br>
                    <input type="email" id="emailR" name="emailR" size="32" maxlength="30" placeholder="ime.prezime@posluzitelj.xxx"><br><br>

                    <label for="lozinkaR">Unesite lozinku:</label><br>
                    <input type="password" id="lozinkaR" name="lozinkaR" size="32" maxlength="30" placeholder="Lozinka"><br><br>

                    <label for="lozinkapotvrda">Ponovite lozinku:</label><br>
                    <div id="potvrdaRINFO" style="color:red"></div>
                    <input type="password" id="lozinkapotvrda" name="lozinkapotvrda" size="32" maxlength="30" placeholder="Lozinka"><br><br>
                    <input class="gumb" id="registracijaButton" name="submit" type="submit" value="Registriraj se"><br><br>
                        <?php
                        if (isset($captchaGreska)) {
                            if (!empty($captchaGreska)) {
                                echo "<div style='color:red'><span>$captchaGreska</span></div>";
                            } else if ($provjeraCaptcha !== "true") {
                                echo "<div style='color:red'><span>$captchaGreska</span></div>";
                            }
                        }
                        ?>
                        <div class="g-recaptcha" data-sitekey="6LdpEwcbAAAAAEPsQrRvsvM6Atg8VsFCqZha_D9D"></div>
                </form>
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
