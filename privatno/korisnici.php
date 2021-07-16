<?php
$putanja = dirname($_SERVER['REQUEST_URI'],2);
$direktorij = dirname(getcwd());
include '../zaglavlje.php';
?>

<!DOCTYPE html>
<html lang = "hr">
    <head>
        <title>Svi korisnici</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="datum" content="25.03.2021">
        <meta name="autor" content="Emanuel Radotović">
        <meta name="keywords" content="private sakriveno svi korisnici">
        <!--<link rel="stylesheet" type="text/css" href="css/eradotovi.css"/>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="../javascript/eradotovi_projekt.js"></script>
    </head>
    <body>
        <header>
            <h1><span style="color:skyblue;">S</span>KIplaner</h1>
            <h2>SVI KORISNICI</h2>
            <a href="../phpscripts/rss.php"> <img src="../multimedija/800px-Feed-icon.svg.png" alt="rss logo" width="30" height="30"/></a>
        </header>

        <?php
        include '../meni.php';
        ?>

        <section>
            <div>
                <h3>Popis svih korisnika</h3>
                <div> 
                        <input type="radio" id="korimeK" name="rad" value="Korisničko ime" checked>
                        <label for="korimeK">Korisničko ime</label>
                        <input type="radio" id="emailK" name="rad" value="Email">
                        <label for="emailK">Stanje računa</label>
                        <input id="SortiranjeButtonRSKK" name="SortiranjeButtonRSKK" type="button" value="Sortiraj">
                    </div>
                <div id="popis_svih_korisnika">
                    
                </div>
            </div>
            <div>
                <br>
                <span class="stranica_link" style="cursor:pointer; padding:6px; border:1px solid #ccc" id="1"><<</span>
                <span class="stranica_link" style="cursor:pointer; padding:6px; border:1px solid #ccc" id="2"><</span>
                <span class="stranica_link" style="cursor:pointer; padding:6px; border:1px solid #ccc" id="3">></span>
                <span class="stranica_link" style="cursor:pointer; padding:6px; border:1px solid #ccc" id="4">>></span>
            </div>
        </section>
        <footer>
            <p>Autor: <a href="autor.php">Emanuel Radotović</a></p>
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