<?php

echo
"
        <nav class=\"stupac_1\">
            <ul>";
echo "<li><a href=\"$putanja/index.php\">Početna stranica</a></li>";
if (!isset($_SESSION["uloga"])) {
    echo "<li><a href=\"$putanja/obrasci/prijava.php\">Prijava</a></li>
          <li><a href=\"$putanja/obrasci/registracija.php\">Registracija</a></li>";
}
if (isset($_SESSION["uloga"]) && $_SESSION["uloga"] < 4) {
    echo "<li><a href=\"$putanja/rezervacija.php\">Rezervacija</a></li>";
}
if (isset($_SESSION["uloga"]) && $_SESSION["uloga"] < 3) {
    echo "<li><a href=\"$putanja/izletiRezervacije.php\">Izleti</a></li>";
}
if (isset($_SESSION["uloga"]) && $_SESSION["uloga"] < 2) {
    echo "<li><a href=\"$putanja/administracija.php\">Administracija</a></li>";
}

echo "<li><a href=\"$putanja/privatno/korisnici.php\">.HTACCESS</a></li>";
echo "<li><a href=\"$putanja/dokumentacija.html\">Dokumentacija</a></li>";

if (isset($_SESSION["uloga"])) {
    echo "<li><a href=\"$putanja/phpscripts/odjava.php\">ODJAVA</a></li>";
}

echo "</ul></nav>";

?>