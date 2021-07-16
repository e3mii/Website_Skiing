<?php

$putanja = dirname($_SERVER['REQUEST_URI'],2);
$direktorij = dirname(getcwd());
include '../zaglavlje.php';
$veza = new Baza();
$veza->spojiDB();
$upit = "SELECT CONCAT(rezervacija.ime_rez,' ',rezervacija.prez_rez) AS ime_prezime, rezervacija.br_rez_mjesta, izlet.naziv_izleta, skijaliste.naziv_skijalista "
        . "FROM rezervacija INNER JOIN izlet ON izlet.izlet_id = rezervacija.izlet_izlet_id INNER JOIN skijaliste ON skijaliste.skijaliste_id = izlet_izlet_id ORDER BY skijaliste.naziv_skijalista LIMIT 10";
$rezultat = $veza->selectDB($upit);

header("Content-type: text/xml");

echo "<?xml version='1.0' encoding='UTF-8'?>
 <rss version='2.0'>
 <channel>
 <title>Dodani podaci</title>
 <link>/</link>
 <description>Ovdje se nalaze podaci iz tablice DZ4_igra</description>
 <language>hr</language>";

while ($row = mysqli_fetch_array($rezultat)) {
    $ime_prezime = $row['ime_prezime'];
    $br_rez_mjesta = $row['br_rez_mjesta'];
    $naziv_izleta = $row['naziv_izleta'];
    $naziv_skijalista = $row['naziv_skijalista'];

    echo "<item>
            <ime_i_prezime>$ime_prezime</ime_i_prezime>
            <rezrvirana_mjesta>$br_rez_mjesta</rezrvirana_mjesta>
            <naziv_izleta>$naziv_izleta</naziv_izleta>
            <naziv_skijalista>$naziv_skijalista</naziv_skijalista>
            </item>";
}
echo "</channel></rss>";

$veza->zatvoriDB();
?>