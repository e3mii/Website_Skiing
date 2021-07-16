<?php
$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = getcwd();
include 'zaglavlje.php';
?>

<!DOCTYPE html>

<html lang = "hr">
    <head>
        <title>Početna stranica</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="datum" content="25.03.2021">
        <meta name="autor" content="Emanuel Radotović">
        <meta name="keywords" content="početna pregled izleta statistika">
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
            <h2>POČETNA STRANICA</h2>
            <div class="tablica">
                <p class="podnaslovi">Popis organiziranih izleta</p>
                <div> 
                    <input type="radio" id="nazivIzlet" name="izlet" value="Naziv izleta" checked>
                    <label for="nazivIzlet">Naziv izleta</label>
                    <input type="radio" id="nazivSkijaliste" name="izlet" value="Naziv skijalista">
                    <label for="nazivSkijaliste">Naziv skijališta</label>
                    <input class="gumb" id="SortiranjeButton" name="SortiranjeButton" type="button" value="Sortiraj">
                </div>
                <div id="izleti_pocetna">

                </div>
            </div>
            <div>
                <br>
                <span class="stranica_link" style="cursor:pointer; padding:6px; border:1px solid #ccc" id="1"><<</span>
                <span class="stranica_link" style="cursor:pointer; padding:6px; border:1px solid #ccc" id="2"><</span>
                <span class="stranica_link" style="cursor:pointer; padding:6px; border:1px solid #ccc" id="3">></span>
                <span class="stranica_link" style="cursor:pointer; padding:6px; border:1px solid #ccc" id="4">>></span>
            </div>

            <div class="tablica">
                <p class="podnaslovi">Statistika broja izleta po skijalištima:</p>
                <div id="statIzlet">

                </div>
            </div>
            <br>
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