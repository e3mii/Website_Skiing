<?php
$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = getcwd();
include './zaglavlje.php';
include './phpscripts/materijaliProcedure.php';
?>

<!DOCTYPE html>

<html lang = "hr">
    <head>
        <title>Matrijali korisnika</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="datum" content="25.03.2021">
        <meta name="autor" content="Emanuel Radotović">
        <meta name="keywords" content="materijali video slika pdf">
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
            if (isset($_GET['idIZLET'])) {
                $idIZLET = $_GET['idIZLET'];
                $_SESSION['idIZLET'] = $idIZLET;
            }
            ?>
        </div>

        <section>
            <div class="rss">
                <a href="./phpscripts/rss.php"> <img src="multimedija/800px-Feed-icon.svg.png" alt="rss logo" width="30" height="30"/></a>
            </div>
            <h2>MATERIJALI KORISNIKA</h2>
            <?php
            if (isset($_SESSION['korisnik'])) {
                $idIZLET = $_SESSION['idIZLET'];
                $veza = new Baza();
                $veza->spojiDB();

                $upitIDkorisnik = "SELECT korisnik_id FROM korisnik WHERE korisnicko_ime = '{$_SESSION['korisnik']}'";
                $rezultatUpitaID = $veza->selectDB($upitIDkorisnik);
                $IDkorisnikBAZA = $rezultatUpitaID->fetch_assoc();
                $IDkorisnikSTRING = $IDkorisnikBAZA['korisnik_id'];

                $IDkorisnikINT = (int) $IDkorisnikSTRING;
                $_SESSION['IDkorisnikINT'] = $IDkorisnikINT;

                $upitPostojanjaRez = "SELECT rezervacija_id, status_rez FROM rezervacija WHERE korisnik_korisnik_id = {$IDkorisnikINT} && izlet_izlet_id = '{$idIZLET}'";
                $rezultatPostojanjaRez = $veza->selectDB($upitPostojanjaRez);
                $postojanjeBAZA = $rezultatPostojanjaRez->fetch_assoc();
                if ($postojanjeBAZA !== null) {
                    $status_rez = $postojanjeBAZA['status_rez'];
                }
                $veza->zatvoriDB();
                if (isset($status_rez)) {
                    if ($status_rez !== 0) {
                        echo "<p>Vidimo da ste bili na izletu! Ovdje možete postaviti materijale:</p>"
                        . "<form id='noviMaterijal' method='post' name='unosRezervacije' action='" . $_SERVER['PHP_SELF'] . "'>"
                        . "<label for='nazivMaterijala'>Unesite naziv materijala:</label><br>"
                        . "<input type='text' id='nazivMaterijala' name='nazivMaterijala' size='102' maxlength='100' placeholder='Naziv materijala'><br><br>"
                        . "<label for='linkMaterijala'>Unesite poveznicu na materijal:</label><br>"
                        . "<input type='text' id='linkMaterijala' name='linkMaterijala' size='102' maxlength='100' placeholder='link...'><br><br>"
                        . "<label for='tipMaterijala'>Odaberite vrstu materijala:</label>"
                        . "<select name='tipMaterijala' id='tipMaterijala'>"
                        . "<option value='1'>Slika</option>"
                        . "<option value='2'>Video</option>"
                        . "<option value='3'>Audio</option>"
                        . "<option value='4'>PDF</option>"
                        . "</select><br><br>"
                        . "<input class='gumb' id='unosMaterijalaButton' name='submit' type='submit' value='Dodaj'>"
                        . "</form>";
                    }
                }
            }
            ?>
            <p class="podnaslovi">Materijali za izlet:</p>
            <div id="galerijaMaterijala">

            </div>
        </section>

        <footer>
            <p>Autor: <a href="autor.html">Emanuel Radotović</a></p>
            <p>&copy; 2021</p>
            <div>
                <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2020%2Fzadaca_04%2Feradotovi%2Fgalerija.php">
                    <img src="https://barka.foi.hr/WebDiP/2020/materijali/zadace/HTML5.png" alt="HTML5" height="39"/>
                </a>
                <a href="https://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2020%2Fzadaca_04%2Feradotovi%2Fcss%2Feradotovi.css&profile=css3svg&usermedium=all&warning=1&vextwarning=&lang=en">
                    <img src="https://barka.foi.hr/WebDiP/2020/materijali/zadace/CSS3.png" alt="CSS3" height="44"/>
                </a>
            </div>
        </footer>
    </body>
</html>
